<?php

namespace App\Http\Controllers;

use App\TaskPaid;
use App\SubTask;
use App\Activity;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewTask;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;
use Redirect;
use App\Models\Task;
use App\User;
use App\Projects;
use App\Campaigns;
use Validator;

class TaskPaidController extends Controller
{
	public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
    }

    public function quick(Request $request)
    {
        $cre = TaskPaid::all();
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
                'department' =>  'Paid',
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
    public function datatables()
    {
         $datas = TaskPaid::where('campaign', '!=', 'NCT')->orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->editColumn('assignee', function(TaskPaid $data) {
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
            ->editColumn('campaign', function(TaskPaid $data) {
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
            ->editColumn('duration', function(TaskPaid $data) {
                $minutes = $data->duration;

                $hours = floor($minutes / 60);
                $min = $minutes - ($hours * 60);

                return $hours.":".$min;
            })
            ->addColumn('status', function(TaskPaid $data) {
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
            ->addColumn('action', function(TaskPaid $data){
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_paid',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
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
            ->rawColumns(['status', 'types', 'action'])
            ->toJson();
    }
    public function nct_datatables()
    {
         $datas = TaskPaid::where('department', 'NCT')->orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->editColumn('assignee', function(TaskPaid $data) {
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
            ->editColumn('campaign', function(TaskPaid $data) {
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
            ->editColumn('duration', function(TaskPaid $data) {
                $minutes = $data->duration;

                $hours = floor($minutes / 60);
                $min = $minutes - ($hours * 60);

                return $hours.":".$min;
            })
            ->addColumn('status', function(TaskPaid $data) {
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
            ->addColumn('action', function(TaskPaid $data){
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_nct',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                $action .= '<a href="' . route('destroy_task',$data->id) . '" class="btn btn-sm btn-danger btn-icon btn-icon-sm kt-mr-5"> <i class="flaticon2-trash"></i></a>';
                endif;
                return $action;
            })
            ->rawColumns(['status', 'types', 'action'])
            ->toJson();
    }
    public function aggregators_datatables()
    {
         $datas = TaskPaid::where('department', 'aggregator')->orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->editColumn('assignee', function(TaskPaid $data) {
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
            ->editColumn('campaign', function(TaskPaid $data) {
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
            ->editColumn('duration', function(TaskPaid $data) {
                $minutes = $data->duration;

                $hours = floor($minutes / 60);
                $min = $minutes - ($hours * 60);

                return $hours.":".$min;
            })
            ->addColumn('status', function(TaskPaid $data) {
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
            ->addColumn('action', function(TaskPaid $data){
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_aggregators',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                $action .= '<a href="' . route('destroy_aggregators',$data->id) . '" class="btn btn-sm btn-danger btn-icon btn-icon-sm kt-mr-5"> <i class="flaticon2-trash"></i></a>';
                endif;
                return $action;
            })
            ->rawColumns(['status', 'types', 'action'])
            ->toJson();
    }


    public function index()
    {
        $current_user = Auth::user();
        $paid_task = TaskPaid::all();
        return view('task.paid.dataindex', compact(array('paid_task', 'current_user')));
    }
    public function nct_index()
    {
        $current_user = Auth::user();
        $paid_task = TaskPaid::all();
        return view('task.nctindex', compact(array('paid_task', 'current_user')));
    }
    public function aggregators_index()
    {
        $current_user = Auth::user();
        $paid_task = TaskPaid::all();
        return view('task.aggregators.nctindex', compact(array('paid_task', 'current_user')));
    }
    public function create()
    {
        //
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['2', '5', '7'])->get();
        return view('task.paid.create', compact(array('projects', 'campaigns', 'users')));
    }
    public function nct_create()
    {
        //
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['1','2','4','5','6','7','11','12', '8'])->get();
        return view('task.create', compact(array('projects', 'campaigns', 'users')));
    }
    public function aggregators_create()
    {
        //
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['1','2','4','5','6','7','11','12', '8'])->get();
        return view('task.aggregators.create', compact(array('projects', 'campaigns', 'users')));
    }

     public function nct_store(Request $request)
    {
        $user = Auth::user();
        
        $store_paid_task = new TaskPaid([
            'name' => $request->get('name'),
            'department' => 'NCT',
            'task_owner_eta' => $request->get('task_owner_eta'),
            'brief' => $request->get('brief'),
            'priority' => $request->get('priority'),
            'assignee' => $request->get('assignee'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_paid_task->save();
        $sub_task = $request->get('sub_task_list');
        if($sub_task !== null){
            foreach ($sub_task as $task){
                $new_sub_task = new SubTask([
                    'model' => 'Task',
                    'user_id' => $user->id,
                    'parent_id' => $store_paid_task->id,
                    'name' => $task['name'],
                    'activity' => $task['activity'],
                    'due_date' => $task['eta'],
                    'status' => 'New'
                ]);
                $new_sub_task->save();
            }
        }
        return redirect('/task/nct_index')->with('success', 'Task Created Successfully!');
    }
     public function aggregators_store(Request $request)
    {
        $user = Auth::user();
        
        $store_paid_task = new TaskPaid([
            'name' => $request->get('name'),
            'department' => 'aggregator',
            'task_owner_eta' => $request->get('task_owner_eta'),
            'brief' => $request->get('brief'),
            'priority' => $request->get('priority'),
            'assignee' => $request->get('assignee'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_paid_task->save();
        $sub_task = $request->get('sub_task_list');
        if($sub_task !== null){
            foreach ($sub_task as $task){
                $new_sub_task = new SubTask([
                    'model' => 'Task',
                    'user_id' => $user->id,
                    'parent_id' => $store_paid_task->id,
                    'name' => $task['name'],
                    'activity' => $task['activity'],
                    'due_date' => $task['eta'],
                    'status' => 'New'
                ]);
                $new_sub_task->save();
            }
        }
        return redirect('/task/aggregators_index')->with('success', 'Task Created Successfully!');
    }
     public function store(Request $request)
    {
        $user = Auth::user();
        // $camp = '';
        if($request->get('campaign') == 0){
            $project = 'Non Campaign Task';
            $campaign = 'Non Campaign Task';
            $campaign_name = 'Non Campaign Task';
        }else{
            $camp_id = $request->get('campaign');
            $camp = Campaigns::where('id', $camp_id)->first();
            $project = $camp->project;
            $campaign = $camp->id;
            $campaign_name = $camp->name;
        }
        
        $store_paid_task = new TaskPaid([
            'name' => $request->get('name'),
            'project' => $project,
            'department' => 'Paid',
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
        $store_paid_task->save();
        $sub_task = $request->get('sub_task_list');
        if($sub_task !== null){
            foreach ($sub_task as $task){
                $new_sub_task = new SubTask([
                    'model' => 'TaskPaid',
                    'user_id' => $user->id,
                    'parent_id' => $store_paid_task->id,
                    'name' => $task['name'],
                    'activity' => $task['activity'],
                    'due_date' => $task['eta'],
                    'status' => 'New'
                ]);
                $new_sub_task->save();
            }
        }
        $get_assignee = User::where('id', $request->get('assignee'))->first();
        $task_edit_url = route('edit_paid',  $store_paid_task->id);
        $mdata = array(
            'to' => $get_assignee->email,
            'to_name' => $get_assignee->name,
            'from' => $user->email,
            'from_name' => $user->name,
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
            'model' => 'TaskPaid',
            'model_id' => $store_paid_task->id,
            'description' => 'The Creative Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return redirect('/task/paid')->with('success', 'Paid task Created Successfully!');
    }

    public function view($id)
    {
        $user = Auth::user();
        $creative_task = TaskPaid::find($id);
        $activity = Activity::where('model', 'TaskPaid')->where('model_id', $creative_task->id)->get();
        return view('task.creative.view', compact(array('creative_task', 'creative_users', 'approval_users', 'creatives', 'users', 'current_user', 'agency_users', 'activity')));    
    }
    public function edit($id)
    {
        $user = Auth::user();
        $paid_task = TaskPaid::find($id);
        $sub_task = SubTask::where('model', 'TaskPaid')->where('parent_id', $id)->get();
        $campaigns = Campaigns::all();
        $activity = Activity::where('model', 'TaskPaid')->where('model_id', $paid_task->id)->get();
        return view('task.paid.edit', compact(array('paid_task', 'campaigns','activity', 'sub_task')));    
    }
    public function nct_edit($id)
    {
        $user = Auth::user();
        $paid_task = TaskPaid::find($id);
        $sub_task = SubTask::where('model', 'TaskPaid')->where('parent_id', $id)->get();
        $campaigns = Campaigns::all();
        $activity = Activity::where('model', 'TaskPaid')->where('model_id', $paid_task->id)->get();
        return view('task.edit', compact(array('paid_task', 'campaigns','activity', 'sub_task')));    
    }
    public function aggregators_edit($id)
    {
        $user = Auth::user();
        $paid_task = TaskPaid::find($id);
        $sub_task = SubTask::where('model', 'TaskPaid')->where('parent_id', $id)->get();
        $campaigns = Campaigns::all();
        $activity = Activity::where('model', 'TaskPaid')->where('model_id', $paid_task->id)->get();
        return view('task.aggregators.edit', compact(array('paid_task', 'campaigns','activity', 'sub_task')));    
    }

    public function update_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
        $old_task = $c_task->status;
        $c_task->status = $request->get('status');
        $duration = $request->get('duration');
        $c_task->save();


        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $c_task->id,
            'description' => 'The web task status has been updated from <strong>'.$old_task.'</strong> to <strong>'.$request->get('status').'</strong> with total duration : <strong>'.$duration.'</strong>. Status Notes: '.$request->get('status_notes').' | Updated by - '.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function nct_update_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
        $old_task = $c_task->status;
        $c_task->status = $request->get('status');
        $duration = $request->get('duration');
        $c_task->save();
        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function aggregators_update_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
        $old_task = $c_task->status;
        $c_task->status = $request->get('status');
        $duration = $request->get('duration');
        $c_task->save();
        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function update_sub_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
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
    public function nct_update_sub_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
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
    public function aggregators_update_sub_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
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
        $c_task = TaskPaid::find($id);

        if($request->get('campaign') == 0){
            $project = 'Non Campaign Task';
            $campaign = 'Non Campaign Task';
        }else{
            $camp_id = $request->get('campaign');
            $camp = Campaigns::where('id', $camp_id)->first();
            $project = $camp->project;
            $campaign = $camp->id;
        }
        $c_task->name = $request->get('name');
        $c_task->project = $project;
        $c_task->campaign = $campaign;
        $c_task->department = 'Paid';
        $c_task->activity = $request->get('activity');
        $c_task->task_owner_eta = $request->get('task_owner_eta');
        $c_task->developer_eta = $request->get('developer_eta');
        $c_task->brief = $request->get('brief');
        $c_task->status_notes = $request->get('status_notes');
        $c_task->priority = $request->get('priority');
        $c_task->assignee = $request->get('assignee');
        $c_task->assignee = $request->get('assignee');
        $c_task->save();
        
        $old_sub_task = SubTask::where('model', 'TaskPaid')->where('parent_id', $c_task->id)->get();
        $sub_task = $request->get('sub_task_list');
        $selected_task = array();

        if($sub_task !== null){
            foreach ($sub_task as $task) {
                $sub_task_id = $task['id'];
                if($sub_task_id == '0'){
                    $new_sub_task = new SubTask([
                        'model' => 'TaskPaid',
                        'user_id' => $user->id,
                        'parent_id' => $c_task->id,
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

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $c_task->id,
            'description' => 'The web task details updated by'.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function nct_update(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
        $c_task->name = $request->get('name');
        $c_task->task_owner_eta = $request->get('task_owner_eta');
        $c_task->brief = $request->get('brief');
        $c_task->priority = $request->get('priority');
        $c_task->assignee = $request->get('assignee');
        $c_task->save();
        
        $old_sub_task = SubTask::where('model', 'Task')->where('parent_id', $c_task->id)->get();
        $sub_task = $request->get('sub_task_list');
        $selected_task = array();

        if($sub_task !== null){
            foreach ($sub_task as $task) {
                $sub_task_id = $task['id'];
                if($sub_task_id == '0'){
                    $new_sub_task = new SubTask([
                        'model' => 'Task',
                        'user_id' => $user->id,
                        'parent_id' => $c_task->id,
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
        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function aggregators_update(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskPaid::find($id);
        $c_task->name = $request->get('name');
        $c_task->task_owner_eta = $request->get('task_owner_eta');
        $c_task->brief = $request->get('brief');
        $c_task->priority = $request->get('priority');
        $c_task->assignee = $request->get('assignee');
        $c_task->save();
        
        $old_sub_task = SubTask::where('model', 'Task')->where('parent_id', $c_task->id)->get();
        $sub_task = $request->get('sub_task_list');
        $selected_task = array();

        if($sub_task !== null){
            foreach ($sub_task as $task) {
                $sub_task_id = $task['id'];
                if($sub_task_id == '0'){
                    $new_sub_task = new SubTask([
                        'model' => 'Task',
                        'user_id' => $user->id,
                        'parent_id' => $c_task->id,
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
        return Redirect::back()->with('creative_added','Updated Successfully!');
    }

    public function destroy($id)
    {
        $cre_task = TaskPaid::find($id);
        $cre_task->delete();

        return redirect('/task/paid/')->with('success', 'Task deleted!');
    }
    public function nct_destroy($id)
    {
        $task = TaskPaid::find($id);
        $task->delete();
        return redirect('/task/nct_index/')->with('success', 'Task deleted!');
    }
    public function aggregators_destroy($id)
    {
        $task = TaskPaid::find($id);
        $task->delete();
        return redirect('/task/aggregators_index/')->with('success', 'Task deleted!');
    }
}
