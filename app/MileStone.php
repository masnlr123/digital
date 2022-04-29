<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MileStone extends Model
{
	protected $table = 'milestone';
    protected $fillable = [
    	'activity',
    	'department',
		'project',
		'campaign',
    	'campaign_id',
    	'ad_campaign_id',
		'channel',
		'medium',
		'source',
		'status',
		'assigned_to',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at'     
    ];
}
