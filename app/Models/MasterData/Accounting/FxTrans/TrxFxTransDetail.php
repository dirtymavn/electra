<?php

namespace App\Models\MasterData\Accounting\FxTrans;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxFxTransDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
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
