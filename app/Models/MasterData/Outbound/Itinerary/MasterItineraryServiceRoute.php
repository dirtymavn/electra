<?php

namespace App\Models\MasterData\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryServiceRoute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_service_routes';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_service_id',
        'description',
        'start_date',
        'end_date',
        'start_description',
        'end_description',
        'status',

    ];

    /**
     * Get the service that owns the route.
     */
    public function service()
    {
        return $this->belongsTo(MasterItineraryService::class);
    }
}
