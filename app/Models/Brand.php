<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Specify the fillable properties
    protected $fillable = [
        'name',
        'slug',
        'brand_image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}    
