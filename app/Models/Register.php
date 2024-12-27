<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $table = 'registers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'verified_at',
        'status', // New status column added
    ];

    protected $hidden = [
        'password',
        'otp',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'status' => 'boolean', // Cast status as boolean for easier use
    ];
}
