<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TentangKami;

class TentangKamiController extends Controller
{
    // Tampilkan form admin
    public function edit()
    {
        $tentang = TentangKami::first();
        return view('admin.tentang.tentangsetting', compact('tentang'));
    }

    // Tampilkan halaman user
    public function show()
    {
        $tentang = TentangKami::first();
        return view('user.about.about', compact('tentang'));
    }

    // Simpan / update data
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
        $data = $request->only(['hero','title1','desc1','title2','desc2','title3','webdesc']);

        // Upload image1
        if ($request->hasFile('image1')) {
            if ($tentang && $tentang->image1 && file_exists(public_path('about_images/'.$tentang->image1))) {
                unlink(public_path('about_images/'.$tentang->image1));
            }
            $filename = time().'_'.$request->file('image1')->getClientOriginalName();
            $request->file('image1')->move(public_path('about_images'), $filename);
            $data['image1'] = $filename;
        }

        // Upload image2
        if ($request->hasFile('image2')) {
            if ($tentang && $tentang->image2 && file_exists(public_path('about_images/'.$tentang->image2))) {
                unlink(public_path('about_images/'.$tentang->image2));
            }
            $filename = time().'_'.$request->file('image2')->getClientOriginalName();
            $request->file('image2')->move(public_path('about_images'), $filename);
            $data['image2'] = $filename;
        }

        if ($tentang) {
            $tentang->update($data);
        } else {
            TentangKami::create($data);
        }

        return redirect()->back()->with('success', 'Data Tentang Kami berhasil disimpan.');
    }
}
