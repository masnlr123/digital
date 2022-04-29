<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedCreativeReport extends Model
{
    protected $table = 'saved_creative_reports';
    protected $fillable = [
    	'data_range',
		'project',
		'creative',
		'spend',
		'impression',
		'cpm',
		'reach',
		'frequency',
		'clicks',
		'ctr',
		'fb_leads',
		'lms_fb_leads',
		'leads_diff',
		'valid_leads',
		'valid_leads_per',
		'walk_in',
		'cpl',
		'cpvl',
		'cpw',
		'reach_to_leads',
		'lmp_to_leads',
		'clicks_to_leads',
		'vltw'
	];
}
