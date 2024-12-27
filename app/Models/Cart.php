<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'carts';

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the product that belongs to the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
