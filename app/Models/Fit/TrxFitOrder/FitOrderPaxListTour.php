<?php

namespace App\Models\Fit\TrxFitOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitOrderPaxListTour extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
    	return $this->hasOne(FitOrderPaxListTourAccomodation::class, 'trx_fit_order_pax_list_tour_id');
    }

    public function paxListTourSelling()
    {
    	return $this->hasOne(FitOrderPaxListTourSelling::class, 'trx_fit_order_pax_list_tour_id');
    }

    public function paxListTourFlights()
    {
        return $this->hasMany(FitOrderPaxListTourFlight::class, 'trx_fit_order_pax_list_tour_id');
    }
}
