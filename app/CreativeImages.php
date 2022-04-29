<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreativeImages extends Model
{

    protected $table = 'creative_images';

    protected $fillable = [
		'creative_id',
		'order_id',
		'status',
		'name',
		'path',
		'location',
		'comment',
		'reapproval_notes',
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
