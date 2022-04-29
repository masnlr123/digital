<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creatives extends Model
{

    protected $table = 'creatives';

    protected $fillable = [
		'url',
		'task_id',
		'creative_id',
		'designer_comment',
		'approval_comment',
		'note',
		'status',
		'assignee',
		'eta',
		'is_mail',
		'mail_to',
		'mail_cc',
		'updated_by',
		'approval_by',
		'created_at',
		'deleted_at'     
    ];
}
