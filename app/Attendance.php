<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'user_id',
        'start_date',
        'start_time',
        'start_ip',
        'end_date',
        'end_time',
        'login_device',
        'logout_device',
        'login_screen',
        'logout_screen',
        'end_ip',
        'total_duration'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function started_date()
    {
        return \Carbon\Carbon::Parse($this->start_date)->format('d-m-Y');
    }
    public function ended_date()
    {
        return \Carbon\Carbon::Parse($this->end_date)->format('d-m-Y');
    }
}
