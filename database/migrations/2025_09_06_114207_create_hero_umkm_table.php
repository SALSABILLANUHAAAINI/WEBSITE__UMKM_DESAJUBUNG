<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_umkm', function (Blueprint $table) {
            $table->id();
            $table->string('hero'); // field untuk judul hero
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_umkm');
    }
};
