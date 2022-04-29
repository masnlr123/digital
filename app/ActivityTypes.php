<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTypes extends Model
{
    protected $table = 'activity_types';
    protected $fillable = [
	    'id',
	    'name',
	    'module',
	    'fields',
	    'type',
	    'status',
	    'created_by'
	    ];
}
