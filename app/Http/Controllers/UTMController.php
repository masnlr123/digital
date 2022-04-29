<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\BunnyCDNStorage;
use App\UTM;
use App\Activity;
use Auth;
use DB;
use Storage;
use DataTables;
use App\AdCampaigns;
use Redirect;
use App\User;
use App\Projects;
use App\Campaigns;
// use App\AdCampaigns;
use Validator;

class UTMController extends Controller
{
	public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
    }
    //*** JSON Request
    public function datatables()
    {
        if(Auth::user()->role_id == '15'){
            $datas = UTM::where('created_by', 'Sri Krishna')->orderBy('id','desc')->get();
        }
        else{
            $datas = UTM::orderBy('id','desc')->get();
        }
         return DataTables::of($datas)
            ->addColumn('output', function(UTM $data) {
                $output = $data->output;
                $output = '<span style="with:500px;">'.$output.'</span>';
                return $output;
            })
            ->editColumn('is_dynamic', function(UTM $data) {
                $is_dynamic = $data->is_dynamic;
                if($is_dynamic != 0){
                    $is_dynamic_lp = 'Yes';
                }else{
                    $is_dynamic_lp = 'No';
                }
                return $is_dynamic_lp;
            })
            ->editColumn('campaign', function(UTM $data) {
                $campaign = $data->campaign;
                if(empty($campaign)){
                    $get_camp = 'Not Found';
                }
                elseif(is_numeric($campaign)){
                    $get_camp = AdCampaigns::find($campaign);
                    $get_camp = $get_camp->name;
                }
                else{
                    $get_camp = $campaign;
                }
                return $get_camp;
            })
            ->addColumn('action', function(UTM $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_utm',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                $action .= '<a target="_blank" href="'.$data->output. '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-external-link-alt"></i></a>';
                $action .= '<a href="#" data-clipboard-text="'.$data->output.'" class="copy-btn btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="far fa-clone"></i></a>';
                // if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8'))):
                $action .= '<form class="d-inline" action="' . route('delete_utm',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_utm',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                // endif;
                return $action;
            })
            ->rawColumns(['output', 'types', 'action'])
            ->toJson();
    }

    public function index()
    {
        $current_user = Auth::user();
        $utm_task = UTM::all();
        return view('task.utm.dataindex', compact(array('utm_task', 'current_user')));
    }
    public function create()
    {
        //
        $projects = Projects::all();
        $campaigns = AdCampaigns::where('status', 'Live')->get();
        return view('task.utm.create', compact(array('projects', 'campaigns')));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $desktop_creative_name = NULL;
        $mobile_creative_name = NULL;
        if(isset($request->lp_dynamic)){
            $is_dynamic = true;
            $output = $request->get('dynamic_url');
            if($request->hasFile('desktop_creative')) {
                $filenamewithextension = $request->file('desktop_creative')->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $request->file('desktop_creative')->getClientOriginalExtension();
                $desktop_creative_name = $filename.'_'.uniqid().'.'.$extension;
                Storage::disk('ftp')->put($desktop_creative_name, fopen($request->file('desktop_creative'), 'r+'));
            }
            else{
                $desktop_creative_name = '';
            }
            if($request->hasFile('mobile_creative')) {
                $filenamewithextension = $request->file('mobile_creative')->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $extension = $request->file('mobile_creative')->getClientOriginalExtension();
                $mobile_creative_name = $filename.'_'.uniqid().'.'.$extension;
                Storage::disk('ftp')->put($mobile_creative_name, fopen($request->file('mobile_creative'), 'r+'));
            }
            else{
                $mobile_creative_name = "";
            }
        }
        else{
            $is_dynamic = false;
            $output = $request->get('url');
        }

        $output .= '?utm_source='.rawurlencode($request->get('utm_source'));
        $output .= '&utm_medium='.rawurlencode($request->get('utm_medium'));
        if(isset($request->campaign)){
            if(is_numeric($request->campaign)){
                $get_utm_camp = AdCampaigns::find($request->get('campaign'));
                $output .= '&utm_campaign='.rawurlencode($get_utm_camp->name);
                $get_camp_name = $get_utm_camp->name;

                if(isset($request->project)){
                    $get_project_name = $get_utm_camp->project;
                }
                else{
                    $get_project_name = $request->get('project');
                }
            }
            else{
                $output .= '&utm_campaign='.rawurlencode($request->get('campaign'));
                $get_project_name = $request->get('project');
                $get_camp_name = $request->get('campaign');
            }
        }
        else{
            if(isset($request->project)){
                $get_project_name = $request->get('project');
            }
            else{
                $get_project_name = $request->get('url');
            }
            $get_camp_name = '';
        }

        if(isset($request->is_utm_term)){
            $output .= '&utm_term='.rawurlencode($request->get('utm_term'));
        }
        if(isset($request->is_utm_content)){
            $output .= '&utm_content='.rawurlencode($request->get('utm_content'));
        }
        if(isset($request->is_ad_position)){
            $output .= '&utm_adposition='.rawurlencode($request->get('utm_adposition'));
        }
        if(isset($request->is_utm_device)){
            $output .= '&utm_device='.rawurlencode($request->get('utm_device'));
        }
        if(isset($request->is_utm_network)){
            $output .= '&utm_network='.rawurlencode($request->get('utm_network'));
        }
        if(isset($request->is_utm_placement)){
            $output .= '&utm_placement='.rawurlencode($request->get('utm_placement'));
        }
        if(isset($request->is_utm_target)){
            $output .= '&utm_target='.rawurlencode($request->get('utm_target'));
        }
        if(isset($request->is_ad_group)){
            $output .= '&utm_ad='.rawurlencode($request->get('utm_ad'));
        }
        if($is_dynamic == true){
            $output .= '&desktop_creative='.$desktop_creative_name;
            $output .= '&mobile_creative='.$mobile_creative_name;
            $output .= '&phone='.$request->get('lp_contact');
        }

        // $output = urlencode($output);
        $store_utm_task = new UTM([
            'url' => $request->get('url'),
            'project' => $get_project_name,
            'campaign' => $get_camp_name,
            'desktop_creative' => $desktop_creative_name,
            'mobile_creative' => $mobile_creative_name,
            'lp_contact' => $request->get('lp_contact'),
            'is_dynamic' => $is_dynamic,
            'utm_source' => $request->get('utm_source'),
			'utm_medium' => $request->get('utm_medium'),
			'utm_campaign' => $request->get('utm_campaign'),
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
        $store_utm_task->save();
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'UTM',
            'model_id' => $store_utm_task->id,
            'description' => 'The Creative Task Has been created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return redirect('/task/utm')->with('success', 'Creative task saved!');
    }

    public function edit($id)
    { 
        $user = Auth::user();
        $utm_task = UTM::find($id);
        $campaigns = AdCampaigns::where('status', 'Live')->get();
        $activity = Activity::where('model', 'UTM')->where('model_id', $utm_task->id)->get();
        return view('task.utm.edit', compact(array('utm_task', 'campaigns','activity')));    
    }

    public function update_status(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = UTM::find($id);
        $old_task = $c_task->status;
        $c_task->status = $request->get('status');
        $duration = $request->get('duration');
        $c_task->save();


        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'UTM',
            'model_id' => $c_task->id,
            'description' => 'The web task status has been updated from <strong>'.$old_task.'</strong> to <strong>'.$request->get('status').'</strong> with total duration : <strong>'.$duration.'</strong>. Status Notes: '.$request->get('status_notes').' | Updated by - '.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');

    }
    public function update(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = UTM::find($id);
        $output = $request->get('url');

        if(isset($request->utm_source)){
            $output .= '?utm_source='.rawurlencode($request->get('utm_source'));
        }
        if(isset($request->utm_medium)){
            $output .= '&utm_medium='.rawurlencode($request->get('utm_medium'));
        }
        if(isset($request->utm_campaign)){
            $output .= '&utm_campaign='.rawurlencode($request->get('utm_campaign'));
        }
        if(isset($request->utm_term)){
            $output .= '&utm_term='.rawurlencode($request->get('utm_term'));
        }
        if(isset($request->utm_content)){
            $output .= '&utm_content='.rawurlencode($request->get('utm_content'));
        }
        if(isset($request->utm_adposition)){
            $output .= '&utm_adposition='.rawurlencode($request->get('utm_adposition'));
        }
        if(isset($request->utm_device)){
            $output .= '&utm_device='.rawurlencode($request->get('utm_device'));
        }
        if(isset($request->utm_network)){
            $output .= '&utm_network='.rawurlencode($request->get('utm_network'));
        }
        if(isset($request->utm_placement)){
            $output .= '&utm_placement='.rawurlencode($request->get('utm_placement'));
        }
        if(isset($request->utm_target)){
            $output .= '&utm_target='.rawurlencode($request->get('utm_target'));
        }
        if(isset($request->utm_ad)){
            $output .= '&utm_ad='.rawurlencode($request->get('utm_ad'));
        }
        $c_task->campaign = $request->get('campaign');
		$c_task->utm_source = $request->get('utm_source');
		$c_task->url = $request->get('url');
		$c_task->utm_medium = $request->get('utm_medium');
		$c_task->utm_campaign = $request->get('utm_campaign');
		$c_task->utm_term = $request->get('utm_term');
		$c_task->utm_content = $request->get('utm_content');
		$c_task->utm_adposition = $request->get('utm_adposition');
		$c_task->utm_device = $request->get('utm_device');
		$c_task->utm_network = $request->get('utm_network');
		$c_task->utm_placement = $request->get('utm_placement');
		$c_task->utm_target = $request->get('utm_target');
		$c_task->utm_ad = $request->get('utm_ad');
		$c_task->output = $output;
		$c_task->created_by = $request->get('created_by');
        $c_task->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'UTM',
            'model_id' => $c_task->id,
            'description' => 'The UTM Parameter details updated by'.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }

    public function destroy($id)
    {
        $cre_task = UTM::find($id);
        $cre_task->delete();

        return redirect('/task/utm/')->with('success', 'Task deleted!');
    }
}
