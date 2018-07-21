<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_departments';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'department_name',
        'department_code',
        'is_draft',
    ];

    /**
     * Get the user for the department.
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_department_id', 'id');
    }

    /**
     * Get available department
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'company_departments.company_id')
            ->where('company_departments.is_draft', false)
            ->where('company_departments.company_id', user_info('company_id'));

        return $return;

    }
}
