<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroUmkm extends Model
{
    use HasFactory;

    protected $table = 'hero_umkm';
    protected $fillable = ['hero'];
}
