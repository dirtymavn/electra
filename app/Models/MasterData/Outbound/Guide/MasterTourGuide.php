<?php

namespace App\Models\MasterData\Outbound\Guide;

use Illuminate\Database\Eloquent\Model;
use Request;
use OwenIt\Auditing\Contracts\Auditable;

class MasterTourGuide extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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

    public static function religions()
    {
        $religions = [
            'budha' => 'Budha',
            'catholic' => 'Catholic',
            'christian' => 'Christian',
            'hindu' => 'Hindu',
            'muslim' => 'Muslim',
            'other' => 'Other'
        ];

        return collect($religions);
    }

    public static function getAutoNumber()
    {
        $result = self::orderBy('id', 'desc')->first();

        $findCode = \DB::table('setting_codes')->whereType('TG')->first();
        if ($result) {
            $lastNumber = (int) substr($result->guide_code, strlen($result->guide_code) - 4, 4);
            $newNumber = $lastNumber + 1;
            
            if (strlen($newNumber) == 1) {
                $newNumber = '000'.$newNumber;
            } elseif (strlen($newNumber) == 2) {
                $newNumber = '00'.$newNumber;
            } elseif (strlen($newNumber) == 3) {
                $newNumber = '0'.$newNumber;
            } else {
                $newNumber = $newNumber;
            }

            $currMonth = (int)date('m', strtotime($result->guide_code));
            $currYear = (int)date('y', strtotime($result->guide_code));
            $nowMonth = (int)date('m');
            $nowYear = (int)date('y');

            if ( ($currMonth < $nowMonth && $currYear == $nowYear) || ($currMonth == $nowMonth && $currYear < $nowYear) ) {
                $newNumber = '0001';
            } else {
                $newNumber = $newNumber;
            }

            $newCode = $findCode->type.$newNumber;
        } else {
            $newCode = $findCode->type.'0001';
        }

        return $newCode;
    }
}
