<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

use Request;

class TrxSales extends Model
{
    protected $table = 'trx_sales';

    protected $fillable = [
        'sales_no',
        'customer_id',
        'trip_date',
        'deadline',
        'your_ref',
        'our_ref',
        'tc_id',
        'invoice_no',
        'sales_date',
        'ticket_amt',
        'rebate',
        'is_draft',
        'company_id'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($sales) {
            $input = Request::all();
            $input['sales_id'] = $sales->id;


            // Save Trx Sales Credit Card
            $credit = new TrxSalesCreditCard();
            $credit->trx_sales_id = $sales->id;
            $credit->card_type = $input['card_type'];
            $credit->card_no = $input['card_no'];
            $credit->cardholder_name = $input['cardholder_name'];
            $credit->expiry_date = $input['expiry_date'];
            $credit->security_id = $input['security_id'];
            $credit->merchant_no = $input['merchant_no'];
            $credit->roc_no = $input['roc_no'];
            $credit->amount = $input['amount'];
            $credit->sof_flag = $input['sof_flag'];
            $credit->authorisation_code = $input['authorisation_code'];
            $credit->authorisation_date = $input['authorisation_date'];

            $credit->save();

            // Save Trx Billing 
            $billing = new TrxSalesBilling();
            $billing->trx_sales_id = $sales->id;
            $billing->ta_no = $input['ta_no'];
            $billing->cc_id = $input['cc_id'];
            $billing->purpose_code = $input['purpose_code'];
            $billing->prcj_no = $input['prcj_no'];
            $billing->department = $input['department'];
            $billing->employee_no = $input['employee_no'];
            $billing->account_no = $input['account_no'];
            $billing->job_title = $input['job_title'];

            $billing->save();

            // $salesDetail = \DB::table('temporaries')->whereType('sales-detail')
            //     ->whereUserId(user_info('id'))
            //     ->get();

            // if (count($salesDetail) > 0) {
            //     foreach ($salesDetail as $itinDetail) {
            //         $detail = new TrxSalesDetail;
            //         $itinDetail = json_decode($itinDetail->data);
            //     }
            // }
        });

        self::saved(function($sales) {
            $input = Request::all();
            $input['sales_id'] = $sales->id;


            // Save Trx Sales Credit Card
            $credit = TrxSalesCreditCard::where('trx_sales_id', $sales->id)->first();
            $credit->trx_sales_id = $sales->id;
            $credit->card_type = $input['card_type'];
            $credit->card_no = $input['card_no'];
            $credit->cardholder_name = $input['cardholder_name'];
            $credit->expiry_date = $input['expiry_date'];
            $credit->security_id = $input['security_id'];
            $credit->merchant_no = $input['merchant_no'];
            $credit->roc_no = $input['roc_no'];
            $credit->amount = $input['amount'];
            $credit->sof_flag = $input['sof_flag'];
            $credit->authorisation_code = $input['authorisation_code'];
            $credit->authorisation_date = $input['authorisation_date'];

            $credit->save();

            // Save Trx Billing 
            $billing = new TrxSalesBilling();
            $billing->trx_sales_id = $sales->id;
            $billing->ta_no = $input['ta_no'];
            $billing->cc_id = $input['cc_id'];
            $billing->purpose_code = $input['purpose_code'];
            $billing->prcj_no = $input['prcj_no'];
            $billing->department = $input['department'];
            $billing->employee_no = $input['employee_no'];
            $billing->account_no = $input['account_no'];
            $billing->job_title = $input['job_title'];

            $billing->save();

            // $salesDetail = \DB::table('temporaries')->whereType('sales-detail')
            //     ->whereUserId(user_info('id'))
            //     ->get();

            // if (count($salesDetail) > 0) {
            //     foreach ($salesDetail as $itinDetail) {
            //         $detail = new TrxSalesDetail;
            //         $itinDetail = json_decode($itinDetail->data);
            //     }
            // }
        });
    }
}
