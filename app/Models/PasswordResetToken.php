<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    
    protected $fillable = [
        'email',
        'role',
        'token',
        'created_at',
    ];

    protected $primaryKey = 'email';

    public $timestamps = false;

}
