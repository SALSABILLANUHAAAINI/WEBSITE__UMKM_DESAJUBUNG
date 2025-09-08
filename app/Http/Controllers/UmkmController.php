<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Product;
use App\Models\Katalog;
use App\Models\HeroUmkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    // -------- USER SIDE --------
    public function index()
    {
        $umkms = Umkm::latest()->get();
        $products = Product::with(['umkm', 'katalog'])->get(); // untuk grid produk
        $katalogs = Katalog::where('is_active', 1)->get();      // ambil kategori aktif
        $heroUmkm = HeroUmkm::first(); // Ambil hero
        if (!$heroUmkm) {
            $heroUmkm = new HeroUmkm();
            $heroUmkm->hero = 'Berbagai Macam UMKM Desa Jubung';
        }

        return view('user.umkm.index', compact('umkms', 'products', 'katalogs', 'heroUmkm'));
    }

    public function show(Umkm $umkm)
    {
        $umkm->load('products');
        return view('user.umkm.show', compact('umkm'));
    }

    // -------- ADMIN SIDE --------
    public function adminIndex()
    {
        $umkms = Umkm::latest()->get();
        $heroUmkm = HeroUmkm::first();
        if (!$heroUmkm) {
            $heroUmkm = new HeroUmkm();
            $heroUmkm->hero = 'Berbagai Macam UMKM Desa Jubung';
        }

        return view('admin.umkm.index', compact('umkms', 'heroUmkm'));
    }

    public function adminShow(Umkm $umkm)
    {
        $umkm->load('products');
        return view('admin.umkm.show', compact('umkm'));
    }
}


