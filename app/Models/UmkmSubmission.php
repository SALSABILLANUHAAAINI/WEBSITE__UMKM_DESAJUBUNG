<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmkmSubmission extends Model {
    protected $fillable = [
        'nama_umkm',
        'owner',
        'deskripsi',
        'alamat',
        'kontak',
        'gambar',   // ubah dari logo -> gambar
        'gmaps',
        'social',
        'store',
        'status'
    ];

    public function products(){
        return $this->hasMany(ProductSubmission::class, 'umkm_sub_id');
    }
}
