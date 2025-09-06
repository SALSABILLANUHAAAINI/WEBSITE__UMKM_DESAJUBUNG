<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UmkmSubmission;
use App\Models\ProductSubmission;

class UmkmSubmissionSeeder extends Seeder
{
    public function run()
    {
        // Contoh 2 submission UMKM
        $submissions = [
            [
                'nama_umkm' => 'Dapur Mbok Siti',
                'owner' => 'Siti Aminah',
                'deskripsi' => 'Kue dan makanan tradisional khas desa Jubung, dibuat dengan bahan alami dan resep turun-temurun.',
                'alamat' => 'Jl. Melati No. 45, Jubung, Sukorambi',
                'kontak' => '081234567890',
                'logo' => 'logo1.png',
                'gmaps' => 'https://goo.gl/maps/abc123',
                'social' => 'https://instagram.com/dapurmboksiti',
                'store' => 'Pasar Jubung Blok A No. 12',
                'status' => 'pending'
            ],
            [
                'nama_umkm' => 'Kerajinan Tangan Maju Jaya',
                'owner' => 'Budi Santoso',
                'deskripsi' => 'Kerajinan tangan lokal dari bahan alami dengan kualitas premium.',
                'alamat' => 'Jl. Kenanga No. 12, Jubung, Sukorambi',
                'kontak' => '081298765432',
                'logo' => 'logo2.png',
                'gmaps' => 'https://goo.gl/maps/def456',
                'social' => 'https://instagram.com/kerajinantangan',
                'store' => 'Toko Kerajinan Jubung',
                'status' => 'pending'
            ]
        ];

        foreach ($submissions as $sub) {
            $umkmSub = UmkmSubmission::create($sub);

            // Produk untuk setiap submission
            ProductSubmission::create([
                'umkm_sub_id' => $umkmSub->id,
                'nama_produk' => 'Kue Klepon',
                'harga' => '25000',
                'deskripsi' => 'Klepon isi gula merah yang kenyal, lembut, dan ditaburi kelapa parut segar.',
                'product_image' => 'produk1.png'
            ]);

            ProductSubmission::create([
                'umkm_sub_id' => $umkmSub->id,
                'nama_produk' => 'Kue Lapis',
                'harga' => '30000',
                'deskripsi' => 'Kue lapis legit dengan rasa tradisional.',
                'product_image' => 'produk2.png'
            ]);
        }
    }
}
