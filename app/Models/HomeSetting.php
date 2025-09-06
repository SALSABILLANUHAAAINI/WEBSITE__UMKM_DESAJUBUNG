<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'subjudul',
        'deskripsi',
        'highlight',
        'gambar_kiri',
        'gambar_kanan',
    ];
}
