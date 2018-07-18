<?php

namespace App\Models\System\CoreConfig;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class CoreConfig extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'core_configs';

    protected $fillable = [
    	'base_currency_id',
        'base_date',
        'decimal_number',
        'company_id',
        'branch_id',
        'is_draft',
    ];

    public function main()
    {
    	return $this->hasOne(CoreConfigMain::class, 'core_config_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($coreConfig) {
            $input = Request::all();
            $input['core_config_id'] = $coreConfig->id;

            $main = new CoreConfigMain;
            $main->create($input);

        });
    }
}
