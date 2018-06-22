<?php

namespace App\Models\GL\TrxPosting;

use Illuminate\Database\Eloquent\Model;

class TrxPosting extends Model
{
    protected $table = 'trx_posting';

    protected $fillable = [
    	'postdate_start',
    	'postdate_end',
    	'user_id',
    	'branch_id',
    	'is_draft'
    ];

    /**
     * Get the detail for the fxTrans.
     */
    public function details()
    {
        return $this->hasMany(TrxPostingDetail::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($trx) {
            $trxDetails = \DB::table('temporaries')->whereType('posting-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($trxDetails) > 0) {
                foreach ($trxDetails as $trxDetail) {
                    $detail = new TrxPostingDetail;

                    $trxDetail = json_decode($trxDetail->data);

                    $detail->trx_posting_id = $trx->id;
                    $detail->transaction_subject = $trxDetail->transaction_subject;
                    $detail->transaction_type = $trxDetail->transaction_type;
                    $detail->in_qty = $trxDetail->in_qty;
                    $detail->in_price = $trxDetail->in_price;
                    $detail->in_total = $trxDetail->in_total;
                    $detail->out_qty = $trxDetail->out_qty;
                    $detail->out_price = $trxDetail->out_price;
                    $detail->out_total = $trxDetail->out_total;
                    $detail->result_qty = $trxDetail->result_qty;
                    $detail->result_avg = $trxDetail->result_price;
                    $detail->result_total = $trxDetail->result_total;
                    
                    $detail->save();
                }
            }

            \DB::table('temporaries')->whereUserId(user_info('id'))
                ->delete();

        });
    }
}
