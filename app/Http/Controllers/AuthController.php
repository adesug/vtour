<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        }else if(Auth::user()->role == 'user'){
            return redirect()->route('dashboardAdmin');
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

    public function register()
    {
        return view('auth.register');
    }
    public function proces_register(Request $request)
    {
       // Validasi input
    $request->validate([
        'nama' => 'required',
        'email' => 'required',
        'password' => 'required' // Tambahkan validasi panjang minimum untuk password
    ]);

    // Siapkan data pengguna
    $dataUser  = [
        'name' => $request->nama, // Pastikan menggunakan 'name' sesuai dengan validasi
        'password' => Hash::make($request->password), // Hash password
        'email' => $request->email,
        'role' => 'user'
    ];
  
    // Simpan data pengguna ke database
    $saveData = DB::table('users')->insert($dataUser );

    // Anda bisa menambahkan respon atau redirect setelah menyimpan data
    if ($saveData) {
        return redirect()->route('login')->with('success','Register Berhasil, Silahkan Login');
    } else {
        return redirect()->route('register')->with('failed','Register Gagal !');
    }
    }
}
