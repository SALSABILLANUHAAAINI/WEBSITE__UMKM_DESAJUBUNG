<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSetting;

class HomeSettingSeeder extends Seeder
{
    public function run(): void
    {
        HomeSetting::create([
            'judul' => 'Selamat Datang di Website Kami',
            'subjudul' => 'Temukan UMKM Terbaik di Sekitar Anda',
            'deskripsi' => 'Website ini menampilkan berbagai UMKM lokal yang menawarkan produk berkualitas dan layanan terbaik.',
            'highlight' => 'Produk Unggulan Bulan Ini',
            'gambar_kiri' => null, // bisa diisi path default atau biarkan null
            'gambar_kanan' => null,
        ]);
    }
}
