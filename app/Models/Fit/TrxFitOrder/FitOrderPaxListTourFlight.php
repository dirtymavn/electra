<?php

namespace App\Models\Fit\TrxFitOrder;

use Illuminate\Database\Eloquent\Model;

class FitOrderPaxListTourFlight extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trx_fit_order_pax_list_tour_flights';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_fit_order_pax_list_tour_id',
        'flight_from',
        'flight_to',
        'airline_id',
        'flight_no',
        'class',
        'farebasis',
        'depart_date',
        'arrived_date',
        'status',
    ];

    public function cityFrom()
    {
        return $this->belongsTo('App\Models\MasterData\City', 'flight_from');
    }

    public function cityTo()
    {
        return $this->belongsTo('App\Models\MasterData\City', 'flight_to');
    }
}
