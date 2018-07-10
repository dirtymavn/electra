<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
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
    // protected static function boot()
    // {
    //     parent::boot();

    //     self::created(function($sales) {
    //         $input = Request::all();
    //         $input['sales_id'] = $sales->id;

    //         $itinDetails = \DB::table('temporaries')->whereType('sales-detail')
    //             ->whereUserId(user_info('id'))
    //             ->get();

    //         if (count($itinDetails) > 0) {
    //             foreach ($itinDetails as $itinDetail) {
    //                 $detail = new TrxSalesDetail;

    //                 $itinDetail = json_decode($itinDetail->data);
    //             }
    //         }
    //     }
    // }
}
