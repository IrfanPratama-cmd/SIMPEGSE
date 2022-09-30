<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Login gagal!, Silahkan cek email anda untuk verifikasi.');
        } elseif (Auth::user()->is_email_verified == null) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
