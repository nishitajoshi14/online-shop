<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    // Specify the fillable attributes
    protected $fillable = [
        'email',
        'logged_in_at',
    ];

    // Query scope to find logins by email
    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }
}
