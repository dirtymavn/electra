<?php

namespace App\Models\Business\Customer;

use Illuminate\Database\Eloquent\Model;
use Request;

class MasterCustomer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customers';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_no',
        'customer_name',
        'company_name',
        'status',
        'salutation',
        'sales_id',
        'customer_group_id',
        'is_draft',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the basic for the customer.
     */
    public function basics()
    {
        return $this->hasMany(MasterCustomerBasic::class, 'customer_id');
    }

    /**
     * Get the credit_card for the customer.
     */
    public function creditCards()
    {
        return $this->hasMany(MasterCustomerCreditCard::class, 'customer_id');
    }

    /**
     * Get the discount_rate for the customer.
     */
    public function discountRates()
    {
        return $this->hasMany(MasterCustomerDiscountRate::class, 'customer_id');
    }

    /**
     * Get the general for the customer.
     */
    public function generals()
    {
        return $this->hasMany(MasterCustomerGeneral::class, 'customer_id');
    }

    /**
     * Get the main for the customer.
     */
    public function mains()
    {
        return $this->hasMany(MasterCustomerMain::class, 'customer_id');
    }

    /**
     * Get the term_fee for the customer.
     */
    public function termFees()
    {
        return $this->hasMany(MasterCustomerTermFee::class, 'customer_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($customer) {
            $input = Request::all();
            $input['customer_id'] = $customer->id;

            $main = new MasterCustomerMain;
            $main->create($input);

            $basic = new MasterCustomerBasic;
            $basic->create($input);
            
            $general = new MasterCustomerGeneral;
            $general->create($input);
            
            $discountrate = new MasterCustomerDiscountRate;
            $discountrate->create($input);
            
            $creditcard = new MasterCustomerCreditCard;
            $input['expiry_date'] = $input['cc_expiry_date'];
            $creditcard->create($input);

            $termfee = new MasterCustomerTermFee;
            $termfee->create($input);

        });

        // self::updating(function ($customer) {
        //     wew($customer);
        //     $input = Request::all();
        //     $input['customer_id'] = $customer->id;

        //     $main = $customer->mains()->first();
        //     $main->update($input);

        //     $basic = $customer->basics()->first();
        //     $basic->update($input);

        //     $general = $customer->generals()->first();
        //     $general->update($input);

        //     $discountrate = $customer->discountRates()->first();
        //     $discountrate->update($input);

        //     $creditcard = $customer->creditCards()->first();
        //     $input['expiry_date'] = $input['cc_expiry_date'];
        //     $creditcard->update($input);

        //     $termfee = $customer->termFees()->first();
        //     $termfee->update($input);

        // });

    }
}
