<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'type', 'is_featured', 'is_active', 'category_id'
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
