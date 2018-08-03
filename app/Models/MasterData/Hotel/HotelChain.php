<?php

namespace App\Models\MasterData\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelChain extends Model
{
    protected $table = 'master_hotel_chain';

    protected $fillable = [
    	'name',
    	'description',
        'branch_id',
    	'company_id'
    ];

    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_hotel_chain.company_id')
            ->where('master_hotel_chain.company_id', user_info('company_id'));

        return $return;

    }
}
