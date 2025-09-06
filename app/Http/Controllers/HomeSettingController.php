<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSetting;
use Illuminate\Support\Facades\Storage;

class HomeSettingController extends Controller
{
    // Tampilkan form home setting
    public function edit()
    {
        $home = HomeSetting::first(); // Ambil data pertama (anggap hanya 1 row)
        return view('admin.home.homesetting', compact('home'));
    }

    // Simpan atau update home setting
    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'subjudul' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'highlight' => 'nullable|string|max:255',
            'gambar_kiri' => 'nullable|image|mimes:jpeg,png,jpg',
            'gambar_kanan' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $home = HomeSetting::first();

        $data = $request->only(['judul','subjudul','deskripsi','highlight']);

        // Upload gambar kiri
        if ($request->hasFile('gambar_kiri')) {
            if ($home && $home->gambar_kiri && Storage::disk('public')->exists($home->gambar_kiri)) {
                Storage::disk('public')->delete($home->gambar_kiri);
            }
            $data['gambar_kiri'] = $request->file('gambar_kiri')->store('home_images', 'public');
        }

        // Upload gambar kanan
        if ($request->hasFile('gambar_kanan')) {
            if ($home && $home->gambar_kanan && Storage::disk('public')->exists($home->gambar_kanan)) {
                Storage::disk('public')->delete($home->gambar_kanan);
            }
            $data['gambar_kanan'] = $request->file('gambar_kanan')->store('home_images', 'public');
        }

        if ($home) {
            $home->update($data);
        } else {
            HomeSetting::create($data);
        }

        return redirect()->back()->with('success', 'Home Setting berhasil disimpan.');
    }
}
