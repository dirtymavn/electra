<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;

class TourOrderPaxListTourAccomodation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_tour_order_pax_list_tour_accomodations';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_tour_order_pax_list_tour_id',
        'room_type',
        'room_category',
        'room_share',
        'room_id',
        'adjoin_room_id',
    ];
}
