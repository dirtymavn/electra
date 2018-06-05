<?php

namespace App\Models\Business\Customer;

use Illuminate\Database\Eloquent\Model;
use Request;

class MasterCustomerMain extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_mains';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'servicing_branch_id',
        'rpt_group_id',
        'cust_type_id',
        'mailing_address',
        'billing_address',
        'office_address',
        'travel_policy',

    ];

    /**
     * Get the customer that owns the basic.
     */
    public function customer()
    {
        return $this->belongsTo(MasterCustomer::class);
    }

    /**
     * Get the contact for the main.
     */
    public function contacts()
    {
        return $this->hasMany(MasterCustomerMainContact::class, 'customer_main_id', 'id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($customerMain) {
            $input = Request::all();
            $input['customer_main_id'] = $customerMain->id;

            $contac = new MasterCustomerMainContact;
            $contac->create($input);

        });

        // self::updating(function ($customerMain) {
        //     $input = Request::all();
        //     $input['customer_main_id'] = $customerMain->id;

        //     $contac = $customerMain->contacts()->first();
        //     $contac->update($input);

        // });

    }
}
