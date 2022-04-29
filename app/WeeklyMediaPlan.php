<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeklyMediaPlan extends Model
{
	protected $table = 'weekly_media_plans';
    protected $fillable = [
		'media_plan_id',
		'source',
		'month',
		'week',
		'from_date',
		'to_date',
		'leads_per',
		'leads',
		'valid_leads_per',
		'valid_leads',
		'cpl',
		'cpvl',
		'created_by',
		'created_at',
		'updated_at'
    ];
}
