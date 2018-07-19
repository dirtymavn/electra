<?php

namespace App\Models\MasterData\Document;

use Illuminate\Database\Eloquent\Model;

class MasterQueueMessage extends Model
{
    protected $table = 'master_queue_messages';

    protected $fillable = [
    	'attached_document',
    	'queue_message',
    	'due_date',
    	'subject',
    	'target_role',
    	'spesific_role',
    	'company_id',
    	'branch_id',
    	'user_id',
    	'status'
    ];
}
