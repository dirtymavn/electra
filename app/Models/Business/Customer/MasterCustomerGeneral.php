<?php

namespace App\Models\Business\Customer;

use Illuminate\Database\Eloquent\Model;
use Request;

class MasterCustomerGeneral extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_generals';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'exit_permit_no',
        'exit_permit_exp_date',
        'seat_pref',
        'seat_pref_remark',
        'meal',
        'meal_remark',
        'other_pref',

    ];

    /**
     * Get the customer that owns the basic.
     */
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
    }

    /**
     * Get the doc for the general.
     */
    public function docs()
    {
        return $this->hasMany(MasterCustomerGeneralDoc::class, 'master_customer_general_id', 'id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($customerGeneral) {
            $input = Request::all();
            $input['master_customer_general_id'] = $customerGeneral->id;

            $doc = new MasterCustomerGeneralDoc;
            $doc->create($input);

        });

        // self::updating(function ($customerGeneral) {
        //     $input = Request::all();
        //     $input['master_customer_general_id'] = $customerGeneral->id;

        //     $doc = $customerGeneral->docs()->first();
        //     $doc->update($input);

        // });

    }
}
