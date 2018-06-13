<?php

namespace App\Models\Outbound\Guide;

use Illuminate\Database\Eloquent\Model;

class MasterTourGuideMain extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_tour_guide_mains';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_tour_guide_id',
        'job_title',
        'home_tel',
        'mobile',
        'office_tel',
        'fax_no',
        'email',
        'office_addr',
        'home_addr',
        'remark',
        'start_date',
        'expertise',
        'religion',
        'language',

    ];

    /**
     * Get the guide that owns the main.
     */
    public function guide()
    {
        return $this->belongsTo(MasterTourGuide::class);
    }
}
