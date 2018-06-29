<?php

namespace App\Models\MasterData\Outbound\Guide;

use Illuminate\Database\Eloquent\Model;
use Request;

class MasterTourGuide extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_tour_guides';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guide_code',
        'guide_status',
        'supplier_no',
        'guide_name_first',
        'guide_name_last',
        'tour_guide_visa_id',
        'is_draft',
        'company_id',
        'branch_id'
    ];

    /**
     * Get the basic for the guide.
     */
    public function basics()
    {
        return $this->hasMany(MasterTourGuideBasic::class, 'master_tour_guide_id');
    }

    /**
     * Get the main for the guide.
     */
    public function mains()
    {
        return $this->hasMany(MasterTourGuideMain::class, 'master_tour_guide_id');
    }

    /**
     * Get the visa that owns the guide.
     */
    public function visa()
    {
        return $this->belongsTo(TourGuideVisa::class, 'tour_guide_visa_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($guide) {
            $input = Request::all();
            $input['master_tour_guide_id'] = $guide->id;

            $main = new MasterTourGuideMain;
            $main->create($input);

            $basic = new MasterTourGuideBasic;
            $basic->create($input);
        });

    }
}
