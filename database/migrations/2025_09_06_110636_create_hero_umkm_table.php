<?php
// database/migrations/xxxx_xx_xx_create_hero_umkm_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_umkm', function (Blueprint $table) {
            $table->id();
            $table->string('hero')->nullable(); // hanya judul hero
            $table->timestamps();
        });

        // Optional: insert default hero
        DB::table('hero_umkm')->insert(['hero' => 'Berbagai Macam UMKM Desa Jubung']);
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_umkm');
    }
};
