<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'short_description',
        'description',
        'image',
        'regular_price',
        'sale_price',
        'sku',
        'quantity',
        'in_stock',
        'featured',
    ];

    public function gallery_images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}


public function carts()
{
    return $this->hasMany(Cart::class);
}
    
}
