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
