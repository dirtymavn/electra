<?php

namespace App\Models\System\Core;

use Illuminate\Database\Eloquent\Model;

class CoreFormChain extends Model
{
    
	protected $table = 'core_from_chain';

	protected $fillable = [
		'core_from_id',
		'chain_before',
		'chain_after'
	];
}
