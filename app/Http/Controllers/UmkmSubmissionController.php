<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use App\Models\UmkmSubmission;
use App\Models\ProductSubmission;
use Illuminate\Http\Request;

class UmkmSubmissionController extends Controller
{
    public function showForm()
    {
        $katalogs = Katalog::where('is_active', 1)->get();
        $settings = \App\Models\ServiceSetting::first();
        return view('user.service.service', compact('katalogs', 'settings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:1000',
            'kontak' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'gmaps' => 'nullable|string|max:255',
            'social' => 'nullable|string|max:255',
            'store' => 'nullable|string|max:255',
            'product.*' => 'required|string|max:255',
            'price.*' => 'required|string|max:50',
            'description.*' => 'required|string|max:1000',
            'katalog_id.*' => 'required|exists:katalogs,id',
            'product_images.*.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload gambar langsung ke public/umkm_images
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('umkm_images'), $fileName);
            $gambarPath = 'umkm_images/'.$fileName;
        }

        // Create UMKM submission
        $submission = UmkmSubmission::create([
            'nama_umkm' => $validated['nama_umkm'],
            'owner' => $validated['owner'],
            'alamat' => $validated['alamat'],
            'deskripsi' => $validated['deskripsi'],
            'kontak' => $validated['kontak'],
            'gambar' => $gambarPath,
            'gmaps' => $validated['gmaps'] ?? null,
            'social' => $validated['social'] ?? null,
            'store' => $validated['store'] ?? null,
            'status' => 'pending',
        ]);

        // Upload produk
        $products = $request->input('product', []);
        $prices = $request->input('price', []);
        $descriptions = $request->input('description', []);
        $katalogIds = $request->input('katalog_id', []);
        $productImages = $request->file('product_images') ?? [];

        foreach ($products as $i => $name) {
            $imgPath = null;

            if (isset($productImages[$i][0]) && $productImages[$i][0]->isValid()) {
                $file = $productImages[$i][0];
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('product_images'), $fileName);
                $imgPath = 'product_images/'.$fileName;
            }

            ProductSubmission::create([
                'umkm_sub_id' => $submission->id,
                'katalog_id' => $katalogIds[$i] ?? null,
                'nama_produk' => $name,
                'harga' => $prices[$i] ?? null,
                'deskripsi' => $descriptions[$i] ?? null,
                'product_image' => $imgPath,
            ]);
        }

        return redirect()->back()->with('success', 'Data UMKM berhasil dikirim, menunggu persetujuan admin.');
    }
}
    