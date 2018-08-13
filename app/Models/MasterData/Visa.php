<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Request;

class Visa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'master_visa';

    protected $fillable = [
    	'passport_id',
        'visa_purpose',
        'visa_code',
        'visa_no',
        'validity',
        'length_of_stay',
        'no_of_entries',
        'issue_date',
        'expiry_date',
        'selling_currency',
        'cost_currency',
        'cost',
        'profit',
        'remark',
        'status',
        'company_id',
        'branch_id'

    ];

    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_visa.company_id')
            ->where('master_visa.company_id', user_info('company_id'));

        return $return;

    }

    public function visaDocument()
    {
        return $this->hasMany(VisaDocument::class, 'master_visa_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::created(function($Visa) {
            $input = Request::all();
            // $input['id_hotel_allotment'] = $Visa->id;

            $Visadocumentdetail = \DB::table('temporaries')->whereType('visadocument-detail')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($Visadocumentdetail) > 0) {
                foreach ($Visadocumentdetail as $visadocumentvalue) {
                    $visdocData = json_decode($visadocumentvalue->data);

                    $visdoc = new VisaDocument;
                    $visdoc->master_visa_id = $Visa->id;
                    $visdoc->document_type = $visdocData->document_type;
                    $visdoc->document_uri = $visdocData->document_uri;
                    $visdoc->company_id = user_info('company_id');
                    $visdoc->save();

                }
            }

        });

    }
}