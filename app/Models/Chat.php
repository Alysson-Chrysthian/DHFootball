<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Chat extends Model
{
    
    protected $table = 'chats';

    public function getFormatedMessage()
    {
        return Str::limit($this->message, 28);
    }

}
