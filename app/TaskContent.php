<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskContent extends Model
{
    protected $table = 'task_content';

    protected $fillable = [
		'id',
		'name',
		'project',
		'campaign',
		'activity',
		'task_owner_eta',
		'content',
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
