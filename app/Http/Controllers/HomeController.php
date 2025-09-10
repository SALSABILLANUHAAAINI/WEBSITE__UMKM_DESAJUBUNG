<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\HomeSetting;
use App\Models\Katalog;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 data UMKM terbaru
        $umkms = Umkm::latest()->take(8)->get();

        // Ambil hero UMKM (HomeSetting)
        $heroUmkm = HomeSetting::first(); // bisa null jika belum ada data

        // Ambil 8 produk terbaru dengan relasi
        $products = Product::with(['katalog', 'umkm'])->latest()->take(8)->get();

        // Ambil kategori katalog aktif (opsional, jika nanti butuh filter)
        $katalogs = Katalog::where('is_active', true)->get();

        return view('user.home', [
            'umkms'     => $umkms,
            'heroUmkm'  => $heroUmkm,
            'products'  => $products,
            'katalogs'  => $katalogs,
        ]);
    }
}
