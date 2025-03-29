<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Scout extends User implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'club_id',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function getClubIcon()
    {
        return Club::find($this->club_id)->icon;
    }
}
