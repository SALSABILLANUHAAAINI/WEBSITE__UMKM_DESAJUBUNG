<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Umkm;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        Umkm::create([
            'nama_umkm' => 'Mochi Manis',
            'owner'     => 'Siti Aminah',
            'deskripsi' => 'Mochi Manis adalah UMKM lokal yang memproduksi kue mochi dengan rasa autentik.
                            Menggunakan bahan alami tanpa pengawet, menghadirkan kelembutan dalam setiap gigitan.',
            'gambar'    => 'https://via.placeholder.com/400x300/FFC0CB/000000?text=Mochi+1',
            'kontak'    => '0812-3456-7890',
            'gmaps'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.303970010792!2d112.707351!3d-7.958933',
            'alamat'    => 'Jl. Raya Jubung No. 12, Desa Jubung, Jawa Timur',
            'logo'      => 'https://via.placeholder.com/150x150.png?text=Logo+UMKM',
            'social'    => 'https://instagram.com/mochimanis',
            'store'     => 'https://shopee.co.id/mochimanis'
        ]);
    }
}
