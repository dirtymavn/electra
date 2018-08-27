<?php

namespace App\Models\Outbound\TrxTourOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourOrderPaxListTourFlight extends Model
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
    protected $table = 'trx_tour_order_pax_list_tour_flights';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_tour_order_pax_list_tour_id',
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
