<?php

namespace App\Models\Outbound\Itinerary;

use Illuminate\Database\Eloquent\Model;

class MasterItineraryService extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_itinerary_services';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_itinerary_id',
        'product_code',
        'type',
        'ref_no',
        'charge_method',
        'supplier_no',
        'currency',
        'remark',
        'tax_type',
        'tax_currency',
        'tax_free_foc_flag',
        'foc_discount_type',
        'is_temp',

    ];

    /**
     * Get the itinerary that owns the service.
     */
    public function itinerary()
    {
        return $this->belongsTo(MasterItinerary::class);
    }

    /**
     * Get the costInterval for the service.
     */
    public function costIntervals()
    {
        return $this->hasMany(MasterItineraryServiceCostInterval::class, 'master_itinerary_service_id');
    }

    /**
     * Get the foc for the service.
     */
    public function focs()
    {
        return $this->hasMany(MasterItineraryServiceFoc::class, 'master_itinerary_service_id');
    }

    /**
     * Get the otherPtc for the service.
     */
    public function otherPtcs()
    {
        return $this->hasMany(MasterItineraryServiceOtherPtc::class, 'master_itinerary_service_id');
    }

    /**
     * Get the route for the service.
     */
    public function routes()
    {
        return $this->hasMany(MasterItineraryServiceRoute::class, 'master_itinerary_service_id');
    }

    /**
     * Get the tax for the service.
     */
    public function taxs()
    {
        return $this->hasMany(MasterItineraryServiceTax::class, 'master_itinerary_service_id');
    }
}
