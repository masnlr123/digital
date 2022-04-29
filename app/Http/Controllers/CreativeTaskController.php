<?php

namespace App\Http\Controllers;
use App\CreativeTask;
use App\Creatives;
use App\Models\Task;
use App\Activity;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCreativeTask;
use DataTables;
use Auth;
use DB;
use Redirect;
use Response;
use App\User;
use App\CreativeImages;
use App\CreativeSamples;
use App\Projects;
use App\Campaigns;
use Validator;

class CreativeTaskController extends Controller
{
    public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
    }

    //*** JSON Request
    public function datatables()
    {
         $datas = CreativeTask::orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->addColumn('types', function(CreativeTask $data) {
                // $datas = CreativeTask::orderBy('id','desc')->get();
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
            ->addColumn('status', function(CreativeTask $data) {
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'new':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
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
                        $creative_status_tag = '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                } 
                return $creative_status_tag;
            })
            // ->addColumn('status', function(CreativeTask $data) {
            //     $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
            //     $s = $data->status == 1 ? 'selected' : '';
            //     $ns = $data->status == 0 ? 'selected' : '';
            //     return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
            // })
            ->addColumn('action', function(CreativeTask $data) {
                $action = '<div class="action-list d-inline-flex">';
                $test_creatives = CreativeImages::where('creative_id', $data->id)->get();
                if(!$test_creatives->isEmpty()):
                if($data->status =='internal_review' || $data->status =='review' || $data->status =='external_review'):
$action .= '<a title="Click to View" class="btn btn-sm btn-view btn-icon btn-icon-sm kt-mr-5" href="'. route('view_creatives', $data->id). '" target="_blank"><i class="fa fa-eye" style="color: #fff;"></i></a>';

if(Auth::user()->role_id == '1' || Auth::user()->role_id == '2' || Auth::user()->role_id == '3' ):
$action .= '<a title="Click to Approval" class="btn btn-sm btn-primary btn-icon btn-icon-sm kt-mr-5" href="'. route('creative_approval', $data->id). '"><i class="flaticon2-checkmark" style="color: #fff;"></i></a>';
                endif;
                endif;
                endif;
                $action .= '<a href="' . route('edit_creative_task',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                $action .= '<form class="d-inline" action="' . route('delete_creative',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_creative',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                endif;
                return $action;
            })
            ->rawColumns(['status', 'types', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        $current_user = Auth::user();
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['1', '2', '5', '6', '7'])->get();
        $creative_users = User::whereIn('role_id', ['4'])->get();
        $all_creative_task = CreativeTask::all()->sortByDesc("id");
        $gobrand_creative_task = CreativeTask::where('task_for', 'gobrand')->get()->sortByDesc("id");
        $astra_creative_task = CreativeTask::where('task_for', 'astra')->get()->sortByDesc("id");
        $settings = Setting::all();
        return view('task.creative.index', compact(array(
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
    public function dataindex()
    {
        $current_user = Auth::user();
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $users = User::whereIn('role_id', ['1', '2', '5', '6', '7'])->get();
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
    public function index_json()
    {
        $creative_task = CreativeTask::all();

        $res_arrays = 
        array (
          'meta' => 
          array (
            'page' => 1,
            'pages' => 1,
            'perpage' => -1,
            'total' => $creative_task->count(),
            'sort' => 'asc',
            'field' => 'id',
          ),
          'data' => $creative_task,
        );
        // return Response::json($campaigns, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        return Response::json($res_arrays, 201, array(), JSON_PRETTY_PRINT);
        // return view('campaign.index', compact(array('campaigns')));
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

    public function quick(Request $request)
    {
        $cre = CreativeTask::all();
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
            $store_task = new Task([
                'name' => $task->creative_type,
                'project_id' =>  $project_id,
                'camp_id' =>  0,
                'department' =>  'Creative',
                'eta' =>  $task->creator_eta,
                'tag' =>  $task->task_cat,
                'responsible' =>  $task->assignee,
                'status' =>  $task->status,
                'created_by' =>  $task->created_by,
                'brief' =>  $task->task_brief,
                'priority' =>  $task->task_priority
            ]);
            $store_task->save();

            $all_task_samp = CreativeSamples::where('task_id', $task->id)->get();
            foreach($all_task_samp as $samp){
               $samp->task_id = $store_task->id;
               $samp->save();
            }
            $all_task_creatives = CreativeImages::where('creative_id', $task->id)->get();
            foreach($all_task_creatives as $creatives){
               $creatives->creative_id = $store_task->id;
               $creatives->save();
            }
            $all_get_creatives = Creatives::where('task_id', $task->id)->get();
            foreach($all_get_creatives as $creatives){
               $creatives->task_id = $store_task->id;
               $creatives->save();
            }

        }
        echo 'Updated!';
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        if($request->get('campaign') == 0){
            $task_project = 'Non Campaign Task';
            $campaign = 'Non Campaign Task';
        }else{
            $currentCampaign = Campaigns::where('name', $request->get('campaign'))->first();
            $campaign = $currentCampaign->id;
            $task_project = $currentCampaign->project;
        }
        if(isset($request->name)){
            $new_task_name = $request->get('name');
        }
        else{
            $new_task_name = NULL;
        }
        if(isset($request->task_cat)){
            $creative_cat = $request->get('task_cat');
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
        $store_craetive_task = new CreativeTask([
            'task_name' => $new_task_name,
            'task_cat' => $creative_cat,
            'task_for' => $request->get('task_for'),
            'project' => $task_project,
            'campaign' => $campaign,
            'creative_type' => $creative_creative_type,
            'task_brief' => $request->get('task_brief'),
            'hero_message' => $request->get('hero_message'),
            'creative_size' => $request->get('creative_size'),
            'creator_eta' => $request->get('eta_from_creator'),
            'priority' => $request->get('creator_priority'),
            'status' => 'new',
            'created_by' => $user->name,
            'created_by_email' => $user->email,
            'created_time' => date('Y-m-d H:i:s')
        ]);
        $store_craetive_task->save();


        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $directory = "storage/samples/$year/$month/$day";
        if(!is_dir($directory)){
            mkdir($directory, 755, true);
        }
        $creatives = $request->file('samples_creatives');
        if($creatives){
            foreach ($creatives as $image) {
                $new_name = $image->getClientOriginalName();
                // $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move($directory, $new_name);
                $location = $directory.'/'.$new_name;
                $store_craetive_image = new CreativeSamples([
                    'task_id' => $store_craetive_task->id,
                    'name' => $new_name,
                    'path' => $directory,
                    'location' => $location,
                    'upload_by' => $user->name
                ]);
                $store_craetive_image->save();
            }
        }

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'CreativeTask',
            'model_id' => $store_craetive_task->id,
            'description' => 'New Task Created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $task_edit_url = url('task/creative/edit/').'/'.$store_craetive_task->id;
        $mdata = array(
            'key' => 'created',
            'to' => array('xavier@alliancein.com', 'vaibhavrao.n@alliancein.com'),
            'from' => $user->email,
            'from_name' => $user->name,
            'subject' => ' New Task - '.$request->get('task_name'),
            'task_name' => $new_task_name,
            'task_cat' => $creative_cat,
            'task_for' => $request->get('task_for'),
            'project' => $task_project,
            'campaign' => $request->get('campaign'),
            'creative_type' => $creative_creative_type,
            'task_brief' => $request->get('task_brief'),
            'hero_message' => $request->get('hero_message'),
            'creative_size' => $request->get('creative_size'),
            'creator_eta' => $request->get('eta_from_creator'),
            'priority' => $request->get('creator_priority'),
            'status' => 'new',
            'created_by' => $user->name,
            'edit_url' => $task_edit_url,
            'created_time' => date('Y-m-d H:i:s')
        );
        Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        return redirect('/task/creative')->with('success', 'Creative has beed created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $creative_task = CreativeTask::find($id);
        $creatives = CreativeImages::where('creative_id', $creative_task->id)->get();
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
        $creative_task = CreativeTask::find($id);
        if(empty($creative_task)){
            return abort(404);
        }
        $creatives = CreativeImages::where('creative_id', $creative_task->id)->where('status', 1)->orderBy('order_id', 'ASC')->get();
        $status_history = Creatives::where('task_id', $creative_task->id)->get();
        $samples = CreativeSamples::where('task_id', $creative_task->id)->get();
        $users = User::all();
        $current_user = Auth::user();
        $creative_users = User::where('role_id', '4')->get();
        $approval_users = User::where('role_id', '3')->get();
        $agency_users = User::whereIn('role_id', ['9', '10'])->get();
        $projects = Projects::all();
        $campaigns = Campaigns::all();
        $activity = Activity::where('model', 'CreativeTask')->where('model_id', $creative_task->id)->get();
        return view('task.creative.edit', compact(array(
            'creative_task', 
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
    public function update_basic(Request $request, $id)
    {   
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $c_task = CreativeTask::find($id);

        $creative_cat = $request->get('task_cat');
        $creative_cat = implode(',', $creative_cat);
        
        if($request->get('campaign') == 0){
            $creative_project = 'Non Campaign Task';
            $campaign = 'Non Campaign Task';
        }else{
            $currentCampaign = Campaigns::where('name', $request->get('campaign'))->first();
            $campaign = $currentCampaign->id;
            $creative_project = $currentCampaign->project;
        }
        
        $creative_creative_type = $request->get('creative_type');
        $creative_creative_type = implode(',', $creative_creative_type);
        
        if($request->get('task_cat')){ $c_task->task_cat = $creative_cat;}
        if($request->get('task_for')){ $c_task->task_for = $request->get('task_for');}
        if($request->get('project')){ $c_task->project = $creative_project;}
        if($request->get('campaign')){ $c_task->campaign = $campaign;}
        if($request->get('creative_type')){ $c_task->creative_type = $creative_creative_type;}
        if($request->get('task_brief')){ $c_task->task_brief = $request->get('task_brief');}
        if($request->get('hero_message')){ $c_task->hero_message = $request->get('hero_message');}
        if($request->get('creative_size')){ $c_task->creative_size = $request->get('creative_size');}
        if($request->get('creator_eta')){ $c_task->creator_eta = $request->get('eta_from_creator');}
        if($request->get('priority')){ $c_task->priority = $request->get('creator_priority');}
        $c_task->status = 'new_updated';
        $c_task->save();

        $activity_log = new Activity([
            'name' => 'Basic Update',
            'model' => 'CreativeTask',
            'model_id' => $c_task->id,
            'description' => 'The Task has been updated by<strong>'.$user->name.'</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $task_edit_url = url('task/creative/edit/').'/'.$c_task->id;
        $creative_app_trans = url('task/creative/edit/').'/'.$c_task->id;
        $update_review_person = User::where('name', $c_task->new_update_req_person)->get();
        // $mdata = array(
        //     'key' => 'updated',
        //     'to' => $update_review_person[0]['email'],
        //     'from' => $user->email,
        //     'subject' => 'The Task Updated - '.$request->get('task_name').' by '.$c_task->new_update_count.' time!.',
        //         'to_name' => $c_task->created_by,
        //     'task_name' => $request->get('task_name'),
        //     'task_cat' => $request->get('task_cat'),
        //     'task_for' => $request->get('task_for'),
        //     'project' => $request->get('project'),
        //     'campaign' => $request->get('campaign'),
        //     'campaign_type' => $request->get('campaign_type'),
        //     'channel' => $request->get('channel'),
        //     'creative_type' => $request->get('creative_type'),
        //     'task_brief' => $request->get('task_brief'),
        //     'hero_message' => $request->get('hero_message'),
        //     'creative_size' => $request->get('creative_size'),
        //     'creator_eta' => $request->get('eta_from_creator'),
        //     'priority' => $request->get('creator_priority'),
        //     'status' => $c_task->status,
        //     'created_by' => $user->name,
        //     'created_by_email' => $user->email,
        //     'edit_url' => $task_edit_url,
        //     'created_time' => date('Y-m-d H:i:s')
        // );
        // Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        return Redirect::back()->with('creative_added','The Creative Task Updated Successful !');

    }
    public function update(Request $request, $id)
    {   
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $c_task = CreativeTask::find($id);

        $task_edit_url = url('task/creative/edit/').'/'.$c_task->id;

        // Default Mail Address
        // if($c_task->campaign_type == 'paid'){
        //     if($c_task->project == 'AGR' || $c_task->project == 'HG' || $c_task->project == 'CNGS' || $c_task->project == 'JS'){
        //         $default_to = 'pemmaiah@alliancein.com';
        //         $default_cc = array(
        //             'mageshkumar@alliancein.com',
        //             'kamal@alliancein.com',
        //             'rajendrajoshi@alliancein.com',
        //             'udayshankar.g@alliancein.com',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'gouravjain.r@alliancein.com',
        //             'sudhakar@alliancein.com',
        //             'mohan.m@alliancein.com',
        //             'Rajasekhar.c@urbanrise.in',
        //             'bharathiraja.s@alliancein.com'
        //         );
        //         if($c_task->channel == 'Aggregators'){
        //             array_push($default_cc, 'praveen@alliancein.com');
        //         }
        //     }
        //     if($c_task->project == 'JR' || $c_task->project == 'OS'){
        //         $default_to = 'udayshankar.g@alliancein.com';
        //         $default_cc = array(
        //             'rajendrajoshi@alliancein.com',
        //             'kamalraj@alliancein.com',
        //             'harishankar@urbanrise.in',
        //             'ranjith@urbanrise.in',
        //             'suman@alliancein.com',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'gouravjain.r@alliancein.com',
        //             'sudhakar@alliancein.com',
        //             'mohan.m@alliancein.com',
        //             'Rajasekhar.c@urbanrise.in',
        //             'bharathiraja.s@alliancein.com'
        //         );
        //         if($c_task->channel == 'Aggregators'){
        //             array_push($default_cc, 'praveen@alliancein.com');
        //         }
        //     }
        //     if($c_task->project == 'CNID'){
        //         $default_to = 'udayshankar.g@alliancein.com';
        //         $default_cc = array(
        //             'rajendrajoshi@alliancein.com',
        //             'kamalraj@alliancein.com',
        //             'harishankar@urbanrise.in',
        //             'ranjith@urbanrise.in',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'gouravjain.r@alliancein.com',
        //             'sudhakar@alliancein.com',
        //             'mohan.m@alliancein.com',
        //             'Rajasekhar.c@urbanrise.in',
        //             'bharathiraja.s@alliancein.com'
        //             );
        //         if($c_task->channel == 'Aggregators'){
        //             array_push($default_cc, 'praveen@alliancein.com');
        //         }
        //     }
        //     if($c_task->project == 'ET' || $c_task->project == 'VIB' || $c_task->project == 'TSAI'){
        //         $default_to = 'harishankar@urbanrise.in';
        //         $default_cc = array(
        //             'rajendrajoshi@alliancein.com',
        //             'udayshankar.g@alliancein.com',
        //             'cmo@urbanrise.in',
        //             'ranjith@urbanrise.in',
        //             'theja.krishna@urbanrise.in',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'gouravjain.r@alliancein.com',
        //             'sudhakar@alliancein.com',
        //             'mohan.m@alliancein.com',
        //             'Rajasekhar.c@urbanrise.in',
        //             'bharathiraja.s@alliancein.com'
        //             );
        //         if($c_task->channel == 'Aggregators'){
        //             array_push($default_cc, 'praveen@alliancein.com');
        //         }

        //     }
        // }
        // if($c_task->campaign_type == 'orgainc'){
        //     if($c_task->project == 'AGR' || $c_task->project == 'HG' || $c_task->project == 'CNGS' || $c_task->project == 'JS'){
        //         $default_to = 'pemmaiah@alliancein.com';
        //         $default_cc = array(
        //             'udayshankar.g@alliancein.com',
        //             'mageshkumar@alliancein.com',
        //             'kamal@alliancein.com',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'kumaran@alliancein.com',
        //             'ravi.p@alliancein.com',
        //             'rajeshwari.g@urbanrise.in'
        //         );
        //     }
        //     if($c_task->project == 'JR' || $c_task->project == 'OS'){
        //         $default_to = 'udayshankar.g@alliancein.com';
        //         $default_cc = array(
        //             'kamalraj@alliancein.com',
        //             'ranjith@urbanrise.in',
        //             'suman@alliancein.com',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'kumaran@alliancein.com',
        //             'ravi.p@alliancein.com',
        //             'rajeshwari.g@urbanrise.in'
        //         );
        //     }
        //     if($c_task->project == 'CNID'){
        //         $default_to = 'udayshankar.g@alliancein.com';
        //         $default_cc = array(
        //             'harishankar@urbanrise.in',
        //             'kamalraj@alliancein.com',
        //             'ranjith@urbanrise.in',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'kumaran@alliancein.com',
        //             'ravi.p@alliancein.com',
        //             'rajeshwari.g@urbanrise.in'
        //         );
        //     }
        //     if($c_task->project == 'ET' || $c_task->project == 'VIB' || $c_task->project == 'TSAI'){
        //         $default_to = 'harishankar@urbanrise.in';
        //         $default_cc = array(
        //             'udayshankar.g@alliancein.com',
        //             'cmo@urbanrise.in',
        //             'ranjith@urbanrise.in',
        //             'theja.krishna@urbanrise.in',
        //             'harish@urbanrise.in',
        //             'mohammedidris@alliancein.com',
        //             'kumaran@alliancein.com',
        //             'ravi.p@alliancein.com',
        //             'rajeshwari.g@urbanrise.in'
        //         );
        //     }
        // }
        $default_to = 'mohammedidris@alliancein.com';
        $default_cc = array('gouravjain.r@alliancein.com', 'vaibhavrao.n@alliancein.com', 'xavier@alliancein.com', 'vijay.cs@alliancein.com');
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
        $creator_email = $c_task->created_by_email;
        $old_task = $c_task->status;
        $c_task_status = $request->get('task_cat');
        if($c_task_status == 'new_needed'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'Need more clarity on the given information. This is what i am expecting - '.$request->get('new_correction_need'),
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;
            $mdata = array(
                'key' => 'status_new_needed',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $c_task->created_by,
                'subject' => 'Need more details about this Creative Task - '.now(),
                'task_name' => $c_task->creative_type,
                'edit_url' => $task_edit_url,
                'new_correction_need' => $request->get('new_correction_need')
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
            // Mail::to($mdata['to'])->cc($mdata['cc'])->send(new SendCreativeTask($mdata));
        }
        if($c_task_status == 'assigned'){

            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task has been assigned to <strong>'.$request->get('assigned_to').'</strong>',
                'eta' => $request->get('eta_from_assigner'),
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->assignee = $request->get('assigned_to');
            $c_task->status = $c_task_status;
            $assigner_email = User::where('name', $request->get('assigned_to'))->first();
            $mdata = array(
                'key' => 'status_assigned',
                'to' => $creator_email,
                'cc' => $assigner_email->email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $c_task->created_by,
                'subject' => 'This Creative Task has been assigned to '.$request->get('assigned_to').' with status of '.ucfirst($c_task->status),
                'task_name' => $c_task->creative_type,
                'assigned_by' => $user->name,
                'assigned_to' => $request->get('assigned_to'),
                'assigned_date' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'eta_from_assigner' => $request->get('eta_from_assigner'),
            );
            Mail::to($mdata['to'])->cc($mdata['cc'])->bcc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }

        if($c_task_status == 'processed'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task has been processed by '.$c_task->assignee,
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;
            $mdata = array(
                'key' => 'status_processed',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                // 'from' => $user->email,
                'by_name' => $user->name,
                'to_name' => $c_task->created_by,
                'subject' => 'The Task has been processed by '.$user->name.' with status of '.ucfirst($c_task->status),
                'task_name' => $c_task->creative_type,
                'processed_by' => $user->name,
                'processed_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($c_task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($c_task_status == 'process_transfer'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task has been Transfer from <strong>'.$c_task->assignee.'</strong> to  <strong>'.$request->get('process_transfer_to').'</strong>',
                'assignee' => $request->get('process_transfer_to'),
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->assignee = $request->get('process_transfer_to');
            $c_task->status = $c_task_status;
            $mdata = array(
                'key' => 'status_pro_trans',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $c_task->created_by,
                'subject' => 'The Task has been Transfer to '.$request->get('process_transfer_to').' with status of '.ucfirst($c_task->status),
                'task_name' => $c_task->creative_type,
                'process_transfer_by' => $user->name,
                'assigned_to' => $c_task->assigned_to,
                'process_transfer_to' => $request->get('process_transfer_to'),
                'process_transfer_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($c_task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($c_task_status == 'internal_review'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task is Under Interal Review',
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;
            $mdata = array(
                'key' => 'status_int',
                'to' => $creator_email,
                'from' => $user->email,
                'by_name' => $user->name,
                'to_name' => $c_task->created_by,
                'subject' => 'The Task is Under Interal Review - '.ucfirst($c_task->task_name).' with status of '.ucfirst($c_task->status),
                'task_name' => ucfirst($c_task->task_name),
                'internal_review_by' => $user->name,
                'internal_review_time' => date('Y-m-d H:i:s'),
            'edit_url' => $task_edit_url,
                'status' => ucfirst($c_task->status),
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
        if($c_task_status == 'external_review'){

            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task is Under Review',
                'mail_to' => $mail_to_list,
                'mail_cc' => $mail_cc_list,
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;

            $mdata = array(
                'key' => 'status_ext',
                'to' => $mail_send_to,
                'from' => $creator_email,
                'from_name' => $c_task->created_by,
                'by_name' => $c_task->created_by,
                'to_name' => '',
                'project' => $c_task->project,
                'creative_type' => $c_task->creative_type,
                'cc' => $mail_send_cc,
                'subject' => 'The Creative Task - with campaign of '.ucfirst($c_task->campaign).' is waiting for approval',
                'task_name' => $c_task->creative_type,
                'internal_review_by' => $user->name,
                'internal_review_time' => date('Y-m-d H:i:s'),
                'edit_url' => route('view_creatives', $c_task->id),
                'status' => ucfirst($c_task->status),
            );
            Mail::to($mdata['to'])->cc($mdata['cc'])->bcc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        if($c_task_status == 'review'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task is Under Review',
                'mail_to' => $mail_to_list,
                'mail_cc' => $mail_cc_list,
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;

            $mdata = array(
                'key' => 'status_ext',
                'to' => $mail_send_to,
                'from' => $creator_email,
                'from_name' => $c_task->created_by,
                'by_name' => $c_task->created_by,
                'to_name' => '',
                'project' => $c_task->project,
                'campaign' => $c_task->campaign,
                'creative_type' => $c_task->creative_type,
                'cc' => $mail_send_cc,
                'subject' => 'The Creative Task - with campaign of '.ucfirst($c_task->campaign).' is waiting for approval',
                'task_name' => $c_task->creative_type,
                'internal_review_by' => $user->name,
                'internal_review_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($c_task->status),
            );
            Mail::to($mdata['to'])->cc($mdata['cc'])->bcc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }
        // if($c_task_status == 'review'){
        //     $c_task->external_review_time = date('Y-m-d H:i:s');
        //     $c_task->external_review_by = $user->name;
        //     $c_task->approval_person = $request->get('approval_person');
        //     $c_task->mail_to = $request->get('mail_to');
        //     $c_task->mail_cc = $request->get('mail_cc');
        // }
        if($c_task_status == 'completed'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'All the creatives has neen approved. And the Task has been completed',
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->completed_time = date('Y-m-d H:i:s');
            $c_task->completed_by = $user->name;
            $c_task->status = $c_task_status;
            $mdata = array(
                'key' => 'status_completed',
                'to' => $creator_email,
                'from' => $user->email,
                'from_name' => $user->name,
                'by_name' => $user->name,
                'to_name' => $c_task->created_by,
                'subject' => 'The Task is Completed - '.ucfirst($c_task->task_name).' with status of '.ucfirst($c_task->status),
                'task_name' => $c_task->creative_type,
                'completed_by' => $user->name,
                'completed_time' => date('Y-m-d H:i:s'),
                'edit_url' => $task_edit_url,
                'status' => ucfirst($c_task->status),
            );
            Mail::to($mdata['to'])->cc('mohammedidris@alliancein.com')->send(new SendCreativeTask($mdata));
        }

        if($c_task_status == 'discard'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task have been discard',
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;
        }

        if($c_task_status == 'on_hold'){
            $creatives = new Creatives([
                'updated_by' => $user->name,
                'note' => 'The Task have been On Hold',
                'assignee' => $c_task->assignee,
                'designer_comment' => $request->get('notes'),
                'status' => $c_task_status,
                'task_id' => $c_task->id
            ]);
            $creatives->save();
            $c_task->status = $c_task_status;
        }

        $c_task->actual_duration = $request->get('actual_duration');
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'CreativeTask',
            'model_id' => $c_task->id,
            'description' => 'The Task status changed from <span class="kt-font-danger">'.ucfirst($old_task).'</span> to <span class="kt-font-info">'.ucfirst($c_task->status).'</span>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $c_task->notes = $request->get('notes');
        $c_task->save();

        return Redirect::back()->with('creative_added','Added Successful !');
        // return redirect('/task/creative/')->with('success', 'Creative Task updated!');
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
        $c_task = CreativeTask::find($id);
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $directory = "storage/creatives/$year/$month/$day";
        if(!is_dir($directory)){
            mkdir($directory, 755, true);
        }
        $creatives = $request->file('creatives');
        $creatives_count = CreativeImages::where('creative_id', $c_task->id)->distinct('order_id')->count();
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
                'creative_id' => $c_task->id,
                'order_id' => $start_order_id,
                'status' => 1,
                'name' => $new_name,
                'path' => $directory,
                'location' => $location,
                'upload_by' => $user->name,
                'approval' => 'No'
            ]);
            $activity_log = new Activity([
                'name' => 'Store_Creatives',
                'model' => 'CreativeTask',
                'model_id' => $c_task->id,
                'description' => $new_name.' - The Creaive has been uploaded successfuly',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
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
        $activity_log = new Activity([
            'name' => 'Store_Creatives',
            'model' => 'CreativeTask',
            'model_id' => $old_creative_img->id,
            'description' => $new_name.' - The Creaive has been uploaded successfuly',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $store_craetive_image->save();
        $old_creative_img->status = 0;
        $old_creative_img->save();

        // $activity_log = new Activity([
        //     'name' => 'Update_Creatives',
        //     'model' => 'CreativeTask',
        //     'model_id' => $old_creative_img->creative_id,
        //     'description' => 'The Creaive ( '.$old_creative_img->name.' ) Has been Updated successfuly',
        //     'created_by' => $user->name,
        // ]);
        // $activity_log->save();
        return Redirect::back()->with('creative_updated',' The Creaive has been uploaded successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cre_task = CreativeTask::find($id);
        $cre_task->delete();

        return redirect('/task/creative/')->with('success', 'Task deleted!');
    }


    public function creative_delete($id)
    {
        $user = Auth::user();
        $creative_img =CreativeImages::where('id', $id)->firstOrFail();

        $creative_img->status = 0;
        $creative_img->save();

        $activity_log = new Activity([
            'name' => 'Update_Creatives',
            'model' => 'CreativeTask',
            'model_id' => $creative_img->creative_id,
            'description' => 'The Creaive ( '.$creative_img->name.' ) Has been Deleted successfuly',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        // DB::table('creative_images')->where('id', $id)->delete();

        // return Redirect::back()->with('creative_delete_message','Deleted Successful !');
        // return redirect('/task/creative/')->with('success', 'Task deleted!');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
