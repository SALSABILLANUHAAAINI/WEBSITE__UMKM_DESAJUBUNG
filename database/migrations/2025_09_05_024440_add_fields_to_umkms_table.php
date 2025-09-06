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
        Schema::table('umkms', function (Blueprint $table) {
            // Tambahkan kolom baru jika belum ada
            if (!Schema::hasColumn('umkms', 'owner')) {
                $table->string('owner')->nullable()->after('nama_umkm');
            }
            if (!Schema::hasColumn('umkms', 'social')) {
                $table->string('social')->nullable()->after('logo');
            }
            if (!Schema::hasColumn('umkms', 'store')) {
                $table->string('store')->nullable()->after('social');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropColumn(['owner','social','store']);
        });
    }
};
