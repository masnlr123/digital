<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskSEO extends Model
{
    protected $table = 'task_seo';

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
		'assignee',
		'duration',
		'status',
		'created_by',
		'created_at',
		'updated_at'
	];
}
