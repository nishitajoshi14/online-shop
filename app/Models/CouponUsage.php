<?php

// app/Models/CouponUsage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;

    // If you want to define the fillable fields
    protected $fillable = [
        'user_id',
        'coupon_id',
    ];

    // Optional: Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // In CouponUsage.php
public function coupon()
{
    return $this->belongsTo(Coupon::class);
}


    
    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_usages', 'coupon_id', 'user_id');
    }


}
