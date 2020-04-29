<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortItem extends Model
{
    protected $fillable = [
        'order_no',
        'title',
        'content',
    ];
}
