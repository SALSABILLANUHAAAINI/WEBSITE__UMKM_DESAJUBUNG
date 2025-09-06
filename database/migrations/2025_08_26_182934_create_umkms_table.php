<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('umkms', function (Blueprint $table) {
        $table->id();
        $table->string('nama_umkm');
        $table->text('deskripsi');
        $table->string('gambar')->nullable();   // simpan path gambar
        $table->string('kontak')->nullable();   // WA/Telepon
        $table->string('gmaps')->nullable();    // link Google Maps
        $table->string('alamat')->nullable();
        $table->string('logo')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
