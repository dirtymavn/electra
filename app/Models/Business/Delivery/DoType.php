<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;

class DoType extends Model
{
    protected $table = 'do_types';

    protected $fillable = [
    	'do_type_name',
    	'do_type_code',
    	'do_type_status',
    	'company_id',
    	'is_draft'
    ];

    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'do_types.company_id')
            ->where('do_types.is_draft', false)
            ->where('do_types.company_id', user_info('company_id'));

        return $return;

    }
}