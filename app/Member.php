<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name',
        'dept_id',
        'mail',
    ];
}
