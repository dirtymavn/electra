<?php

namespace App\Models\Setting\AccountingConfig;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class AccountingConfig extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounting_configs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'core_form_id',
        'company_id',
        'branch_id',
        'is_draft',
    ];

    /**
     * Get the detail record associated with the company.
    */
    public function details()
    {
        return $this->hasMany(AccountingConfigDetail::class, 'accounting_config_id');
    }

    public function coreForm()
    {
        return $this->belongsTo('App\Models\Setting\CoreForm', 'core_form_id');
    }

    /**
     * Get available config
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'accounting_configs.company_id')
            ->where('accounting_configs.is_draft', false)
            ->where('accounting_configs.company_id', user_info('company_id'));

        return $return;

    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($accConfig) {
            $input = Request::all();
            foreach ($input['config_detail']['coa'] as $key => $coa) {
                AccountingConfigDetail::create([
                	'accounting_config_id' => $accConfig->id,
			        'master_coa_id' => $coa,
			        'type' => $input['config_detail']['type'][$key],
			        'value' => $input['config_detail']['value'][$key],
                ]);
            }
        });

    }
}
