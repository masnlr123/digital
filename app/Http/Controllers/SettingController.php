<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\CreativeTask;
use App\Activity;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCreativeTask;
use Auth;
use Str;
use Redirect;
use App\User;
use App\Sources;
use App\CreativeImages;
use App\Projects;
use App\Campaigns;
use Validator;

class SettingController extends Controller
{
    public function index(){
    	$setting = Setting::all();
    	$setting_cat = Setting::select('cat')->groupBy('cat')->get()->toArray();
    	$setting_name = Setting::select('name')->groupBy('name')->get()->toArray();        
    	$activity = Activity::where('model', 'Settings')->get()->sortByDesc("id");
    	return view('admin.setting', compact(array(
    		'setting',
    		'setting_cat',
    		'activity',
    		'setting_name'
    	)));
    }
    public function profile_overview(){
        return view('admin.setting_pages.general');
    }
    public function store(Request $request){

    	$user = Auth::user();
    	if($request->get('setting_cat') == 'new_cat'){
    		$settingCat = $request->get('setting_cat_new');
    	}
    	else{
    		$settingCat = $request->get('setting_cat');
    	}
    	if($request->get('setting_name') == 'new_name'){
    		$settingName = $request->get('setting_name_new');
    	}
    	else{
    		$settingName = $request->get('setting_name');
    	}
        $settings = new Setting([
			'cat' => $settingCat,
			'name' => $settingName,
			'setting_type' => $request->get('setting_type'),
			'select_type' => $request->get('select_type'),
			'value' => $request->get('setting_value'),
			'created_by' => $user->name
        ]);
        $activity_log = new Activity([
            'name' => 'Setting',
            'model' => 'Settings',
            'description' => 'New Setting Created for '.$settingCat.' with the Setting Name <strong>'.$settingName.'</strong> and the value is <strong>'.$request->get('setting_value').' </strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $settings->save();
        return Redirect::back()->with('setting_created','New Setting Added Successfully !');
    }

    public function store_source(Request $request){

    	if(Auth::check()){
    		$user = Auth::user();
    	}else{
    		return redirect('/');
    	}
        $source = new Sources([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'created_by' => $user->name
        ]);
        $activity_log = new Activity([
            'name' => 'Setting',
            'model' => 'Settings',
            'description' => 'New Source has been created with the Name of'.$request->get('name'),
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $source->save();
        // return response()->json([
        //     'success' => 'The Source has been added successfully!'
        // ]);
        return Redirect::back()->with('setting_created','New Setting Added Successfully !');
    }
    public function destroy($id)
    {
        $cre_task = Setting::find($id);
        $cre_task->delete();

        return Redirect::back()->with('success', 'Setting deleted!');
    }
    public function index_task_department()
    {
        return view('admin.setting_pages.project.task_department');
    }
    public function store_task_department(Request $request){
        $user = Auth::user();
        $department = array();
        $department['name'] =  $request->get('name');
        $department['icon'] =  $request->get('icon');
        if(isset($request->url)){
            $department['url'] =  $request->get('url');
        }
        else{
            $department['url'] =  Str::slug($request->get('name'));
        }
        $department['users'] =  json_encode($request->get('users'));
        $store_department = new Setting([
            'name' => 'task_department',
            'value' => json_encode($department),
            'created_by' => $user->name
        ]);
        $store_department->save();
        return Redirect::back();
    }
    public function store_lp(Request $request){
        $user = Auth::user();
        $lp = array();
        $lp['name'] =  $request->get('name');
        $lp['url'] =  $request->get('url');
        $store_lp = new Setting([
            'name' => 'dynamic_lp',
            'value' => json_encode($lp),
            'created_by' => $user->name
        ]);
        $store_lp->save();
        return Redirect::back();
    }



}
