<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//
class ChatPost extends Model
{

    protected $fillable = [
        'chat_id',
        'user_id',
        'title',
        'body',        
    ];    

}
