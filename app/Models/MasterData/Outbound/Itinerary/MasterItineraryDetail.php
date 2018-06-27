<?php

namespace App\Models\MasterData\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_details';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_id',
        'day',
        'as_remark_flag',
        'remark_seq',
        'itinerary_item_code',
        'city',
        'brief_description',
        'land_operator',
        'description',
        'highlight',
        'breakfast',
        'lunch',
        'dinner',
        'accomodations',
        'remark',
        'transport_detail',
        'is_temp',

    ];

    /**
     * Get the itinerary that owns the detail.
     */
    public function itinerary()
    {
        return $this->belongsTo(MasterItinerary::class);
    }
}
