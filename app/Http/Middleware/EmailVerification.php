<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmailVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'Please log in to continue.');
        }

        // Get fresh user data from database (avoid stale cached data)
        $user = Auth::user()->fresh();

        // Ensure user exists and is verified
        if (!$user->email_verified_at) {
            return redirect()
                ->route('auth.verify-otp', ['email' => $user->email])
                ->with('error', 'Please verify your account before proceeding.');
        }

        // Ensure user has selected an account type (use exists() for efficiency)
        if (!$user->roles()->exists()) {
            return redirect()
                ->route('account.load.accounts')
                ->with('info', 'Please select your account type to continue.');
        }

        return $next($request);
    }
}
