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

        $user = Auth::user();

        // Ensure user exists and is verified
        if (!$user->is_verified) {
            return redirect()
                ->route('auth.verify-otp', ['email' => $user->email])
                ->with('error', 'Please verify your account before proceeding.');
        }

        return $next($request);
    }
}
