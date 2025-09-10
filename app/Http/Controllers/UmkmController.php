<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Product;
use App\Models\Katalog;
use App\Models\HeroUmkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    // ================= USER SIDE =================
    public function index()
    {
        $umkms = Umkm::latest()->paginate(6);
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

    // ================= ADMIN SIDE =================
    public function adminIndex(Request $request)
    {
        $query = Umkm::query();

        if ($request->filled('search')) {
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
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('umkm_images'), $filename);
            $data['gambar'] = 'umkm_images/' . $filename;
        }

        Umkm::create($data);

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
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($umkm->gambar && file_exists(public_path($umkm->gambar))) {
                unlink(public_path($umkm->gambar));
            }

            $file = $request->file('gambar');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('umkm_images'), $filename);
            $data['gambar'] = 'umkm_images/' . $filename;
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui!');
    }

    public function destroy(Umkm $umkm)
    {
        if ($umkm->gambar && file_exists(public_path($umkm->gambar))) {
            unlink(public_path($umkm->gambar));
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus!');
    }

    // ================= HERO UPDATE =================
    public function updateHero(Request $request)
    {
        $request->validate(['hero' => 'required|string|max:255']);
        $heroUmkm = HeroUmkm::first() ?? new HeroUmkm();
        $heroUmkm->hero = $request->hero;
        $heroUmkm->save();

        return redirect()->route('admin.umkm.index')->with('success', 'Hero UMKM berhasil diperbarui!');
    }
}
