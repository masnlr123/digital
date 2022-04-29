<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdCampaigns extends Model
{
	protected $table = 'ad_campaigns';
    protected $fillable = [
    	'name',
		'project',
		'campaign',
    	'campaign_id',
		'channel',
		'medium',
		'source',
		'type',
		'status',
		'assigned_to',
		'description',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at'     
    ];
}
