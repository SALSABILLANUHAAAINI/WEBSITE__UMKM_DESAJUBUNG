<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TentangKami;
use Illuminate\Support\Facades\Storage;

class TentangKamiController extends Controller
{
    // Tampilkan form beserta data
    public function edit()
    {
        $tentang = TentangKami::first();
        return view('admin.tentang.tentangsetting', compact('tentang'));
    }
    // Tampilkan halaman Tentang Kami untuk user
public function show()
{
    $tentang = TentangKami::first();
    return view('user.about.about', compact('tentang'));
}


    // Simpan/update data
    public function update(Request $request)
    {
        $request->validate([
            'hero' => 'nullable|string|max:255',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg',
            'title1' => 'nullable|string|max:255',
            'desc1' => 'nullable|string',
            'title2' => 'nullable|string|max:255',
            'desc2' => 'nullable|string',
            'title3' => 'nullable|string|max:255',
            'webdesc' => 'nullable|string',
        ]);

        $tentang = TentangKami::first();
        $data = $request->only(['hero', 'image1', 'image2', 'title1', 'desc1', 'title2', 'desc2', 'title3', 'webdesc']);

        // Upload image1
        if ($request->hasFile('image1')) {
            if ($tentang && $tentang->image1 && Storage::disk('public')->exists($tentang->image1)) {
                Storage::disk('public')->delete($tentang->image1);
            }
            $data['image1'] = $request->file('image1')->store('tentang_images', 'public');
        }

        // Upload image2
        if ($request->hasFile('image2')) {
            if ($tentang && $tentang->image2 && Storage::disk('public')->exists($tentang->image2)) {
                Storage::disk('public')->delete($tentang->image2);
            }
            $data['image2'] = $request->file('image2')->store('tentang_images', 'public');
        }

        if ($tentang) {
            $tentang->update($data);
        } else {
            TentangKami::create($data);
        }

        return redirect()->back()->with('success', 'Data Tentang Kami berhasil disimpan.');
    }
}
