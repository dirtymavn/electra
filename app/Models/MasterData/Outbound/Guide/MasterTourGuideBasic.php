<?php

namespace App\Models\MasterData\Outbound\Guide;

use Illuminate\Database\Eloquent\Model;

class MasterTourGuideBasic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_tour_guide_basics';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_tour_guide_id',
        'gender',
        'marital_status',
        'country_of_birth',
        'id_no',
        'nationality_1',
        'nationality_2',
        'date_of_birth',
        'license_no',
        'license_expiry_date',
        'exit_permit_no',
        'passport1',
        'passport1_issue_date',
        'passport1_isseu_place',
        'passport1_expiry_date',
        'passport2',
        'passport2_issue_date',
        'passport2_isseu_place',
        'passport2_expiry_date',

    ];

    /**
     * Get the guide that owns the basic.
     */
    public function guide()
    {
        return $this->belongsTo(MasterTourGuide::class);
    }
}
