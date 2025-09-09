<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSetting;

class HomeSettingController extends Controller
{
    public function edit()
    {
        $home = HomeSetting::first();
        return view('admin.home.homesetting', compact('home'));
    }

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

        if ($request->hasFile('gambar_kiri')) {
    if ($home && $home->gambar_kiri && file_exists(public_path('home_images/'.$home->gambar_kiri))) {
        unlink(public_path('home_images/'.$home->gambar_kiri));
    }
    $filename = time().'_'.$request->file('gambar_kiri')->getClientOriginalName();
    $request->file('gambar_kiri')->move(public_path('home_images'), $filename);
    $data['gambar_kiri'] = $filename;
}

if ($request->hasFile('gambar_kanan')) {
    if ($home && $home->gambar_kanan && file_exists(public_path('home_images/'.$home->gambar_kanan))) {
        unlink(public_path('home_images/'.$home->gambar_kanan));
    }
    $filename = time().'_'.$request->file('gambar_kanan')->getClientOriginalName();
    $request->file('gambar_kanan')->move(public_path('home_images'), $filename);
    $data['gambar_kanan'] = $filename;
}


        if ($home) {
            $home->update($data);
        } else {
            HomeSetting::create($data);
        }

        return redirect()->back()->with('success', 'Home Setting berhasil disimpan.');
    }
}
