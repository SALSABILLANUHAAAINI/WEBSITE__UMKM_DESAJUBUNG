<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm; // panggil model Umkm

class HomeController extends Controller
{
    public function index()
    {
        // ambil 8 data umkm saja untuk ditampilkan di home
        $umkms = Umkm::take(8)->get();

        return view('user.home', compact('umkms'));
    }
}
