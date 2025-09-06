<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('product_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('katalog_id')->nullable()->after('umkm_sub_id');

            // Jika ada tabel katalog
            $table->foreign('katalog_id')->references('id')->on('katalogs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('product_submissions', function (Blueprint $table) {
            $table->dropForeign(['katalog_id']);
            $table->dropColumn('katalog_id');
        });
    }
};
