<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
    //
    protected $fillable = [
        'message_id',
        'name',
    ];    
}
