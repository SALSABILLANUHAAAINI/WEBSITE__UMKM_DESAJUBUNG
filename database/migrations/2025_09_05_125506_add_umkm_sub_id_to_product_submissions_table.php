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
        Schema::table('product_submissions', function (Blueprint $table) {
            // Hanya ubah tipe/constraint jika kolom sudah ada
            if (Schema::hasColumn('product_submissions', 'umkm_sub_id')) {
                $table->unsignedBigInteger('umkm_sub_id')->nullable()->change();
            } else {
                $table->unsignedBigInteger('umkm_sub_id')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_submissions', function (Blueprint $table) {
            if (Schema::hasColumn('product_submissions', 'umkm_sub_id')) {
                $table->dropColumn('umkm_sub_id');
            }
        });
    }
};
