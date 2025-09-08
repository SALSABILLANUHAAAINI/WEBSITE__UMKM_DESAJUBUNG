<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil admin.
     */
    public function edit(Request $request)
    {
        // Ambil data user yang sedang login
        $user = $request->user(); 

        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Memperbarui profil admin.
     */
    public function update(Request $request)
{
    $user = $request->user();

    // Validasi diubah untuk memeriksa 'username', bukan 'email'
    // Aturan 'unique' akan mengabaikan user saat ini, sehingga Anda tidak error saat menyimpan tanpa mengubah username
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$user->id],
        'password' => ['nullable', 'confirmed', Password::defaults()],
    ]);

    // Update nama dan username
    $user->name = $validated['name'];
    $user->username = $validated['username'];

    // Jika user mengisi password baru, update passwordnya
    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
}
}