<?php

namespace App\Models\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryServiceOtherPtc extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_service_other_ptcs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_service_id',
        'pax_ptc',
        'pax_from',
        'pax_to',
        'unit_cost',
        'discount_percent',
        'discount_amount',
        'net_cost',

    ];

    /**
     * Get the service that owns the otherPtc.
     */
    public function service()
    {
        return $this->belongsTo(MasterItineraryService::class);
    }
}
