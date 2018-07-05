<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporary extends Model
{
    protected $table = 'temporaries';

    protected $fillable = [
    	'type',
    	'user_id',
    	'data',
    	'parent_id'
    ];
}
