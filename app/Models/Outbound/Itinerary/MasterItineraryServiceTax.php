<?php

namespace App\Models\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryServiceTax extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_service_taxs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_service_id',
        'ptc',
        'tax_amount',

    ];

    /**
     * Get the service that owns the tax.
     */
    public function service()
    {
        return $this->belongsTo(MasterItineraryService::class);
    }
}
