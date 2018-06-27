<?php

namespace App\Models\MasterData\Customer;

use Illuminate\Database\Eloquent\Model;

class MasterCustomerMainContact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_main_contacts';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_main_id',
        'contact_type',
        'surname',
        'gname',
        'title',
        'office_phone',
        'home_phone',
        'mobile_phone',
        'fax_1',
        'fax_2',
        'job_title',
        'email',

    ];

    /**
     * Get the main that owns the contact.
     */
    public function main()
    {
        return $this->belongsTo(MasterCustomerMain::class);
    }
}
