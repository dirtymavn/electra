<?php

namespace App\Models\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryServiceCostInterval extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_service_cost_intervals';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_service_id',
        'pax_from',
        'pax_to',
        'unit_cost',
        'discount_percent',
        'discount_amount',
        'net_cost',

    ];

    /**
     * Get the service that owns the costInterval.
     */
    public function service()
    {
        return $this->belongsTo(MasterItineraryService::class);
    }
}
