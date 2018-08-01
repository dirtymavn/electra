<?php

namespace App\Models\Setting\AccountingConfig;

use Illuminate\Database\Eloquent\Model;

class AccountingConfigDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounting_config_details';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'accounting_config_id',
        'master_coa_id',
        'type',
        'value',
    ];

    public function config()
    {
        return $this->belongsTo(AccountingConfig::class);
    }

    public function masterCoa()
    {
        return $this->belongsTo('App\Models\MasterData\Accounting\MasterCoa', 'master_coa_id');
    }
}
