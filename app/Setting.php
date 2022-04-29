<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Setting extends Model
{
	protected $table = 'settings';
    protected $fillable = [
		'cat',
		'setting_type',
		'select_type',
		'name',
		'value',
		'status',
		'created_by',
		'created_at',
		'updated_at'
    ];

    public static function getValue($name){
    	return DB::table('settings')->where('name', $name)->get();
    }
}
