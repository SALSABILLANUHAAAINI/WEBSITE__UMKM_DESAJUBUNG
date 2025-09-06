<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\HeroUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // -------- USER SIDE --------


   public function index()
{
    $umkms = Umkm::latest()->get();
    $heroUmkm = \App\Models\HeroUmkm::first(); // Ambil hero
    if (!$heroUmkm) {
        $heroUmkm = new \App\Models\HeroUmkm();
        $heroUmkm->hero = 'Berbagai Macam UMKM Desa Jubung';
    }
    return view('user.umkm.index', compact('umkms', 'heroUmkm'));
}


    public function show(Umkm $umkm)
    {
        return view('user.umkm.show', compact('umkm'));
    }

    // -------- ADMIN SIDE --------
    public function adminIndex()
{
    $umkms = Umkm::latest()->get();

    // Ambil hero, kalau belum ada buat default
    $heroUmkm = HeroUmkm::first();
    if (!$heroUmkm) {
        $heroUmkm = HeroUmkm::create([
            'hero' => 'Berbagai Macam UMKM Desa Jubung'
        ]);
    }

    return view('admin.umkm.index', compact('umkms', 'heroUmkm'));
}

    public function adminCreate()
    {
        return view('admin.umkm.create');
    }

    public function adminStore(Request $request)
    {
        $this->saveUmkm($request);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'Data UMKM berhasil ditambahkan.');
    }

    public function adminEdit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function adminUpdate(Request $request, Umkm $umkm)
    {
        $this->saveUmkm($request, $umkm);

        return redirect()->route('admin.umkm.index')
                         ->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function destroy(Umkm $umkm)
{
    // Hapus logo jika ada
    if ($umkm->logo && Storage::disk('public')->exists($umkm->logo)) {
        Storage::disk('public')->delete($umkm->logo);
    }

    // Hapus gambar jika ada
    if ($umkm->gambar && Storage::disk('public')->exists($umkm->gambar)) {
        Storage::disk('public')->delete($umkm->gambar);
    }

    // Hapus record UMKM
    $umkm->delete();

    return redirect()->route('admin.umkm.index')
                     ->with('success', 'Data UMKM beserta gambar berhasil dihapus.');
}


    // -------- REUSABLE SAVE FUNCTION --------
    private function saveUmkm(Request $request, Umkm $umkm = null)
{
    $validated = $request->validate([
        'nama_umkm' => 'required|string|max:255',
        'owner'     => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'alamat'    => 'required|string',
        'kontak'    => 'required|string|max:20',
        'gmaps'     => 'nullable|string',
        'logo'      => 'nullable|image|mimes:jpeg,png,jpg',
        'gambar'    => 'nullable|image|mimes:jpeg,png,jpg',
        'social'    => 'nullable|string|max:255',
        'store'     => 'nullable|string|max:255',
    ]);

    $data = $validated;

    // Upload logo
    if ($request->hasFile('logo')) {
        if ($umkm && $umkm->logo && Storage::disk('public')->exists($umkm->logo)) {
            Storage::disk('public')->delete($umkm->logo);
        }

        // pastikan folder ada
        if (!Storage::disk('public')->exists('logos')) {
            Storage::disk('public')->makeDirectory('logos');
        }

        $data['logo'] = $request->file('logo')->store('logos', 'public');
    }

    // Upload gambar
    if ($request->hasFile('gambar')) {
        if ($umkm && $umkm->gambar && Storage::disk('public')->exists($umkm->gambar)) {
            Storage::disk('public')->delete($umkm->gambar);
        }

        // pastikan folder ada
        if (!Storage::disk('public')->exists('gambar_umkm')) {
            Storage::disk('public')->makeDirectory('gambar_umkm');
        }

        $data['gambar'] = $request->file('gambar')->store('gambar_umkm', 'public');
    }

    // Simpan data
    if ($umkm) {
        $umkm->update($data);
    } else {
        Umkm::create($data);
    }
}

public function updateHero(Request $request)
{
    $request->validate([
        'hero' => 'required|string|max:255',
    ]);

    $hero = \App\Models\HeroUmkm::first(); // karena hanya ada 1 hero
    if (!$hero) {
        $hero = new \App\Models\HeroUmkm();
    }

    $hero->hero = $request->hero;
    $hero->save();

    return redirect()->route('admin.umkm.index')->with('success', 'Hero UMKM berhasil diperbarui');
}

}
