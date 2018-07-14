<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;

class TourOrderPaxListTourSelling extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_tour_order_pax_list_tour_sellings';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_tour_order_pax_list_tour_id',
        'price_type',
        'less_total_disc',
        'room_surcharge',
        'tax',
        'rebate',
        'comm',
        'gst',
        'airline_id',
        'ticket_no',
        'register_date',
        'currency',
        'special_req',
        'remark',
    ];
}
