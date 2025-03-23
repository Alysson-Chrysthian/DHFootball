<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Player extends User implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'position_id',
        'video',
        'avatar',
        'birthday',
        'thumbnail',
    ];

    public function getAge()
    {
        $now = new DateTime();
        $birthday = new DateTime($this->birthday);

        $difference = $now->diff($birthday);
        return $difference->y;
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

}
