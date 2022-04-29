<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class UTM extends Model
{
    protected $table = 'utm';
    protected $fillable = [
		'project',
		'campaign',
		'url',
		'desktop_creative',
		'mobile_creative',
		'lp_contact',
		'is_dynamic',
		'utm_source',
		'utm_medium',
		'utm_campaign',
		'utm_term',
		'utm_content',
		'utm_adposition',
		'utm_device',
		'utm_network',
		'utm_placement',
		'utm_target',
		'utm_ad',
		'output',
		'created_by'
	];
}
