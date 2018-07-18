<?php

namespace App\Models\System\CoreConfig;

use Illuminate\Database\Eloquent\Model;

class CoreConfigMain extends Model
{
    protected $table = 'core_config_mains';

    protected $fillable = [
    	'core_config_id',
        'allow_backdate',
        'backdate_interval',
    ];
}
