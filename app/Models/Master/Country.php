<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'master_countries';

    protected $fillable = [
        'code',
        'name'
    ];
}
