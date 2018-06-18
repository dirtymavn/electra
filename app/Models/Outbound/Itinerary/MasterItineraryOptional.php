<?php

namespace App\Models\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryOptional extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_optionals';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_id',
        'product_description',
        'supplier_no',
        'product_code',
        'reference_no',
        'currency',
        'cost',
        'is_temp',

    ];

    /**
     * Get the itinerary that owns the optional.
     */
    public function itinerary()
    {
        return $this->belongsTo(MasterItinerary::class);
    }
}
