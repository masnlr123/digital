<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = ['invoice_id','invoice_teamplate','grid','customer','client','amount','tax','cross_total','total_amount','created_by','created_at','deleted_at'];

    public $timestamps = false;

    public function Many()
    {
    	return $this->hasMany('App\Models\ClassName');
    }
    public function To()
    {
    	return $this->belongsTo('App\Models\ClassName')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
    }

    public function One()
    {
        return $this->hasOne('App\Models\ClassName');
    }

}