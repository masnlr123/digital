<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\BunnyCDNStorage;
use App\Campaigns;
use App\CreativeTask;
use App\TaskPaid;
use App\Activity;
use App\TaskSEO;
use App\TaskLMS;
use App\TaskWeb;
use App\User;
use App\Setting;
use App\Inbox;
use App\Emoji;
// use Webklex\IMAP\Client;
use Webklex\IMAP\Facades\Client;
use Carbon\Carbon;
use Auth;
use DB;
use DataTables;
use Redirect;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewTask;
use App\Mail\DailyTaskNotice;

// use Config;
use Illuminate\Support\Facades\Config;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$bunnyCDNStorage = new BunnyCDNStorage("urbanris", "0f398b11-1e7f-48e4-be47832ed3c9-aab7-4614");
    	$files = $bunnyCDNStorage->getStorageObjects("/urbanris/");
    	// echo '<pre>';
    	// print_r($files);
    	// echo '</pre>';
    	// foreach($files as $file){
    	// 	echo '<img src="https://urbanrislp.b-cdn.net/'.$file->ObjectName.'">';
    	// }
        return view('media.bunny', compact(array('files')));    
    }
    public function store_media(Request $request){
        $dashboad = new \stdClass;
        $dashboad->all_leads = 'Success!';
        return response()->json($dashboad, 200);
    }
}