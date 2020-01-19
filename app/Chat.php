<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//
class Chat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'content',
        'user_id',
    ];    
}
