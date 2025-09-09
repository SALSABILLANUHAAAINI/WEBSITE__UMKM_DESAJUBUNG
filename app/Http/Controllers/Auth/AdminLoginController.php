<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Menampilkan form login dan MEMBUAT kode unik.
     */
    public function showLoginForm()
    {
        // Membuat kode unik 4 digit (antara 1000 dan 9999)
        $uniqueCode = rand(1000, 9999);

        // Simpan kode yang benar di session
        session(['captcha_code' => $uniqueCode]);

        // Kirim kode uniknya ke view untuk ditampilkan
        return view('admin.login.login', ['captcha_code' => $uniqueCode]);
    }

    /**
     * Menangani permintaan login dan MEMERIKSA kode unik.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
            'captcha'  => ['required', 'numeric'], // Jawaban harus angka
        ]);

        // Periksa jawaban captcha
        if ($request->captcha != session('captcha_code')) {
            // Jika salah, kembalikan dengan pesan error captcha
            return back()->withErrors([
                'captcha' => 'Kode unik yang Anda masukkan salah.',
            ])->onlyInput('username');
        }

        // Hapus 'captcha' dari credentials sebelum mencoba login
        unset($credentials['captcha']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Hapus session captcha setelah berhasil login
            $request->session()->forget('captcha_code');
            return redirect()->intended(route('admin.dashboard'));
        }

        // Jika login gagal, hapus juga session captcha agar user mendapat kode baru
        $request->session()->forget('captcha_code');

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