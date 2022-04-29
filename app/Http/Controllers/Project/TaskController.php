<?php
namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Spatie\Analytics\Period;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Models\Task;
use App\Models\Timer;
use App\Creatives;
use App\Activity;
use App\TaskWeb;
use App\SubTask;
use App\Setting;
use App\Events\TaskNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCreativeTask;
use App\Mail\SendNewTask;
use App\Mail\TodayTask;
use DataTables;
use Auth;
use DB;
use Str;
use Redirect;
use Response;
use App\User;
use App\CreativeImages;
use App\CreativeSamples;
use App\Projects;
use App\Campaigns;
use App\AdCampaigns;
use App\MileStone;
use Validator;
use \Carbon\Carbon;

class TaskController extends Controller
{
    public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
    }

    public function web_push_notification(){
        event(new TaskNotification('This is Test Task by Mahimai Alex'));
        return "Event has been sent!";
    }
    public function datatables(Request $request, $department)
    {
        $department = Str::slug($department);
        $order_status = ['new', 'on_hold', 'discard', 'new_needed', 'new_updated', 'assigned', 'processed', 'process_transfer',  'wip', 'review', 'internal_review', 'external_review', 'completed'];
        $datas = Task::orderBy('id','desc');
        // orderByRaw('FIELD (status, ' . implode(', ', $order_status) . ') DESC');
        // orderBy('status','desc');
        if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_at', [$from, $to]);
        }
        else{
            $from = date('Y-m-d', strtotime('today - 29 days'));
            $to = now();
            $datas->whereBetween('created_at', [$from, $to]);
        }
        if(isset($request->filter['project_id'])){
            $datas->where('project_id', $request->filter['project_id']);
        }
        if(isset($request->filter['camp_id'])){
            $datas->where('camp_id', $request->filter['camp_id']);
        }
        if(isset($request->filter['created_by'])){
            $datas->where('created_by', $request->filter['created_by']);
        }
        if(isset($request->filter['responsible'])){
            $datas->where('responsible', $request->filter['responsible']);
        }
        if(isset($request->filter['department'])){
            $datas->where('department', $request->filter['department']);
        }
        elseif($department != 'all'){
            $datas->where('department', $department);
        }
        if(isset($request->filter['status'])){
            $datas->where('status', $request->filter['status']);
        }
        // else{
        //     $datas->where('status', '!=', 'completed');
        // }
        // if($department == 'all'){
        //     $datas = Task::where('status', '!=', 'completed')
        // }
        // else{
        //     $datas = Task::where('department', $department)->where('status', '!=', 'completed');
        // }
        $datas->get();
        return DataTables::of($datas)
            ->addColumn('project', function(Task $data){
                $get_project = Projects::find($data->project_id);
                if(!empty($get_project)){
                    $project_name = $get_project->name;
                }
                else{
                    $get_camp = AdCampaigns::find($data->ad_camp_id);
                    if(!empty($get_camp)){
                        $project_name = $get_camp->project;
                    }
                    else{
                        $project_name = 'No Project';
                    }
                }
                return $project_name;
            })
            ->addColumn('campaign', function(Task $data) {
                $get_camp = AdCampaigns::find($data->ad_camp_id);
                if(!empty($get_camp)){
                    $camp_name = $get_camp->name;
                }
                else{
                    $camp_name = 'No Campaign';
                }
                return $camp_name;
            })
            ->addColumn('types', function(Task $data) {
                // $datas = Task::orderBy('id','desc')->get();
                $tasks = explode(',' , $data->creative_type);
                $types = '';
                $i = 0;
                $len = count($tasks);
                    foreach ($tasks as $task) {
                        $types .= '<span>';
                        $types .= $task;
                        if($i == $len - 1){
                            $types .= '</span>';
                        }else{
                            $types .= ' | </span>';
                        }
                        $i++;
                    }
                return $types;
            })
            ->addColumn('timer', function(Task $data) {
                $user = Auth::user();
                if($data->timer == 1){
                    if($data->user_id == $user->id){
                        $timer = '<a href="' . route('stop_timer',$data->timer_id) . '" style="border-radius: 50%;background: #ffc107;" class="btn btn-sm btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-pause"></i></a>';
                    }
                    else{
                        $timer = '<span style="border-radius: 50%;background: #ffc107;" class="btn btn-sm btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-pause"></i></span>';
                    }
                }
                elseif($data->timer == 2){
                    $timer = '<a href="' . route('new_timer',$data->id) . '" style="border-radius: 50%;background: #e6e6e6;" class="btn btn-sm btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-play"></i></a>';
                }
                else{
                $timer = '<a href="' . route('new_timer',$data->id) . '" style="border-radius: 50%;background: #8bc34a;" class="btn btn-sm btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-play"></i></a>';

                }
                return $timer;
            })
            ->addColumn('end_time', function(Task $data) {
                if(!empty($data->eta)){
                    $end_time = Carbon::parse($data->eta);
                    return $end_time->format('Y-m-d H:i:s');
                }
                else{
                    return '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill" style="border-radius: 3px;color: #fff !important;background: #f00 !important;min-width: 70px;text-align: center;">NO ETA</span>';
                }
            })
            ->addColumn('day_duration', function(Task $data) {
                if($data->status == 'completed'):
                    return '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                else:
                if(!empty($data->eta)){
                    $date1 = Carbon::parse($data->eta); 
                    $date2 = Carbon::now(); 

                    // $date = new \DateTime($data->created_at);
                    // $date2 = new \DateTime($data->eta);


                    $diff = abs(strtotime($date2) - strtotime($date1)); 

                    $years   = floor($diff / (365*60*60*24)); 
                    $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                    $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                    $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

                    $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

                    $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

                    if($date1 > $date2){
                        $total_duration = '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill" style="border-radius: 3px;color: #fff !important;background:#8bc34a !important;min-width: 70px;text-align: center;">'.sprintf("%d days<br> %d:%d:%d", $days, $hours, $minuts, $seconds).'</span>';;
                    }
                    else{
                        $total_duration = '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill" style="border-radius: 3px;color: #fff !important;background: #f00 !important;min-width: 70px;text-align: center;">'.sprintf("- %d days<br> %d:%d:%d", $days, $hours, $minuts, $seconds).'</span>';
                    }
                    return $total_duration;
                }
                else{
                    
                        return '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill" style="border-radius: 3px;color: #fff !important;background: #f00 !important;min-width: 70px;text-align: center;">NO ETA</span>';
                }
                endif;
            })
            ->addColumn('status', function(Task $data){
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'new':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                    case 'wip':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill" style="background:#55f996 !important;">WIP</span>';
                        break;
                    case 'new_needed':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">New - Correction Needed</span>';
                        break;
                    case 'new_updated':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">New - Correction Updated</span>';
                        break;
                    case 'assigned':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--assigned kt-badge--inline kt-badge--pill">Assigned</span>';
                        break;
                    case 'processed':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--onprogress kt-badge--inline kt-badge--pill">On Process</span>';
                        break;
                    case 'process_transfer':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--progress-transfer kt-badge--danger kt-badge--pill">Process Transfer</span>';
                        break;
                    case 'internal_review':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--internal-review kt-badge--inline kt-badge--pill">Internal Review</span>';
                        break;
                    case 'review':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill">Review</span>';
                        break;
                    case 'external_review':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill">External Review</span>';
                        break;
                    case 'completed':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                        break;
                    case 'completed':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                        break;
                    case 'on_hold':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--onhold kt-badge--inline kt-badge--pill">On Hold</span>';
                        break;
                    
                    case 'discard':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--discard kt-badge--inline kt-badge--pill">Discard</span>';
                        break;
                    
                    default:
                        $creative_status_tag = '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">'.ucfirst($creative_status).'</span>';
                        break;
                }
                return $creative_status_tag;
            })
            // ->addColumn('status', function(Task $data) {
            //     $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
            //     $s = $data->status == 1 ? 'selected' : '';
            //     $ns = $data->status == 0 ? 'selected' : '';
            //     return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
            // })
            ->addColumn('action', function(Task $data) {
                $action = '<div class="action-list d-inline-flex">';
                $test_creatives = CreativeImages::where('creative_id', $data->id)->where('status', 1)->get();
                if(!$test_creatives->isEmpty()):
                if($data->status =='internal_review' || $data->status =='review' || $data->status =='external_review'):
$action .= '<a title="Click to View" class="btn btn-sm btn-view btn-icon btn-icon-sm kt-mr-5" href="'. route('view_creatives', $data->id). '" target="_blank"><i class="fa fa-eye" style="color: #fff;"></i></a>';

if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '3' ):
$action .= '<a title="Click to Approval" class="btn btn-sm btn-primary btn-icon btn-icon-sm kt-mr-5" href="'. route('creative_approval', $data->id). '"><i class="flaticon2-checkmark" style="color: #fff;"></i></a>';
                endif;
                endif;
                endif;
                $action .= '<a href="' . route('view_task',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';

                $action .= '<a href="' . route('task_delete',$data->id) . '" class="btn btn-sm btn-danger btn-icon btn-icon-sm"> <i class="flaticon2-trash"></i></a>';
                // if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                // $action .= '<form class="d-inline" action="' . route('task_delete',$data->id) . '" method="POST">
                // <input type="hidden" name="_method" value="DELETE">
                // <input type="hidden" name="_token" value="'.csrf_token().'">
                // <button title="Delete details" 
                // class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                // href="' . route('task_delete',$data->id) . '">
                // <i class="flaticon2-trash"></i>
                // </button>
                // </form>';
                // endif;
                return $action;
            })
            ->rawColumns(['status', 'types', 'action', 'project', 'campaign', 'timer', 'end_time', 'day_duration'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function pending_task_notification()
    {
        $users = array('1', '5', '7', '8', '10', '11', '13', '15', '27', '29', '30', '32', '34', '37');
        foreach($users as $user){
            $get_user = User::find($user);
            $pending_status = array('new', 'on_hold', 'discard', 'new_needed', 'new_updated', 'assigned', 'processed', 'process_transfer',  'wip', 'review', 'internal_review', 'external_review');
            $get_task = Task::where('responsible', $get_user->name)->select('id', 'name','status','department','activity','eta','priority','created_by')->whereIn('status', $pending_status)->get();
            $dt = Carbon::now();
            $today = $dt->format('Y-m-d');
            if(!empty($get_task)){
                $mdata = array(
                    // 'to' => 'mahimai@alliancein.com',
                    'to' => $get_user->email,
                    'toname' => $get_user->name,
                    'subject' => 'Today Task For '.$get_user->name.' - '.$today,
                    'task' => $get_task
                );
                // Mail::to($mdata['to'])->send(new TodayTask($mdata));
                Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new TodayTask($mdata));
            }
        }
    }
    public function index($department)
    {
        $current_department = $department;
        $user = Auth::user();
        $users = User::whereIn('role_id', ['1', '2', '5', '6', '7', '11'])->get();
        $settings = Setting::all();
        $current_route = $department;


        $options_created_by = Task::select('created_by')->distinct()->get();
        $options_status = Task::select('status')->distinct()->get();
        $options_responsible = Task::select('responsible')->distinct()->get();
        $options_department = Task::select('department')->distinct()->get();
        $options_campaigns = Task::select('camp_id')->distinct()->get();
        $options_projects = Task::select('project_id')->distinct()->get();
        $current_carbon_route = str_replace('task_', '', $current_route);
        return view('backend.project.task.index', compact(array(
            'user', 
            'settings', 
            'users', 
            'current_route', 
            'current_carbon_route', 
            'current_department',
            'options_status',
            'options_created_by',
            'options_responsible',
            'options_department',
            'options_projects',
            'options_campaigns',
        )));

    }
    public function dataindex()
    {
        $current_user = Auth::user();
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['1', '2', '5', '6', '7', '11'])->get();
        $creative_users = User::whereIn('role_id', ['4'])->get();
        $all_creative_task = CreativeTask::all()->sortByDesc("id");
        $gobrand_creative_task = CreativeTask::where('task_for', 'gobrand')->get()->sortByDesc("id");
        $astra_creative_task = CreativeTask::where('task_for', 'astra')->get()->sortByDesc("id");
        $settings = Setting::all();
        return view('task.creative.dataindex', compact(array(
            // 'creative_task', 
            'current_user', 
            'creative_users', 
            'settings', 
            'users', 
            'all_creative_task', 
            'gobrand_creative_task', 
            'astra_creative_task', 
            'projects', 
            'campaigns'
        )));
    }
    public function carbon_index($department)
    {
        $user = Auth::user();
        $users = User::whereIn('role_id', ['1', '2', '5', '6', '7', '11'])->get();
        $current_route = \Route::current()->getName();
        $current_index_route = 'task_'.$department;
        $current_department = $department;
        $current_route = $department;
        $settings = Setting::all();
        // $all_task = TaskWeb::orderBy('id','desc')->get();
        if($department == 'all'){
            $todo_tasks = Task::where('status', '!=', 'completed')->whereIn('status', ['new', 'new_needed', 'new_updated', 'assigned'])->orderBy('id','desc')->get();
            $wip_tasks = Task::where('status', '!=', 'completed')->whereIn('status', ['processed', 'wip', 'process_transfer'])->orderBy('id','desc')->get();
            $review_tasks = Task::where('status', '!=', 'completed')->whereIn('status', ['correction_updates', 'review', 'internal_review', 'external_review'])->orderBy('id','desc')->get();
            $completed_tasks = Task::where('status', '!=', 'completed')->where('status', 'completed')->orderBy('id','desc')->get();
        }
        else{
            $todo_tasks = Task::where('status', '!=', 'completed')->where('department', $department)->whereIn('status', ['new', 'new_needed', 'new_updated', 'assigned'])->orderBy('id','desc')->get();
            $wip_tasks = Task::where('status', '!=', 'completed')->where('department', $department)->whereIn('status', ['processed', 'wip', 'process_transfer'])->orderBy('id','desc')->get();
            $review_tasks = Task::where('status', '!=', 'completed')->where('department', $department)->whereIn('status', ['correction_updates', 'review', 'internal_review', 'external_review'])->orderBy('id','desc')->get();
            $completed_tasks = Task::where('status', '!=', 'completed')->where('department', $department)->where('status', 'completed')->orderBy('id','desc')->get();

        }
        return view('backend.project.task.carbon', compact(array(
            'user', 
            'settings', 
            'users', 
            'todo_tasks', 
            'wip_tasks', 
            'review_tasks', 
            'review_tasks', 
            'completed_tasks', 
            'current_index_route', 
            'current_department', 
            'current_route', 
        )));
    }

    public function modal_view($id)
    {
        $task = TaskWeb::find($id);
        $activity = Activity::where('model', 'TaskWeb')->where('model_id', $task->id)->get();
        return view('backend.project.task.modal_task_view', compact(array('task', 'activity')));    
    }
    public function sub_task_modal_view($id)
    {
        $sub_task = SubTask::find($id);
        return view('backend.project.task.modal.sub_task_view', compact(array('sub_task')));    
    }
    public function quick_update(Request $request)
    {
        $task = TaskWeb::find($request->id);
        $value = $request->value;
        $name = $request->name;
        $task->$name = $value;
        $task->save();
        return 'Updated!';
        // return view('backend.project.task.modal_task_view', compact(array('task', 'activity')));   
    }
    public function get_task_data(Request $request, $department)
    {
        if(isset($request->from_date) && isset($request->to_date)){
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }
        else{
            $from = date('Y-m-d', strtotime('today - 29 days'));
            $from_date = Carbon::parse($from);
            $to_date = Carbon::now();
        }
        if($department == 'all'){

            $all_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->get()->count();
            $todo_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['new', 'on_hold', 'new_needed', 'new_updated', 'assigned'])->select('status')->get()->count();
            $wip_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['wip', 'processed', 'process_transfer'])->select('status')->get()->count();
            $review_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['review', 'internal_review', 'external_review'])->select('status')->get()->count();
            $completed_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['completed'])->select('status')->get()->count();
        }
        else{

            $all_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->where('department', $department)->get()->count();
            $todo_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['new', 'on_hold', 'new_needed', 'new_updated', 'assigned'])->select('status')->where('department', $department)->get()->count();
            $wip_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['wip', 'processed', 'process_transfer'])->select('status')->where('department', $department)->get()->count();
            $review_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['review', 'internal_review', 'external_review'])->select('status')->where('department', $department)->get()->count();
            $completed_task = QueryBuilder::for(Task::class)->allowedFilters('project_id', 'department', 'camp_id', 'status', 'created_by', 'responsible')->whereBetween('created_at', [$from_date, $to_date])->whereIn('status', ['completed'])->select('status')->where('department', $department)->get()->count();

        }

        $dashboad = new \stdClass;
        $dashboad->all_task = $all_task;
        $dashboad->todo_task = $todo_task;
        $dashboad->wip_task = $wip_task;
        $dashboad->review_task = $review_task;
        $dashboad->completed_task = $completed_task;
        return response()->json($dashboad, 200); 
    }
    public function sub_task_quick_update(Request $request)
    {
        $task = SubTask::find($request->id);
        $value = $request->value;
        $name = $request->name;
        $task->$name = $value;
        $task->save();
        return 'Updated!';
        // return view('backend.project.task.modal_task_view', compact(array('task', 'activity')));   
    }
    public function carbon_status_update(Request $request)
    {
        $task = Task::find($request->task_id);
        $old_status = $task->status;
        if($task->department == "Creative"){
            if($request->status == 'new'){
                $task->status = 'new';
            }
            elseif($request->status == 'wip'){
                $task->status = 'processed';
            }
            elseif($request->status == 'review'){
                $task->status = 'review';
                
            }
            elseif($request->status == 'completed'){
                $task->status = 'completed';
            }
        }
        else{
            $task->status = $request->status;
        }
        $task->save();
        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'Update',
            'model' => 'Task',
            'model_id' => $task->id,
            'description' => 'The Task <strong>'.$task->name.'</strong> Updated with status from'.$old_status.' to '.$task->status,
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return 'Updated!';
        // return view('backend.project.task.modal_task_view', compact(array('task', 'activity')));   
    }
    public function add_new_sub_task(Request $request)
    {
        $user = Auth::user();
        $empty_sub_task = new SubTask([
            'task_id' => $request->task_id,
            'user_id' => $user->id
        ]);
        $empty_sub_task->save();

        return response()->json([
            'sub_task_id' => $empty_sub_task->id
        ]);
        // return view('backend.project.task.modal_task_view', compact(array('task', 'activity')));   
    }
    public function load_all_sub_task(Request $request)
    {
        $user = Auth::user();
        $all_sub_task = SubTask::where('task_id', $request->task_id)->get();
        return response()->json($all_sub_task);
        // return view('backend.project.task.modal_task_view', compact(array('task', 'activity')));   
    }
    public function update_sub_task(Request $request)
    {
        $task_id = $request->get('task_id');
        $sub_task = SubTask::find($task_id);
        $field = $request->get('field');
        $sub_task->$field = $request->get('value');
        $sub_task->save();
        return response()->json([
            'success' => 'All Changes has been updated successfully!'
        ]);
    }
    public function delete_sub_task(Request $request)
    {
        $task_id = $request->get('task_id');
        $sub_task = SubTask::find($task_id);
        $sub_task->delete();
    }
    public function clone_sub_task(Request $request)
    {
        $task_id = $request->get('task_id');
        $tasks = SubTask::find($task_id);
        $newTask = $tasks->replicate();
        $newTask->save();
        return Redirect::back();
    }
    public function new_timer(Request $request, $id)
    {
        $user = Auth::user();
        if(!empty($user->timer)){
            $get_user_task = Task::find($user->live_task_id);
            return Redirect::back()->with('warning', 'You are already working with another task - '.$get_user_task->name);
        }
        else{
            $get_task = Task::find($id);
            $new_timer = new Timer([
                'department' => $get_task->department,
                'task_id' => $id,
                'date' => Carbon::now()->format('Y-m-d'),
                'start' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => $user->id,
            ]);
            $new_timer->save();
            $get_task->timer = 1;
            $get_task->timer_id = $new_timer->id;
            $get_task->save();
            //Update User
            $get_user = User::find($user->id);
            $get_user->timer = $new_timer->start;
            $get_user->live_task_id = $get_task->id;
            $get_user->save();
            return Redirect::back()->with('success', 'Timer Created successfully!');

        }
    }
    public function stop_timer(Request $request, $id)
    {
        $timer = Timer::find($id);
        if(empty($timer)){
            return Redirect::back()->with('warning', 'Timer Not Found!');
        }
        //Update Timer
        $end_date = now();
        $end_date_time = $end_date->format('Y-m-d H:i:s');
        $date = new \DateTime($timer->start);
        $date2 = new \DateTime($end_date);
        $total_sec = $date2->getTimestamp() - $date->getTimestamp();
        $total_sec = $total_sec;
        $total_sec = round($total_sec);
        $total_duration = sprintf('%02d:%02d:%02d', ($total_sec/ 3600),($total_sec/ 60 % 60), $total_sec% 60);
        $timer->end = $end_date_time;
        $timer->duration = $total_duration;
        $timer->save();
        //Update Task
        $get_task = Task::find($timer->task_id);
        $get_task->timer = 0;
        $get_task->timer_id = NULL;
        $get_task->save();
        //Update User
        $get_user = User::find($timer->user_id);
        $get_user->timer = NULL;
        $get_user->live_task_id = NULL;
        $get_user->save();
        return Redirect::back()->with('success', 'Timer Updated successfully!');
    }
    public function add_new_task(Request $request)
    {
        $task_id = $request->get('task_id');
        $parent_task_id = $request->get('parent_id');
        $sub_task = SubTask::find($task_id);
        $parent_task = Task::find($parent_task_id);
        // $newTask = $tasks->replicate();
        // $newTask->save();
        // return Redirect::back();
        
        $get_all_department = Setting::where('name', 'task_department')->get();
        $department_name = '';
        foreach($get_all_department as $department){
            $get_department = json_decode($department->value);
            $get_users = json_decode($get_department->users);
            if(in_array($sub_task->assignee, $get_users)){
                $department_name = $get_department->name;
            }
            if(!empty($department_name)){
                break;
            }
        }
        $task_assignee = User::find($sub_task->assignee);
        $user = Auth::user();

        if($department_name == 'Creative'){
            $user = Auth::user();
            $creative_creative_type = NULL;
            $creative_tag = NULL;
            $store_task = new Task([
                'name' => $sub_task->name,
                'project_id' =>  $parent_task->project_id,
                'camp_id' =>  $parent_task->camp_id,
                'ad_camp_id' =>  $parent_task->ad_camp_id,
                'section_id' =>  $parent_task->section_id,
                'department' =>  $department_name,
                'eta' =>  $sub_task->due_date,
                'tag' =>  $creative_tag,
                'responsible' =>  $task_assignee->name,
                'is_from_sub_task' =>  1,
                'from_sub_task_id' =>  $sub_task->id,
                'status' =>  'new',
                'created_by' =>  $user->name
            ]);
            $store_task->save();

            // Sent Email
            $task_edit_url = url('tasks/view_task/').'/'.$store_task->id;
            $mdata = array(
                'key' => 'created',
                'to' => $task_assignee->email,
                'from_name' => $user->name,
                'subject' => ' New Creative Task - '.$request->get('name'),
                'task_name' => $store_task->name,
                'task_for' => NULL,
                'creative_type' => $creative_creative_type,
                'task_brief' => NULL,
                'creator_eta' => $sub_task->due_date,
                'priority' => NULL,
                'status' => 'new',
                'created_by' => $user->name,
                'edit_url' => $task_edit_url,
                'is_from_sub_task' => 1,
                'from_sub_task_id' => $sub_task->id,
                'created_time' => date('Y-m-d H:i:s')
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        else{
            $user = Auth::user();
            $store_task = new Task([
                'name' => $sub_task->name,
                'project_id' =>  $parent_task->project_id,
                'camp_id' =>  $parent_task->camp_id,
                'ad_camp_id' =>  $parent_task->ad_camp_id,
                'section_id' =>  $parent_task->section_id,
                'department' =>  $department_name,
                'eta' =>  $sub_task->due_date,
                'brief' =>  NULL,
                'priority' =>  NULL,
                'responsible' =>  $task_assignee->name,
                'is_from_sub_task' =>  1,
                'from_sub_task_id' =>  $sub_task->id,
                'status' =>  'new',
                'created_by' =>  $user->name
            ]);
            $store_task->save();
            // Sent Email
            $task_edit_url = url('tasks/view_task/').'/'.$store_task->id;
            $mdata = array(
                'to' => $task_assignee->email,
                'to_name' => 'Team',
                'from_name' => $user->name,
                'subject' => ' New Task - '.$sub_task->name,
                'task_name' => $sub_task->name,
                'priority' => NULL,
                'status' => 'new',
                'created_by' => $user->name,
                'edit_url' => $task_edit_url,
                'is_from_sub_task' => 1,
                'from_sub_task_id' => $sub_task->id,
                'created_time' => date('Y-m-d H:i:s')
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendNewTask($mdata));
            // Mail::to($mdata['to'])->send(new SendNewTask($mdata));
        }
        // Save Activity
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'Task',
            'model_id' => $store_task->id,
            'description' => 'New Task Created! - '.$store_task->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $sub_task->is_main_task = 1;
        $sub_task->main_task_id = $store_task->id;
        $sub_task->save();
        return response()->json([
            'success' => 'All Changes has been updated successfully!'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $settings = Setting::all();
        return view('task.creative.create', compact(array('projects', 'campaigns', 'settings')));
    }

    public function adj(Request $request)
    {
        // $get_task = Task::whereBetween('id', ['3011', '3164'])->get();
        $get_task = Activity::all();
        foreach ($get_task as $task) {
            if($task->model_id > 2010){
                $new_task = Activity::find($task->id);
                $new_task->model_id = $new_task->model_id+1;
                $new_task->save();
            }
        }
    }
    public function store(Request $request)
    {
        $department = $request->get('department');
        
        $get_setting = Setting::where('name', 'task_department')->where('value', 'like', '%"name":"'.$request->get('department').'"%')->first();
        $user_emails = array();
        if(!empty($get_setting)){
            $get_setting = json_decode($get_setting->value);
            foreach(json_decode($get_setting->users) as $user){
                $get_user_name = User::find($user);
                $user_emails[] = $get_user_name->email;
            }
        }
        if($request->from == 'task'){
            $camp_id = 0;
        }
        else{
           isset($request->camp_id)? $camp_id = $request->get('camp_id'):$camp_id = NULL; 
        }
        isset($request->project_id)? $project_id = $request->get('project_id'):$project_id = NULL;
        isset($request->ad_camp_id)? $ad_camp_id = $request->get('ad_camp_id'):$ad_camp_id = NULL;
        isset($request->section_id)? $section_id = $request->get('section_id'):$section_id = NULL;
        isset($request->team)? $team = $request->get('team'):$team = NULL;
        isset($request->activity)? $activity = $request->get('activity'):$activity = NULL;
        isset($request->eta)? $eta = $request->get('eta'):$eta = NULL;
        isset($request->brief)? $brief = $request->get('brief'):$brief = NULL;
        isset($request->priority)? $priority = $request->get('priority'):$priority = NULL;
        isset($request->responsible)? $responsible = $request->get('responsible'):$responsible = NULL;
        if(isset($request->creative_type)){
            $creative_creative_type = $request->get('creative_type');
            $creative_creative_type = implode(',', $creative_creative_type);
        }
        else{
            $creative_creative_type = NULL;
        }
        if(isset($request->tag)){
            $creative_tag = $request->get('tag');
            $creative_tag = implode(',', $creative_tag);
        }
        else{
            $creative_tag = NULL;
        }
        $user = Auth::user();
        $store_task = new Task([
            'name' => $request->get('name'),
            'project_id' => NULL,
            'camp_id' => $camp_id,
            'ad_camp_id' => $ad_camp_id,
            'section_id' => $section_id,
            'department' => $department,
            'team' =>  $team,
            'activity' =>  $activity,
            'creatives' =>  $creative_creative_type,
            'eta' =>  $eta,
            'tag' =>  $creative_tag,
            'brief' =>  $brief,
            'priority' =>  $priority,
            'responsible' =>  $responsible,
            'status' =>  'new',
            'created_by' =>  $user->name
        ]);
        $store_task->save();
        $get_responsible_person = User::where('name', $request->get('responsible'))->first();
        if($department == 'Creative'){
            $store_task->save();
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            $directory = "storage/samples/$year/$month/$day";
            if(!is_dir($directory)){
                mkdir($directory, 755, true);
            }
            $creatives = $request->file('samples_creatives');
            if($creatives){
                foreach($creatives as $image){
                    $new_name = $image->getClientOriginalName();
                    // $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move($directory, $new_name);
                    $location = $directory.'/'.$new_name;
                    $store_craetive_image = new CreativeSamples([
                        'task_id' => $store_task->id,
                        'name' => $new_name,
                        'path' => $directory,
                        'location' => $location,
                        'upload_by' => $user->name
                    ]);
                    $store_craetive_image->save();
                }
            }
            // Sent Email
            $task_edit_url = url('tasks/view_task/').'/'.$store_task->id;
            $mdata = array(
                'key' => 'created',
                'to' => $get_responsible_person->email,
                'from_name' => $user->name,
                'subject' => ' New Task - '.$request->get('name'),
                'task_name' => $request->get('name'),
                'task_for' => $request->get('team'),
                'activity' =>  $request->get('activity'),
                'creative_type' => $creative_creative_type,
                'task_brief' => $request->get('brief'),
                'creator_eta' => $request->get('eta'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name,
                'edit_url' => $task_edit_url,
                'created_time' => date('Y-m-d H:i:s')
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        else{
            // Sent Email
            $task_edit_url = url('tasks/view_task/').'/'.$store_task->id;
            $mdata = array(
                'to' => $get_responsible_person->email,
                'to_name' => 'Team',
                'from_name' => $user->name,
                'subject' => ' New Task - '.$request->get('name'),
                'task_name' => $request->get('name'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name,
                'edit_url' => $task_edit_url,
                'created_time' => date('Y-m-d H:i:s')
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendNewTask($mdata));
            // Mail::to($mdata['to'])->send(new SendNewTask($mdata));
        }
        // Save Activity
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'Task',
            'model_id' => $store_task->id,
            'description' => 'New Task Created! - '.$store_task->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return Redirect::back()->with('success', 'Task created successfully!');
    }

    public function clone($id)
    {
        $tasks = Task::find($id);
        $newTask = $tasks->replicate();
        $newTask->save();
        return Redirect::back();
    }
    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect::back();
    }
    public function form_get_campaign(Request $request)
    {
        $campaigns = Campaigns::where('project', $request->project)->get();
        $campaign_list = '<option value="">Choose one Campaign</option>';
        foreach ($campaigns as $campaign) {
            $campaign_list .= '<option value="'.$campaign->id.'">'.$campaign->name.'</option>';
        }
        echo $campaign_list;
    }
    public function form_get_ad_campaign(Request $request)
    {
        $ad_campaigns = AdCampaigns::where('campaign_id', $request->campaign)->get();
        $campaign_list = '<option value="">Choose one Ad Campaign</option>';
        foreach ($ad_campaigns as $campaign) {
            $campaign_list .= '<option value="'.$campaign->id.'">'.$campaign->name.'</option>';
        }
        echo $campaign_list;
    }
    public function form_get_milestone(Request $request)
    {
        $milestones = MileStone::where('ad_campaign_id', $request->campaign)->get();
        $milestone_list = '<option value="">Choose one MileStone</option>';
        foreach ($milestones as $milestone) {
            $milestone_list .= '<option value="'.$milestone->id.'">'.$milestone->activity.'</option>';
        }
        echo $milestone_list;
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $creative_task = Task::find($id);
        $creatives = CreativeImages::where('creative_id', $creative_task->id)->where('status', 1)->get();
        $users = User::all();
        $current_user = Auth::user();
        $creative_users = User::where('role_id', '4')->get();
        $approval_users = User::where('role_id', '3')->get();
        $agency_users = User::whereIn('role_id', ['9', '10'])->get();
        $activity = Activity::where('model', 'CreativeTask')->where('model_id', $creative_task->id)->get();
        return view('task.creative.view', compact(array('creative_task', 'creative_users', 'approval_users', 'creatives', 'users', 'current_user', 'agency_users', 'activity')));    
    }
    public function edit($id)
    {
        $user = Auth::user();
        $settings = Setting::all();
        $task = Task::find($id);
        if(empty($task)){
            return abort(404);
        }
        if($task->department == 'Creative'){
            $creatives = CreativeImages::where('creative_id', $task->id)->where('status', 1)->orderBy('order_id', 'ASC')->get();
            $status_history = Creatives::where('task_id', $task->id)->get();
            $samples = CreativeSamples::where('task_id', $task->id)->get();
            $users = User::all();
            $current_user = Auth::user();
            $creative_users = User::where('role_id', '4')->get();
            $approval_users = User::where('role_id', '3')->get();
            $agency_users = User::whereIn('role_id', ['9', '10'])->get();
            $projects = Projects::all();
            $campaigns = Campaigns::all();
            $activity = Activity::where('model_id', $task->id)->get();
            return view('backend.project.task.creative_view', compact(array(
                'task', 
                'creative_users', 
                'approval_users', 
                'creatives', 
                'status_history', 
                'users', 
                'current_user', 
                'agency_users', 
                'activity', 
                'projects', 
                'campaigns',
                'settings',
                'samples'
            )));   
        }
        else{
            $projects = Projects::all();
            $user = Auth::user();
            $task = Task::find($id);
            $sub_task = SubTask::where('model', 'TaskWeb')->where('parent_id', $id)->get();
            $campaigns = Campaigns::all();
            // $activity = '';
            $activity = Activity::where('model_id', $task->id)->get();
            return view('backend.project.task.task_view', compact(array('task', 'projects', 'campaigns','activity', 'sub_task'))); 
        } 
    }
    public function approval($id)
    {
        $creative_task = CreativeTask::find($id);
        $creatives = CreativeImages::where('creative_id', $creative_task->id)->where('status', '1')->where('approval', 'No')->orderBy('order_id', 'ASC')->get();
        $task_id = $creative_task->id;
        $users = User::all();
        $current_user = Auth::user();
        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'Approval',
            'model' => 'CreativeTask',
            'model_id' => $creative_task->id,
            'description' => $user->name.'Open the Task ('.$creative_task->task_name.') to Approval',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return view('task.creative.approval', compact(array('creative_task', 'task_id', 'creatives', 'users', 'current_user', 'user')));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_task(Request $request, $id)
    {   
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $task = Task::find($id);
        if($request->department =='Creative'){
            if(isset($request->tag)){
                $creative_cat = $request->get('tag');
                $creative_cat = implode(',', $creative_cat);  
            }
            else{
                $creative_cat = NULL;
            }
            if(isset($request->creative_type)){
                $creative_creative_type = $request->get('creative_type');
                $creative_creative_type = implode(',', $creative_creative_type); 
            }
            else{
                $creative_creative_type = NULL;
            }
            $task->name = $request->get('name');
            $task->team =  $request->get('team');
            $task->creatives =  $creative_creative_type;
            $task->eta =  $request->get('eta');
            $task->tag =  $creative_cat;
            $task->brief =  $request->get('brief');
            $task->priority =  $request->get('priority');
            $task->responsible =  $request->get('responsible');
            $task->save();
            $activity_log = new Activity([
                'name' => 'Creative Update',
                'model' => 'Creative Task',
                'model_id' => $task->id,
                'description' => 'The Creative Task ('.$task->name.') Details has been updated by<strong>'.$user->name.'</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        else{
            $task->name = $request->get('name');
            $task->team =  $request->get('team');
            $task->eta =  $request->get('eta');
            $task->brief =  $request->get('brief');
            $task->priority =  $request->get('priority');
            $task->activity =  $request->get('activity');
            $task->responsible =  $request->get('responsible');
            $task->save();
            $activity_log = new Activity([
                'name' => 'Creative Task Details Update',
                'model' => 'Creative Task',
                'model_id' => $task->id,
                'description' => 'The Creative Task ('.$task->name.') Details has been updated by<strong>'.$user->name.'</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();

        }
        return Redirect::back()->with('creative_added','The Creative Task Updated Successful !');

    }
    public function creative_status_update(Request $request, $id)
    {   
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $task = Task::find($id);
        $task_edit_url = url('tasks/view_task/').'/'.$task->id;
        $default_to = 'mohammedidris@alliancein.com';
        $default_cc = array('gouravjain.r@alliancein.com', 'vaibhavrao.n@alliancein.com', 'xavier@alliancein.com', 'mahimai@alliancein.com');
        $default_bcc = array('mohammedidris@alliancein.com', 'vaibhavrao.n@alliancein.com', 'xavier@alliancein.com');
        if (!empty($request->get('mail_to'))){
            $mail_send_to = $request->get('mail_to');
        } 
        else{
            $mail_send_to = $default_to;
        }
        if ($request->get('mail_cc')) {
            $mail_send_cc = $request->get('mail_cc');
        }
        else{
            $mail_send_cc = $default_cc;
        }
        $creator_email = User::where('name', $task->created_by)->first();
        $creator_email = $creator_email->email;
        $old_task = $task->status;
        $task_status = $request->get('task_cat');
        if($task_status == 'new_needed'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'Need more clarity on the given information. This is what i am expecting - '.$request->get('new_correction_need'),
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
            $mdata = array(
                'key' => 'status_new_needed',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $task->created_by,
                'subject' => 'Need more details about this Creative Task - '.now(),
                'task_name' => $task->creative_type,
                'edit_url' => $task_edit_url,
                'new_correction_need' => $request->get('new_correction_need')
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($task_status == 'assigned'){

            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task has been assigned to <strong>'.$request->get('assigned_to').'</strong>',
                'eta' => $request->get('eta_from_assigner'),
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->responsible = $request->get('assigned_to');
            $task->status = $task_status;
            $assigner_email = User::where('name', $request->get('assigned_to'))->first();
            $mdata = array(
                'key' => 'status_assigned',
                'to' => $creator_email,
                'cc' => $assigner_email->email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $task->created_by,
                'subject' => 'This Creative Task has been assigned to '.$request->get('assigned_to').' with status of '.ucfirst($task->status),
                'task_name' => $task->creative_type,
                'assigned_by' => $user->name,
                'assigned_to' => $request->get('assigned_to'),
                'assigned_date' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'eta_from_assigner' => $request->get('eta_from_assigner'),
            );
            Mail::to($mdata['to'])->cc($mdata['cc'])->bcc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }

        if($task_status == 'processed'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task has been processed by '.$task->responsible,
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
            $mdata = array(
                'key' => 'status_processed',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                // 'from' => $user->email,
                'by_name' => $user->name,
                'to_name' => $task->created_by,
                'subject' => 'The Task has been processed by '.$user->name.' with status of '.ucfirst($task->status),
                'task_name' => $task->creative_type,
                'processed_by' => $user->name,
                'processed_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($task_status == 'process_transfer'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task has been Transfer from <strong>'.$task->responsible.'</strong> to  <strong>'.$request->get('process_transfer_to').'</strong>',
                'assignee' => $request->get('process_transfer_to'),
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->responsible = $request->get('process_transfer_to');
            $task->status = $task_status;
            $mdata = array(
                'key' => 'status_pro_trans',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $task->created_by,
                'subject' => 'The Task has been Transfer to '.$request->get('process_transfer_to').' with status of '.ucfirst($task->status),
                'task_name' => $task->creative_type,
                'process_transfer_by' => $user->name,
                'assigned_to' => $task->assigned_to,
                'process_transfer_to' => $request->get('process_transfer_to'),
                'process_transfer_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($task_status == 'internal_review'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task is Under Interal Review',
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;

            if($task->is_from_sub_task == 1){
                $get_sub_task = SubTask::find($task->from_sub_task_id);
                $get_sub_task->status = 'review';
                $get_sub_task->save();
            }
            $mdata = array(
                'key' => 'status_int',
                'to' => $creator_email,
                'from' => $user->email,
                'by_name' => $user->name,
                'to_name' => $task->created_by,
                'subject' => 'The Task is Under Interal Review - '.ucfirst($task->task_name).' with status of '.ucfirst($task->status),
                'task_name' => ucfirst($task->task_name),
                'internal_review_by' => $user->name,
                'internal_review_time' => date('Y-m-d H:i:s'),
            'edit_url' => $task_edit_url,
                'status' => ucfirst($task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
            $mail_to_list = $request->get('mail_to');
            $mail_cc_list = $request->get('mail_cc');
        // if(!is_array($request->get('mail_to'))){
        //     $mail_to_list = implode(',', $request->get('mail_to'));
        // }
        // else{
        //     $mail_to_list = $request->get('mail_to');
        // }
        // if(!is_array($request->get('mail_cc'))){
        //     $mail_cc_list = implode(',', $request->get('mail_cc'));
        // }
        // else{
        //     $mail_cc_list = $request->get('mail_cc');
        // }
        if($task_status == 'external_review'){

            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task is Under Review',
                'mail_to' => $mail_to_list,
                'mail_cc' => $mail_cc_list,
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
            if($task->is_from_sub_task == 1){
                $get_sub_task = SubTask::find($task->from_sub_task_id);
                $get_sub_task->status = 'review';
                $get_sub_task->save();
            }

            $mdata = array(
                'key' => 'status_ext',
                'to' => $mail_send_to,
                'from' => $creator_email,
                'from_name' => $task->created_by,
                'by_name' => $task->created_by,
                'to_name' => '',
                'project' => $task->project,
                'creative_type' => $task->creative_type,
                'cc' => $mail_send_cc,
                'subject' => 'The Creative Task - with campaign of '.ucfirst($task->campaign).' is waiting for approval',
                'task_name' => $task->creative_type,
                'internal_review_by' => $user->name,
                'internal_review_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($task->status),
            );
            Mail::to($mdata['to'])->cc($mdata['cc'])->bcc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($task_status == 'review'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task is Under Review',
                'mail_to' => $mail_to_list,
                'mail_cc' => $mail_cc_list,
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
            if($task->is_from_sub_task == 1){
                $get_sub_task = SubTask::find($task->from_sub_task_id);
                $get_sub_task->status = 'review';
                $get_sub_task->save();
            }

            $mdata = array(
                'key' => 'status_ext',
                'to' => $mail_send_to,
                'from' => $creator_email,
                'from_name' => $task->created_by,
                'by_name' => $task->created_by,
                'to_name' => '',
                'project' => $task->project,
                'campaign' => $task->campaign,
                'creative_type' => $task->creative_type,
                'cc' => $mail_send_cc,
                'subject' => 'The Creative Task - with campaign of '.ucfirst($task->campaign).' is waiting for approval',
                'task_name' => $task->creative_type,
                'internal_review_by' => $user->name,
                'internal_review_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($task->status),
            );
            Mail::to($mdata['to'])->cc($mdata['cc'])->bcc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        // if($task_status == 'review'){
        //     $task->external_review_time = date('Y-m-d H:i:s');
        //     $task->external_review_by = $user->name;
        //     $task->approval_person = $request->get('approval_person');
        //     $task->mail_to = $request->get('mail_to');
        //     $task->mail_cc = $request->get('mail_cc');
        // }
        if($task_status == 'completed'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'All the creatives has neen approved. And the Task has been completed',
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
            if($task->is_from_sub_task == 1){
                $get_sub_task = SubTask::find($task->from_sub_task_id);
                $get_sub_task->status = 'completed';
                $get_sub_task->save();
            }
            $mdata = array(
                'key' => 'status_completed',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $task->created_by,
                'subject' => 'The Task is Completed - '.ucfirst($task->task_name).' with status of '.ucfirst($task->status),
                'task_name' => $task->creative_type,
                'completed_by' => $user->name,
                'completed_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }

        if($task_status == 'discard'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task have been discard',
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
        }

        if($task_status == 'on_hold'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task have been On Hold',
                'assignee' => $task->responsible,
                'designer_comment' => $request->get('notes'),
                'status' => $task_status,
                'task_id' => $task->id
            ]);
            $creatives->save();
            $task->status = $task_status;
        }

        $task->duration = $request->get('actual_duration');
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'CreativeTask',
            'model_id' => $task->id,
            'description' => 'The Task status changed from <span class="kt-font-danger">'.ucfirst($old_task).'</span> to <span class="kt-font-info">'.ucfirst($task->status).'</span>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $task->save();

        return Redirect::back()->with('creative_added','Added Successful !');
    }
    public function update_status(Request $request, $id)
    {   

        $user = Auth::user();
        $task = Task::find($id);
        $old_task = $task->status;
        $task->status = $request->get('status');
        $task->duration = $request->get('duration_hr').' : '.$request->get('duration_minit');
        $task->score = $request->get('task_score');
        if(isset($request->lp_url)){
            $task->lp_url = $request->get('lp_url');
        }
        $duration = $request->get('duration_hr').' : '.$request->get('duration_minit');
        $task->save();
        if($task->is_from_sub_task == 1){
            $get_sub_task = SubTask::find($task->from_sub_task_id);
            $get_sub_task->status = $request->get('status');
            $get_sub_task->save();
        }
        $activity_log = new Activity([
            'name' => 'Update',
            'model' => $task->department,
            'model_id' => $task->id,
            'description' => 'The task <strong>'.$task->name.'</strong> status has been updated from <strong>'.$old_task.'</strong> to <strong>'.$request->get('status').'</strong> with total duration : <strong>'.$duration.'</strong>. Status Notes: '.$request->get('status_notes').' | Score: '.$request->get('score').'% | Updated by - '.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return Redirect::back()->with('creative_added','Updated Successfully!');

    }
    public function approval_update(Request $request, $id)
    {
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $creatives = CreativeImages::where('creative_id', $id)->where('status', '1')->where('approval', 'No')->orderBy('order_id', 'ASC')->get();
        foreach ($creatives as $creative){
            $status = $request->get('id'.$creative->id.'_approval');
            $comment = $request->get($creative->id.'_comment');
            $creative_img =CreativeImages::where('id', $creative->id)->firstOrFail();
            if ($status =='approved') {
                $creative_img->approval = 'Yes';
                $activity_log = new Activity([
                    'name' => 'CreativeApproval',
                    'model' => 'CreativeTask',
                    'model_id' => $creative_img->id,
                    'description' => $creative_img->name.' has been Approved by '.$user->name,
                    'created_by' => $user->name,
                ]);
                $activity_log->save();
            }
            elseif ($status =='review_update') {
                $creative_img->comment = $comment;
                $creative_img->approval = 'No';
                $activity_log = new Activity([
                    'name' => 'CreativeApproval',
                    'model' => 'CreativeTask',
                    'model_id' => $creative_img->id,
                    'description' => $creative_img->name.' has been updated comment - '.$creative_img->comment.' By - '.$user->name,
                    'created_by' => $user->name,
                ]);
                $activity_log->save();
            }
            $creative_img->save();
        }


        return response()->json([
            'success' => 'All Changes has been updated successfully!'
        ]);

    }
    public function store_creatives(Request $request, $id){

        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $task = Task::find($id);
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $directory = "storage/creatives/$year/$month/$day";
        if(!is_dir($directory)){
            mkdir($directory, 755, true);
        }
        $creatives = $request->file('creatives');
        $creatives_count = CreativeImages::where('creative_id', $task->id)->distinct('order_id')->count();
        if($creatives_count == '0'){
            $start_order_id = 1;
        }
        else{
            $start_order_id = $creatives_count + 1;
        }
        foreach ($creatives as $image) {
            $new_name = $image->getClientOriginalName();
            // $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $new_name);
            $location = $directory.'/'.$new_name;
            $store_craetive_image = new CreativeImages([
                'creative_id' => $task->id,
                'order_id' => $start_order_id,
                'status' => 1,
                'name' => $new_name,
                'path' => $directory,
                'location' => $location,
                'upload_by' => $user->name,
                'approval' => 'No'
            ]);
            $store_craetive_image->save();
            $start_order_id++;
        }
        return Redirect::back()->with('creative_added','Added Successful !');
    }
    public function creative_update(Request $request, $id)
    {   
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $creative ='';
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $directory = "storage/creatives/$year/$month/$day";
        if(!is_dir($directory)){
            mkdir($directory, 755, true);
        }
        $old_creative_img =CreativeImages::where('id', $id)->firstOrFail();
        $image = $request->creative_update;
        $new_name = $image->getClientOriginalName();
        // $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move($directory, $new_name);
        $location = $directory.'/'.$new_name;
        $store_craetive_image = new CreativeImages([
            'creative_id' => $old_creative_img->creative_id,
            'order_id' => $old_creative_img->order_id,
            'status' => 1,
            'name' => $new_name,
            'path' => $directory,
            'location' => $location,
            'reapproval_notes' => $request->get('reapproval_notes'),
            'upload_by' => $user->name,
            'approval' => 'No'
        ]);
        $store_craetive_image->save();
        $old_creative_img->status = 0;
        $old_creative_img->save();
        return Redirect::back()->with('creative_updated',' The Creaive has been uploaded successfuly!');
    }
    public function creative_delete($id)
    {
        $user = Auth::user();
        $creative_img =CreativeImages::where('id', $id)->firstOrFail();
        $creative_img->status = 0;
        $creative_img->save();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
    public function task_delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect::back()->with('success', 'Task deleted!');
    }
}
