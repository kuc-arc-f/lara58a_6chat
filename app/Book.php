<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'type',
        'radio_1',
        'radio_2',
        'check_1',
        'check_2',
        'date_1',
        'date_2',
    ];
}
