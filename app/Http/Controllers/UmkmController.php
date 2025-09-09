<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Product;
use App\Models\Katalog;
use App\Models\HeroUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // -------- USER SIDE --------
    public function index()
    {
        $umkms = Umkm::latest()->paginate(6); // pagination 6 data
        $products = Product::with(['umkm', 'katalog'])->get();
        $katalogs = Katalog::where('is_active', 1)->get();
        $heroUmkm = HeroUmkm::first() ?? new HeroUmkm(['hero' => 'Berbagai Macam UMKM Desa Jubung']);

        return view('user.umkm.index', compact('umkms', 'products', 'katalogs', 'heroUmkm'));
    }

    public function show(Umkm $umkm)
    {
        $umkm->load('products');
        return view('user.umkm.show', compact('umkm'));
    }

    // -------- ADMIN SIDE --------
    public function adminIndex(Request $request)
{
    $query = Umkm::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('nama_umkm', 'like', '%' . $request->search . '%')
              ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
    }

    $umkms = $query->latest()->paginate(6)->withQueryString();
    $heroUmkm = HeroUmkm::first() ?? new HeroUmkm(['hero' => 'Berbagai Macam UMKM Desa Jubung']);

    return view('admin.umkm.index', compact('umkms', 'heroUmkm'));
}


    public function adminCreate()
    {
        return view('admin.umkm.create');
    }

    public function adminStore(Request $request)
    {
        $data = $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'owner'     => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat'    => 'nullable|string',
            'kontak'    => 'nullable|string|max:255',
            'gmaps'     => 'nullable|url',
            'social'    => 'nullable|url',
            'store'     => 'nullable|string|max:255',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('umkm_logos', 'public');
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('umkm_images', 'public');
        }

        Umkm::create($data); // Lebih ringkas dan aman

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan!');
    }

    public function adminEdit(Umkm $umkm)
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    public function adminUpdate(Request $request, Umkm $umkm)
    {
        $data = $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'owner'     => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat'    => 'nullable|string',
            'kontak'    => 'nullable|string|max:255',
            'gmaps'     => 'nullable|url',
            'social'    => 'nullable|url',
            'store'     => 'nullable|string|max:255',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            // HAPUS FILE LAMA JIKA ADA
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }
            $data['logo'] = $request->file('logo')->store('umkm_logos', 'public');
        }

        if ($request->hasFile('gambar')) {
            // HAPUS FILE LAMA JIKA ADA
            if ($umkm->gambar) {
                Storage::disk('public')->delete($umkm->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('umkm_images', 'public');
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui!');
    }

    public function destroy(Umkm $umkm)
    {
        // HAPUS FILE SEBELUM MENGHAPUS DATA
        if ($umkm->logo) {
            Storage::disk('public')->delete($umkm->logo);
        }
        if ($umkm->gambar) {
            Storage::disk('public')->delete($umkm->gambar);
        }

        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus!');
    }

    // -------- HERO UPDATE --------
    public function updateHero(Request $request)
    {
        $request->validate([
            'hero' => 'required|string|max:255',
        ]);

        $heroUmkm = HeroUmkm::first() ?? new HeroUmkm();
        $heroUmkm->hero = $request->hero;
        $heroUmkm->save();

        return redirect()->route('admin.umkm.index')->with('success', 'Hero UMKM berhasil diperbarui!');
    }
}
