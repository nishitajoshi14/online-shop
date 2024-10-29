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

    // Optional: You can define relationships here if needed in the future
    // For example, if you want to define a relationship to products:
    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
