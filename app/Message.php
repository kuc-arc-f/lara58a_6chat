<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'type',
        'from_id',
        'to_id',
    ];
    
}
