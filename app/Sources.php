<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sources extends Model
{
	protected $table = 'sources';
    protected $fillable = [
    	'name',
		'creative_count',
		'lp_count',
		'camp_ids',
		'description',
		'created_by',
		'created_at',
		'updated_at'  
    ];
}
