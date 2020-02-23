<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//
class ChatMember extends Model
{

    protected $fillable = [
        'chat_id',
        'user_id',
        'token',
    ];        
}
