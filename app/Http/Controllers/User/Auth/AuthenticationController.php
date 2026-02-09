<?php

namespace App\Http\Controllers\User\Auth;

use Log;
use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Mail\OtpMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    public function login()
    {
        return Inertia::render('AuthPage', [
            'type' => 'login'
        ]);
    }

    public function register()
    {
        return Inertia::render('AuthPage', [
            'type' => 'register'
        ]);
    }

    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\-\'\.]+$/', // Only allows letters, spaces, hyphens, apostrophes, and dots
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns', // Ensures valid domain (checks MX records)
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:64',
                'confirmed',
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'uuid' => (string) Str::uuid(),
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
            'last_otp_sent_at' => Carbon::now(),
            'is_active' => false,
        ]);


        // Log OTP
        Log::info('User OTP', [
            'email' => $user->email,
            'otp' => $otp,
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('auth.verify-otp', ['email' => $user->email])
            ->with('success', 'Registration successful! Please check your email for the verification code.');
    }

    public function showVerifyOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->email_verified_at) {
            return Inertia::render('VerifyOtp', [
                'email' => $request->email
            ]);
        } else {
            return redirect()->route('auth.login')->with('info', 'Account already verified. Please login.');
        }
    }


    public function handleVerifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp || Carbon::now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'email_verified_at' => Carbon::now(),
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('account.load.accounts')->with('success', 'Email verified successfully! Please select your account type.');
    }

    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        if ($user->last_otp_sent_at && Carbon::parse($user->last_otp_sent_at)->addMinutes(1)->isFuture()) {
            return back()->withErrors(['otp' => 'Please wait a minute before requesting a new code.']);
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
            'last_otp_sent_at' => Carbon::now(),
        ]);

        Mail::to($user->email)->send(new OtpMail($otp));

        return back()->with('success', 'A new verification code has been sent to your email.');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();

            if (!$user->email_verified_at) {
                // Send a fresh OTP if expired or not set (respecting rate limits)
                $shouldSendOtp = !$user->otp || 
                    !$user->otp_expires_at || 
                    Carbon::now()->isAfter($user->otp_expires_at);
                
                $canSendOtp = !$user->last_otp_sent_at || 
                    Carbon::parse($user->last_otp_sent_at)->addMinutes(1)->isPast();

                if ($shouldSendOtp && $canSendOtp) {
                    $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                    $user->update([
                        'otp' => $otp,
                        'otp_expires_at' => Carbon::now()->addMinutes(10),
                        'last_otp_sent_at' => Carbon::now(),
                    ]);
                    
                    Mail::to($user->email)->send(new OtpMail($otp));
                }

                return redirect()->route('auth.verify-otp', ['email' => $user->email])
                    ->with('warning', 'Please verify your email address first. A verification code has been sent to your email.');
            }

            // Check if user has selected an account type
            if (!$user->roles()->exists()) {
                $request->session()->regenerate();
                return redirect()->route('account.load.accounts')
                    ->with('info', 'Please select your account type to continue.');
            }

            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showForgotPassword()
    {
        return Inertia::render('ForgotPassword');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);

        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('emails.forgot-password', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });

        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function showResetPassword(Request $request, $token)
    {
        return Inertia::render('ResetPassword', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $reset = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('auth.login')->with('success', 'Password reset successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
