<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;

class HeroController extends Controller
{
    // Tampilkan form Hero
    public function edit()
    {
        // Ambil data hero pertama di tabel
        $hero = Hero::first();
        return view('admin.setting.form', compact('hero'));
    }

    // Simpan atau update Hero
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        // Ambil data hero pertama
        $hero = Hero::first();

        $data = $request->only(['title', 'subtitle']);

        if ($hero) {
            // Update jika sudah ada
            $hero->update($data);
        } else {
            // Buat baru jika belum ada
            Hero::create($data);
        }

        return redirect()->back()->with('success', 'Hero berhasil disimpan.');
    }
}
