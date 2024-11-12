<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function proces_login(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required',
        'password' => 'required' 
    ]);

    // Ambil data email dan password dari request
    $data  = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    // Cek kredensial dengan Auth::attempt
    if (Auth::attempt($data)) {
        // Cek role apakah 'admin' atau 'superadmin'
        if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'adminwisata') {
            // Arahkan ke dashboard yang sama
            return redirect()->route('admin.adminDashboard'); // Dashboard yang sama untuk kedua role
        } else {
            // Jika role tidak sesuai
            return redirect()->route('login')->with('failed', 'Anda tidak memiliki akses ke halaman ini.');
        }
    } else {
        // Jika kredensial salah
        return redirect()->route('login')->with('failed', 'Email atau Password salah !!!');
    }
}

    public function proces_logout() 
    {
       Auth::logout();
       return redirect()->route('login')->with('success','Logout Berhasil');
    }
}
