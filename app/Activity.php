<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $table = 'activities';
    protected $fillable = [
    	'name',
		'model',
		'model_id',
		'description',
		'created_by',
		'created_at',
		'updated_at',
		'deleted_at'     
    ];

    public function creative_task() {     
		return $this->belongsTo('CreativeTask::class');
	}
}
