<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected  $table = 'timer';
    protected $fillable = [
    	'department',
    	'task_id',
    	'user_id',
    	'date',
    	'start',
    	'end',
    	'duration',
		'created_at',
		'updated_at'
	];
    public function task()
    {
        return $this->hasOne('App\Models\Task', 'id', 'task_id');
    }
    // public function campaign()
    // {
    //     return ->hasOne('App\Campaigns', 'id', 'camp_id');
    // }
    // public function ad_campaign()
    // {
    //     return ->hasOne('App\AdCampaigns', 'id', 'ad_camp_id');
    // }
    // public function milestone()
    // {
    //     return ->hasOne('App\MileStone', 'id', 'section_id');
    // }
    // public function sub_task()
    // {
    //     return ->hasMany('App\SubTask');
    // }
}
