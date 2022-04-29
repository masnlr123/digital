<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreativeReport extends Model
{
    protected $table = 'creative_reports';
    protected $fillable = [
		'name',
		'project',
		'lead_id',
		'lead_number',
		'contact',
		'lead_stage',
		'lead_source',
		'campaign',
		'page',
		'form',
		'ad_name',
		'ad_set',
		'ad_group',
		'created_on',
		'is_valid'
	];
}
