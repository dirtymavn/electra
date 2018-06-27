<?php

namespace App\Models\MasterData\Outbound\Guide;

use Illuminate\Database\Eloquent\Model;

class TourGuideVisa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tour_guide_visas';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country',
        'purpose',
        'entries_no',
        'visa_no',
        'visa_date',
        'visa_expiry',
        'visa_remark',
        'issue_country',

    ];

    /**
     * Get the guide for the visa.
     */
    public function guides()
    {
        return $this->hasMany(MasterTourGuide::class, 'tour_guide_visa_id');
    }
}
