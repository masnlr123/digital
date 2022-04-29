<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $table = 'sub_tasks';
    protected $fillable = [
            'id',
            'model',
            'task_id',
            'user_id',
            'parent_id',
            'assignee',
            'name',
            'activity',
            'brief',
            'due_date',
            'deliverable',
            'status',
            'duration',
            'is_main_task',
            'main_task_id',
    ];
    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'assignee');
    }
}
