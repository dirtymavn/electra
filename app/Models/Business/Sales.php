<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

    public static function getAvailableData()
    {
        return self::where('company_id', user_info()->company_id);
    }

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
