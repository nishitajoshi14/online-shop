<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullName', 'phoneNumber', 'pincode', 'state', 'city',
        'address1', 'address2', 'landmark', 'paymentMethod', 
        'subtotal', 'discount', 'vat', 'total', 'order_status'
    ];

    //public function products()
    //{
       // return $this->belongsToMany(Product::class ,'order_product')
                  //  ->withPivot('quantity', 'price', 'sku', 'return_status', 'image')
        //            ->withTimestamps();
    //}

    // Order.php (Model)
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    
    // In Order.php (Model)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
    


    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
