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
        $umkms = Umkm::take(6)->get();
        $homeSetting = HomeSetting::first();
        $products = Product::with(['katalog', 'umkm'])->take(6)->get();
        $katalogs = Katalog::where('is_active', true)->get();

        return view('user.home', [
            'umkms'    => $umkms,
            'home'     => $homeSetting,
            'products' => $products,
            'katalogs' => $katalogs,
        ]);
    }
}
