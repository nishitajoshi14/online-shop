<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'logins';

    protected $fillable = [
        'email',
        'password',
        'logged_in_at',
        'verified_at', // Include this if using email verification
    ];

    protected $dates = ['logged_in_at', 'verified_at']; // Parse these as dates
}
