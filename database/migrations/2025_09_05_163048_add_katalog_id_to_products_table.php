<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // kolom katalog_id
            $table->foreignId('katalog_id')->nullable()->after('umkm_id')->constrained('katalogs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['katalog_id']);
            $table->dropColumn('katalog_id');
        });
    }
};
