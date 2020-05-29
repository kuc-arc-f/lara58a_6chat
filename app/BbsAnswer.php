<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BbsAnswer extends Model
{
    //
    protected $fillable = [
        'bbs_post_id',
        'user_id',
        'content',
        'status',        
    ]; 

}
