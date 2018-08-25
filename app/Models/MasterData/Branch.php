<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Branch extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_branchs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'branch_name',
        'branch_code',
        'branch_address',
        'branch_phone',
        'is_draft',
    ];

    /**
     * Get the user for the branch.
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'branch_id', 'id');
    }

    /**
     * Get available branch
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'company_branchs.company_id')
            ->where('company_branchs.is_draft', false)
            ->where('company_branchs.company_id', user_info('company_id'));

        return $return;

    }

    public static function findMyBranch($company_id=null){
        $return = self::where('is_draft', false);
        
        if(is_null($company_id)){
            $company_id= user_info('company_id');
        }
        $return= $return->where('company_id', $company_id)->first();
        return $return;
    }
}
