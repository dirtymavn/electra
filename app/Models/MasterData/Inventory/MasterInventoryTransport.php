<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryTransport extends Model
{
    protected $table = 'master_inventory_transport';

    protected $fillable = [
    	'master_inventory_id',
        'airline_no',
        'reissue',
        'valid_from',
        'valid_to',
        'issue_date',
        'conjunction_ticket_flag',
        'conjunction_firts_ticket',
    ];
}
