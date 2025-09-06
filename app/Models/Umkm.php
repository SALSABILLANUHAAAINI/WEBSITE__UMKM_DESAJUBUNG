<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkms';

    protected $fillable = [
        'nama_umkm',
        'owner',
        'deskripsi',
        'gambar',
        'kontak',
        'gmaps',
        'alamat',
        'logo',
        'social',
        'store',
        'hero',
    ];
}
