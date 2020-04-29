<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleUser extends Model
{
    protected $fillable = [
		'email',
		'name',		
		'google_uid',		
    ];
}
