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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('umkm_id')->after('id')->constrained('umkms')->onDelete('cascade');
            $table->string('nama_produk')->after('umkm_id');
            $table->string('harga')->nullable()->after('nama_produk');
            $table->text('deskripsi')->nullable()->after('harga');
            $table->string('product_image')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['umkm_id', 'nama_produk', 'harga', 'deskripsi', 'product_image']);
        });
    }
};
