<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LpLeads extends Model
{
    protected  $connection  = 'analytics';
    protected  $table = 'leads';
    protected $fillable = [
        'track_id',
        'name',
        'email',
        'contact',
        'lp_id',
        'leadsquared_submited',
        'lead_id',
        'lead_stage',
        'project',
        'source',
        'update_in_leadsquared',
        'created_at',
        'updated_at'
	];
    // public function task()
    // {
    //     return $this->hasOne('App\Models\Task', 'id', 'task_id');
    // }

}
