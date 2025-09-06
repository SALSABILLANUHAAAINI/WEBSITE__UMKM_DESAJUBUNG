<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TentangKami;

class TentangKamiSeeder extends Seeder
{
    public function run(): void
    {
        TentangKami::create([
            'hero' => 'Selamat Datang di Website Kami',
            'image1' => null, // bisa diisi path default gambar jika ada
            'image2' => null,
            'title' => 'Tentang UMKM Lokal',
            'desc1' => 'Website ini menampilkan berbagai UMKM lokal yang menawarkan produk berkualitas dan layanan terbaik.',
            'desc2' => 'Kami berkomitmen untuk mendukung UMKM di seluruh Indonesia dengan promosi dan teknologi digital.',
            'webdesc' => 'Website ini dibuat untuk memudahkan masyarakat mengenal UMKM unggulan.',
        ]);
    }
}
