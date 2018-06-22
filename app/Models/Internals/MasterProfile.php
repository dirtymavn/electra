<?php

namespace App\Models\Internals;

use Illuminate\Database\Eloquent\Model;

class MasterProfile extends Model
{
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
    	'branch_id',
    	'office_tel',
    	'fax_no',
    	'email',
    	'office_address',
    	'home_address',
    	'remark',
    	'dr_account',
    	'is_draft'
    ];
}
