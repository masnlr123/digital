<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreativeSamples extends Model
{
	protected $table = 'creative_samples';

    protected $fillable = [
		'id',
		'task_id',
		'name',
		'path',
		'location',
		'comment',
		'upload_by',
		'modified_by',
		'approval',
		'created_at',
		'updated_at',
		'deleted_at'     
    ];

    public function creative_task() {     
		return $this->belongsTo('CreativeTask::class');
	}
}