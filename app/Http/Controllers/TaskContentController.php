<?php

namespace App\Http\Controllers;

use App\TaskContent;
use App\SubTask;
use App\Activity;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewTask;
use Illuminate\Http\Request;
use Auth;
use DB;
use DataTables;
use Redirect;
use App\User;
use App\Projects;
use App\Campaigns;
use Validator;

class TaskContentController extends Controller
{
	public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = TaskContent::orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->editColumn('assignee', function(TaskContent $data) {
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
            ->editColumn('campaign', function(TaskContent $data) {
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
            ->editColumn('duration', function(TaskContent $data) {
                $minutes = $data->duration;

                $hours = floor($minutes / 60);
                $min = $minutes - ($hours * 60);

                return $hours.":".$min;
            })
            ->addColumn('status', function(TaskContent $data) {
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
            ->addColumn('action', function(TaskContent $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_content',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
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

    public function index()
    {
        $current_user = Auth::user();
        $content_task = TaskContent::all();
        return view('task.content.dataindex', compact(array('content_task', 'current_user')));
    }
    public function create()
    {
        //
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['12'])->get();
        return view('task.content.create', compact(array('projects', 'campaigns', 'users')));
    }

    public function store(Request $request)
    {
    	$user = Auth::user();
        
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

        $store_content_task = new TaskContent([
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
        $store_content_task->save();

        $sub_task = $request->get('sub_task_list');
        if($sub_task !== null){
            foreach ($sub_task as $task){
                $new_sub_task = new SubTask([
                    'model' => 'TaskContent',
                    'user_id' => $user->id,
                    'parent_id' => $store_content_task->id,
                    'name' => $task['name'],
                    'activity' => $task['activity'],
                    'due_date' => $task['eta'],
                    'status' => 'New'
                ]);
                $new_sub_task->save();
            }
        }
        $get_assignee = User::where('id', $request->get('assignee'))->first();
        $task_edit_url = route('edit_content',  $store_content_task->id);
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
            'model' => 'TaskContent',
            'model_id' => $store_content_task->id,
            'description' => 'The Creative Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

    	return redirect('/task/content')->with('success', 'Creative task saved!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $content_task = TaskContent::find($id);
        $sub_task = SubTask::where('model', 'TaskContent')->where('parent_id', $id)->get();
        $campaigns = Campaigns::all();
        $activity = Activity::where('model', 'TaskContent')->where('model_id', $content_task->id)->get();
        return view('task.content.edit', compact(array('content_task', 'campaigns','activity', 'sub_task')));    
    }

    public function update_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskContent::find($id);
        $old_task = $c_task->status;
        $c_task->status = $request->get('status');
        $duration = $request->get('duration');
        $c_task->content = $request->get('content');
        $c_task->save();


        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskContent',
            'model_id' => $c_task->id,
            'description' => 'The Content task status has been updated from <strong>'.$old_task.'</strong> to <strong>'.$request->get('status').'</strong> with total duration : <strong>'.$duration.'</strong>. Status Notes: '.$request->get('status_notes').' | Updated by - '.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');

    }
    public function update(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskContent::find($id);

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
        $c_task->activity = $request->get('activity');
        $c_task->task_owner_eta = $request->get('task_owner_eta');
        $c_task->brief = $request->get('brief');
        $c_task->priority = $request->get('priority');
        $c_task->assignee = $request->get('assignee');
        $c_task->save();
        $sub_task = $request->get('sub_task_list');

        $old_sub_task = SubTask::where('model', 'TaskContent')->where('parent_id', $c_task->id)->get();
        $selected_task = array();
        
        if($sub_task !== null){
            foreach ($sub_task as $task) {
                $sub_task_id = $task['id'];
                if($sub_task_id == '0'){
                    $new_sub_task = new SubTask([
                        'model' => 'TaskContent',
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
            'model' => 'TaskContent',
            'model_id' => $c_task->id,
            'description' => 'The Content task details updated by'.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }
    public function update_sub_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = TaskContent::find($id);
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

    public function destroy($id)
    {
        $cre_task = TaskContent::find($id);
        $cre_task->delete();

        return redirect('/task/content/')->with('success', 'Task deleted!');
    }
}
