<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskPaid extends Model
{
    protected $table = 'task_paid';

    protected $fillable = [
		'id',
		'name',
		'department',
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
