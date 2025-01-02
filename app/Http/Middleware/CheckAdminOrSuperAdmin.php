<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminOrSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       // Cek apakah user sudah login
       if (!Auth::check()) {
        return redirect('/login');
    }

    // Cek apakah user memiliki role admin atau superadmin
    $user = Auth::user();
    if ($user->role == 'adminwisata' || $user->role == 'superadmin' || $user->role == 'user') {
        return $next($request); // Lanjutkan jika role sesuai
    }

    return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
