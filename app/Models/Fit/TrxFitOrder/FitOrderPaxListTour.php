<?php

namespace App\Models\Fit\TrxFitOrder;

use Illuminate\Database\Eloquent\Model;

class FitOrderPaxListTour extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_fit_order_pax_list_tours';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_fit_order_pax_list_id',
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
