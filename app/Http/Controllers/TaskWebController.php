<?php

namespace App\Http\Controllers;

use App\TaskWeb;
use App\SubTask;
use App\Activity;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DataTables;
use DB;
use Redirect;
use App\User;
use App\Projects;
use App\Campaigns;
use Validator;


class TaskWebController extends Controller
{
	public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
    }

    public function quick(Request $request)
    {
        $cre = TaskWeb::all();
        foreach($cre as $task){
            if(!empty($task->project)){
                $get_project = Projects::where('shortcode', $task->project)->first();
                if(!empty($get_project)){
                    $project_id = $get_project->id;
                }
                else{

                    $project_id = NULL;
                }
            }
            else{
                    $project_id = NULL;
            }
            if(!empty($task->assignee)){
                $get_user = User::find($task->assignee);
                $responsible = $get_user->name;
            }
            else{

                $responsible = NUll;
            }
            $store_task = new Task([
                'name' => $task->name,
                'project_id' => $project_id,
                'camp_id' =>  0,
                'department' =>  'Web',
                'eta' =>  $task->task_owner_eta,
                'responsible' =>  $responsible,
                'status' =>  strtolower($task->status),
                'created_by' =>  $task->created_by,
                'brief' =>  $task->brief,
                'activity' =>  $task->activity,
                'priority' =>  $task->task_priority
            ]);
            $store_task->save();

        }
        echo 'Updated!';
    }

    //*** JSON Request
    public function datatables(Request $request)
    {
         $datas = TaskWeb::orderBy('id','desc');

         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_at', [$from, $to]);
        }
        // else{
        //     $from = date('Y-m-d', strtotime('today - 29 days'));
        //     $to = Carbon::now();
        //     $datas->whereBetween('created_at', [$from, $to]);

        // }
         if(isset($request->project)){
            $datas->where('project', $request->project);
        }
         if(isset($request->activity)){
            $datas->where('activity', $request->activity);
        }
         if(isset($request->assignee)){
            $datas->where('assignee', $request->assignee);
        }
         if(isset($request->status)){
            if($request->status == 'Not_Completed'){
                $datas->where('status', '!=', 'Completed');
            }
            else{
                $datas->where('status', $request->status);
            }
        }
        $datas->get();

         return DataTables::of($datas)
            ->addColumn('lp', function(TaskWeb $data) {
                return $data->live;
            })
            ->editColumn('assignee', function(TaskWeb $data) {
                $assignee = $data->assignee;
                if($assignee == NULL){
                    $assignee_name = 'No Assignee';
                }
                else{
                    $get_assignee = User::where('id', $assignee)->first();
                    $assignee_name = $get_assignee->name;
                }
                return $assignee_name;
            })
            ->editColumn('campaign', function(TaskWeb $data) {
                $campaign = $data->campaign;
                if($campaign == "Non Campaign Task"){
                    $campaign_name = 'Non Campaign Task';
                }
                elseif($campaign == NULL){
                    $campaign_name = 'Campaign Not found';
                }
                else{
                    $get_campaign = Campaigns::where('id', $campaign)->first();
                    $campaign_name = $get_campaign->name;
                }
                return $campaign_name;
            })
            ->editColumn('duration', function(TaskWeb $data) {
                $minutes = $data->duration;

                $hours = floor($minutes / 60);
                $min = $minutes - ($hours * 60);

                return $hours.":".$min;
            })
            ->addColumn('status', function(TaskWeb $data) {
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'new':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                    case 'New Updates':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">New Updates</span>';
                        break;
                    case 'WIP':
                        $creative_status_tag = '<span style="background: orange !important;" class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">WIP</span>';
                        break;
                    case 'Correction Updates':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">Correction Updates</span>';
                        break;
                    case 'Under Review':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--assigned kt-badge--inline kt-badge--pill">Under Review</span>';
                        break;
                    case 'Completed':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                        break;
                    
                    default:
                        $creative_status_tag = '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                } 
                return $creative_status_tag;
            })
            ->addColumn('action', function(TaskWeb $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_web',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                $action .= '<form class="d-inline" action="' . route('delete_web',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_web',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                endif;
                return $action;
            })
            ->rawColumns(['lp', 'status', 'types', 'action'])
            ->toJson();
    }
    //*** JSON Request
    public function lp_datatables()
    {
         $datas = TaskWeb::orderBy('id','desc')->where('lp_url', '!=', NULL)->get();
         return DataTables::of($datas)
            ->addColumn('lp', function(TaskWeb $data) {
                $lp_url = $data->lp_url;
                if($lp_url){
                    return '<a href="'.$lp_url.'" target="_blank">'.$lp_url.'</a>';
                }
            })
            ->addColumn('month', function(TaskWeb $data) {
                $this_month = Carbon::parse($data->updated_at)->format('F - Y');
                return $this_month;
            })
            ->addColumn('live', function(TaskWeb $data) {
                if($data->live == "Live"){
                    $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Live</span>';
                }
                else{
                    $creative_status_tag = '<span class="kt-badge kt-badge--external-review kt-badge--inline kt-badge--pill" style="color:#fff !important;">Pause</span>';
                }
                return $creative_status_tag;
            })
            // ->editColumn('assignee', function(TaskWeb $data) {
            //     $assignee = $data->assignee;
            //     if($assignee == NULL){
            //         $assignee_name = 'No Assignee';
            //     }
            //     else{
            //         $get_assignee = User::where('id', $assignee)->first();
            //         $assignee_name = $get_assignee->name;
            //     }
            //     return $assignee_name;
            // })
            // ->editColumn('campaign', function(TaskWeb $data) {
            //     $campaign = $data->campaign;
            //     if($campaign == "Non Campaign Task"){
            //         $campaign_name = 'Non Campaign Task';
            //     }
            //     elseif($campaign == NULL){
            //         $campaign_name = 'Campaign Not found';
            //     }
            //     else{
            //         $get_campaign = Campaigns::where('id', $campaign)->first();
            //         $campaign_name = $get_campaign->name;
            //     }
            //     return $campaign_name;
            // })
            ->addColumn('status', function(TaskWeb $data) {
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'new':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                    case 'New Updates':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">New Updates</span>';
                        break;
                    case 'Correction Updates':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">Correction Updates</span>';
                        break;
                    case 'Under Review':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--assigned kt-badge--inline kt-badge--pill">Under Review</span>';
                        break;
                    case 'Completed':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                        break;
                    
                    default:
                        $creative_status_tag = '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                } 
                return $creative_status_tag;
            })
            ->addColumn('action', function(TaskWeb $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' .$data->lp_url. '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5" target="_blank"> <i class="fas fa-eye"></i></a></div>';
                // if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                // $action .= '<form class="d-inline" action="' . route('delete_creative',$data->id) . '" method="POST">
                // <input type="hidden" name="_method" value="DELETE">
                // <input type="hidden" name="_token" value="'.csrf_token().'">
                // <button title="Delete details" 
                // class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                // href="' . route('delete_creative',$data->id) . '">
                // <i class="flaticon2-trash"></i>
                // </button>
                // </form>';
                // endif;
                return $action;
            })
            ->rawColumns(['lp', 'month', 'live', 'status', 'types', 'action'])
            ->toJson();
    }

    public function index()
    {
        $current_user = Auth::user();
        $web_task = TaskWeb::all();
        $projects = TaskWeb::select('project')->distinct()->get();
        $activity = TaskWeb::select('activity')->distinct()->get();
        $assignees = TaskWeb::select('assignee')->distinct()->get();
        $status = TaskWeb::select('status')->distinct()->get();
        return view('task.web.dataindex', compact(array('web_task', 'current_user', 'projects', 'activity', 'assignees', 'status')));
    }
    public function lp_index()
    {
        $current_user = Auth::user();
        $web_task = TaskWeb::all();
        return view('task.web.index', compact(array('web_task', 'current_user')));
    }
    public function create()
    {
        //
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['1', '8'])->get();
        return view('task.web.create', compact(array('projects', 'campaigns', 'users')));
    }

    public function store(Request $request)
    {
    	$user = Auth::user();
        // $camp = '';
        if($request->get('campaign') == 0){
            $project = $request->get('project');
            $campaign = 'Non Campaign Task';
            $campaign_name = 'Non Campaign Task';
        }else{
            $camp_id = $request->get('campaign');
            $camp = Campaigns::where('id', $camp_id)->first();
            $project = $request->get('project');
            $campaign = $camp->id;
            $campaign_name = $camp->name;
        }

        $store_craetive_task = new TaskWeb([
            'name' => $request->get('name'),
            'project' => $project,
            'campaign' => $campaign,
            'activity' => $request->get('activity'),
            'task_owner_eta' => $request->get('task_owner_eta'),
            'developer_eta' => $request->get('developer_eta'),
            'brief' => $request->get('brief'),
            'status_notes' => $request->get('status_notes'),
            'priority' => $request->get('priority'),
            'assignee' => $request->get('assignee'),
            'status' => 'new',
			'created_by' => $user->name
        ]);
        $store_craetive_task->save();
        $sub_task = $request->get('sub_task_list');
        if($sub_task !== null){
            foreach ($sub_task as $task){
                $new_sub_task = new SubTask([
                    'model' => 'TaskWeb',
                    'user_id' => $user->id,
                    'parent_id' => $store_craetive_task->id,
                    'name' => $task['name'],
                    'activity' => $task['activity'],
                    'due_date' => $task['eta'],
                    'status' => 'New'
                ]);
                $new_sub_task->save();
            }
        }
        $get_assignee = User::where('id', $request->get('assignee'))->first();
        $task_edit_url = route('edit_web',  $store_craetive_task->id);
        $mdata = array(
            'to' => $get_assignee->email,
            'cc' => 'vijay.cs@alliancein.com',
            'to_name' => $get_assignee->name,
            'from' => $user->email,
            'from_name' => $user->name.' - From Alliance Group',
            'subject' => ' New Task - '.$request->get('name'),
            'task_name' => $request->get('name'),
            'campaign' => $campaign_name,
            'priority' => $request->get('priority'),
            'status' => 'new',
            'created_by' => $user->name,
            'edit_url' => $task_edit_url,
            'created_time' => date('Y-m-d H:i:s')
        );
        Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendNewTask($mdata));

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskWeb',
            'model_id' => $store_craetive_task->id,
            'description' => 'The Creative Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

    	return redirect('/task/web')->with('success', 'Web task Created Successfully!');
    }

    public function view($id)
    {
        $user = Auth::user();
        $creative_task = TaskWeb::find($id);
        $activity = Activity::where('model', 'TaskWeb')->where('model_id', $creative_task->id)->get();
        return view('task.creative.view', compact(array('creative_task', 'creative_users', 'approval_users', 'creatives', 'users', 'current_user', 'agency_users', 'activity')));    
    }
    public function edit($id)
    {
        $projects = Projects::all();
        $user = Auth::user();
        $web_task = TaskWeb::find($id);
        $sub_task = SubTask::where('model', 'TaskWeb')->where('parent_id', $id)->get();
        $campaigns = Campaigns::all();
        $activity = Activity::where('model', 'TaskWeb')->where('model_id', $web_task->id)->get();
        return view('task.web.edit', compact(array('web_task', 'projects', 'campaigns','activity', 'sub_task')));    
    }

    public function update_status(Request $request, $id)
    {	
        $user = Auth::user();
        $c_task = TaskWeb::find($id);
        $old_task = $c_task->status;
        $c_task->status = $request->get('status');
        $c_task->duration = $request->get('duration');
        $c_task->lp_url = $request->get('lp_url');
        $duration = $request->get('duration');
        $c_task->save();


        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskWeb',
            'model_id' => $c_task->id,
            'description' => 'The web task status has been updated from <strong>'.$old_task.'</strong> to <strong>'.$request->get('status').'</strong> with total duration : <strong>'.$duration.'</strong>. Status Notes: '.$request->get('status_notes').' | Updated by - '.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');

    }
    public function update_sub_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskWeb::find($id);
        $tasks = $request->get('sub_task_update');
        foreach ($tasks as $sub_tasks){
            $update_sub_task = SubTask::find($sub_tasks['id']);
            $update_sub_task->deliverable = $sub_tasks['deliverable'];
            $update_sub_task->duration = $sub_tasks['duration'];
            $update_sub_task->status = $sub_tasks['status'];
            $update_sub_task->save();
        }

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function update(Request $request, $id)
    {   
    	$user = Auth::user();
        $c_task = TaskWeb::find($id);

        if($request->get('campaign') == 0){
            $project = $request->get('project');
            $campaign = 'Non Campaign Task';
        }else{
            $camp_id = $request->get('campaign');
            $camp = Campaigns::where('id', $camp_id)->first();
            $project = $request->get('project');
            $campaign = $camp->id;
        }
        $c_task->name = $request->get('name');
        $c_task->project = $project;
        $c_task->campaign = $campaign;
        $c_task->activity = $request->get('activity');
        $c_task->task_owner_eta = $request->get('task_owner_eta');
        $c_task->developer_eta = $request->get('developer_eta');
        $c_task->brief = $request->get('brief');
        $c_task->status_notes = $request->get('status_notes');
        $c_task->priority = $request->get('priority');
        $c_task->assignee = $request->get('assignee');
        $c_task->live = $request->get('live');
        $c_task->platform = $request->get('platform');
        $c_task->month = $request->get('month');
        $c_task->save();

        //Update Sub Task
        $sub_task = $request->get('sub_task_list');
        $old_sub_task = SubTask::where('model', 'TaskWeb')->where('parent_id', $c_task->id)->get();
        $selected_task = array();

        if($sub_task !== null){
            foreach ($sub_task as $task) {
                $sub_task_id = $task['id'];
                if($sub_task_id == '0'){
                    $new_sub_task = new SubTask([
                        'model' => 'TaskWeb',
                        'user_id' => $user->id,
                        'parent_id' => $c_task['id'],
                        'name' => $task['name'],
                        'activity' => $task['activity'],
                        'due_date' => $task['eta'],
                        'status' => 'New'
                    ]);
                    $new_sub_task->save();
                }
                else{
                    $oldtask = SubTask::find($task['id']);
                    $oldtask->name = $task['name'];
                    $oldtask->activity = $task['activity'];
                    $oldtask->due_date = $task['eta'];
                    $oldtask->save();
                    $selected_task[] = $task['id'];
                }
            }
            foreach ($old_sub_task as $old_task) {
                if(in_array($old_task->id, $selected_task)){

                }
                else{
                    $cre_task = SubTask::find($old_task->id);
                    $cre_task->delete();
                }
            }
        }
        else{
            foreach ($old_sub_task as $old_task) {
                $cre_task = SubTask::find($old_task->id);
                $cre_task->delete();
            }

        }
        // print_r($old_sub_task);

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskWeb',
            'model_id' => $c_task->id,
            'description' => 'The web task details updated by'.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }

    
    public function get_lp_http_code($id, $url){
        $http = curl_init($url);
        $result = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        curl_close($http);
        echo $http_status;
        $lp = TaskWeb::find($id);
        $lp->lp_status = $http_status;
        $lp->save();
    }

    public function get_lp_status(){
        $lps = TaskWeb::orderBy('id','desc')->where('lp_url', '!=', NULL)->get();
        foreach ($lps as $lp) {
            $this->get_lp_http_code($lp->id, $lp->lp_url);
        }
    }

    public function destroy($id)
    {
        $cre_task = TaskWeb::find($id);
        $cre_task->delete();
        return Redirect::back()->with('success', 'Task deleted!');
    }
}
