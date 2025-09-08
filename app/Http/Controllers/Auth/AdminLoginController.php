<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Menampilkan form login admin.
     */
    public function showLoginForm()
    {
        return view('admin.login.login');
    }

    /**
     * Menangani permintaan login.
     */
    public function login(Request $request)
{
    // 1. Validasi input: sekarang mencari 'username' bukan 'email'
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required'],
    ]);

    // 2. Coba lakukan login: menggunakan 'username'
    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    // 3. Jika gagal, kembalikan pesan error untuk 'username'
    return back()->withErrors([
        'username' => 'Username atau password yang Anda masukkan salah.',
    ])->onlyInput('username');
}

    /**
     * Menangani permintaan logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }
}