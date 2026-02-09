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
        // check the user

        $user = Auth::user();

        if(auth()->check() && !$user->is_verified){
            // return back to verify otp
            return redirect()->route('auth.verify-otp')->with('error', 'Please verify your account.');
        }elseif(!$user){
            return redirect()->route('auth.login')->with('error', 'User not found'); 
        }
        return $next($request);
    }
}
