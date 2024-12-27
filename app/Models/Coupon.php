<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_code',
        'coupon_type',
        'value',
        'cart_value',
        'expiry_date',
    ];

    /**
     * Check if the coupon is valid based on the expiry date.
     *
     * @return bool
     */
    public function isValid()
    {
        return Carbon::parse($this->expiry_date)->isFuture(); // Check if the expiry date is in the future
    }

    
}
