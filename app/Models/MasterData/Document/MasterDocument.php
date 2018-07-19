<?php

namespace App\Models\MasterData\Document;

use Illuminate\Database\Eloquent\Model;

class MasterDocument extends Model
{
    protected $table = 'master_documents';

    protected $fillable = [
    	'document_type',
    	'document_uri',
    	'company_id',
    	'branch_id',
    	'user_id',
    	'is_draft'
    ];


    /**
     * Get the rate for the currency.
     */
    public function queues()
    {
        return $this->hasMany(MasterQueueMessage::class, 'attached_document');
    }


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($document) {
        	$documents = \DB::table('temporaries')->whereType('data-document')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($documents) > 0) {
                foreach ($documents as $val) {
                    $value = json_decode($val->data);

                   $rate = new MasterQueueMessage;
                   $rate->attached_document = $document->id;
                   $rate->queue_message = $value->queue_message;
                   $rate->due_date = $value->due_date;
                   $rate->subject = $value->subject;
                   $rate->target_role = $value->target_role;
                   $rate->spesific_role = $value->spesific_role;
                   $rate->status = $value->status;

                   $rate->save();
                }
            }
        });
    }
}
