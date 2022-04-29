<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = [
    	'name',
    	'ext',
    	'created_by',
		'created_at',
		'updated_at'
	];
}
