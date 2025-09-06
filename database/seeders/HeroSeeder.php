<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh data hero awal
        Hero::create([
            'title' => 'Explore Our Clients',
            'subtitle' => 'Tampilkan katalog terbaikmu di sini',
        ]);
    }
}
