<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = [
        'umkm_id',
        'katalog_id',   // tambahkan ini
        'nama_produk',
        'harga',
        'deskripsi',
        'product_image'
    ];

    public function umkm(){
        return $this->belongsTo(Umkm::class,  'umkm_id');
    }

    public function katalog(){
        return $this->belongsTo(Katalog::class); // relasi ke katalog
    }

}
