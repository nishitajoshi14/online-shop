<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['filename', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
