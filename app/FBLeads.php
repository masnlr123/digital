<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FBLeads extends Model
{
    protected $table = 'f_b_leads';
    protected $fillable = [
		'list_name',
		'project',
		'lead_id',
		'sub_project',
		'name',
		'contact',
		'email',
		'source',
		'source_orgin',
		'sub_source',
		'activity',
		'api_response',
		'ad_name',
		'adset_name',
		'campaign_name',
		'form_name',
		'imported_by',
		'duration',
		'stage',
		'status'
    ];
}
