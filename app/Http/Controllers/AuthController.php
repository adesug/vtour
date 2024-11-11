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
        dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required' 
        ]);

        $data  = [
            'email' =>$request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($data))
        {
            return redirect()->route('admin.adminDashboard');
        }else {
            return redirect()->route('login')->with('failed','Email atau Password salah !!!');
        }
    }
    public function proces_logout() 
    {
       Auth::logout();
       return redirect()->route('login')->with('success','Logout Berhasil');
    }
}
