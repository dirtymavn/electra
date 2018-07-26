<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class SettingCode extends Model
{
    protected $table = 'setting_codes';

    protected $fillable = [
    	'name',
    	'type'
    ];

    public static function getCode($type)
    {
    	$result = self::whereType($type)->first();

    	if ($result) {
    		return $result->type;
    	} else {
    		return false;
    	}
    }
}
