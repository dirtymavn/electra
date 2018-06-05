<?php

namespace App\Models\Business\Customer;

use Illuminate\Database\Eloquent\Model;

class MasterCustomerGeneralDoc extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_customer_general_docs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_customer_general_id',
        'passport_no',
        'issue_country',
        'nationality',
        'type',
        'issue_date',
        'expire_date',
        'entry_country',
        'passenger_name',
        'remark',

    ];

    /**
     * Get the general that owns the doc.
     */
    public function general()
    {
        return $this->belongsTo(MasterCustomerGeneral::class);
    }
}
