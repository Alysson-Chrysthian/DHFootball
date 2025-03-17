<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdateEmailToken extends Model
{
    
    protected $fillable = [
        'old_email',
        'new_email',
        'token',
        'role'
    ];

}
