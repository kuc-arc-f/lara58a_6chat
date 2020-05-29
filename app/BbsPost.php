<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BbsPost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'display',        
    ];    
}
