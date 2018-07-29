<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    protected $table = 'master_inventory_type';

    protected $fillable = [
    	'inventory_type_code',
    	'inventory_type_name',
    	'is_draft',
    	'company_id'
    ];

    /**
     * Get available city
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_inventory_type.company_id')
            ->where('master_inventory_type.is_draft', false)
            ->where('master_inventory_type.company_id', user_info('company_id'));

        return $return;

    }
}
