<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;

class TourOrderPaxList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_tour_order_pax_lists';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_tour_order_id',
        'customer_id',
        'vip_status_flag',
        'surname',
        'given_name',
        'ptc',
        'title',
        'gender',
        'id_no',
        'dob',
    ];

    public function paxListTour()
    {
    	return $this->hasOne(TourOrderPaxListTour::class, 'trx_tour_order_pax_list_id');
    }
}
