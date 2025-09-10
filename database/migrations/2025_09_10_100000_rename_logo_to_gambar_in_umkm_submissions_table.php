<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkm_submissions', function (Blueprint $table) {
            // Rename kolom 'logo' menjadi 'gambar'
            if (Schema::hasColumn('umkm_submissions', 'logo')) {
                $table->renameColumn('logo', 'gambar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('umkm_submissions', function (Blueprint $table) {
            // Kembalikan nama kolom
            if (Schema::hasColumn('umkm_submissions', 'gambar')) {
                $table->renameColumn('gambar', 'logo');
            }
        });
    }
};
