<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $fillable = [
    	'name',
    	'account_id',
    	'section_type',
    	'project_id',
    	'camp_id',
    	'ad_camp_id',
    	'section_id',
    	'department',
        'activity',
        'custom',
    	'team',
    	'creatives',
    	'eta',
    	'tag',
    	'brief',
    	'priority',
    	'responsible',
    	'score',
    	'duration',
    	'status',
    	'approval',
        'timer',
        'timer_id',
        'is_from_sub_task',
        'from_sub_task_id',
    	'created_by',
		'created_at',
		'updated_at'
	];

    public function project()
    {
        return $this->hasOne('App\Projects', 'id', 'project_id');
    }
    public function campaign()
    {
        return $this->hasOne('App\Campaigns', 'id', 'camp_id');
    }
    public function ad_campaign()
    {
        return $this->hasOne('App\AdCampaigns', 'id', 'ad_camp_id');
    }
    public function milestone()
    {
        return $this->hasOne('App\MileStone', 'id', 'section_id');
    }
    public function sub_task()
    {
        return $this->hasMany('App\SubTask');
    }
}
