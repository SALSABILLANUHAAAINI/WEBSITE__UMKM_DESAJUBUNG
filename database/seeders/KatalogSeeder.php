<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Katalog;

class KatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Katalog::create([
            'name' => 'Makanan Ringan',
            'is_active' => true,
        ]);

        Katalog::create([
            'name' => 'Minuman',
            'is_active' => false,
        ]);

        Katalog::create([
            'name' => 'Kerajinan',
            'is_active' => true,
        ]);

        Katalog::create([
            'name' => 'Fashion',
            'is_active' => true,
        ]);

        Katalog::create([
            'name' => 'Elektronik',
            'is_active' => false,
        ]);
    }
}
