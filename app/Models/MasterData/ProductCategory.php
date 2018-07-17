<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'master_product_categories';

    protected $fillable = [
    	'category_name',
    	'category_code',
    	'parent_category_id',
    	'status',
    	'company_id',
    	'is_draft'
    ];

    public static function active()
    {
    	$return = self::whereIsDraft(false)->whereCompanyId(user_info()->company_id);

    	return $return;
    }
}
