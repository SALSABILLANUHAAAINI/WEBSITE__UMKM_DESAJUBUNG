<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToTentangKamiTable extends Migration
{
    public function up(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            if (!Schema::hasColumn('tentang_kami', 'title1')) {
                $table->string('title1')->nullable();
            }
            if (!Schema::hasColumn('tentang_kami', 'desc1')) {
                $table->text('desc1')->nullable();
            }
            if (!Schema::hasColumn('tentang_kami', 'title2')) {
                $table->string('title2')->nullable();
            }
            if (!Schema::hasColumn('tentang_kami', 'desc2')) {
                $table->text('desc2')->nullable();
            }
            if (!Schema::hasColumn('tentang_kami', 'title3')) {
                $table->string('title3')->nullable();
            }
            if (!Schema::hasColumn('tentang_kami', 'webdesc')) {
                $table->text('webdesc')->nullable();
            }
            // Hapus baris hero karena sudah ada
            // if (!Schema::hasColumn('tentang_kami', 'hero')) {
            //     $table->string('hero')->nullable();
            // }
        });
    }

    public function down(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            $table->dropColumn(['title1', 'desc1', 'title2', 'desc2', 'title3', 'webdesc']);
            // Jangan drop hero karena sudah ada
        });
    }
}
