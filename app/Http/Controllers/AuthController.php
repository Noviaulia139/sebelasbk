<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

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

    return back()->with('error','Username / Password salah');
}
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}