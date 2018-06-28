<?php

namespace App\Models\MasterData\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryServiceFoc extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_service_focs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_service_id',
        'pax_no',
        'foc',

    ];

    /**
     * Get the service that owns the foc.
     */
    public function service()
    {
        return $this->belongsTo(MasterItineraryService::class);
    }
}
