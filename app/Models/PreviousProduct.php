<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousProduct extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'product_name', 'price', 'quantity', 'image_url'];
}
