<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Attendance;
use Redirect;
use Auth;
use Carbon\Carbon;
// use Request;
use Session;
use Cookie;
use App\Exports\ExportAttendance;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function start_work(Request $request){
    	$start_date_time = now();
    	$start_date = $start_date_time->format('Y-m-d H:i:s');
        $start_only_date = $start_date_time->format('Y-m-d H:i:s');
    	$start_time = $start_date_time->format('H:i:s');
    	$logged_user = Auth::user()->id;
    	$logged_ip = $_SERVER['REMOTE_ADDR'];
        if(Cookie::get('screen') !== null){
            $login_screen = Cookie::get('screen');
        }
        else{
            $login_screen = NULL;
        }
    	$data = new Attendance([
	        'user_id' => $logged_user,
	        'start_date' => $start_date,
	        'start_time' => $start_time,
	        'start_ip' => $logged_ip,
            'login_device' => $request->header('user-agent'),
            'login_screen' => $login_screen,
    	]);
    	$data->save();
    	return Redirect::back();
    }
    public function stop_work(Request $request){
        $user = Auth::user();
        $data = Attendance::whereDay('start_date', date('d'))->where('user_id', $user->id)->whereNull('end_date')->first(); 

    	$end_date_time = now();
    	$end_date = $end_date_time->format('Y-m-d H:i:s');
    	$end_time = $end_date_time->format('H:i:s');
    	$logged_ip = $_SERVER['REMOTE_ADDR'];

        // if(Cookie::get('screen') !== null){
        //     $logout_screen = Cookie::get('screen');
        // }
        // else{
        //     $logout_screen = NULL;
        // }
        $logout_screen = Cookie::get('screen');
    	if(!empty($data)){
	        $date = new \DateTime($data->start_date);
	        $date2 = new \DateTime($end_date);
	        $total_sec = $date2->getTimestamp() - $date->getTimestamp();
	        $total_sec = $total_sec;
	        $total_sec = round($total_sec);
	        $total_duration = sprintf('%02d:%02d:%02d', ($total_sec/ 3600),($total_sec/ 60 % 60), $total_sec% 60);

		    $data->user_id = $user->id;
		    $data->end_date = $end_date;
		    $data->end_time = $end_time;
		    $data->end_ip = $logged_ip;
		    $data->total_duration = $total_duration;
            $data->logout_device = $request->header('User-Agent');
            $data->logout_screen = $logout_screen;
	    	$data->save();
    	}
    	return Redirect::back();
    }
    public function stop_work_remote(){
        $user = Auth::user();
        $data = Attendance::whereDay('start_date', date('d'))->where('user_id', $user->id)->whereNull('end_date')->first(); 
        $end_date_time = now();
        $end_date = $end_date_time->format('Y-m-d H:i:s');
        $end_time = $end_date_time->format('H:i:s');
        $logged_ip = $_SERVER['REMOTE_ADDR'];
        if(!empty($data)){
            $date = new \DateTime($data->start_date);
            $date2 = new \DateTime($end_date);
            $total_sec = $date2->getTimestamp() - $date->getTimestamp();
            $total_sec = $total_sec;
            $total_sec = round($total_sec);
            $total_duration = sprintf('%02d:%02d:%02d', ($total_sec/ 3600),($total_sec/ 60 % 60), $total_sec% 60);

            $data->user_id = $user->id;
            $data->end_date = $end_date;
            $data->end_time = $end_time;
            $data->end_ip = $logged_ip;
            $data->total_duration = $total_duration;
            $data->save();
        }
        Session::forget('gloabl_work_timer');
    }
    public function cron_stop_work(Request $request){
        $end_date_time = Carbon::now()->subDays(1);
        $today_date = $end_date_time->format('Y-m-d');
        $end_date = $end_date_time->format('Y-m-d H:i:s');
        $end_time = '18:30:00';
        $logged_ip = $_SERVER['REMOTE_ADDR'];
        $selected_data = Attendance::whereDate('start_date', '=', $today_date)->whereNull('end_date')->get();
        // $selected_data = Attendance::whereDate('start_date', '=', $today_date)->get();
        foreach($selected_data as $data){
            $date = new \DateTime($data->start_date);
            $date2 = new \DateTime($end_date);
            $total_sec = $date2->getTimestamp() - $date->getTimestamp();
            $total_sec = round($total_sec);
            $total_duration = sprintf('%02d:%02d:%02d', ($total_sec/ 3600),($total_sec/ 60 % 60), $total_sec% 60);
            $data->end_date = $end_date;
            $data->end_time = $end_time;
            $data->end_ip = $logged_ip;
            $data->total_duration = $total_duration;
            $data->save();
        }

        // $logged_user = Auth::user()->id;
        // if($logged_user == '11'){
        //     $request->session()->flush();
        //     Session::forget('gloabl_work_timer');
        //     return Redirect::back()->with('gloabl_work_timer_stoped', 'Your work timer has been stopped successfully. Thank you!.');
        // }
    }
    public function stop_all() 
    {
        $logged_ip = $_SERVER['REMOTE_ADDR'];
        $data = new Attendance([
            'user_id' => '1',
            'start_date' => '2021-01-06',
            'start_time' => '18:30:01',
            'start_ip' => $logged_ip,
        ]);
        $data->save();
    }
    public function exportAttendance() 
    {
        return Excel::download(new ExportAttendance, 'Attendance.xlsx');
    }
    
}
