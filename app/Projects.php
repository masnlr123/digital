<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
	protected $table = 'projects';
    protected $fillable = [
		'name',
		'shortcode',
		'project_type',
		'launch_date',
		'business_name',
		'developer',
		'gated_community',
		'ownership',
		'current_status',
		'hand_over_date',
		'rera_no',
		'lms',
		'furnishing_status',
		'target_audience',
		'awards',
		'website',
		'site_address',
		'email',
		'acres',
		'blocks',
		'floors',
		'units',
		'total_floors',
		'product_range',
		'amenities',
		'top_competitor',
		'status',
		'created_by',
		'created_at',
		'updated_at'
    ];
}
