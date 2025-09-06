<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubmission extends Model {
    protected $fillable = ['umkm_sub_id','katalog_id','nama_produk','harga','deskripsi','product_image'];

    public function umkmSubmission(){
        return $this->belongsTo(UmkmSubmission::class, 'umkm_sub_id');
    }

    public function katalog(){
        return $this->belongsTo(Katalog::class);
    }
}
