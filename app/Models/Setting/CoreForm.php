<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class CoreForm extends Model
{
    protected $table = 'core_forms';

    protected $fillable = [
    	'name',
    	'slug',
        'label',
        'model',
        'code',
        'type'
    ];

    public static function getCodeBySlug($slug)
    {
    	$result = self::whereSlug($slug)->first();

    	if ($result) {
    		return $result->code;
    	} else {
    		return false;
    	}
    }
}
