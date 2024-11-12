<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
         // Cek apakah pengguna sudah login dan memiliki peran yang sesuai
         if (Auth::check() && Auth::user()->role == $role) {
            return $next($request); // Lanjutkan ke rute selanjutnya jika role sesuai
        }

        // Jika pengguna tidak memiliki role yang benar, redirect ke halaman login atau error
        return redirect('/login')->with('error', 'You do not have access to this page.');
    }
}
