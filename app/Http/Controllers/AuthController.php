<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Controller untuk menangani autentikasi (login & logout)
class AuthController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    // Proses login + redirect berdasarkan role user
    public function login(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Coba autentikasi user
        if (Auth::attempt($credentials)) {

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect sesuai role user
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            }

            if (Auth::user()->role == 'guru') {
                return redirect('/guru/dashboard');
            }

            if (Auth::user()->role == 'siswa') {
                return redirect('/siswa/dashboard');
            }
        }

        // Jika login gagal
        return back()->with('error','Username / Password salah');
    }

    // Proses logout user
    public function logout(Request $request)
    {
        // Hapus sesi login
        Auth::logout();

        // Invalidate session & regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}