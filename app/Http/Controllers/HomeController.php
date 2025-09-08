<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\HomeSetting;
use App\Models\Katalog;
use App\Models\Product; // ✅ ambil produk untuk katalog

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 8 data umkm
        $umkms = Umkm::take(8)->get();

        // Ambil home setting
        $homeSetting = HomeSetting::first();

        // Ambil 8 produk katalog
        $products = Product::with(['katalog', 'umkm'])->take(8)->get();

        // Ambil kategori katalog aktif
        $katalogs = Katalog::where('is_active', true)->get();

        return view('user.home', [
            'umkms'    => $umkms,
            'home'     => $homeSetting,
            'products' => $products,
            'katalogs' => $katalogs,
        ]);
    }
}


