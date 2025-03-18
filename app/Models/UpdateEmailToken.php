<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateEmailToken extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'old_email',
        'new_email',
        'token',
        'role'
    ];

}
