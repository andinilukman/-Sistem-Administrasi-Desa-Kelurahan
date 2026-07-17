<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function process(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Nama pengguna wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Simple mock login since we don't have DB setup yet
        // In real app, use Auth::attempt()
        if ($request->username === 'admin' && $request->password === 'admin') {
            session(['user_logged_in' => true, 'username' => 'Admin Desa']);
            return redirect()->route('dashboard')->with('success', 'Selamat datang di Sistem Administrasi Desa/Kelurahan');
        }

        // Just let any login pass for the sake of mockup if needed, or strictly check 'admin'
        // Let's accept anything for the demonstration except empty
        session(['user_logged_in' => true, 'username' => $request->username]);
        return redirect()->route('dashboard')->with('success', 'Selamat datang di Sistem Administrasi Desa/Kelurahan');
    }

    public function logout()
    {
        session()->forget('user_logged_in');
        session()->forget('username');
        
        return redirect()->route('login');
    }
}
