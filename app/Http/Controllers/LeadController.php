<?php

namespace App\Http\Controllers;
use App\Lead;
use App\Activity;
use App\Setting;
use App\CreativeImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use App\Mail\SendNotification;
use DataTables;
use Auth;
use DB;
use Redirect;
use Response;
use App\User;
use Validator;

class LeadController extends Controller
{ 
    public function __construct(){
        // if (!Auth::user()){
        //     return view('auth.login');
        // }
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }

    }


    public function datatables()
    {


        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }

        if($user->role_id == '1' || $user->role_id == '2'){
            $datas = Lead::orderBy('id','desc')->select('id', 'first_name', 'email', 'contact', 'lead_stage', 'orgin', 'projects_agr', 'projects_hg', 'projects_os', 'projects_jr', 'projects_bp', 'projects_js', 'projects_cnid','projects_cngs', 'projects_et', 'projects_ammenpur', 'projects_bachu', 'projects_gandimaisamma', 'leadsquared_status', 'created_by')->get();
        }
        if($user->role_id == '3'){
            $dst_manager_name = $user->name;
            $dsts_name = User::where('dst_manager_id', $user->id)->get();
            $names = array();
            foreach($dsts_name as $dst){
                $names[] = $dst->name;
            }
            array_push($names, $dst_manager_name);
                $datas = Lead::whereIn('created_by', $names)->orderBy('id','desc')->select('id', 'first_name', 'email', 'contact', 'lead_stage', 'orgin', 'projects_agr', 'projects_hg', 'projects_os', 'projects_jr','projects_bp', 'projects_js', 'projects_cnid','projects_cngs', 'projects_et', 'projects_ammenpur', 'projects_bachu', 'projects_gandimaisamma', 'leadsquared_status', 'created_by')->get();
        }
        if($user->role_id == '5'){
            $cp_manager_name = $user->name;
            $cps_name = User::where('cp_manager_id', $user->id)->get();
            $names = array();
            foreach($cps_name as $cp){
                $names[] = $cp->name;
            }
            array_push($names, $cp_manager_name);
                $datas = Lead::whereIn('created_by', $names)->orderBy('id','desc')->select('id', 'first_name', 'email', 'contact', 'lead_stage', 'orgin', 'projects_agr', 'projects_hg', 'projects_os', 'projects_jr','projects_bp', 'projects_js', 'projects_cnid','projects_cngs', 'projects_et', 'projects_ammenpur', 'projects_bachu', 'projects_gandimaisamma', 'leadsquared_status', 'created_by')->get();
        }
        if($user->role_id == '4' || $user->role_id == '6'){
                $datas = Lead::where('created_by', $user->name)->select('id', 'first_name', 'email', 'contact', 'lead_stage', 'orgin', 'projects_agr', 'projects_hg', 'projects_os', 'projects_jr','projects_bp', 'projects_js', 'projects_cnid','projects_cngs', 'projects_et', 'projects_ammenpur', 'projects_bachu', 'projects_gandimaisamma', 'leadsquared_status', 'created_by')->get();
        }


         // $datas = Lead::orderBy('id','desc')->select('id', 'first_name', 'email', 'contact', 'orgin', 'projects_agr', 'projects_hg', 'projects_os', 'projects_jr', 'projects_js', 'projects_cnid','projects_cngs', 'projects_et', 'projects_ammenpur', 'projects_bachu', 'projects_gandimaisamma', 'leadsquared_status')->get();
         return DataTables::of($datas)
            ->addColumn('lead_id', function(Lead $data){
                // $lead_orgin = (array) json_decode($data->orgin);
                // if(!empty($lead_orgin)):
                // $lead_id = $lead_orgin->ProspectAutoId;
                // else:
                $lead_id = '000'.$data->id;
                // endif;
                return $lead_id;
            })
            ->addColumn('project', function(Lead $data){
                $project_name = '';
                if($data->projects_agr == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">AGR </span>';
                endif;
                if($data->projects_hg == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">HG </span>';
                endif;
                if($data->projects_os == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">OS </span>';
                endif;
                if($data->projects_jr == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">JR </span>';
                endif;
                if($data->projects_bp == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">BP </span>';
                endif;
                if($data->projects_js == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">JS </span>';
                endif;
                if($data->projects_cnid == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">CNID </span>';
                endif;
                if($data->projects_cngs == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">CNGS </span>';
                endif;
                if($data->projects_et == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">ET </span>';
                endif; 
                if($data->projects_ammenpur == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">Ammenpur </span>';
                endif; 
                if($data->projects_bachu == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">Bachupally </span>';
                endif; 
                if($data->projects_gandimaisamma == 'Yes'):                                 
                $project_name .= '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">Gandimaisamma </span>';
                endif;
                return $project_name;

            })
            ->addColumn('action', function(Lead $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_lead',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
                if(in_array(Auth::user()->role_id, array('1', '2'))):
                $action .= '<form class="d-inline" action="' . route('delete_lead',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_lead',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                endif;
                return $action;
            })
            ->rawColumns(['lead_id', 'project', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }


    public function index(Request $request)
    {
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }

        $stage = explode(',', $request->stage);
        if($user->role_id == '1' || $user->role_id == '2'){
            if($request->has('stage') == true){
                $all_creative_task = Lead::whereIn('lead_stage', $stage)->get();
            }
            else{
                $all_creative_task = Lead::all()->sortByDesc("id");
            }
        }
        if($user->role_id == '3'){
            $dst_manager_name = $user->name;
            $dsts_name = User::where('dst_manager_id', $user->id)->get();
            $names = array();
            foreach($dsts_name as $dst){
                $names[] = $dst->name;
            }
            array_push($names, $dst_manager_name);
            // return $names;
            if($request->has('stage') == true){
                $all_creative_task = Lead::whereIn('created_by', $names)->whereIn('lead_stage', $stage)->get();
            }
            else{
                $all_creative_task = Lead::whereIn('created_by', $names)->get()->sortByDesc("id");
            }
        }
        if($user->role_id == '5'){
            $cp_manager_name = $user->name;
            $cps_name = User::where('cp_manager_id', $user->id)->get();
            $names = array();
            foreach($cps_name as $cp){
                $names[] = $cp->name;
            }
            array_push($names, $cp_manager_name);
            // return $names;
            if($request->has('stage') == true){
                $all_creative_task = Lead::whereIn('created_by', $names)->whereIn('lead_stage', $stage)->get();
            }
            else{
                $all_creative_task = Lead::whereIn('created_by', $names)->get()->sortByDesc("id");
            }
        }
        if($user->role_id == '4' || $user->role_id == '6'){
            $cp_name = $user->name;
            if($request->has('stage') == true){
                $all_creative_task = Lead::where('created_by', $cp_name)->whereIn('lead_stage', $stage)->get();
            }
            else{
                $all_creative_task = Lead::where('created_by', $cp_name)->get()->sortByDesc("id");
            }
        }
        $current_user = Auth::user();
        $users = User::whereIn('role_id', ['1', '2', '5', '6', '7'])->get();
        $creative_users = User::whereIn('role_id', ['4'])->get();
        // if($current_user->role_id == '1' || $current_user->role_id == '2')
            
        // }
        $settings = Setting::all();
        return view('lead.index', compact(array(
            'current_user', 
            'creative_users', 
            'settings', 
            'users', 
            'user', 
            'all_creative_task',
        )));
    }
    public function index_json()
    {
        $creative_task = Lead::all();

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

    public function create()
    {
        //

        $user = Auth::user();
        $settings = Setting::all();
        return view('lead.create', compact(array('settings', 'user')));
    }
    public function get_source($id=0){

        $empData['data'] = User::orderby("name","asc")->select('id','name')->where('role_id',$id)->get();

        return response()->json($empData);
    }
    public function get_sub_source($role, $id=0){
        // $empData = '';
        if($role == '3'){
        $empData['data'] = User::orderby("name","asc")->select('id','name')->where('dst_manager_id',$id)->get();
        }
        if($role == '5'){
        $empData['data'] = User::orderby("name","asc")->select('id','name')->where('cp_manager_id',$id)->get();
        }
        return response()->json($empData);
    }

    public function check_projects($project, $email_res, $contact_res){
        $email_res = (array) json_decode($email_res);
        $contact_res = (array) json_decode($contact_res);
        if($project == 'Yes' && $email_res == NULL){
            $project_selection = true;
        }
        elseif($project == 'Yes' && $contact_res == NULL){
            $project_selection = true;
        }
        elseif($project == 'Yes' && $email_res->ProspectStage == 'Dropped'){
            $project_selection = true;
        }
        elseif($project == 'Yes' && $contact_res->ProspectStage == 'Dropped'){
            $project_selection = true;
        }
        elseif($project == 'Yes' && $email_res->ProspectStage == 'Invalid'){
            $project_selection = true;
        }
        elseif($project == 'Yes' && $contact_res->ProspectStage == 'Invalid'){
            $project_selection = true;
        }
        else{
            $project_selection = 0;
        }
        return $project_selection;
    }
    public function store(Request $request)
    {

        // $lead_source = '';
        // $lead_sub_source = '';
        $req_lead_type = $request->get('lead_type');
        $req_source = $request->get('source');
        $req_sub_source = $request->get('sub_source');

        $user = Auth::user();
        if($user->role_id =='1' || $user->role_id =='2'){
            $manager_name = User::where('id', $req_source)->first();
            $exe_name = User::where('id', $req_sub_source)->first();
            $lead_source = $manager_name->name;
            $lead_sub_source = $exe_name->name;
        }
        if($user->role_id == '4'){
            $dst_manager = User::where('id', $user->dst_manager_id)->first();
            $lead_source = $dst_manager->name;
            $lead_sub_source = $user->name;
        }
        elseif($user->role_id == '6'){
            $cp_manager = User::where('id', $user->cp_manager_id)->first();
            $lead_source = $cp_manager->name;
            $lead_sub_source = $user->name;
        }else{
            $lead_source = $user->name;
            $lead_sub_source = $user->name;
        }
        $orgin_response = '';
        $current_lead_id = '';
        $current_lead_stage = '';
        // $agr_response = '';
        // $hg_response = '';
        // $os_response = '';
        // $vib_response = '';
        // $jr_response = '';
        // $cngs_response = '';
        // $hyd_response = '';
        // $agr_contact_response = '';
        // $hg_contact_response = '';
        // $os_contact_response = '';
        // $vib_contact_response = '';
        // $jr_contact_response = '';
        // $cngs_contact_response = '';
        // $hyd_contact_response = '';
        // $cp_res_data = '';

        // Master account check
        $api_key_master = 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a&emailaddress='.$request->get('email');
        $master_curl = curl_init();
        curl_setopt_array($master_curl, array(
            CURLOPT_URL => $api_key_master,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $master_response_email = curl_exec($master_curl);
        
        $api_key_master_contact = 'https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&phone='.$request->get('contact');
        $master_contact_curl = curl_init();
        curl_setopt_array($master_contact_curl, array(
            CURLOPT_URL => $api_key_master_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $master_response_contact = curl_exec($master_contact_curl);


        // Other Projects checks
        $api_key_agr = 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&emailaddress='.$request->get('email');
        $agr_curl = curl_init();
        curl_setopt_array($agr_curl, array(
            CURLOPT_URL => $api_key_agr,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $agr_response = curl_exec($agr_curl);
        $api_key_hg = 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8&emailaddress='.$request->get('email');
        $hg_curl = curl_init();
        curl_setopt_array($hg_curl, array(
            CURLOPT_URL => $api_key_hg,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $hg_response = curl_exec($hg_curl);
        $api_key_os = 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf&emailaddress='.$request->get('email');
        $os_curl = curl_init();
        curl_setopt_array($os_curl, array(
            CURLOPT_URL => $api_key_os,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $os_response = curl_exec($os_curl);
        $api_key_vib = 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&emailaddress='.$request->get('email');
        $vib_curl = curl_init();
        curl_setopt_array($vib_curl, array(
            CURLOPT_URL => $api_key_vib,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $vib_response = curl_exec($vib_curl);
        $api_key_jr = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd&emailaddress='.$request->get('email');
        $jr_curl = curl_init();
        curl_setopt_array($jr_curl, array(
            CURLOPT_URL => $api_key_jr,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $jr_response = curl_exec($jr_curl);
        $api_key_cngs = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&emailaddress='.$request->get('email');
        $cngs_curl = curl_init();
        curl_setopt_array($cngs_curl, array(
            CURLOPT_URL => $api_key_cngs,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
       $cngs_response = curl_exec($cngs_curl);
       $api_key_bp = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246&emailaddress='.$request->get('email');
        $bp_curl = curl_init();
        curl_setopt_array($bp_curl, array(
            CURLOPT_URL => $api_key_bp,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $bp_response = curl_exec($bp_curl);
        $api_key_hyd = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&emailaddress='.$request->get('email');
        $hyd_curl = curl_init();
        curl_setopt_array($hyd_curl, array(
            CURLOPT_URL => $api_key_hyd,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $hyd_response = curl_exec($hyd_curl);

        $api_key_agr_contact = 'https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a&phone='.$request->get('contact');
        $agr_contact_curl = curl_init();
        curl_setopt_array($agr_contact_curl, array(
            CURLOPT_URL => $api_key_agr_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $agr_contact_response = curl_exec($agr_contact_curl);
        $api_key_hg_contact = 'https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8&phone='.$request->get('contact');
        $hg_contact_curl = curl_init();
        curl_setopt_array($hg_contact_curl, array(
            CURLOPT_URL => $api_key_hg_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $hg_contact_response = curl_exec($hg_contact_curl);
        $api_key_os_contact = 'https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf&phone='.$request->get('contact');
        $os_contact_curl = curl_init();
        curl_setopt_array($os_contact_curl, array(
            CURLOPT_URL => $api_key_os_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $os_contact_response = curl_exec($os_contact_curl);
        $api_key_vib_contact = 'https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&phone='.$request->get('contact');
        $vib_contact_curl = curl_init();
        curl_setopt_array($vib_contact_curl, array(
            CURLOPT_URL => $api_key_vib_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $vib_contact_response = curl_exec($vib_contact_curl);
        $api_key_jr_contact = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd&phone='.$request->get('contact');
        $jr_contact_curl = curl_init();
        curl_setopt_array($jr_contact_curl, array(
            CURLOPT_URL => $api_key_jr_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $jr_contact_response = curl_exec($jr_contact_curl);
        $api_key_cngs_contact = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&phone='.$request->get('contact');
        $cngs_contact_curl = curl_init();
        curl_setopt_array($cngs_contact_curl, array(
            CURLOPT_URL => $api_key_cngs_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $cngs_contact_response = curl_exec($cngs_contact_curl);
        $api_key_hyd_contact = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&phone='.$request->get('contact');
        $hyd_contact_curl = curl_init();
        curl_setopt_array($hyd_contact_curl, array(
            CURLOPT_URL => $api_key_hyd_contact,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));
        $hyd_contact_response = curl_exec($hyd_contact_curl);
                
        // Load All Response
        $decode_agr_response = (array) json_decode($agr_response);
        $decode_hg_response = (array) json_decode($hg_response);
        $decode_os_response = (array) json_decode($os_response);
        $decode_bp_response = (array) json_decode($bp_response);
        $decode_vib_response = (array) json_decode($vib_response);
        $decode_jr_response = (array) json_decode($jr_response);
        $decode_cngs_response = (array) json_decode($cngs_response);
        $decode_hyd_response = (array) json_decode($hyd_response);
        $decode_agr_contact_response = (array) json_decode($agr_contact_response);
        $decode_hg_contact_response = (array) json_decode($hg_contact_response);
        $decode_os_contact_response = (array) json_decode($os_contact_response);
        $decode_vib_contact_response = (array) json_decode($vib_contact_response);
        $decode_bp_contact_response = (array) json_decode($bp_contact_response);
        $decode_jr_contact_response = (array) json_decode($jr_contact_response);
        $decode_cngs_contact_response = (array) json_decode($cngs_contact_response);
        $decode_hyd_contact_response = (array) json_decode($hyd_contact_response);

        // Load All project configuration
        $projects_agr = $request->get('projects_agr');
        $projects_hg = $request->get('projects_hg');
        $projects_os = $request->get('projects_os');
        $projects_vib = $request->get('projects_vib');
        $projects_bv = $request->get('projects_bv');
        $projects_bp = $request->get('projects_bp');
        $projects_js = $request->get('projects_js');
        $projects_jr = $request->get('projects_jr');
        $projects_cnid = $request->get('projects_cnid');
        $projects_cngs = $request->get('projects_cngs');
        $projects_et = $request->get('projects_et');
        $projects_ammenpur = $request->get('projects_ammenpur');
        $projects_bachu = $request->get('projects_bachu');
        $projects_gandimaisamma = $request->get('projects_gandimaisamma');

        // Check AGR
        if($projects_agr == 'Yes' && $decode_agr_response == NULL){
            $pro_agr = true;
            $projects_agr = 'Yes';
        }
        elseif($projects_agr == 'Yes' && $decode_agr_contact_response == NULL){
            $pro_agr = true;
            $projects_agr = 'Yes';
        }
        elseif(!empty($decode_agr_response)){
            if($projects_agr == 'Yes' && $decode_agr_response[0]->ProspectStage == 'Dropped' || $decode_agr_contact_response[0]->ProspectStage == 'Dropped' || $projects_agr == 'Yes' && $decode_agr_response[0]->ProspectStage == 'Invalid' || $decode_agr_contact_response[0]->ProspectStage == 'Invalid'){
            $pro_agr = true;
            $projects_agr = 'Yes';
        }
        }
        else{
            $pro_agr = 0;
            $projects_agr = '';
        }

        // Check HG
        if($projects_hg == 'Yes' && $decode_hg_response == NULL){
            $pro_hg = true;
            $projects_hg = 'Yes';
        }
        elseif($projects_hg == 'Yes' && $decode_hg_contact_response == NULL){
            $pro_hg = true;
            $projects_hg = 'Yes';
        }
        elseif(!empty($decode_hg_response)){
            if($projects_hg == 'Yes' && $decode_hg_response->ProspectStage == 'Dropped' || $decode_hg_contact_response->ProspectStage == 'Dropped' || $decode_hg_response->ProspectStage == 'Invalid' || $decode_hg_contact_response->ProspectStage == 'Invalid'){
            $pro_hg = true;
            $projects_hg = 'Yes';
        }
        }
        else{
            $pro_hg = 0;
            $projects_hg = '';
        }

        // Check BP
        if($projects_bp == 'Yes' && $decode_bp_response == NULL){
            $pro_bp = true;
            $projects_bp = 'Yes';
        }
        elseif($projects_bp == 'Yes' && $decode_bp_contact_response == NULL){
            $pro_bp = true;
            $projects_bp = 'Yes';
        }
        elseif(!empty($decode_bp_response)){
            if($projects_bp == 'Yes' && $decode_bp_response->ProspectStage == 'Dropped' || $decode_bp_contact_response->ProspectStage == 'Dropped' || $decode_bp_response->ProspectStage == 'Invalid' || $decode_bp_contact_response->ProspectStage == 'Invalid'){
            $pro_bp = true;
            $projects_bp = 'Yes';
        }
        }
        else{
            $pro_bp = 0;
            $projects_bp = '';
        }

        // Check OS
        if($projects_os == 'Yes' && $decode_os_response == NULL){
            $pro_os = true;
            $projects_os = 'Yes';
        }
        elseif($projects_os == 'Yes' && $decode_os_contact_response == NULL){
            $pro_os = true;
            $projects_os = 'Yes';
        }
        elseif(!empty($decode_os_response)){
            if($projects_os == 'Yes' && $decode_os_response->ProspectStage == 'Dropped' || $decode_os_contact_response->ProspectStage == 'Dropped' || $decode_os_response->ProspectStage == 'Invalid' || $decode_os_contact_response->ProspectStage == 'Invalid'){
            $pro_os = true;
            $projects_os = 'Yes';
        }
        }
        else{
            $pro_os = 0;
            $projects_os = '';
        }

        // Check VIB
        if($projects_vib == 'Yes' && $decode_vib_response == NULL){
            $pro_vib = true;
            $projects_vib = 'Yes';
        }
        elseif($projects_vib == 'Yes' && $decode_vib_contact_response == NULL){
            $pro_vib = true;
            $projects_vib = 'Yes';
        }
        elseif(!empty($decode_vib_response)){
            if($projects_vib == 'Yes' && $decode_vib_response->ProspectStage == 'Dropped' || $decode_vib_contact_response->ProspectStage == 'Dropped' || $decode_vib_response->ProspectStage == 'Invalid' || $decode_vib_contact_response->ProspectStage == 'Invalid'){
            $pro_vib = true;
            $projects_vib = 'Yes';
        }
        }
        else{
            $pro_vib = 0;
            $projects_vib = '';
        }

        // Check JS
        if($projects_js == 'Yes' && $decode_cngs_response == NULL){
            $pro_js = true;
            $projects_js = 'Yes';
        }
        elseif($projects_js == 'Yes' && $decode_cngs_contact_response == NULL){
            $pro_js = true;
            $projects_js = 'Yes';
        }
        elseif(!empty($decode_cngs_response)){
            if($projects_js == 'Yes' && $decode_cngs_response->ProspectStage == 'Dropped' || $decode_cngs_contact_response->ProspectStage == 'Dropped' || $decode_cngs_response->ProspectStage == 'Invalid' || $decode_cngs_contact_response->ProspectStage == 'Invalid'){
            $pro_js = true;
            $projects_js = 'Yes';
        }
        }
        else{
            $pro_js = 0;
            $projects_js = '';
        }

        // Check JR
        if($projects_jr == 'Yes' && $decode_jr_response == NULL){
            $pro_jr = true;
            $projects_jr = 'Yes';
        }
        elseif($projects_jr == 'Yes' && $decode_jr_contact_response == NULL){
            $pro_jr = true;
            $projects_jr = 'Yes';
        }
        elseif(!empty($decode_jr_response)){
            if($projects_jr == 'Yes' && $decode_jr_response->ProspectStage == 'Dropped' || $decode_jr_contact_response->ProspectStage == 'Dropped' || $decode_jr_response->ProspectStage == 'Invalid' || $decode_jr_contact_response->ProspectStage == 'Invalid'){
            $pro_jr = true;
            $projects_jr = 'Yes';
        }
        }
        else{
            $pro_jr = 0;
            $projects_jr = '';
        }

        // Check CNID
        if($projects_cnid == 'Yes' && $decode_cngs_response == NULL){
            $pro_cnid = true;
            $projects_cnid = 'Yes';
        }
        elseif($projects_cnid == 'Yes' && $decode_cngs_contact_response == NULL){
            $pro_cnid = true;
            $projects_cnid = 'Yes';
        }
        elseif(!empty($decode_cngs_response)){
            if($projects_cnid == 'Yes' && $decode_cngs_response->ProspectStage == 'Dropped' || $decode_cngs_contact_response->ProspectStage == 'Dropped' || $decode_cngs_response->ProspectStage == 'Invalid' || $decode_cngs_contact_response->ProspectStage == 'Invalid'){
            $pro_cnid = true;
            $projects_cnid = 'Yes';
        }
        }
        else{
            $pro_cnid = 0;
            $projects_cnid = '';
        }

        // Check CNGS
        if($projects_cngs == 'Yes' && $decode_cngs_response == NULL){
            $pro_cngs = true;
            $projects_cngs = 'Yes';
        }
        elseif($projects_cngs == 'Yes' && $decode_cngs_contact_response == NULL){
            $pro_cngs = true;
            $projects_cngs = 'Yes';
        }
        elseif(!empty($decode_cngs_response)){
            if($projects_cngs == 'Yes' && $decode_cngs_response->ProspectStage == 'Dropped' || $decode_cngs_contact_response->ProspectStage == 'Dropped' || $decode_cngs_response->ProspectStage == 'Invalid' || $decode_cngs_contact_response->ProspectStage == 'Invalid'){
            $pro_cngs = true;
            $projects_cngs = 'Yes';
        }
        }
        else{
            $pro_cngs = 0;
            $projects_cngs = '';
        }

        // Check ET
        if($projects_et == 'Yes' && $decode_vib_response == NULL){
            $pro_et = true;
            $projects_et = 'Yes';
        }
        elseif($projects_et == 'Yes' && $decode_vib_contact_response == NULL){
            $pro_et = true;
            $projects_et = 'Yes';
        }
        elseif(!empty($decode_vib_response)){
            if($projects_et == 'Yes' && $decode_vib_response->ProspectStage == 'Dropped' || $decode_vib_contact_response->ProspectStage == 'Dropped' || $decode_vib_response->ProspectStage == 'Invalid' || $decode_vib_contact_response->ProspectStage == 'Invalid'){
            $pro_et = true;
            $projects_et = 'Yes';
        }
        }
        else{
            $pro_et = 0;
            $projects_et = '';
        }

        // Check Ammenpur
        if($projects_ammenpur == 'Yes' && $decode_hyd_response == NULL){
            $pro_ammenpur = true;
            $projects_ammenpur = 'Yes';
        }
        elseif($projects_ammenpur == 'Yes' && $decode_hyd_contact_response == NULL){
            $pro_ammenpur = true;
            $projects_ammenpur = 'Yes';
        }
        elseif(!empty($decode_hyd_response)){
            if($projects_ammenpur == 'Yes' && $decode_hyd_response->ProspectStage == 'Dropped' || $decode_hyd_contact_response->ProspectStage == 'Dropped' || $decode_hyd_response->ProspectStage == 'Invalid' || $decode_hyd_contact_response->ProspectStage == 'Invalid'){
            $pro_ammenpur = true;
            $projects_ammenpur = 'Yes';
        }
        }
        else{
            $pro_ammenpur = 0;
            $projects_ammenpur = '';
        }

        // Check Bachu
        if($projects_bachu == 'Yes' && $decode_hyd_response == NULL){
            $pro_bachu = true;
            $projects_bachu = 'Yes';
        }
        elseif($projects_bachu == 'Yes' && $decode_hyd_contact_response == NULL){
            $pro_bachu = true;
            $projects_bachu = 'Yes';
        }
        elseif(!empty($decode_hyd_response)){
            if($projects_bachu == 'Yes' && $decode_hyd_response->ProspectStage == 'Dropped' || $decode_hyd_contact_response->ProspectStage == 'Dropped' || $decode_hyd_response->ProspectStage == 'Invalid' || $decode_hyd_contact_response->ProspectStage == 'Invalid'){
            $pro_bachu = true;
            $projects_bachu = 'Yes';
        }
        }
        else{
            $pro_bachu = 0;
            $projects_bachu = '';
        }

        // Check gandimaisamma
        if($projects_gandimaisamma == 'Yes' && $decode_hyd_response == NULL){
            $pro_gandimaisamma = true;
            $projects_gandimaisamma = 'Yes';
        }
        elseif($projects_gandimaisamma == 'Yes' && $decode_hyd_contact_response == NULL){
            $pro_gandimaisamma = true;
            $projects_gandimaisamma = 'Yes';
        }
        elseif(!empty($decode_hyd_response)){
            if($projects_gandimaisamma == 'Yes' && $decode_hyd_response->ProspectStage == 'Dropped' || $decode_hyd_contact_response->ProspectStage == 'Dropped' || $decode_hyd_response->ProspectStage == 'Invalid' || $decode_hyd_contact_response->ProspectStage == 'Invalid'){
            $pro_gandimaisamma = true;
            $projects_gandimaisamma = 'Yes';
        }
        }
        else{
            $pro_gandimaisamma = 0;
            $projects_gandimaisamma = '';
        }

        if($request->get('do_not_call') == 'Yes'){
            $donotcall = true;
        }
        else{
            $donotcall = 0;
        }


        if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '3' || $user->role_id == '4' || $user->role_id == '9'){

            //Redirect if lead already exist
            $master_response_email = json_decode($master_response_email);
            $master_response_contact = json_decode($master_response_contact);
            if(!empty($master_response_email) || !empty($master_response_contact)){
                return Redirect::back()->with('lead_exist','The Lead Already exist! Please try again with some other information.');
            }

            // Lead insert in the Master account
            $lead_insert_api = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08";
            $lead_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$request->get('email').'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$request->get('first_name').'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$request->get('last_name').'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$request->get('sec_contact').'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$request->get('contact').'"
                },
                {
                    "Attribute": "mx_Secondary_Email",
                    "Value": "'.$request->get('sec_email').'"
                },
                {
                    "Attribute": "mx_Alliance_Galleria_Residences",
                    "Value": "'.$pro_agr.'"
                },
                {
                    "Attribute": "mx_Humming_Garden",
                    "Value": "'.$pro_hg.'"
                },
                {
                    "Attribute": "mx_Orchid_Springs",
                    "Value": "'.$pro_os.'"
                },
                {
                    "Attribute": "mx_Project_Bachupally",
                    "Value": "'.$pro_bp.'"
                },
                {
                    "Attribute": "mx_Villa_Belvedere",
                    "Value": "'.$pro_vib.'"
                },
                {
                    "Attribute": "mx_Jasmine_Springs",
                    "Value": "'.$pro_js.'"
                },
                {
                    "Attribute": "mx_Jubilee_Residences",
                    "Value": "'.$pro_jr.'"
                },
                {
                    "Attribute": "mx_Code_Name_Gold_Standard",
                    "Value": "'.$pro_cngs.'"
                },
                {
                    "Attribute": "mx_Code_Name_Independence_Day",
                    "Value": "'.$pro_cnid.'"
                },
                {
                    "Attribute": "mx_Urbanrise_Eternity",
                    "Value": "'.$pro_et.'"
                },
                {
                    "Attribute": "mx_Project_Ameenpur",
                    "Value": "'.$pro_ammenpur.'"
                },
                {
                    "Attribute": "mx_Project_Bachupally",
                    "Value": "'.$pro_bachu.'"
                },
                {
                    "Attribute": "mx_Project_Gandimaisamma",
                    "Value": "'.$pro_gandimaisamma.'"
                },
                {
                    "Attribute": "DoNotCall",
                    "Value": "'.$donotcall.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$request->get('notes').'"
                }
            ]';

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $lead_insert_api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $lead_data_string,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "Host: api.leadsquared.com",
                "cache-control: no-cache"
              ),
            ));
            $lead_response = curl_exec($curl);
            $lead_response = json_decode($lead_response);
            curl_close($curl);
            $current_lead_id = $lead_response->Message->Id;
            if($lead_response->Status == 'Success'){
                $orgin_curl = curl_init();
                curl_setopt_array($orgin_curl, array(
                    CURLOPT_URL => 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&id='.$lead_response->Message->Id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                    ),
                ));
                $orgin_response = curl_exec($orgin_curl);
                $current_lead_orgin = (array) json_decode($orgin_response);
                if($current_lead_orgin){
                    $current_lead_stage = $current_lead_orgin[0]->ProspectStage;
                }
            }
        }
        if($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '5' || $user->role_id == '6' || $user->role_id == '10'){

            $fname = $request->get('first_name');
            $lname = $request->get('last_name');
            $email = $request->get('email');
            $phone = $request->get('contact');
            $alternative = $request->get('sec_contact');
            $projects = $request->input('projects');
            $notes = $request->get('notes');

            //API List
            $post_uri_agr = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
            $post_uri_hg = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
            $post_uri_os = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
            $post_uri_bp = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246";


            $post_uri_vib = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
            $post_uri_bv = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r3e1b53d0bf80244ec3bb5564f93189f7&secretKey=ea1fd88b33df235aa8abd8d8f80c09d54abaca0b";
            $post_uri_cngs = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
            $post_uri_jr = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
            $post_uri_hyd = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';

            $data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                }
            ]';

            $jr_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                }
            ]';


            $bp_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                }
            ]';

            $cngs_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Secondary_Phone_Number",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project",
                    "Value": "Project Siruseri"
                }
            ]';

            $cnid_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Secondary_Phone_Number",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project",
                    "Value": "Project Padur"
                }
            ]';

            $js_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Secondary_Phone_Number",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project",
                    "Value": "Project Jasmine Springs"
                }
            ]';

            $vib_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Projects",
                    "Value": "Villa Belvedere"
                }
            ]';

            $et_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Projects",
                    "Value": "Urbanrise Eternity"
                }
            ]';

            $ammenpur_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project_Name",
                    "Value": "Project Ameenpur"
                }
            ]';
            $bachu_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project_Name",
                    "Value": "Project Bachupally"
                }
            ]';
            $gandimaisamma_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project_Name",
                    "Value": "Project Gandimaisamma"
                }
            ]';

            if ($projects_agr == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_agr,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['agr']['response'] = curl_exec($curl); 
                $cp_res_data['agr']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_bp == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_bp,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['bp']['response'] = curl_exec($curl); 
                $cp_res_data['bp']['err'] = curl_error($curl);
                curl_close($curl);
            }





            if ($projects_hg == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hg,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['hg']['response'] = curl_exec($curl); 
                $cp_res_data['hg']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_os == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_os,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['os']['response'] = curl_exec($curl); 
                $cp_res_data['os']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_jr == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_jr,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $jr_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['jr']['response'] = curl_exec($curl); 
                $cp_res_data['jr']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_vib == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_vib,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $vib_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['vib']['response'] = curl_exec($curl); 
                $cp_res_data['vib']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_et == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_vib,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $et_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['et']['response'] = curl_exec($curl); 
                $cp_res_data['et']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_cngs == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_cngs,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $cngs_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['cngs']['response'] = curl_exec($curl); 
                $cp_res_data['cngs']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_cnid == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_cngs,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $cnid_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['cnid']['response'] = curl_exec($curl); 
                $cp_res_data['cnid']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_js == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_cngs,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $js_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['js']['response'] = curl_exec($curl);
                $cp_res_data['js']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_ammenpur == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hyd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $ammenpur_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['ammenpur']['response'] = curl_exec($curl);
                $cp_res_data['ammenpur']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_bachu == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hyd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $bachu_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['bachu']['response'] = curl_exec($curl);
                $cp_res_data['bachu']['err'] = curl_error($curl);
                curl_close($curl);
            }
            if ($projects_ammenpur == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hyd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $gandimaisamma_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $cp_res_data['gandimaisamma']['response'] = curl_exec($curl);
                $cp_res_data['gandimaisamma']['err'] = curl_error($curl);
                curl_close($curl);
            }
        }


        //Update DST Application
        $store_lead = new Lead([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'contact' => $request->get('contact'),
            'sec_email' => $request->get('sec_email'),
            'sec_contact' => $request->get('sec_contact'),
            'config' => json_encode($request->get('config')),
            'notes' => $request->get('notes'),
            'projects_agr' => $projects_agr,
            'projects_hg' => $projects_hg,
            'projects_os' => $projects_os,
            'projects_vib' => $projects_vib,
            'projects_bv' => $projects_bv,
            'projects_bp' => $projects_bp,
            'projects_js' => $projects_js,
            'projects_jr' => $projects_jr,
            'projects_cnid' => $projects_cnid,
            'projects_cngs' => $projects_cngs,
            'projects_et' => $projects_et,
            'projects_ammenpur' => $projects_ammenpur,
            'projects_bachu' => $projects_bachu,
            'projects_gandimaisamma' => $projects_gandimaisamma,
            'lms_email_agr' => $agr_response,
            'lms_email_hg' => $hg_response,
            'lms_email_os' => $os_response,
            'lms_email_bp' => $bp_response,
            'lms_email_vib' => $vib_response,
            'lms_email_jr' => $jr_response,
            'lms_email_cngs' => $cngs_response,
            'lms_email_hyd' => $hyd_response,
            'lms_contact_agr' => $agr_contact_response,
            'lms_contact_bp' => $bp_contact_response,
            'lms_contact_hg' => $hg_contact_response,
            'lms_contact_os' => $os_contact_response,
            'lms_contact_vib' => $vib_contact_response,
            'lms_contact_jr' => $jr_contact_response,
            'lms_contact_cngs' => $cngs_contact_response,
            'lms_contact_hyd' => $hyd_contact_response,
            'status' => 'New',
            'lead_id' => $current_lead_id,
            'orgin' => $orgin_response,
            'lead_stage' => $current_lead_stage,
            'created_by' => $user->name,
            'created_time' => date('Y-m-d H:i:s')
        ]);
        $store_lead->save();
        if($user->role_id == '5'||$user->role_id == '6'){
            $store_lead->cp_response = json_encode($cp_res_data);
        }
        $store_lead->save();

        // Store Activity Log
        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'Lead',
            'model_id' => $store_lead->id,
            'description' => 'New Lead Created! with status of <strong>New</strong>',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        // $mdata = array(
        //     'key' => 'created',
        //     'to' => array('prasanna.raghavan@alliancein.com', 'xavier@alliancein.com', 'vaibhavrao.n@alliancein.com'),
        //     'from' => $user->email,
        //     'from_name' => $user->name,
        //     'subject' => ' New Task - '.$request->get('task_name'),
        //     'created_time' => date('Y-m-d H:i:s')
        // );
        // Mail::to($mdata['to'])->send(new SendLead($mdata));
        //  return view('lead.index', compact(array(
        //     'lead_response', 
        //     'lead_err'
        // )))->with('success', 'Creative has beed created successfully!');
        return redirect('/lead')->with('success', 'Lead has been created successfully!');
    }

    public function show($id)
    {
        //https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&leadId=57397ba0-4459-4bf8-9311-4082dbf3f40d
    }

    public function view($id)
    {
        $creative_task = Lead::find($id);
        $users = User::all();
        $current_user = Auth::user();
        $creative_users = User::where('role_id', '4')->get();
        $approval_users = User::where('role_id', '3')->get();
        $agency_users = User::whereIn('role_id', ['9', '10'])->get();
        $activity = Activity::where('model', 'Lead')->where('model_id', $creative_task->id)->get();
        return view('lead.view', compact(array('creative_task', 'creative_users', 'approval_users', 'creatives', 'users', 'user', 'current_user', 'agency_users', 'activity')));    
    }
    public function edit($id)
    {
        $user = Auth::user();
        $settings = Setting::all();
        $lead = Lead::find($id);
        $status_tracks = CreativeImages::where('lead_id', $id)->get();
        $users = User::all();
        $current_user = Auth::user();
        $creatives = CreativeImages::where('lead_id', $lead->id)->get();
        $creative_users = User::where('role_id', '4')->get();
        $approval_users = User::where('role_id', '3')->get();
        $agency_users = User::whereIn('role_id', ['9', '10'])->get();
        $activity = Activity::where('model', 'Lead')->where('model_id', $lead->id)->get();

        if($lead->cp_response == NULL){

        }
        elseif($user->role_id == '3' || $user->role_id == '4'){
            $orgin_curl = curl_init();
            curl_setopt_array($orgin_curl, array(
                CURLOPT_URL => 'https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&id='.$lead->lead_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                ),
            ));
            $orgin_response = curl_exec($orgin_curl);
            $lead->orgin = $orgin_response;
            $current_lead_orgin = (array) json_decode($orgin_response);
            if($current_lead_orgin){
                $lead->lead_stage = $current_lead_orgin[0]->ProspectStage;
            }
            $lead->save();
        }
        

        
        // $err = curl_error($cngs_curl);

        return view('lead.edit', compact(array(
            'lead', 
            'creative_users',
            'status_tracks',
            'creatives',
            'approval_users', 
            'user', 
            'users', 
            'current_user', 
            'agency_users', 
            'activity', 
            'settings',
        )));    
    }

    public function update_basic(Request $request, $id)
    {   
        $lead = Lead::find($id);
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }

        if($user->role_id == '3' || $user->role_id == '4' || $user->role_id == '9'){

            $lead_insert_api = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u\$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&leadId=".$lead->lead_id;
            $lead_data_string = '[';
            if($request->get('projects_agr') == 'Yes'):
            $lead_data_string .= '{
                    "Attribute": "mx_Alliance_Galleria_Residences",
                    "Value": "true"
                },';
            endif;
            if($request->get('projects_hg') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Humming_Garden",
                    "Value": "true"
                },';
            endif;

            if($request->get('projects_bp') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Project_Bachupally",
                    "Value": "true"
                },';
            endif;



            if($request->get('projects_os') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Orchid_Springs",
                    "Value": "true"
                },';

            endif;
            if($request->get('projects_vib') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Villa_Belvedere",
                    "Value": "true"
                },';

            endif;
            if($request->get('projects_js') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Jasmine_Springs",
                    "Value": "true"
                },';

            endif;
            if($request->get('projects_jr') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Jubilee_Residences",
                    "Value": "true"
                },';
            endif;
            if($request->get('projects_cngs') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Code_Name_Gold_Standard",
                    "Value": "true"
                },';
            endif;
            if($request->get('projects_cnid') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Code_Name_Independence_Day",
                    "Value": "true"
                },';
            endif;
            if($request->get('projects_et') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Urbanrise_Eternity",
                    "Value": "true"
                }';
            endif;
            if($request->get('projects_ammenpur') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Project_Ameenpur",
                    "Value": "true"
                }';
            endif;
            if($request->get('projects_bachu') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Project_Bachupally",
                    "Value": "true"
                }';
            endif;
            if($request->get('projects_gandimaisamma') == 'Yes'):
             $lead_data_string .= '{
                    "Attribute": "mx_Project_Gandimaisamma",
                    "Value": "true"
                }';
            endif;
             $lead_data_string .= ']';
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $lead_insert_api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $lead_data_string,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "Host: api.leadsquared.com",
                "cache-control: no-cache"
              ),
            ));
            $lead_response = curl_exec($curl);
            $lead_response = json_decode($lead_response);
            curl_close($curl);
        }

        if($user->role_id == '5' || $user->role_id == '6' || $user->role_id == '10'){


        if($user->role_id == '6'){
            $cp_manager = User::where('id', $user->cp_manager_id)->first();
            $lead_source = $cp_manager->name;
            $lead_sub_source = $user->name;
        }else{
            $lead_source = $user->name;
            $lead_sub_source = $user->name;
        }

            $fname = $lead->first_name;
            $lname = $lead->last_name;
            $email = $lead->email;
            $phone = $lead->contact;
            $alternative = $lead->sec_contact;
            $projects = $lead->projects;
            $notes = $lead->notes;

            //API List
            $post_uri_agr = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
            $post_uri_hg = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
            $post_uri_os = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
            $post_uri_vib = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
            $post_uri_bp = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246";
            $post_uri_bv = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u\$r3e1b53d0bf80244ec3bb5564f93189f7&secretKey=ea1fd88b33df235aa8abd8d8f80c09d54abaca0b";
            $post_uri_cngs = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
            $post_uri_jr = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
            $post_uri_hyd = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Create?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';

            $data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                }
            ]';

            $jr_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                }
            ]';

            $bp_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                }
            ]';

            $cngs_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Secondary_Phone_Number",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project",
                    "Value": "Project Siruseri"
                }
            ]';

            $cnid_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Secondary_Phone_Number",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project",
                    "Value": "Project Padur"
                }
            ]';

            $js_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "mx_Secondary_Phone_Number",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_First_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project",
                    "Value": "Project Jasmine Springs"
                }
            ]';

            $vib_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Projects",
                    "Value": "Villa Belvedere"
                }
            ]';

            $et_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Projects",
                    "Value": "Urbanrise Eternity"
                }
            ]';

            $ammenpur_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project_Name",
                    "Value": "Project Ameenpur"
                }
            ]';
            $bachu_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project_Name",
                    "Value": "Project Bachupally"
                }
            ]';
            $gandimaisamma_data_string = '[
                {
                    "Attribute": "EmailAddress",
                    "Value": "'.$email.'"
                },
                {
                    "Attribute": "FirstName",
                    "Value": "'.$fname.'"
                },
                {
                    "Attribute": "LastName",
                    "Value": "'.$lname.'"
                },
                {
                    "Attribute": "mx_Contact_Number_2",
                    "Value": "'.$phone.'"
                },
                {
                    "Attribute": "Phone",
                    "Value": "'.$alternative.'"
                },
                {
                    "Attribute": "Source",
                    "Value": "'.$lead_source.'"
                },
                {
                    "Attribute": "mx_Sub_Source",
                    "Value": "'.$lead_sub_source.'"
                },
                {
                    "Attribute": "Notes",
                    "Value": "'.$notes.'"
                },
                {
                    "Attribute": "mx_Project_Name",
                    "Value": "Project Gandimaisamma"
                }
            ]';
            $cp_response = json_decode($lead->cp_response);
            if ($request->get('projects_agr') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_agr,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['agr']['response'] = curl_exec($curl); 
                $data['agr']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->agr)){
                $data['agr']['response'] = $cp_response->agr->response; 
                $data['agr']['err'] = $cp_response->agr->err;
            }
            if ($request->get('projects_hg') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hg,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['hg']['response'] = curl_exec($curl); 
                $data['hg']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->hg)){
                $data['hg']['response'] = $cp_response->hg->response; 
                $data['hg']['err'] = $cp_response->hg->err;
            }
            if ($request->get('projects_os') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_os,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['os']['response'] = curl_exec($curl); 
                $data['os']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->os)){
                $data['os']['response'] = $cp_response->os->response; 
                $data['os']['err'] = $cp_response->os->err;
            }



            if ($request->get('projects_bp') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_bp,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['bp']['response'] = curl_exec($curl); 
                $data['bp']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->bp)){
                $data['bp']['response'] = $cp_response->bp->response; 
                $data['bp']['err'] = $cp_response->bp->err;
            }





            if ($request->get('projects_jr') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_jr,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $jr_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['jr']['response'] = curl_exec($curl); 
                $data['jr']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->jr)){
                $data['jr']['response'] = $cp_response->jr->response; 
                $data['jr']['err'] = $cp_response->jr->err;
            }
            if ($request->get('projects_vib') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_vib,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $vib_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['vib']['response'] = curl_exec($curl); 
                $data['vib']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->vib)){
                $data['vib']['response'] = $cp_response->vib->response; 
                $data['vib']['err'] = $cp_response->vib->err;
            }
            if ($request->get('projects_et') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_vib,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $et_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['et']['response'] = curl_exec($curl); 
                $data['et']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->et)){
                $data['et']['response'] = $cp_response->et->response; 
                $data['et']['err'] = $cp_response->et->err;
            }
            if ($request->get('projects_cngs') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_cngs,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $cngs_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['cngs']['response'] = curl_exec($curl); 
                $data['cngs']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->cngs)){
                $data['cngs']['response'] = $cp_response->cngs->response; 
                $data['cngs']['err'] = $cp_response->cngs->err;
            }
            if ($request->get('projects_cnid') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_cngs,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $cnid_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['cnid']['response'] = curl_exec($curl); 
                $data['cnid']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->cnid)){
                $data['cnid']['response'] = $cp_response->cnid->response; 
                $data['cnid']['err'] = $cp_response->cnid->err;
            }
            if ($request->get('projects_js') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_cngs,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $js_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['js']['response'] = curl_exec($curl);
                $data['js']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->js)){
                $data['js']['response'] = $cp_response->js->response; 
                $data['js']['err'] = $cp_response->js->err;
            }
            if ($request->get('projects_ammenpur') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hyd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $ammenpur_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['ammenpur']['response'] = curl_exec($curl);
                $data['ammenpur']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->ammenpur)){
                $data['ammenpur']['response'] = $cp_response->ammenpur->response; 
                $data['ammenpur']['err'] = $cp_response->ammenpur->err;
            }
            if ($request->get('projects_bachu') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hyd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $bachu_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['bachu']['response'] = curl_exec($curl);
                $data['bachu']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->bachu)){
                $data['bachu']['response'] = $cp_response->bachu->response; 
                $data['bachu']['err'] = $cp_response->bachu->err;
            }
            if ($request->get('projects_ammenpur') == 'Yes') {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri_hyd,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $gandimaisamma_data_string,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Cache-Control: no-cache",
                    "Connection: keep-alive",
                    "Content-Type: application/json",
                    "Host: api-in21.leadsquared.com",
                    "cache-control: no-cache"
                  ),
                ));
                $data['gandimaisamma']['response'] = curl_exec($curl);
                $data['gandimaisamma']['err'] = curl_error($curl);
                curl_close($curl);
            }
            elseif(isset($cp_response->gandimaisamma)){
                $data['gandimaisamma']['response'] = $cp_response->gandimaisamma->response; 
                $data['gandimaisamma']['err'] = $cp_response->gandimaisamma->err;
            }

            $lead->cp_response = $data;
        }


        $config = json_decode($lead->config);
        if($request->get('projects_agr')){ 
            $lead->projects_agr = $request->get('projects_agr');
            $config->agr = $request->get('config_agr');
        }
        if($request->get('projects_hg')){ 
            $lead->projects_hg = $request->get('projects_hg');
            $config->hg = $request->get('config_hg');
        }
        if($request->get('projects_bp')){ 
            $lead->projects_bp = $request->get('projects_bp');
            $config->bp = $request->get('config_bp');
        }
        if($request->get('projects_os')){ 
            $lead->projects_os = $request->get('projects_os');
            $config->os = $request->get('config_os');
        }
        if($request->get('projects_vib')){ 
            $lead->projects_vib = $request->get('projects_vib');
            $config->vib = $request->get('config_vib');
        }
        // if($request->get('projects_bv')){ $lead->projects_bv = $request->get('projects_bv');
        //     $config->bv = $request->get('config_bv');}
        if($request->get('projects_js')){ $lead->projects_js = $request->get('projects_js');
            $config->js = $request->get('config_js');}
        if($request->get('projects_jr')){ $lead->projects_jr = $request->get('projects_jr');
            $config->jr = $request->get('config_jr');}
        if($request->get('projects_cnid')){ $lead->projects_cnid = $request->get('projects_cnid');
            $config->cnid = $request->get('config_cnid');}
        if($request->get('projects_cngs')){ $lead->projects_cngs = $request->get('projects_cngs');
            $config->cngs = $request->get('config_cngs');}

        if($request->get('projects_et')){ $lead->projects_et = $request->get('projects_et');
            $config->et = $request->get('config_et');}

        if($request->get('projects_ammenpur')){ $lead->projects_ammenpur = $request->get('projects_ammenpur');
            $config->ammenpur = $request->get('config_ammenpur');}

        if($request->get('projects_bachu')){ $lead->projects_bachu = $request->get('projects_bachu');
            $config->bachu = $request->get('config_bachu');}

        if($request->get('projects_gandimaisamma')){ $lead->projects_gandimaisamma = $request->get('projects_gandimaisamma');
            $config->gandimaisamma = $request->get('config_gandimaisamma');}
        $lead->config = json_encode($config);

        $lead->save();
        $activity_log = new Activity([
            'name' => 'Update',
            'model' => 'Lead',
            'model_id' => $lead->id,
            'description' => 'The Lead has been updated',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return Redirect::back()->with('creative_added','The Lead Projects Updated Successfully !');

    }
    public function update(Request $request, $id)
    {    
        //mx_Visit_Type
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $lead = Lead::find($id);
        $lead->status = $request->get('status');


        if($current_user->role_id == '1' || $current_user->role_id == '2' || $current_user->role_id == '3' || $current_user->role_id == '4' || $current_user->role_id == '9'):
        $lead_insert_api = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Update?accessKey=u\$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&leadId=".$lead->lead_id;
        $lead_data_string = '[';
        if($request->get('status') == 'Cold'):
        $lead_data_string .= '{
                "Attribute": "ProspectStage",
                "Value": "Cold"
            },';
        endif;
        if($request->get('status') == 'Warm'):
        $lead_data_string .= '{
                "Attribute": "ProspectStage",
                "Value": "Warm"
            },';
        endif;
        if($request->get('status') == 'Home Visit Scheduled'):
        $lead_data_string .= '{
                "Attribute": "ProspectStage",
                "Value": "Home Visit Scheduled"
            },';
        endif;
        if($request->get('status') == 'Home Visit Done'):
        $lead_data_string .= '{
                "Attribute": "ProspectStage",
                "Value": "Home Visit Done"
            },';
        endif;
        if($request->get('status') == 'Site Visit Scheduled'):
        $lead_data_string .= '{
                "Attribute": "ProspectStage",
                "Value": "Site Visit Scheduled"
            },';
        endif;
        if($request->get('status') == 'Site Visit Done'):
        $lead_data_string .= '{
                "Attribute": "ProspectStage",
                "Value": "Site Visit Done"
            },';
        endif;
         $lead_data_string .= ']';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $lead_insert_api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $lead_data_string,
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/json",
            "Host: api.leadsquared.com",
            "cache-control: no-cache"
          ),
        ));
        $lead_response = curl_exec($curl);
        $lead_response = json_decode($lead_response);
        curl_close($curl);

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'Lead',
            'model_id' => $lead->id,
            'description' => 'The Lead Status Update: '.$lead_response->Status,
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $lead->notes = $request->get('notes');
        $lead->save();
        //Store Images
        if($request->status == 'Home Visit Done' || $request->status == 'Site Visit Done'):
        if($request->file('proof')):
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $directory = "storage/site_visti_photos/$year/$month/$day";
        if(!is_dir($directory)){
            mkdir($directory, 755, true);
        }
        $creatives = $request->file('proof');
        $path_location ='';
        foreach ($creatives as $image) {
            $new_name = $image->getClientOriginalName();
            $image->move($directory, $new_name);
            $path_location .= $directory.'/'.$new_name.',';
        }
        $store_local_activity = new CreativeImages([
            'lead_id' => $lead->id,
            'proof' => $path_location,
            'notes' => $request->get('notes'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'created_by' => $user->name
        ]);
        $store_local_activity->save();
        else:
        $store_local_activity = new CreativeImages([
            'lead_id' => $lead->id,
            'notes' => $request->get('notes'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'created_by' => $user->name
        ]);
        $store_local_activity->save();
        endif;
        else:
        $store_local_activity = new CreativeImages([
            'lead_id' => $lead->id,
            'notes' => $request->get('notes'),
            'status' => $request->get('status'),
            'date' => $request->get('date'),
            'send_email' => $request->get('send_email'),
            'email' => $request->get('email'),
            'created_by' => $user->name
        ]);
        if($request->get('email')):
        $mdata = array(
            'to' => array($request->get('email')),
            'from' => $user->email,
            'from_name' => $user->name,
            'subject' => ' New Message from - '.$user->name,
            'notes' => $request->get('notes'),
            'created_time' => date('Y-m-d H:i:s')
        );
        Mail::to($mdata['to'])->send(new SendNotification($mdata));
        endif;
        $store_local_activity->save();
        endif;
        elseif($current_user->role_id == '1' || $current_user->role_id == '2' || $current_user->role_id == '5' || $current_user->role_id == '6' || $current_user->role_id == '9'):
            $selected_project = $request->get('selected_project');
            $notes = $request->get('notes');
            $cp_res = (array)json_decode($lead->cp_response);
            //API List
            if($selected_project == 'AGR'){
                $agr_res = json_decode($cp_res['AGR']->response);
                $lead_id = $agr_res->Message->Id;
                $post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
            }
            if($selected_project == 'HG'){
                $hg_res = json_decode($cp_res['HG']->response);
                $lead_id = $hg_res->Message->Id;
                $post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
            }
            if($selected_project == 'BP'){
                $bp_res = json_decode($cp_res['BP']->response);
                $lead_id = $bp_res->Message->Id;
                $post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246";
            }
            if($selected_project == 'OS'){
                $os_res = json_decode($cp_res['OS']->response);
                $lead_id = $os_res->Message->Id;
                $post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
            }
            if($selected_project == 'VIB' || $selected_project == 'ET'){
                if($selected_project == 'VIB'){
                    $vib_res = json_decode($cp_res['VIB']->response);
                    $lead_id = $vib_res->Message->Id;
                }
                elseif($selected_project == 'ET'){
                    $et_res = json_decode($cp_res['ET']->response);
                    $lead_id = $et_res->Message->Id;
                }
                $post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
            }
            if($selected_project == 'JS' ||$selected_project == 'CIND' ||$selected_project == 'CNGS'){
                if($selected_project == 'JS'){
                    $js_res = json_decode($cp_res['VIB']->response);
                    $lead_id = $js_res->Message->Id;
                }
                elseif($selected_project == 'CIND'){
                    $cind_res = json_decode($cp_res['CIND']->response);
                    $lead_id = $cind_res->Message->Id;
                }
                elseif($selected_project == 'CNGS'){
                    $cngs_res = json_decode($cp_res['CNGS']->response);
                    $lead_id = $cngs_res->Message->Id;
                }
                $post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
            }
            if($selected_project == 'JR'){

                $post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
            }
            if($selected_project == 'ammenpur' || $selected_project == 'bachu' || $selected_project == 'gandimaisamma'){
                if($selected_project == 'ammenpur'){
                    $ammenpur_res = json_decode($cp_res['ammenpur']->response);
                    $lead_id = $ammenpur_res->Message->Id;
                }
                elseif($selected_project == 'bachu'){
                    $bachu_res = json_decode($cp_res['bachu']->response);
                    $lead_id = $bachu_res->Message->Id;
                }
                elseif($selected_project == 'gandimaisamma'){
                    $gandimaisamma_res = json_decode($cp_res['gandimaisamma']->response);
                    $lead_id = $gandimaisamma_res->Message->Id;
                }
                $post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/CreateNote?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
            }

            $note_string = '[{
                "RelatedProspectId": "'.$lead_id.'",
                "Note": "'.$notes.'"
            }]';

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $post_uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $note_string,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "cache-control: no-cache"
              ),
            ));
            $note_response = curl_exec($curl);
            $note_response = json_decode($note_response);
            curl_close($curl);

        endif;
        return Redirect::back()->with('creative_added','The Lead Status Updated Successful !');
    }
    public function update_activity(Request $request, $id){
        $lead = Lead::find($id);
        $lead_id = $lead->lead_id;
        $lead_insert_api = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rde29139071380bb4f2d95b108f8e1964&secretKey=7e73b2e27c1aab4e317ce6c850b73d0f35d8df08&leadId=".$lead_id;
        $lead_data_string = '';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $lead_insert_api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $lead_data_string,
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/json",
            "Host: api.leadsquared.com",
            "cache-control: no-cache"
          ),
        ));
        $lead_response = curl_exec($curl);
        curl_close($curl);
        $lead->activity = $lead_response;
        $lead->save();
        return Redirect::back()->with('creative_added','Updated Successfully!');

    }

    public function destroy($id)
    {
        $lead = Lead::where('id', $id)->first();
        if ($lead != null) {
            $lead->delete();
        }
        return redirect('/lead')->with('success', 'Task deleted!');
    }


}
