<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCreativeTask;
use App\Mail\SendCampaignNotification;
use App\Mail\MediaPlanNotification;
use App\Mail\AdCampaignNotification;
use App\Campaigns;
use App\Setting;
use App\WeeklyMediaPlan;
use App\Projects;
use App\CreativeTask;
use App\TaskPaid;
use App\TaskSEO;
use App\TaskWeb;
use App\TaskLMS;
use App\TaskContent;
use App\UTM;
use App\AdCampaigns;
use App\MileStone;
use App\CreativeImages;
use App\CreativeSamples;
use DataTables;
use App\Activity;
use App\User;
use App\Sources;
use Redirect;
use Auth;
use DB;
use PDF;
use Response;
use Carbon\Carbon;
use Validator;

class CampaignController extends Controller
{

    //*** JSON Request
    public function datatables()
    { 
         $datas = Campaigns::orderBy('id','desc')->where('channels', '!=', NULL)->get();
         return DataTables::of($datas)
            ->addColumn('id', function(Campaigns $data) {
                return '<strong>PC'.$data->id.'</strong>';
            })
            ->addColumn('date', function(Campaigns $data) {
                return '<strong>'.$data->created_at.'</strong>';
            })
            ->addColumn('project', function(Campaigns $data) {
                $pro_name = str_replace('_', ' ', $data->project);
                return ucwords($pro_name);
            })
            // ->addColumn('channels', function(Campaigns $data) {
            //     $clist = json_decode($data->channels);
            //     $channels = '';
            //     if(is_array($clist)){
            //         foreach($clist as $camp){
            //             $channels .='<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill" style="background: #ecdaf0 !important;margin: 2px;">'.ucwords($camp->camp_channel).'</span>';
            //         }
                    
            //     }
            //     return $channels;
            // })
            ->addColumn('status', function(Campaigns $data) {
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'new':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                        break;
                    case 'not_started':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">Not Started</span>';
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
            ->addColumn('action', function(Campaigns $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('campaign_details',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
                $action .= '<a href="' . route('clone_campaign',$data->id) . '" class="btn btn-sm btn-primary btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-clone"></i></a>';
                if(in_array(Auth::user()->role_id, array('1'))):
                $action .= '<form class="d-inline" action="' . route('delete_project_camp',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_project_camp',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                endif;
                return $action;
            })
            ->rawColumns(['id', 'status', 'project', 'action'])
            ->toJson();
    }
    public function ad_camp_datatables($id)
    { 
         $datas = AdCampaigns::where('campaign_id', $id)->orderBy('id','desc')->select('id', 'name', 'project', 'channel', 'status', 'source', 'assigned_to', 'created_at')->get();
         return DataTables::of($datas)
            // ->addColumn('id', function(AdCampaigns $data) {
            //     return '<strong>AC'.$data->id.'</strong>';
            // })
            // ->addColumn('date', function(AdCampaigns $data) {
            //     return '<strong>'.$data->created_at.'</strong>';
            // })
            ->addColumn('project', function(AdCampaigns $data) {
                $pro_name = str_replace('_', ' ', $data->project);
                return ucwords($pro_name);
            })
            ->addColumn('status', function(AdCampaigns $data) {
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'Live':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">Live</span>';
                        break;
                    case 'Pause':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">Pause</span>';
                        break;
                    case 'Not Started':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">Not Started</span>';
                        break;
                } 
                return $creative_status_tag;
            })
            ->addColumn('action', function(AdCampaigns $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('ad_camp_details',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
                $action .= '<a href="' . route('delete_ad_camp',$data->id) . '" class="btn btn-sm btn-danger btn-icon btn-icon-sm kt-mr-5"> <i class="flaticon2-trash"></i></a>';
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
            ->rawColumns(['project','status','action'])
            ->toJson();
    }
    public function all_ad_camp_datatables()
    { 
         $datas = AdCampaigns::orderBy('id','desc')->select('id', 'name', 'project','campaign', 'channel', 'status', 'source', 'assigned_to', 'created_at')->get();
         return DataTables::of($datas)
            // ->addColumn('id', function(AdCampaigns $data) {
            //     return '<strong>AC'.$data->id.'</strong>';
            // })
            // ->addColumn('date', function(AdCampaigns $data) {
            //     return '<strong>'.$data->created_at.'</strong>';
            // })
            ->addColumn('project', function(AdCampaigns $data) {
                $pro_name = str_replace('_', ' ', $data->project);
                return ucwords($pro_name);
            })
            ->addColumn('status', function(AdCampaigns $data) {
                $creative_status = $data->status;
                switch ($creative_status) {
                    case 'Live':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">Live</span>';
                        break;
                    case 'Pause':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">Pause</span>';
                        break;
                    case 'Not Started':
                        $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">Not Started</span>';
                        break;
                } 
                return $creative_status_tag;
            })
            ->addColumn('action', function(AdCampaigns $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('ad_camp_details',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
                $action .= '<a href="' . route('delete_ad_camp',$data->id) . '" class="btn btn-sm btn-danger btn-icon btn-icon-sm kt-mr-5"> <i class="flaticon2-trash"></i></a>';
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
            ->rawColumns(['project','status','action'])
            ->toJson();
    }

    public function index()
    {
        $campaigns = Campaigns::all();
        return view('campaign.dataindex', compact(array('campaigns')));
    }
    public function all_ad_camp_index()
    {
        $campaigns = Campaigns::all();
        return view('campaign.all_ad_camp_index', compact(array('campaigns')));
    }
    public function index_json()
    {
        $campaigns = Campaigns::all();

        $res_arrays = 
        array (
          'meta' => 
          array (
            'page' => 1,
            'pages' => 1,
            'perpage' => -1,
            'total' => 40,
            'sort' => 'asc',
            'field' => 'id',
          ),
          'data' => $campaigns,
        );
        // return Response::json($campaigns, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        return Response::json($res_arrays, 200, array(), JSON_PRETTY_PRINT);
        // return view('campaign.index', compact(array('campaigns')));
    }
    public function create()
    {
        $users = User::all();
        $digital_users = User::whereIn('role_id', ['5', '7'])->get();
        $settings = Setting::all();
        $projects = Projects::all();
        $sources = Sources::all();
        return view('campaign.create', compact(array(
          'digital_users',
          'settings',
          'sources',
          'projects'
        )));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $campaign = new Campaigns([
            'name' => $request->get('plan_name'),
            'project' => $request->get('project'),
            'month' => $request->get('month'),
            'budget_cost' => $request->get('budget_cost'),
            'base_price' => $request->get('base_price'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'channels' => json_encode($request->get('asaignee_list')),
            'metrix' => json_encode($request->get('metrix')),
            'description' => $request->get('description'),
            'status' => 'Not Started',
            'created_by' => $user->name,
            'created_time' => date('Y-m-d H:i:s')
        ]);
        $campaign->save();
        $camp_edit_url = route('campaign_details', $campaign->id);
        if(isset($request->asaignee_list)){  
            foreach($request->get('asaignee_list') as $plan){
                $get_user = User::find($plan['user']);
                $get_user = json_decode($get_user);
                $channel = $plan['medium'];
                $mdata = array(
                    'key' => 'created',
                    'to' => $get_user->email,
                    'to_name' => $get_user->name,
                    'from' => 'admin@alliancein.com',
                    'from_name' => 'Task Management System',
                    'subject' => ' New Campaign - '.$request->get('name'),
                    'name' => $request->get('name'),
                    'project' => $request->get('project'),
                    'channel' => $channel,
                    'description' => $request->get('description'),
                    'status' => 'Not Started',
                    'created_by' => $user->name,
                    'edit_url' => $camp_edit_url,
                    'created_time' => date('Y-m-d H:i:s')
                );


                // Mail::to($get_user->email)->send(new SendCampaignNotification($mdata));
            }
        }
        // $activity_log = new Activity([
        //     'name' => 'Create',
        //     'model' => 'Campaigns',
        //     'model_id' => $campaign->id,
        //     'description' => $user->name.' Has been Created the Campaign - <strong>'.$request->get('name').'</strong>',
        //     'created_by' => $user->name,
        // ]);
        // $activity_log->save();
        // return redirect($camp_edit_url)->with('success', 'New Campaign has been Created.!');
        return response()->json(['success' => 'Campaign Created Successfully!']);
    }
    public function store_ad_campaign(Request $request)
    {
        $user = Auth::user();
        $campaign = new AdCampaigns([
            'name' => $request->get('name'),
            'project' => $request->get('project'),
            'campaign' => $request->get('campaign'),
            'campaign_id' => $request->get('campaign_id'),
            'channel' => $request->get('channel'),
            'source' => $request->get('source'),
            'description' => $request->get('description'),
            'type' => $request->get('type'),
            'status' => 'Live',
            'assigned_to' => $request->get('assigned_to'),
            'created_by' => $user->name
        ]);
        $campaign->save();
        $camp_edit_url = route('ad_camp_details', $campaign->id);
        $get_user = User::where('name', $request->get('assigned_to'))->first();
        $mdata = array(
            'key' => 'created',
            'to' => $get_user->email,
            'to_name' => $get_user->name,
            'subject' => ' New Campaign - '.$request->get('name'),
            'project_camp' => $request->get('campaign'),
            'name' => $request->get('name'),
            'project' => $request->get('project'),
            'channel' => $request->get('channel'),
            'description' => $request->get('description'),
            'status' => 'Live',
            'created_by' => $user->name,
            'edit_url' => $camp_edit_url
        );
        // Mail::to($get_user->email)->send(new AdCampaignNotification($mdata));
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'AdCampaigns',
            'model_id' => $campaign->id,
            'description' => $user->name.' Has been Created the Ad Campaign - <strong>'.$request->get('name').'</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return redirect($camp_edit_url)->with('success', 'New Ad Campaign has been Created.!');
    }
    public function milestone_store(Request $request)
    {
        $user = Auth::user();
        $milestone = new MileStone([
            'activity' => $request->get('activity'),
            // 'department' => $request->get('department'),
            'project' => $request->get('project'),
            'campaign' => $request->get('campaign'),
            'campaign_id' => $request->get('campaign_id'),
            'ad_campaign_id' => $request->get('ad_campaign_id'),
            'channel' => $request->get('channel'),
            'medium' => $request->get('medium'),
            'source' => $request->get('source'),
            'assigned_to' => $request->get('assigned_to'),
            'created_by' => $user->name
        ]);
        $milestone->save();
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'MileStone',
            'model_id' => $milestone->id,
            'description' => $user->name.' Has been Created the New MileStone - <strong>'.$request->get('name').'</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return Redirect::back()->with('success', 'New milestone has been Created.!');
    }
    public function show($id)
    {
        //
    }
    public function details($id)
    {
        $user = Auth::user();
        if($id == 'Non Campaign Task'){
            $campaigns = Campaigns::find(0);
            $activity = Activity::where('model', 'Campaigns')->where('model_id', $campaigns->id)->get();
            $creative_tasks = CreativeTask::where('campaign', '0')->get();
        }
        else{
            $campaigns = Campaigns::find($id);
            $creative_tasks = CreativeTask::where('campaign', $campaigns->name)->get();
            $activity = Activity::where('model', 'Campaigns')->where('model_id', $campaigns->id)->get();
        }
        $users = User::all();
        $pre_month = $campaigns->month;
        $pre_month = date("F Y", strtotime ('-1 month' , strtotime($pre_month)));
        $pre_camp = Campaigns::where('project', $campaigns->project)->where('month', $pre_month)->get();
        $paid_users = User::whereIn('role_id', ['5', '7'])->get();
        $settings = Setting::all();
        $projects = Projects::all();
        // $activity = Activity::where('model', 'CreativeTask')->where('model_id', $creative_task->id)->get();
        return view('campaign.details', compact(array(
          'campaigns', 
          'pre_month', 
          'pre_camp', 
          'paid_users',
          'settings',
          'activity',
          'projects',
          'creative_tasks',
          'user'
        )));    
    }
    public function ad_camp_details($id)
    {
        $user = Auth::user();
        $ad_camp = AdCampaigns::find($id);
        if(empty($ad_camp)){
            abort(404);
        }
        $milestones = MileStone::where('ad_campaign_id', $ad_camp->id)->get();
        
        $campaigns = Campaigns::find($ad_camp->campaign_id);
        $creative_tasks = CreativeTask::where('campaign', $campaigns->name)->get();
        $activity = Activity::where('model', 'Campaigns')->where('model_id', $campaigns->id)->get();

        $users = User::all();
        $paid_users = User::whereIn('role_id', ['5', '7'])->get();
        $settings = Setting::all();
        $projects = Projects::all();
        // $activity = Activity::where('model', 'CreativeTask')->where('model_id', $creative_task->id)->get();
        return view('campaign.adcamp_details', compact(array(
          'ad_camp', 
          'milestones', 
          'campaigns', 
          'paid_users',
          'settings',
          'activity',
          'projects',
          'creative_tasks',
          'user'
        )));    
    }
    public function store_paids(Request $request, $id){

        $user = Auth::user();

        // $camp_id = $request->get('campaign');
        $camp = Campaigns::find($id);
        $project = $camp->project;
        $campaign = $camp->id;

        $store_craetive_task = new TaskPaid([
            'name' => $request->get('name'),
            'project' => $project,
            'campaign' => $campaign,
            'activity' => $request->get('activity'),
            'task_owner_eta' => $request->get('task_owner_eta'),
            'developer_eta' => $request->get('developer_eta'),
            'brief' => $request->get('brief'),
            'status_notes' => $request->get('status_notes'),
            'priority' => $request->get('priority'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_craetive_task->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $store_craetive_task->id,
            'description' => 'The Paid Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('success', 'Paid task Created Successfully!');
    }


    public function store_seo(Request $request, $id){

        $user = Auth::user();

        // $camp_id = $request->get('campaign');
        $camp = Campaigns::find($id);
        $project = $camp->project;
        $campaign = $camp->id;

        $store_craetive_task = new TaskSEO([
            'name' => $request->get('name'),
            'project' => $project,
            'campaign' => $campaign,
            'activity' => $request->get('activity'),
            'task_owner_eta' => $request->get('task_owner_eta'),
            'developer_eta' => $request->get('developer_eta'),
            'brief' => $request->get('brief'),
            'status_notes' => $request->get('status_notes'),
            'priority' => $request->get('priority'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_craetive_task->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $store_craetive_task->id,
            'description' => 'The SEO Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('success', 'SEO task Created Successfully!');
    }

    public function store_lms(Request $request, $id){

        $user = Auth::user();
        // $camp_id = $request->get('campaign');
        $camp = Campaigns::find($id);
        $project = $camp->project;
        $campaign = $camp->id;
        $store_craetive_task = new TaskLMS([
            'name' => $request->get('name'),
            'project' => $project,
            'campaign' => $campaign,
            'activity' => $request->get('activity'),
            'task_owner_eta' => $request->get('task_owner_eta'),
            'brief' => $request->get('brief'),
            'priority' => $request->get('priority'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_craetive_task->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $store_craetive_task->id,
            'description' => 'The LMS Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('success', 'SEO task Created Successfully!');
    }

    public function store_utm(Request $request, $id){

        $user = Auth::user();

        // $camp_id = $request->get('campaign');
        $camp = Campaigns::find($id);
        $project = $camp->project;
        $campaign = $camp->id;

        $output = $request->get('url').'?utm_source='.rawurlencode($request->get('utm_source')).'&utm_medium='.rawurlencode($request->get('utm_medium')).'&utm_campaign='.rawurlencode($campaign).'&utm_term='.rawurlencode($request->get('utm_term')).'&utm_content='.rawurlencode($request->get('utm_content')).'&utm_adposition'.rawurlencode($request->get('utm_adposition')).'&utm_device='.rawurlencode($request->get('utm_device')).'&utm_network='.rawurlencode($request->get('utm_network')).'&utm_placement='.rawurlencode($request->get('utm_placement')).'&utm_target='.rawurlencode($request->get('utm_target')).'&utm_ad'.rawurlencode($request->get('utm_ad'));

        $utm_link = new UTM([
            'url' => $request->get('url'),
            'project' => $project,
            'campaign' => $campaign,
            'utm_source' => $request->get('utm_source'),
            'utm_medium' => $request->get('utm_medium'),
            'utm_campaign' => $campaign,
            'utm_term' => $request->get('utm_term'),
            'utm_content' => $request->get('utm_content'),
            'utm_adposition' => $request->get('utm_adposition'),
            'utm_device' => $request->get('utm_device'),
            'utm_network' => $request->get('utm_network'),
            'utm_placement' => $request->get('utm_placement'),
            'utm_target' => $request->get('utm_target'),
            'utm_ad' => $request->get('utm_ad'),
            'output' => $output,
            'created_by' => $user->name
        ]);
        $utm_link->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'UTM',
            'model_id' => $utm_link->id,
            'description' => 'The UTM Link Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('success', 'LMS task Created Successfully!');
    }
    public function store_web(Request $request, $id){

        $user = Auth::user();

        // $camp_id = $request->get('campaign');
        $camp = Campaigns::find($id);
        $project = $camp->project;
        $campaign = $camp->id;

        $store_craetive_task = new TaskWeb([
            'name' => $request->get('name'),
            'project' => $project,
            'campaign' => $campaign,
            'activity' => $request->get('activity'),
            'task_owner_eta' => $request->get('task_owner_eta'),
            'brief' => $request->get('brief'),
            'priority' => $request->get('priority'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_craetive_task->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $store_craetive_task->id,
            'description' => 'The Web Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('success', 'Web task Created Successfully!');
    }
    public function store_content(Request $request, $id){

        $user = Auth::user();

        // $camp_id = $request->get('campaign');
        $camp = Campaigns::find($id);
        $project = $camp->project;
        $campaign = $camp->id;

        $store_craetive_task = new TaskContent([
            'name' => $request->get('name'),
            'project' => $project,
            'campaign' => $campaign,
            'activity' => $request->get('activity'),
            'task_owner_eta' => $request->get('task_owner_eta'),
            'brief' => $request->get('brief'),
            'priority' => $request->get('priority'),
            'status' => 'new',
            'created_by' => $user->name
        ]);
        $store_craetive_task->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'TaskPaid',
            'model_id' => $store_craetive_task->id,
            'description' => 'The Content Requirements Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('success', 'Web task Created Successfully!');
    }
    public function store_creatives(Request $request, $id){
        $user = Auth::user();
        $currentCampaign = Campaigns::find($id);
        $new_task_name = $request->get('name');
        $creative_cat = $request->get('task_cat');
        $creative_cat = implode(',', $creative_cat);
        $creative_creative_type = $request->get('creative_type');
        $creative_creative_type = implode(',', $creative_creative_type);

        $task_project = $currentCampaign->project;
        $task_channel = $currentCampaign->channel;
        $task_campaign_type = $currentCampaign->type;

        $store_craetive_task = new CreativeTask([
            'task_name' => $new_task_name,
            'task_cat' => $creative_cat,
            'task_for' => $request->get('task_for'),
            'project' => $task_project,
            'channel' => $task_channel,
            'campaign_type' => $task_campaign_type,
            'campaign' => $currentCampaign->name,
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
        $currentCampaign->save();


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
                $activity_log = new Activity([
                    'name' => 'Store_Creative_Samples',
                    'model' => 'CreativeTask',
                    'model_id' => $store_craetive_task->id,
                    'description' => $new_name.' - The Creaive Samples has been uploaded successfuly',
                    'created_by' => $user->name,
                ]);
                $activity_log->save();
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
            'campaign' => $currentCampaign->name,
            'campaign_type' => $task_campaign_type,
            'channel' => $task_channel,
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
        // Mail::to($mdata['to'])->send(new SendCreativeTask($mdata));
        return Redirect::back()->with('success', 'Creative has beed created successfully!');
    }
    public function store_task(Request $request){
        $user = Auth::user();
        $department = $request->get('department');
        $task_name = $request->get('name');
        if($department == 'Creative'){
            $creative_cat = implode(',', $request->get('task_cat'));
            $creative_creative_type = implode(',', $request->get('creative_type'));
            $store_craetive_task = new Task([
                'task_name' => $task_name,
                'task_cat' => $creative_cat,
                'task_for' => $request->get('task_for'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'creative_type' => $creative_creative_type,
                'task_brief' => $request->get('brief'),
                'creator_eta' => $request->get('eta'),
                'priority' => $request->get('type'),
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
                'task_name' => $task_name,
                'task_cat' => $creative_cat,
                'task_for' => $request->get('task_for'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_type' => '',
                'channel' => '',
                'creative_type' => $creative_creative_type,
                'task_brief' => $request->get('brief'),
                'hero_message' => '',
                'creative_size' => '',
                'creator_eta' => $request->get('eta'),
                'priority' => $request->get('type'),
                'status' => 'new',
                'created_by' => $user->name,
                'edit_url' => $task_edit_url,
                'created_time' => date('Y-m-d H:i:s')
            );
            // Mail::to($mdata['to'])->send(new SendCreativeTask($mdata));
        }
        elseif($department == 'Paid'){
            $store_craetive_task = new Paid([
                'name' => $request->get('name'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'activity' => $request->get('activity'),
                'task_owner_eta' => $request->get('task_owner_eta'),
                'developer_eta' => $request->get('eta'),
                'brief' => $request->get('brief'),
                'status_notes' => $request->get('status_notes'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name
            ]);
            $store_craetive_task->save();

            $activity_log = new Activity([
                'name' => 'Create',
                'model' => 'TaskPaid',
                'model_id' => $store_craetive_task->id,
                'description' => 'The Paid Task Has been created! with status of <strong>New</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        elseif($department == 'Organic'){
            $store_craetive_task = new TaskSEO([
                'name' => $request->get('name'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'activity' => $request->get('activity'),
                'task_owner_eta' => $request->get('task_owner_eta'),
                'developer_eta' => $request->get('eta'),
                'brief' => $request->get('brief'),
                'status_notes' => $request->get('status_notes'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name
            ]);
            $store_craetive_task->save();

            $activity_log = new Activity([
                'name' => 'Create',
                'model' => 'TaskPaid',
                'model_id' => $store_craetive_task->id,
                'description' => 'The SEO Task Has been created! with status of <strong>New</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        elseif($department == 'Web'){
            $store_craetive_task = new TaskWeb([
                'name' => $request->get('name'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'activity' => $request->get('activity'),
                'task_owner_eta' => $request->get('task_owner_eta'),
                'brief' => $request->get('brief'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name
            ]);
            $store_craetive_task->save();

            $activity_log = new Activity([
                'name' => 'Create',
                'model' => 'TaskPaid',
                'model_id' => $store_craetive_task->id,
                'description' => 'The Web Task Has been created! with status of <strong>New</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        elseif($department == 'LMS'){
            $store_craetive_task = new TaskLMS([
                'name' => $request->get('name'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'activity' => $request->get('activity'),
                'task_owner_eta' => $request->get('task_owner_eta'),
                'brief' => $request->get('brief'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name
            ]);
            $store_craetive_task->save();

            $activity_log = new Activity([
                'name' => 'Create',
                'model' => 'TaskPaid',
                'model_id' => $store_craetive_task->id,
                'description' => 'The LMS Task Has been created! with status of <strong>New</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        elseif($department == 'Aggregators'){
            $store_craetive_task = new TaskLMS([
                'name' => $request->get('name'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'activity' => $request->get('activity'),
                'task_owner_eta' => $request->get('task_owner_eta'),
                'brief' => $request->get('brief'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name
            ]);
            $store_craetive_task->save();

            $activity_log = new Activity([
                'name' => 'Create',
                'model' => 'TaskPaid',
                'model_id' => $store_craetive_task->id,
                'description' => 'The LMS Task Has been created! with status of <strong>New</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        elseif($department == 'Content'){
            $store_craetive_task = new TaskContent([
                'name' => $request->get('name'),
                'project' => $request->get('project'),
                'campaign' => $request->get('campaign'),
                'campaign_id' => $request->get('campaign_id'),
                'ad_camp_id' => $request->get('ad_camp_id'),
                'activity' => $request->get('activity'),
                'task_owner_eta' => $request->get('task_owner_eta'),
                'brief' => $request->get('brief'),
                'priority' => $request->get('priority'),
                'status' => 'new',
                'created_by' => $user->name
            ]);
            $store_craetive_task->save();
            $activity_log = new Activity([
                'name' => 'Create',
                'model' => 'TaskPaid',
                'model_id' => $store_craetive_task->id,
                'description' => 'The Content Requirements Has been created! with status of <strong>New</strong>',
                'created_by' => $user->name,
            ]);
            $activity_log->save();
        }
        return Redirect::back()->with('success', 'Task created successfully!');
    }
    public function update(Request $request, $id){
      if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $camp = Campaigns::find($id);
        $exist_channel_list = json_decode($camp->channels);
        $channels_count = count($exist_channel_list);
        $newchannels_count = count($request->asaignee_list);
        $new_channel_length = $newchannels_count - $channels_count;
        $new_channel_array = array_slice($request->asaignee_list, $channels_count, $new_channel_length);
        if($new_channel_array){
            $camp_edit_url = route('campaign_details', $camp->id);
            foreach($new_channel_array as $user_id){
                $get_user = User::find($user_id['user']);
                $get_user = json_decode($get_user);
                $channel = $user_id['medium'];
                $mdata = array(
                    'key' => 'created',
                    'to' => $get_user->email,
                    'to_name' => $get_user->name,
                    'from' => 'admin@alliancein.com',
                    'from_name' => 'Task Management System',
                    'subject' => ' New Campaign - '.$camp->name,
                    'name' => $camp->name,
                    'project' => $camp->project,
                    'channel' => $channel,
                    'description' => $camp->description,
                    'status' => $camp->status,
                    'created_by' => $user->name,
                    'edit_url' => $camp_edit_url,
                    'created_time' => date('Y-m-d H:i:s')
                );
                // Mail::to($get_user->email)->send(new SendCampaignNotification($mdata));
            }
            
        }
        $camp->channels = json_encode($request->get('asaignee_list'));
        $camp->metrix = json_encode($request->get('metrix'));
        $camp->name = $request->get('plan_name');
        $camp->project = $request->get('project');
        $camp->month = $request->get('month');
        $camp->budget_cost = $request->get('budget_cost');
        $camp->base_price = $request->get('base_price');
        $camp->start_date = $request->get('start_date');
        $camp->end_date = $request->get('end_date');
        $camp->description = $request->get('description');
        $camp->save();
        // if(null !== $request->asaignee_list[0]['camp_channel']){

        // }
        $activity_log = new Activity([
            'name' => 'Media Plan Update',
            'model' => 'Campaigns',
            'model_id' => $camp->id,
            'description' => $user->name.' Has been updated <strong>'.$camp->name.'</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        $camp_update = new \stdClass;
        $camp_update->success = 'Hey '.$user->name.'!, You Have updated The Media Plan : '.$camp->name;
        return response()->json($camp_update, 200);
    }
    public function destroy($id)
    {
        $cre_task = Campaigns::find($id);
        $cre_task->delete();

        return redirect('/task/creative/')->with('success', 'Task deleted!');
    }
    public function delete_project_camp($id)
    {
        $cre_task = Campaigns::find($id);

        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'Media Plan Delete',
            'model' => 'MediaPlan',
            'model_id' => $id,
            'description' => $user->name.' Has been Deleted The Media Plan <strong>'.$cre_task->name.'</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $cre_task->delete();

        return Redirect::back();
    }
    public function delete_ad_camp($id)
    {
        $camp = AdCampaigns::find($id);
        $camp->delete();
        return redirect('/all_ad_camp_index')->with('success', 'Campaign deleted!');
    }
    public function delete_milestone($id)
    {
        $milestone = MileStone::find($id);
        $milestone->delete();

        return Redirect::back()->with('success', 'Milestone deleted!');
    }
    public function test_index()
    {
        return view('campaign.test_index');    
    }
    public function media_plan_list()
    {
        return view('campaign.index');    
    }
    public function media_plan_create()
    {
        $users = User::all();
        $digital_users = User::whereIn('role_id', ['5', '7'])->get();
        $settings = Setting::all();
        $projects = Projects::all();
        $sources = Sources::all();
        return view('campaign.new.media_plan_create', compact(array(
          'digital_users',
          'settings',
          'sources',
          'projects'
        )));
    }
    public function media_plan_edit()
    {
        $users = User::all();
        $digital_users = User::whereIn('role_id', ['5', '7'])->get();
        $settings = Setting::all();
        $projects = Projects::all();
        $sources = Sources::all();
        return view('campaign.new.media_plan_edit', compact(array(
          'digital_users',
          'settings',
          'sources',
          'projects'
        )));
    }
    public function media_plan_details(Request $request)
    {
        $id = $request->get('id');
        $user = Auth::user();
        if($id == 'Non Campaign Task'){
            $campaigns = Campaigns::find(0);
            $activity = Activity::where('model', 'Campaigns')->where('model_id', $campaigns->id)->get();
            $creative_tasks = CreativeTask::where('campaign', '0')->get();
        }
        else{
            $campaigns = Campaigns::find($id);
            $creative_tasks = CreativeTask::where('campaign', $campaigns->name)->get();
            $activity = Activity::where('model', 'Campaigns')->where('model_id', $campaigns->id)->get();
        }
        $users = User::all();
        $paid_users = User::whereIn('role_id', ['5', '7'])->get();
        $settings = Setting::all();
        $projects = Projects::all();
        // $activity = Activity::where('model', 'CreativeTask')->where('model_id', $creative_task->id)->get();
        return view('campaign.new.media_plan_details', compact(array(
          'campaigns', 
          'paid_users',
          'settings',
          'activity',
          'projects',
          'creative_tasks',
          'user'
        )));    
    }
    public function download_media_plan(Request $request, $id)
    {
        $campaigns = Campaigns::find($id);
        $data['campaigns'] = $campaigns;
        $mail_list = array('mohammedidris@alliancein.com', 'gouravjain.r@alliancein.com', 'vijay.cs@alliancein.com');
        $mdata = array(
            // 'to' => 'vijay.cs@alliancein.com',
            'to' => $request->mail_to,
            'content' => $request->mail_content,
            'subject' => 'Media Plan - '.Carbon::now(),
            'id' => $id,
            'list' => $campaigns
        );
        // Mail::to($mdata['to'])->send(new MediaPlanNotification($mdata));
        // Mail::to('vijay.cs@alliancein.com')->send(new MediaPlanNotification($mdata));
        return Redirect::back();
    }

    public function clone_campaign(Request $request, $id)
    {
        $campaigns = Campaigns::find($id);
        $new_campaigns = $campaigns->replicate();
        $new_campaigns->save();
        return Redirect::back();    
    }
    public function media_plan_get_data(Request $request)
    {
        if(isset($request->month)){
            $campaigns = Campaigns::where('month', $request->get('month'))->get();
            $data_month = $request->month;
        }
        else{
            // $campaigns = Campaigns::where('month', date('F Y'))->get();
            $campaigns = Campaigns::where('month', date('F Y'))->get();
            $data_month = date('F Y');
        }
        $dashboad = new \stdClass;
        $dashboad->list = $campaigns;
        $dashboad->month = $data_month;
        return response()->json($dashboad, 200);
    }
    public function media_plan_edit_data(Request $request, $id)
    {
        $campaign = Campaigns::find($id);

        $campaign->channels = json_decode($campaign->channels);
        $campaign->base_price = (int) $campaign->base_price;
        $campaign->budget_cost = (int) $campaign->budget_cost;
         // $campaign->metrix = json_decode($campaign->metrix),
        // if(empty($campaigns)){
        //     return response()->json('404', 200);
        // }
        $dashboad = new \stdClass;
        $dashboad->camp = $campaign;
        return response()->json($dashboad, 200);
    }
    public function update_actuals(Request $request, $id)
    {
        $campaign = Campaigns::find($id);
        $actuals = $request->get('actuals');
        $actuals['valid_leads_per'] = round($actuals['valid_leads']/$actuals['leads']*100, 2);
        $actuals['revenue'] = round($campaign->base_price * $actuals['sales']);
        $actuals['cpl'] = round($actuals['budget']/$actuals['leads']);
        $actuals['cpvl'] = round($actuals['budget']/$actuals['valid_leads']);
        $actuals['cpw'] = $actuals['walk_in'] ==0 ? 0: round($actuals['budget']/$actuals['walk_in']);
        $actuals['cps'] = $actuals['sales'] ==0 ? 0: round($actuals['budget']/$actuals['sales']);
        $actuals['sor'] = $actuals['revenue'] ==0 ? 0: round($actuals['budget']/$actuals['revenue']*100, 2);
        $actuals['vltw'] = $actuals['valid_leads'] ==0 ? 0: round($actuals['walk_in']/$actuals['valid_leads']*100, 2);
        $actuals['wts'] = $actuals['walk_in'] ==0 ? 0: round($actuals['sales']/$actuals['walk_in']*100, 2);
        $actuals['vlts'] = $actuals['valid_leads'] ==0 ? 0: round($actuals['sales']/$actuals['valid_leads']*100, 2);
        $campaign->actuals = json_encode($actuals);
        $campaign->save();
        return Redirect::back()->with('success', 'Actuals Updated Successfully!');
    }
    public function delete_actuals(Request $request, $id)
    {
        $campaign = Campaigns::find($id);
        $campaign->actuals = NULL;
        $campaign->save();
        return Redirect::back()->with('success', 'Actuals Deleted Successfully!');
    }
    public function store_weekly_media_plan(Request $request, $id)
    {
        $user = Auth::user();
        $campaign = Campaigns::find($id);

        $store_plan = new WeeklyMediaPlan([
            'media_plan_id' => $request->get('media_plan_id'),
            'source' => $request->get('source'),
            'month' => $request->get('month'),
            'week' => $request->get('week'),
            'from_date' => $request->get('from_date'),
            'to_date' => $request->get('to_date'),
            'leads_per' => $request->get('leads_per'),
            'leads' => $request->get('leads'),
            'valid_leads_per' => $request->get('valid_leads_per'),
            'valid_leads' => $request->get('valid_leads'),
            'cpl' => $request->get('cpl'),
            'cpvl' => $request->get('cpvl'),
            'created_by' => $user->name,
        ]);
        return Redirect::back()->with('success', 'Weekly Media Plan Updated Successfully!');
    }
}
