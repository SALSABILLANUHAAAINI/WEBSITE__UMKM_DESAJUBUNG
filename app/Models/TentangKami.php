<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangKami extends Model
{
    use HasFactory;

    protected $table = 'tentang_kami';

    protected $fillable = [
        'hero',
        'image1',
        'image2',
        'title1',
        'desc1',
        'title2',
        'desc2',
        'title3',
        'webdesc',
    ];
}

