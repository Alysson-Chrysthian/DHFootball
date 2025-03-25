<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoutPlayer extends Model
{
    use HasFactory;

    protected $table = 'scout_player';

    protected $fillable = [
        'status',
        'player_id',
        'scout_id',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function scout() 
    {
        return $this->belongsTo(Scout::class);
    }
}
