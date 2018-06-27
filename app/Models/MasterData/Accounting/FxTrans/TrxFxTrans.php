<?php

namespace App\Models\MasterData\Accounting\FxTrans;

use Illuminate\Database\Eloquent\Model;

class TrxFxTrans extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_fx_transactions';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_flag',
        'letter_of_guarantee_flag',
        'credit_note_flag',
        'deposit_overpayment_flag',
        'ap_deposit_flag',
        'cash_account_flag',
        'bank_account_flag',
        'other_account_flag',
        'jv_period',
        'acc_type',
        'fx_acc',
        'is_draft'

    ];

    /**
     * Get the detail for the fxTrans.
     */
    public function details()
    {
        return $this->hasMany(TrxFxTransDetail::class, 'trx_fx_transaction_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($trans) {
            $transDetails = \DB::table('temporaries')->whereType('fxTrans-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($transDetails) > 0) {
                foreach ($transDetails as $transDetail) {
                    $detail = new TrxFxTransDetail;

                    $transDetail = json_decode($transDetail->data);

                    $detail->trx_fx_transaction_id = $trans->id;
                    $detail->currency = $transDetail->currency;
                    $detail->exchange_rate = $transDetail->exchange_rate;
                    
                    $detail->save();
                }
            }

            \DB::table('temporaries')->whereUserId(user_info('id'))
                ->delete();

        });
    }
}
