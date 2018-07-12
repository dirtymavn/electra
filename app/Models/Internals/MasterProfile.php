<?php

namespace App\Models\Internals;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MasterProfile extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'master_profile';

    protected $fillable = [
    	'staff_no',
    	'staff_fullname',
    	'status',
    	'type',
    	'title',
    	'home_tel',
    	'mobile',
    	'employment_date',
        'company_id',
        'branch_id',
        'user_id',
    	'office_tel',
    	'fax_no',
    	'email',
    	'office_address',
    	'home_address',
    	'remark',
    	'dr_account',
    	'is_draft'
    ];

    /**
     * Get the user that owns the master profile.
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
