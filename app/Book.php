<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
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
