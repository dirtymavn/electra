<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;

class TourOrderPaxListTour extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_tour_order_pax_list_tours';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_tour_order_pax_list_id',
        'return_date',
        'deviation',
        'meal',
        'remark',
        'special_req',
    ];

    public function paxListTourAccomodation()
    {
    	return $this->hasOne(TourOrderPaxListTourAccomodation::class, 'trx_tour_order_pax_list_tour_id');
    }

    public function paxListTourSelling()
    {
    	return $this->hasOne(TourOrderPaxListTourSelling::class, 'trx_tour_order_pax_list_tour_id');
    }

    public function paxListTourFlights()
    {
        return $this->hasMany(TourOrderPaxListTourFlight::class, 'trx_tour_order_pax_list_tour_id');
    }
}
