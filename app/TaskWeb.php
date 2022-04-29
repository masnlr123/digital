<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskWeb extends Model
{
    protected $table = 'task_web';

    protected $fillable = [
		'id',
		'name',
		'project',
		'campaign',
		'activity',
		'task_owner_eta',
		'developer_eta',
		'brief',
		'status_notes',
		'priority',
		'live',
		'platform',
		'month',
		'lp_url',
		'lp_status',
		'lp_created_at',
		'assignee',
		'duration',
		'status',
		'created_by',
		'created_at',
		'updated_at'
	];
}
