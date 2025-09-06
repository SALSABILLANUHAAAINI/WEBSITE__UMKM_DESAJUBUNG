<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkm_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_umkm');
            $table->string('owner');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('kontak');
            $table->string('logo')->nullable();
            $table->string('gmaps')->nullable();
            $table->string('social')->nullable();
            $table->string('store')->nullable();
            $table->enum('status',['pending','accepted','rejected'])->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_submissions');
    }
};
