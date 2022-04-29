<?php

namespace App\Http\Controllers;
use App\FBLeads;
use App\Activity;
use App\Setting;
use App\LeadAudit;
use Illuminate\Http\Request;
use App\Imports\FacebookImport;
use Illuminate\Support\Facades\Mail;
use Auth;
use DataTables;
use DB;
use App\Jobs\UploadFBLeads;
// use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;
use \Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class LeadImportController extends Controller
{

    public function fb_leads_datatables(Request $request){
        $datas = FBLeads::orderBy('id','desc');
        // foreach ($datas as $value) {
        //  // print_r($value->api_response);
        //  $output = json_decode($value->api_response);
        //  if(!empty($output->Message)){

        //  print_r($output->Message->RelatedId);
        //  }
        // echo '<br>';
        // echo '<br>';
        // echo '<br>';
        // }
        if(isset($request->filter['project'])){
            $datas->whereIn('project', $request->filter['project']);
        }
        if(isset($request->filter['list_name'])){
            $datas->whereIn('list_name', $request->filter['list_name']);
        }
        if(isset($request->filter['stage'])){
            $datas->whereIn('stage', $request->filter['stage']);
        }
        if(isset($request->filter['activity'])){
            $datas->whereIn('activity', $request->filter['activity']);
        }
        $datas = $datas->get();
        return DataTables::of($datas)
            ->addColumn('is_new_lead', function(FBLeads $data){
                if(!empty($data->api_response)){
                    $api_res = json_decode($data->api_response);
                    if(!empty($api_res->Message)){
                        if($api_res->Message->IsCreated == false){
                            $output = 'Lead Exists';
                        }
                        else{
                            $output = 'New Lead';
                        }
                    }
                    else{
                        $output = 'No API Response';
                    }
                }
                else{
                    $output = 'No API Response';
                }
                return $output;
            })
            ->addColumn('lead_id', function(FBLeads $data){
                if(!empty($data->api_response)){
                    $api_res = json_decode($data->api_response);
                    if(!empty($api_res->Message)){
                        return $api_res->Message->RelatedId;
                    }
                }
                else{
                    return 'No API Response';
                }
            })
            ->rawColumns(['is_new_lead', 'lead_id'])
            ->toJson();
    }
    public function fb_leads_index(){
        $projects = FBLeads::select('project')->distinct()->get();
        $list_name = FBLeads::select('list_name')->distinct()->get();
        $stage = FBLeads::select('stage')->distinct()->get();
        $activity = FBLeads::select('activity')->distinct()->get();
        return view('leads.fb', compact(array('projects', 'list_name','stage', 'activity')));
    }
    public function get_imported_leads_data(){
        $total_lead_count = QueryBuilder::for(FBLeads::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'list_name', 'stage', 'activity')->get()->count();
        $fresh_lead_count = QueryBuilder::for(FBLeads::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'list_name', 'stage', 'activity')->where('activity', 'Fresh Lead')->get()->count();
        $exist_lead_count = QueryBuilder::for(FBLeads::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'list_name', 'stage', 'activity')->where('activity', 'Lead Exists')->get()->count();
        $dashboad = new \stdClass;
        $dashboad->total_lead_count = $total_lead_count;
        $dashboad->fresh_lead_count = $fresh_lead_count;
        $dashboad->exist_lead_count = $exist_lead_count;
        return response()->json($dashboad, 200);
    }
    public function update_lead_import_list(Request $request){
        if(isset($request->delete)){
            $get_lead_list = FBLeads::where('list_name', $request->get('list_name'))->get();
            foreach ($get_lead_list as $lead) {
                $lead->delete();
            }
        }
        return Redirect::back();
    }

    public function facebook_lead_store(Request $request)
    {
        $user = Auth::user();
        $log = "";
        //--- Validation Section
        $rules = [
            'leads_csv'      => 'required|mimes:csv,txt',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $filename = '';
        if ($file = $request->file('leads_csv'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            if(!empty($filename)){

                if($file->move('assets/fb_leads',$filename)){
                    // echo 'File Added';
                    // echo '<br>';
                }
                else{
                    // echo 'File Not Added';
                    // echo '<br>';
                }
            }
        }
        $input = '';
        $file = fopen('assets/fb_leads/'.$filename,"r");
        $i = 1;
        while (($line = fgetcsv($file)) !== FALSE) {
            // $rows_count = count($line);
            // for ($c=0; $c < $rows_count; $c++) {
                // $fname = $line[5];
                // $phone = $line[3];
                // $email = $line[4];
                $phone = $line[0];
                $email = $line[1];
                $fname = $line[2];
                // $form_name = $line[3];
                $imported_by = Auth::user()->name;
                if(!empty($fname)){
                    $fname = mb_strtolower($fname);
                    $fname = ucwords($fname);
                }
                else{
                    $fname = NULL;
                }
                if(!empty($phone)){
                    $phone = $phone;
                }
                else{
                    $phone = NULL;
                }
                if(!empty($email)){
                    $email = $email;
                }
                else{
                    $email = NULL;
                }
                // if($request->get('project') == 'siruseri' ||$request->get('project') == 'vib' ||$request->get('project') == 'hyd'){
                //     $sub_project = $request->get('sub_project');
                // }
                // else{
                //     $sub_project = NULL;
                // }
                // if(isset($request->source)){
                //     $source = $request->get('source');
                // }
                // else{
                //     $source = NULL;
                // }
                // if(isset($request->sub_source)){
                //     $sub_source = $request->get('sub_source');
                // }
                // else{
                //     $sub_source = NULL;
                // }
                $store_lead = new FBLeads([
                    'list_name' => $request->get('list_name'),
                    'name' => $fname,
                    'contact' => $phone,
                    'email' => $email,
                    // 'source' => $source,
                    // 'sub_source' => $sub_source,
                    // 'ad_name' => $ad_name,
                    // 'adset_name' => $adset_name,
                    // 'campaign_name' => $campaign_name,
                    // 'form_name' => $form_name,
                    'imported_by' => $imported_by,
                    'project' => $request->get('project'),
                    'duration' => $request->get('duration'),
                    // 'sub_project' => $sub_project,
                    'status' => 'Waiting for response...',
                    // 'activity' => $activity,
                    // 'stage' => $lead_stage,
                ]);
                
                $store_lead->save();
                $delay_sec = $i * 2;
                UploadFBLeads::dispatch($store_lead->id)->delay(now()->addSeconds($delay_sec));
                $i++;
            // }
        }
        fclose($file);
        return Redirect::back()->with('leads_added','The Facebook Leads Uploaded Successful !');
    }
    public function tsai_lead_store(Request $request)
    {
        $user = Auth::user();
        $log = "";
        //--- Validation Section
        $rules = [
            'leads_csv'      => 'required|mimes:csv,txt',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $filename = '';
        if ($file = $request->file('leads_csv'))
        {
            $filename = time().'-'.$file->getClientOriginalName();
            if(!empty($filename)){

                if($file->move('assets/fb_leads',$filename)){
                    // echo 'File Added';
                    // echo '<br>';
                }
                else{
                    // echo 'File Not Added';
                    // echo '<br>';
                }
            }
        }
        $input = '';
        $file = fopen('assets/fb_leads/'.$filename,"r");
        $i = 1;
        while (($line = fgetcsv($file)) !== FALSE) {
            // $rows_count = count($line);
            // for ($c=0; $c < $rows_count; $c++) {
                // $fname = $line[5];
                // $phone = $line[3];
                // $email = $line[4];
                $phone = $line[0];
                $email = $line[1];
                $fname = $line[2];
                // $form_name = $line[3];
                $imported_by = Auth::user()->name;
                if(!empty($fname)){
                    $fname = mb_strtolower($fname);
                    $fname = ucwords($fname);
                }
                else{
                    $fname = NULL;
                }
                if(!empty($phone)){
                    $phone = $phone;
                }
                else{
                    $phone = NULL;
                }
                if(!empty($email)){
                    $email = $email;
                }
                else{
                    $email = NULL;
                }
                // if($request->get('project') == 'siruseri' ||$request->get('project') == 'vib' ||$request->get('project') == 'hyd'){
                //     $sub_project = $request->get('sub_project');
                // }
                // else{
                //     $sub_project = NULL;
                // }
                // if(isset($request->source)){
                //     $source = $request->get('source');
                // }
                // else{
                //     $source = NULL;
                // }
                // if(isset($request->sub_source)){
                //     $sub_source = $request->get('sub_source');
                // }
                // else{
                //     $sub_source = NULL;
                // }



                $store_lead = new FBLeads([
                    'list_name' => $request->get('list_name'),
                    'name' => $fname,
                    'contact' => $phone,
                    'email' => $email,
                    // 'source' => $source,
                    // 'sub_source' => $sub_source,
                    // 'ad_name' => $ad_name,
                    // 'adset_name' => $adset_name,
                    // 'campaign_name' => $campaign_name,
                    // 'form_name' => $form_name,
                    'imported_by' => $imported_by,
                    'project' => $request->get('project'),
                    'duration' => $request->get('duration'),
                    // 'sub_project' => $sub_project,
                    'status' => 'Waiting for response...',
                    // 'activity' => $activity,
                    // 'stage' => $lead_stage,
                ]);
                
                $store_lead->save();

                $post_uri_tsai = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814';
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
                        "Attribute": "Phone",
                        "Value": "'.$phone.'"
                    },
                    {
                        "Attribute": "Source",
                        "Value": "Facebook-Ads"
                    },
                    {
                        "Attribute": "mx_Sub_Source",
                        "Value": "Mediaqart"
                    }
                ]';
                $res_data = $this->store_lead($post_uri_tsai, $data_string);
                $store_lead->api_response = $res_data;
                $store_lead->save();

            // }
        }
        fclose($file);
        return Redirect::back()->with('leads_added','The Facebook Leads Uploaded Successful !');
    }

    public function get_lead_id($project, $contact){
        switch($project){
            case 'agr':
                $access_key = 'u$r4800daab6f53393a1f2fe8dd52249a0d';
                $secret_key = '89e10b5a6253f3f0b38d18d39f7a566031f81264';
                $agr_contact_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($agr_contact_response);
            break;
            case 'hg':
                $access_key = 'u$rd8514b4e2d79392f50f7f48e6b0f5b3f';
                $secret_key = 'd92a7d0c93f547c589728580fc25e97ea8976584';
                $hg_contact_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($hg_contact_response);
            break;
            case 'bp':
                $access_key = 'u$rd8c2f7aadd8dd7609e08abc230990943';
                $secret_key = 'ae3805268bdd7c3ece47e97188f05394bb509246';
                $bp_contact_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($hg_contact_response);
            break;
            case 'os':
                $access_key = 'u$rdf5144f87796ce4aba6d4e478a56f31a';
                $secret_key = '1da6db1f1ae19e8afc69687020ffbc53ceaddf83';
                $os_contact_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($os_contact_response);
            break;
            case 'vib':
                $access_key = 'u$rbee27a995924ff77a3936aa435c84bec';
                $secret_key = '2444745c5e051179633580eced2b467b421f10a6';
                $vib_contact_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($vib_contact_response);
            break;
            case 'jr':
                $access_key = 'u$r63f08372eaa2f9198c77b19a5e99f302';
                $secret_key = '48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
                $jr_contact_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($jr_contact_response);
            break;
            case 'siruseri':
                $access_key = 'u$r9830a9a140a0b451e6e638c9d001d297';
                $secret_key = '4b65d9a34cee51db65eea8fd935d27eedc43e798';
                $cngs_contact_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($cngs_contact_response);
            break;
            case 'hyd':
                $access_key = 'u$rd75b9d9753960c3b0405cf84747db4d0';
                $secret_key = '645288d91bbdfb06ec5141d12b18850378dbbe93';
                $hyd_contact_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($hyd_contact_response);
            break;
            case 'tsai':
                $access_key = 'u$r3de70d5b8dbb95946a6ba432395cb4c5';
                $secret_key = '3bed1a9912c604716f94683a6dcff2473cf94814';
                $tsai_contact_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&phone=', $contact);
                $contact_response = (array)json_decode($tsai_contact_response);
            break;
            return $contact_response;
        }
        return $contact_response;
    }
    public function get_lead_email($project, $email){
        switch($project){
            case 'agr':
                $access_key = 'u$r4800daab6f53393a1f2fe8dd52249a0d';
                $secret_key = '89e10b5a6253f3f0b38d18d39f7a566031f81264';
                $agr_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($agr_email_response);
            break;
            case 'hg':
                $access_key = 'u$rd8514b4e2d79392f50f7f48e6b0f5b3f';
                $secret_key = 'd92a7d0c93f547c589728580fc25e97ea8976584';
                $hg_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($hg_email_response);
            break;

             case 'bp':
                $access_key = 'u$rd8c2f7aadd8dd7609e08abc230990943';
                $secret_key = 'ae3805268bdd7c3ece47e97188f05394bb509246';
                $bp_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($hg_email_response);
            break;
            case 'os':
                $access_key = 'u$rdf5144f87796ce4aba6d4e478a56f31a';
                $secret_key = '1da6db1f1ae19e8afc69687020ffbc53ceaddf83';
                $os_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($os_email_response);
            break;
            case 'vib':
                $access_key = 'u$rbee27a995924ff77a3936aa435c84bec';
                $secret_key = '2444745c5e051179633580eced2b467b421f10a6';
                $vib_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($vib_email_response);
            break;
            case 'jr':
                $access_key = 'u$r63f08372eaa2f9198c77b19a5e99f302';
                $secret_key = '48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
                $jr_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($jr_email_response);
            break;
            case 'siruseri':
                $access_key = 'u$r9830a9a140a0b451e6e638c9d001d297';
                $secret_key = '4b65d9a34cee51db65eea8fd935d27eedc43e798';
                $cngs_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetByEmailaddress?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($cngs_email_response);
            break;
            case 'hyd':
                $access_key = 'u$rd75b9d9753960c3b0405cf84747db4d0';
                $secret_key = '645288d91bbdfb06ec5141d12b18850378dbbe93';
                $hyd_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($hyd_email_response);
            break;
            case 'tsai':
                $access_key = 'u$r3de70d5b8dbb95946a6ba432395cb4c5';
                $secret_key = '3bed1a9912c604716f94683a6dcff2473cf94814';
                $tsai_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveLeadByPhoneNumber?accessKey='.$access_key.'&secretKey='.$secret_key.'&emailaddress=', $email);
                $email_response = (array)json_decode($tsai_email_response);
            break;
            return $email_response;
        }
        return $email_response;
    }
    public function get_lead($url, $source){
        $api_key_req = $url.$source;
        $req_curl = curl_init();
        curl_setopt_array($req_curl, array(
            CURLOPT_URL => $api_key_req,
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
        $api_response = curl_exec($req_curl);
        return $api_response;
    }

    public function store_lead($url, $data){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/json",
            "cache-control: no-cache"
          ),
        ));
        $cp_res_data = curl_exec($curl); 
        curl_close($curl);
        return $cp_res_data;
    }
    public function lead_verify($lead_id){

        // $user = Auth::user();
        $lead = FBLeads::find($lead_id);
        $lead_controller = new LeadImportController();
        $new_stage = '';
        $fname = $lead->name;
        $email = $lead->email;
        $phone = $lead->contact;
        $ad_name = $lead->ad_name;
        $project = $lead->project;
        $lead_source = $lead->source;
        $lead_sub_source = $lead->sub_source;
        
        if(!empty($lead->duration)){
            $duration = $lead->duration;
        }
        else{
            $duration = 1;
        }
        if($lead->sub_project){
            $sub_project = $lead->sub_project;
        }
        else{
            $sub_project = NULL;
        }
        
        switch ($project) {
            case 'AGR':
                $project_name = 'agr';
            case 'HG':
                $project_name = 'hg';
            case 'OS':
                $project_name = 'os';
            case 'TSAI Apartments':
                $project_name = 'tsai';
            case 'Villa Belvedere':
                $project_name = 'vib';

            case 'BP':
                $project_name = 'bp';
                break;
                

            case 'Eternity':
                $project_name = 'vib';
                break;
            case 'Jubilee Residences':
                $project_name = 'jr';
                break;
            case 'Project Jasmine Springs':
                $project_name = 'siruseri';
                break;
            case 'Project Padur':
                $project_name = 'siruseri';
                break;
            case 'Project Siruseri':
                $project_name = 'siruseri';
                break;
            case 'Project Ameenpur':
                $project_name = 'hyd';
                break;
            case 'Project Bachupally':
                $project_name = 'hyd';
                break;
            case 'Project Gandimaisamma':
                $project_name = 'hyd';
                break;
        }
        $lead_check_response = $lead_controller->get_lead_id($project_name, $phone);
        
        // $activity = '';

        if(count($lead_check_response) == 0){
            $lead->activity = 'Fresh Lead';
        }
        // $lead->activity = 'Working';
        else{
            if(empty($phone) || !is_numeric($phone)){
                $lead_check_email_response = $this->get_lead_email($project_name, $email);
                $email_address_stage = $lead_check_email_response[0]->ProspectStage;
                $lead->stage = $email_address_stage;
                $lead->source_orgin = $lead_check_email_response[0]->Source;
                $lead->activity = 'Lead Exists (Email)';
            }
            else{
                $contact_stage = $lead_check_response[0]->ProspectStage;
                // $email_address_stage = $lead_check_email_response[0]->ProspectStage;
                // if(!empty($contact_stage)){
                $lead->stage = $contact_stage;
                $lead->source_orgin = $lead_check_response[0]->Source;
                $lead->activity = 'Lead Exists (Phone)';
                // }
                // elseif(!empty($email_address_stage)){
                //     $lead->stage = $email_address_stage;
                //     $activity = 'Lead Exists';
                // }
                // else{
                //     $activity = 'Not Found';
                //     $lead->stage = 'Not Found';
                // }
            }
        }
    }

}

