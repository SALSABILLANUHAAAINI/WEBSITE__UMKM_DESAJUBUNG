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
        Schema::create('product_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_sub_id')->constrained('umkm_submissions')->onDelete('cascade');
            $table->string('nama_produk');
            $table->string('harga');
            $table->text('deskripsi');
            $table->string('product_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_submissions');
    }
};
