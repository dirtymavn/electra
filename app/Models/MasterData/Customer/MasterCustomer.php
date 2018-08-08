<?php

namespace App\Models\MasterData\Customer;

use Illuminate\Database\Eloquent\Model;
use Request;
use OwenIt\Auditing\Contracts\Auditable;

class MasterCustomer extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

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
        'company_id',
        'company_name',
        'branch_id',
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
     * Get the term_fee for the customer.
     */
    public function sales()
    {
        return $this->belongTo(Business\Sales\TrxSales::class, 'sales_id');
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
            
            $creditCards = \DB::table('temporaries')->whereType('customer-creditcard')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($creditCards) > 0) {
                foreach ($creditCards as $creditCard) {
                    $creditCard = json_decode($creditCard->data);

                    $cc = new MasterCustomerCreditCard;

                    $cc->customer_id = $customer->id;
                    $cc->card_type = $creditCard->card_type;
                    $cc->merchant_no = $creditCard->merchant_no;
                    $cc->merchant_no_int = $creditCard->merchant_no_int;
                    $cc->credit_card_no = $creditCard->credit_card_no;
                    $cc->expiry_date = $creditCard->cc_expiry_date;
                    $cc->cardholder_name = $creditCard->cardholder_name;
                    $cc->bill_type = $creditCard->bill_type;
                    $cc->preferred_card = $creditCard->preferred_card;
                    $cc->sof = $creditCard->sof;
                    $cc->remark = $creditCard->cc_remark;

                    $cc->save();
                }
            }

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

    /**
     * For Enum Meals
     *
     * @return array
     */
    public static function meals()
    {
        $meals = [
            'Asian Vegetarian' => 'Asian Vegetarian',
            'Baby Meal' => 'Baby Meal',
            'Bland' => 'Bland',
            'Child' => 'Child',
            'Diabetic' => 'Diabetic',
            'Easy' => 'Easy',
            'Fruit Platter' => 'Fruit Platter',
            'Gluten Free' => 'Gluten Free',
            'Hindu' => 'Hindu',
            'Japanese' => 'Japanese',
            'Kosher' => 'Kosher',
            'Moslem' => 'Moslem'
        ];
        
        return collect($meals);
    }

    /**
     * Select RPT GRP
     * @return array
     */
    public static function rptGrp()
    {
        $rpt = [
            '1' => 'Option 1',
            '2' => 'Option 2',
            '3' => 'Option 3',
        ];

        return collect($rpt);
    }

    /**
     * Select RPT GRP
     * @return array
     */
    public static function customerGroup()
    {
        $rpt = [
            '1' => 'Customer Group 1',
            '2' => 'Customer Group 2',
            '3' => 'Customer Group 3'
        ];

        return collect($rpt);
    }

    /**
     * Get available customer
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_customers.company_id')
            ->where(function($query) {
                return $query->where('master_customers.is_draft', false)
                    ->where('master_customers.status', 'active');
            });

        // if (user_info()->inRole('admin')) {
            $return = $return->where('master_customers.company_id', user_info('company_id'));
        // }

        return $return;

    }

    /**
     * Get the order for the customer.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Outbound\TrxTourOrder\TourOrder', 'customer_id');
    }

    public static function getAvaliable()
    {
        $return = self::where('company_id', user_info()->company_id)
        ->whereNotIn('status', ['inactive', 'suspend'])
        ->whereIsDraft(false);

        return $return;
    }
}
