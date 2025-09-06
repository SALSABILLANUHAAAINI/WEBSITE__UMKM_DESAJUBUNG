<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroKatalog extends Model
{
    use HasFactory;
    protected $table = 'hero_katalog'; 
    protected $fillable = ['hero'];
}
