<?php

namespace App\Models\MasterData\Accounting\FxTrans;

use Illuminate\Database\Eloquent\Model;

class TrxFxTransDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_fx_transaction_details';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_fx_transaction_id',
        'currency',
        'exchange_rate'

    ];

    /**
     * Get the fxTrans that owns the detail.
     */
    public function fxTrans()
    {
        return $this->belongsTo(TrxFxTrans::class);
    }
}
