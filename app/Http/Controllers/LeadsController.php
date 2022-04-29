<?php

namespace App\Http\Controllers;
use App\LeadAudit;
use App\LeadsAgr;
use App\LeadsHg;
use App\LeadsOS;
use App\LeadsBP;
use App\LeadsVIB;
use App\LeadsSiruseri;
use App\LeadsJR;
use App\LeadsHyd;
use App\LeadsTsai;
use App\Creatives;
use App\Activity;
use App\FBLeads;
use App\Setting;
use App\Models\LpLeads;
use Illuminate\Http\Request;
use App\Exports\ExportLeadAudit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCreativeTask;
use App\Mail\SendRedAlert;
use DataTables;
use Auth;
use DB;
use Route;
use Redirect;
use Response;
use App\User;
use App\CreativeImages;
use App\CreativeSamples;
use App\Projects;
use App\Campaigns;
use Validator;
use Analytics;
use Spatie\Analytics\Period;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use \Carbon\Carbon;

class LeadsController extends Controller
{
    //

    public function audit_index(){
    	$current_route_name = Route::currentRouteName();
    	$agents = LeadAudit::select('lead_owner')->distinct()->get();
    	$lead_stage = LeadAudit::select('lead_stage')->distinct()->get();
    	$lead_source = LeadAudit::select('lead_source')->distinct()->get();
    	$audit_users = LeadAudit::select('lat_executive')->distinct()->get();
    	$lat_feedback = LeadAudit::select('lat_feedback')->distinct()->get();
    	$projects = LeadAudit::select('project')->distinct()->get();
	    $all_status = LeadAudit::select('lead_stage')->distinct()->get();
    	return view('leads.audit_index', compact(array('current_route_name', 'agents','audit_users','projects', 'lat_feedback', 'all_status', 'lead_stage', 'lead_source')));
    }
    public function agent_report(Request $request){
    	$current_route_name = Route::currentRouteName();
    	$get_agents = new LeadAudit;
        if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $get_agents->whereBetween('created_at', [$from, $to]);
        } 
    	if(isset($request->project)){
        	$project = $request->project;
        	$get_agents->where('project', $project);
        }
    	$agents = $get_agents->select('lead_owner')->distinct()->get();

        $total_lead_count = 0;
        $count_block_1 = 0;
        $count_block_2 = 0;
        $count_block_3 = 0;
        $count_block_4 = 0;
        $count_total_score = 0;

        $sum_block_1 = 0;
        $sum_block_2 = 0;
        $sum_block_3 = 0;
        $sum_block_4 = 0;
        $sum_total_score = 0;

        $agent_report = array();
        foreach($agents as $key => $agent){
        	$get_lead_count = $get_agents->where('lead_owner', $agent->lead_owner)->select('lead_number')->distinct()->get()->count();
            $total_lead_count += $get_lead_count;

            if($agent->block_1_avg($agent->lead_owner) != 'NA'){
                $sum_block_1 += $agent->block_1_avg($agent->lead_owner);
                $count_block_1 += 1;
            }
            if($agent->block_2_avg($agent->lead_owner) != 'NA'){
                $sum_block_2 += $agent->block_2_avg($agent->lead_owner);
                $count_block_2 += 1;
            }
            if($agent->block_3_avg($agent->lead_owner) != 'NA'){
                $sum_block_3 += $agent->block_3_avg($agent->lead_owner);
                $count_block_3 += 1;
            }
            if($agent->block_4_avg($agent->lead_owner) != 'NA'){
                $sum_block_4 += $agent->block_4_avg($agent->lead_owner);
                $count_block_4 += 1;
            }
            if($agent->total_score_avg($agent->lead_owner) != 'NA'){
                $sum_total_score += $agent->total_score_avg($agent->lead_owner);
                $count_total_score += 1;
            }
            $agent_total_score_avg = ceil($sum_total_score/$count_total_score);


            if($agent->total_score_avg($agent->lead_owner) == 'NA'){
                $total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
            }
            elseif($this->in_range($agent->total_score_avg($agent->lead_owner), 0, 69)){
                $total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
            }
            elseif($this->in_range($agent->total_score_avg($agent->lead_owner), 70, 84)){
                $total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
            }
            elseif($this->in_range($agent->total_score_avg($agent->lead_owner), 85, 94)){
                $total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
            }
            elseif($this->in_range($agent->total_score_avg($agent->lead_owner), 95, 100)){
                $total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
            }
            
            if($agent_total_score_avg == 'NA'){
                $agent_total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
            }
            elseif($this->in_range($agent_total_score_avg, 0, 69)){
                $agent_total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
            }
            elseif($this->in_range($agent_total_score_avg, 70, 84)){
                $agent_total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
            }
            elseif($this->in_range($agent_total_score_avg, 85, 94)){
                $agent_total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
            }
            elseif($this->in_range($agent_total_score_avg, 95, 100)){
                $agent_total_score_tag = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
            }
            $agent_report[$key]['lead_owner'] = $agent->lead_owner;
            $agent_report[$key]['get_lead_count'] = $get_lead_count;
            $agent_report[$key]['block_1_avg'] = $agent->block_1_avg($agent->lead_owner).$agent->block_1_avg($agent->lead_owner) == 'NA' ? '': '%';
            $agent_report[$key]['block_2_avg'] = $agent->block_2_avg($agent->lead_owner).'%';
            $agent_report[$key]['block_3_avg'] = $agent->block_3_avg($agent->lead_owner).'%';
            $agent_report[$key]['block_4_avg'] = $agent->block_4_avg($agent->lead_owner).'%';
            $agent_report[$key]['total_score_avg'] = $agent->total_score_avg($agent->lead_owner).'%';
            $agent_report[$key]['total_score_tag'] = $total_score_tag;
            $agent_report[$key]['feedback_colud'] = $agent->lat_feedback_colud($agent->lead_owner);

        }
        $total_lead_count = ceil($total_lead_count);
        $avg_count_block_1 = ceil($sum_block_1/$count_block_1);
        $avg_count_block_2 = ceil($sum_block_2/$count_block_2);
        $avg_count_block_3 = ceil($sum_block_3/$count_block_3);
        $avg_count_block_4 = ceil($sum_block_4/$count_block_4);


    	$lead_stage = LeadAudit::select('lead_stage')->distinct()->get();
    	$lead_source = LeadAudit::select('lead_source')->distinct()->get();
    	$audit_users = LeadAudit::select('lat_executive')->distinct()->get();
    	$lat_feedback = LeadAudit::select('lat_feedback')->distinct()->get();
    	$projects = LeadAudit::select('project')->distinct()->get();
	    $all_status = LeadAudit::select('lead_stage')->distinct()->get();
    	return view('leads.agents_reports', compact(array('current_route_name', 'agents','audit_users','projects', 'lat_feedback', 'all_status', 'lead_stage', 'lead_source', 'agent_report', 'total_lead_count', 'avg_count_block_1', 'avg_count_block_2', 'avg_count_block_3', 'avg_count_block_4', 'agent_total_score_avg', 'agent_total_score_tag')));
    }

    public function in_range($number, $min, $max, $inclusive = TRUE)
        {
                return $inclusive
                    ? ($number >= $min && $number <= $max)
                    : ($number > $min && $number < $max) ;

            return FALSE;
        }
    public function red_alert(Request $request){
    	$current_route_name = Route::currentRouteName();
    	$get_agents = LeadAudit::where('red_alert', 'Yes')->orderBy('lead_owner','desc');
        if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $get_agents->whereBetween('created_at', [$from, $to]);
        }
    	if(isset($request->project)){
        	$project = $request->project;
        	$get_agents->where('project', $project);
        }
    	$all_leads = LeadAudit::orderBy('lead_owner','desc');
        if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $all_leads->whereBetween('created_at', [$from, $to]);
        }
    	if(isset($request->project)){
        	$project = $request->project;
        	$all_leads->where('project', $project);
        }
    	$get_all_leads = $all_leads->get()->count();
    	$agents = $get_agents->get();
    	$red_alert_count = $agents->count();
    	$red_alert_value = round($red_alert_count / $get_all_leads * 100, 2);
    	// $red_alert_value = ceil($agents->count()/$get_all_leads->count());
    	$lead_stage = LeadAudit::select('lead_stage')->distinct()->get();
    	$lead_source = LeadAudit::select('lead_source')->distinct()->get();
    	$audit_users = LeadAudit::select('lat_executive')->distinct()->get();
    	$lat_feedback = LeadAudit::select('lat_feedback')->distinct()->get();
    	$projects = LeadAudit::select('project')->distinct()->get();
	    $all_status = LeadAudit::select('lead_stage')->distinct()->get();
    	return view('leads.red_alert', compact(array('current_route_name', 'agents','audit_users','projects', 'lat_feedback', 'all_status', 'lead_stage', 'lead_source', 'red_alert_count', 'get_all_leads', 'red_alert_value')));
    }
    public function zero_tolerance(Request $request){
    	$current_route_name = Route::currentRouteName();
    	$get_agents = LeadAudit::where('block_4', '>', '100')->orderBy('lead_owner','desc');
        if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $get_agents->whereBetween('created_at', [$from, $to]);
        }
    	if(isset($request->project)){
        	$project = $request->project;
        	$get_agents->where('project', $project);
        }
    	$all_leads = LeadAudit::orderBy('lead_owner','desc');
        if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $all_leads->whereBetween('created_at', [$from, $to]);
        }
    	if(isset($request->project)){
        	$project = $request->project;
        	$all_leads->where('project', $project);
        }
    	$get_all_leads = $all_leads->get()->count();
    	$agents = $get_agents->get();
    	$red_alert_count = $agents->count();
    	$red_alert_value = round($red_alert_count / $get_all_leads * 100, 2);
    	// $red_alert_value = ceil($agents->count()/$get_all_leads->count());
    	$lead_stage = LeadAudit::select('lead_stage')->distinct()->get();
    	$lead_source = LeadAudit::select('lead_source')->distinct()->get();
    	$audit_users = LeadAudit::select('lat_executive')->distinct()->get();
    	$lat_feedback = LeadAudit::select('lat_feedback')->distinct()->get();
    	$projects = LeadAudit::select('project')->distinct()->get();
	    $all_status = LeadAudit::select('lead_stage')->distinct()->get();
    	return view('leads.zero_tolerance', compact(array('current_route_name', 'agents','audit_users','projects', 'lat_feedback', 'all_status', 'lead_stage', 'lead_source', 'red_alert_count', 'get_all_leads', 'red_alert_value')));
    }
    public function import(){
    	$projects = array('agr', 'hg', 'os', 'bp', 'vib', 'jr','siruseri', 'hyd', 'tsai');
    	foreach($projects as $project){
   			$this->import_leads($project);
    	}
    }
    public function import2(){
    	$projects = array('tsai');
    	foreach($projects as $project){
   			$this->import_leads($project);
    	}
    }
    public function import_leads($project){
    	$imoprt_repeater = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
    	$yesterday = date('Y-m-d H:i:s');
    	switch($project){
    		case 'agr':
				LeadsAgr::truncate();
				DB::statement("ALTER TABLE leads_agr AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi.leadsquared.com/';
				$access_key = 'u$r101729ec766c0f0bcf1ac5fcd4dc884a';
				$secret_key = '5437608506c5f4b13773ba4fcb4e932ab2df294a';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Track_ID"}';
    			break;

    		case 'hg':
				LeadsHg::truncate();
				DB::statement("ALTER TABLE leads_hg AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi.leadsquared.com/';
				$access_key = 'u$r2fc623c84409d3bcc18d29be98caa0f8';
				$secret_key = 'ba09c9eadde001c7a33d2defd681785f99ae80e8';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Track_ID"}';
    			break;

            case 'bp':
                LeadsHg::truncate();
                DB::statement("ALTER TABLE leads_bp AUTO_INCREMENT = 0");
                $api_url = 'https://analyticsapi.leadsquared.com/';
                $access_key = 'u$rd8c2f7aadd8dd7609e08abc230990943';
                $secret_key = 'ae3805268bdd7c3ece47e97188f05394bb509246;
                $output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Track_ID"}';
                break;


    		case 'os':
				LeadsOS::truncate();
				DB::statement("ALTER TABLE leads_os AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi.leadsquared.com/';
				$access_key = 'u$r82026083899c8b86ea1762c93c68b421';
				$secret_key = 'ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Track_ID"}';
    			break;
    		case 'vib':
				LeadsVIB::truncate();
				DB::statement("ALTER TABLE leads_vib AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi.leadsquared.com/';
				$access_key = 'u$rb4093458df51f5f657556da5ef326a2e';
				$secret_key = '84afdcf82b6a9cd947b2f617fd51b7ef47bafd87';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Projects,mx_Track_ID"}';
    			break;
    		case 'jr':
				LeadsJR::truncate();
				DB::statement("ALTER TABLE leads_jr AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi-in21.leadsquared.com/';
				$access_key = 'u$r63f08372eaa2f9198c77b19a5e99f302';
				$secret_key = '48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Track_ID"}';
    			break;
    		case 'siruseri':
				LeadsSiruseri::truncate();
				DB::statement("ALTER TABLE leads_siruseri AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi-in21.leadsquared.com/';
				$access_key = 'u$r9830a9a140a0b451e6e638c9d001d297';
				$secret_key = '4b65d9a34cee51db65eea8fd935d27eedc43e798';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Project,mx_Track_ID"}';
    			break;
    		case 'hyd':
				LeadsHyd::truncate();
				DB::statement("ALTER TABLE leads_hyd AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi-in21.leadsquared.com/';
				$access_key = 'u$rd75b9d9753960c3b0405cf84747db4d0';
				$secret_key = '645288d91bbdfb06ec5141d12b18850378dbbe93';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,mx_Interested_to_buy,Notes,SourceReferrerURL,mx_Email_Acknowledged,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge,mx_Project_Name,mx_Track_ID"}';
    			break;
    		case 'tsai':
				LeadsTsai::truncate();
				DB::statement("ALTER TABLE leads_tsai AUTO_INCREMENT = 0");
				$api_url = 'https://analyticsapi-in21.leadsquared.com/';
				$access_key = 'u$r3de70d5b8dbb95946a6ba432395cb4c5';
				$secret_key = '3bed1a9912c604716f94683a6dcff2473cf94814';
				$output_fields = '{"Type":"list","IncludeCSV":" CreatedOn,FirstName,LastName,ProspectID,ProspectAutoId,ProspectStage,Source,mx_Sub_Source,Origin,Notes,SourceReferrerURL,Phone,EmailAddress,OwnerIdName,OwnerIdEmailAddress,LeadAge"}';
    			break;
    	}
		foreach($imoprt_repeater as $repeater){
	    	$data = '{
					"DateFilter":[{"DateField":"LeadCreatedOn","FromDate":"2021-06-01 12:00:00","ToDate":"'.$yesterday.'"}],

					"Output":'.$output_fields.',

					"Paging":{"PageIndex":'.$repeater.',"PageSize":10000}
					}';
			// $data_string = '{"DateFilter":[{"DateField":"LeadCreatedOn","FromDate":"2020-10-17 12:00:00","ToDate":"2020-10-19 12:00:00"}],"Output":{"Type":"list","IncludeCSV":" ProspectID,Source,ProspectAutoId,Origin,ProspectStage,OwnerIdEmailAddress,OwnerIdName,Groups,CreatedOn,Revenue,SourceCampaign,SourceMedium,mx_UTM_term,mx_Project,mx_Created_At_System_Date"},"Paging":{"PageIndex":1,"PageSize":100}}';
			$curl = curl_init($api_url.'Leads/LeadDistribution/FilterByLeadField?accessKey='.$access_key.'&secretKey='.$secret_key.'&responseformat=json');
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			        "Content-Type:application/json",
			        "Content-Length:".strlen($data)
			        ));
			$lead_response = curl_exec($curl);
			curl_close($curl);
			$decode_lead_response = (array) json_decode($lead_response);
			// print_r($decode_lead_response);
			foreach ($decode_lead_response['Results'] as $lead) {
				if(isset($lead->LastName)){
					$last_name = $lead->LastName;
				}
				else{
					$last_name = NULL;
				}
				if(isset($lead->FirstName)){
					$first_name = $lead->FirstName;
				}
				else{
					$first_name = NULL;
				}
				if(isset($lead->mx_Sub_Source)){
					$sub_source = $lead->mx_Sub_Source;
				}
				else{
					$sub_source = NULL;
				}
				if(isset($lead->mx_Track_ID)){
					$track_id = $lead->mx_Track_ID;
				}
				else{
					$track_id = NULL;
				}
				if(isset($lead->Notes)){
					$notes = $lead->Notes;
				}
				else{
					$notes = NULL;
				}
				if(isset($lead->Origin)){
					$orgin = $lead->Origin;
				}
				else{
					$orgin = NULL;
				}
				if(isset($lead->mx_Interested_to_buy)){
					$config = $lead->mx_Interested_to_buy;
				}
				else{
					$config = NULL;
				}
				if(isset($lead->SourceReferrerURL)){
					$ref = $lead->SourceReferrerURL;
				}
				else{
					$ref = NULL;
				}
				if(isset($lead->EmailAddress)){
					$email = $lead->EmailAddress;
				}
				else{
					$email = NULL;
				}
				if(isset($lead->Phone)){
					$phone = $lead->Phone;
				}
				else{
					$phone = NULL;
				}
				if(isset($lead->Source)){
					$source = $lead->Source;
				}
				else{
					$source = NULL;
				}
				if($project =='jr' || $project =='siruseri' || $project =='hyd' || $project =='tsai'){
					$lead_url = 'https://in21.leadsquared.com/LeadManagement/LeadDetails?LeadID='.$lead->ProspectID;
				}
				else{
					$lead_url = 'https://run.leadsquared.com/LeadManagement/LeadDetails?LeadID='.$lead->ProspectID;
				}

				switch($project){
					case 'agr':
					$proejct_name = 'AGR';
					break;
					case 'hg':
					$proejct_name = 'HG';
					break;
					case 'os':
					$proejct_name = 'OS';
					break;
                    case 'bp':
                    $proejct_name = 'BP';
                    break;
					case 'tsai':
					$proejct_name = 'TSAI Apartments';
					break;
					case 'vib':
					if(isset($lead->mx_Projects)){
						if($lead->mx_Projects == 'Villa Belvedere'){
							$proejct_name = 'VIB';
						}else{
							$proejct_name = 'Eternity';
						}
					}
					else{
						$proejct_name = NULL;
					}
					break;
					case 'jr':
					$proejct_name = 'JR';
					break;
					case 'siruseri':
					if(isset($lead->mx_Project)){
						if($lead->mx_Project == 'Project Jasmine Springs'){
							$proejct_name = 'JS';
						}elseif($lead->mx_Project == 'Project Padur'){
							$proejct_name = 'Padur';
						}elseif($lead->mx_Project == 'Project padur'){
							$proejct_name = 'Padur';
						}
						elseif($lead->mx_Project == 'Project Siruseri'){
							$proejct_name = 'Siruseri';
						}
					}
					else{
						$proejct_name = NULL;
					}
					break;
					case 'hyd':
					if(isset($lead->mx_Project_Name)){
						if($lead->mx_Project_Name == 'Project Ameenpur'){
							$proejct_name = 'Ameenpur';
						}elseif($lead->mx_Project_Name == 'Project Bachupally'){
							$proejct_name = 'Bachupally';
						}
						elseif($lead->mx_Project_Name == 'Project Gandimaisamma'){
							$proejct_name = 'Gandimaisamma';
						}
					}
					else{
						$proejct_name = NULL;
					}
					break;
				}

				$lead_save = [
		    	    'project' => $proejct_name,
		    	    'created_on' => $lead->CreatedOn,
		            'first_name' => $first_name,
		            'last_name' => $last_name,
		            'lead_id' => $lead->ProspectID,
		            'lead_number' => $lead->ProspectAutoId,
		            'lead_stage' => $lead->ProspectStage,
		            'lead_source' => $source,
		            'lead_sub_source' => $sub_source,
		            'lead_origin' => $orgin,
		            'interested_to_buy' => $config,
		            'notes' => $notes,
		            'source_referrer_url' => $ref,
		            'contact_number' => $phone,
		            'email' => $email,
		            'lead_url' => $lead_url,
		            'lead_owner' => $lead->OwnerIdName,
		            'lead_owner_email' => $lead->OwnerIdEmailAddress,
		            'lead_age' => $lead->LeadAge,
		            'track_id' => $track_id,
				];
				switch($project){
					case 'agr':
					$save_new_leads = new LeadsAgr($lead_save);
					break;
					case 'hg':
					$save_new_leads = new LeadsHg($lead_save);
					break;
					case 'os':
					$save_new_leads = new LeadsOS($lead_save);
					break;
                    case 'bp':
                    $save_new_leads = new LeadsBP($lead_save);
                    break;
					case 'vib':
					$save_new_leads = new LeadsVIB($lead_save);
					break;
					case 'jr':
					$save_new_leads = new LeadsJR($lead_save);
					break;
					case 'siruseri':
					$save_new_leads = new LeadsSiruseri($lead_save);
					break;
					case 'hyd':
					$save_new_leads = new LeadsHyd($lead_save);
					break;
					case 'tsai':
					$save_new_leads = new LeadsTsai($lead_save);
					break;
				}
				$save_new_leads->save();
			}
		}
		return response()->json([
            'success' => 'Leads saved successfully!.'
        ]);

    }

    //*** AGR Datatable
    public function agr_datatables(Request $request)
    {
        
       
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsAgr::where('project', 'AGR');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsAgr $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsAgr $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_agr', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsAgr $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** HG Datatable
    public function hg_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsHg::where('project', 'HG');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsHg $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsHg $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_hg', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsHg $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }


    //*** BP Datatable
    public function bp_datatables(Request $request)
    {
        // orderBy('created_at', 'ASC')->get()
         $datas = LeadsHg::where('project', 'BP');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
            $lead_stage = $request->stage;
            $datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
            $lead_source = $request->source;
            $datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
            $lead_owner = $request->owner;
            $datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsHg $data){
                $contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
                return $contact_number;
            })
            ->addColumn('action', function(LeadsHg $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_bp', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsHg $data){
                if(!empty($data->audit)){
                    $status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
                }
                else{
                    $status = '<span class="badge badge-warning">Not Started</span>';
                }
                return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }





    //*** OS Datatable
    public function os_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsOS::where('project', 'OS');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsOS $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsOS $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_os', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsOS $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            }) 
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    public function tsai_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsTsai::select('lead_number', 'lead_stage', 'first_name', 'lead_source', 'lead_origin', 'created_on', 'lead_age', 'lead_owner', 'lead_id')->where('project', 'TSAI Apartments');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->addColumn('action', function(LeadsTsai $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_tsai', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsTsai $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            }) 
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    
    //*** JR Datatable
    public function jr_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsJR::where('project', 'JR');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsJR $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsJR $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_jr', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsJR $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            }) 
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** VIB Datatable
    public function vib_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsVIB::where('project', 'VIB');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsVIB $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsVIB $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_vib', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsVIB $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** ET Datatable
    public function et_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsVIB::where('project', 'Eternity');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsVIB $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsVIB $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_vib', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsVIB $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** JS Datatable
    public function js_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsSiruseri::where('project', 'JS');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsSiruseri $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsSiruseri $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_siruseri', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsSiruseri $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** Padur Datatable
    public function padur_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsSiruseri::where('project', 'Padur');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsSiruseri $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsSiruseri $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_siruseri', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsSiruseri $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** Siruseri Datatable
    public function siruseri_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsSiruseri::where('project', 'Siruseri');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsSiruseri $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsSiruseri $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_siruseri', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsSiruseri $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** Siruseri Datatable
    public function ameenpur_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsHyd::where('project', 'Ameenpur');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsHyd $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsHyd $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_hyd', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsHyd $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** Siruseri Datatable
    public function bachu_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsHyd::where('project', 'Bachupally');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsHyd $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsHyd $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_hyd', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsHyd $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** Siruseri Datatable
    public function gandimaisamma_datatables(Request $request)
    {
    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadsHyd::where('project', 'Gandimaisamma');
         if(isset($request->from_date) && isset($request->to_date)){
            $from = $request->from_date;
            $to = $request->to_date;
            $datas->whereBetween('created_on', [$from, $to])->get();
        }
        else{
            $from = date('Y-m-d', strtotime('today - 2 days'));
            $to = date('Y-m-d', strtotime('today'));
            $datas->whereBetween('created_on', [$from, $to])->get();

        }
        //Order Status Filter
        if(isset($request->stage)){
        	$lead_stage = $request->stage;
        	$datas->where('lead_stage', $lead_stage);
        }
        if(isset($request->source)){
        	$lead_source = $request->source;
        	$datas->where('lead_source', $lead_source);
        }
        if(isset($request->owner)){
        	$lead_owner = $request->owner;
        	$datas->where('lead_owner', $lead_owner);
        }
        $datas = $datas->orderBy('created_on','desc')->get();
         return DataTables::of($datas)
            ->editColumn('contact_number', function(LeadsHyd $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('action', function(LeadsHyd $data){
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => 'leads_hyd', 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->addColumn('lead_audit', function(LeadsHyd $data){
            	if(!empty($data->audit)){
            		$status = '<span class="badge badge-success">'.count($data->audit).' Audits</span>';
            	}
            	else{
            		$status = '<span class="badge badge-warning">Not Started</span>';
            	}
            	return $status;
            })
            ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    //*** Padur Datatable
    public function audit_index_datatables(Request $request)
    {


    	// orderBy('created_at', 'ASC')->get()
         $datas = LeadAudit::orderBy('created_at','desc');
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
        //Order Status Filter
        if(isset($request->filter['project'])){
            $datas->where('project', $request->filter['project']);
        }
        if(isset($request->filter['lead_stage'])){
            $datas->where('lead_stage', $request->filter['lead_stage']);
        }
        if(isset($request->filter['lead_source'])){
            $datas->where('lead_source', $request->filter['lead_source']);
        }
        if(isset($request->filter['lead_owner'])){
            $datas->where('lead_owner', $request->filter['lead_owner']);
        }
        if(isset($request->filter['lat_executive'])){
            $datas->where('lat_executive', $request->filter['lat_executive']);
        }
        if(isset($request->filter['total_score'])){
            $datas->where('total_score', $request->filter['total_score']);
        }
        if(isset($request->filter['lat_feedback'])){
            $datas->where('lat_feedback', $request->filter['lat_feedback']);
        }
        if(isset($request->filter['red_alert'])){
            $datas->where('red_alert', $request->filter['red_alert']);
        }
        if(isset($request->filter['record_not_found'])){
            $datas->where('record_not_found', $request->filter['record_not_found']);
        }
        if(isset($request->filter['type'])){
            $datas->where('type', $request->filter['type']);
        }
        $datas = $datas->get();
         return DataTables::of($datas)
            ->editColumn('project', function(LeadAudit $data){
            	$proejct_name = strtoupper($data->project);
            	return $proejct_name;
            })
            ->editColumn('contact_number', function(LeadAudit $data){
            	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            	return $contact_number;
            })
            ->addColumn('total_score', function(LeadAudit $data){
            	$total_score = '<span class="badge badge-success">'.$data->total_score.'% </span>';
            	return $total_score;
            })
            ->addColumn('type', function(LeadAudit $data){
            	$total_score = strtoupper($data->type);
            	return $total_score;
            })
            ->addColumn('action', function(LeadAudit $data){
		    	switch ($data->project) {
		    		case 'AGR':
		            $lead_table_name = 'leads_agr';
		    		break;
		    		case 'HG':
		            $lead_table_name = 'leads_hg';
		    		break;
		    		case 'OS':
		            $lead_table_name = 'leads_os';
		    		break;
                    case 'BP':
                    $lead_table_name = 'leads_bp';
                    break;
		    		case 'VIB':
		            $lead_table_name = 'leads_vib';
		    		break;
		    		case 'Eternity':
		            $lead_table_name = 'leads_vib';
		    		break;
		    		case 'JR':
		            $lead_table_name = 'leads_jr';
		    		break;
		    		case 'JS':
		            $lead_table_name = 'leads_siruseri';
		    		break;
		    		case 'Padur':
		            $lead_table_name = 'leads_siruseri';
		    		break;
		    		case 'Siruseri':
		            $lead_table_name = 'leads_siruseri';
		    		break;
		    		case 'Ameenpur':
		            $lead_table_name = 'leads_hyd';
		    		break;
		    		case 'Bachupally':
		            $lead_table_name = 'leads_hyd';
		    		break;
		    		case 'Gandimaisamma':
		            $lead_table_name = 'leads_hyd';
		    		break;
		    		case 'TSAI Apartments':
		            $lead_table_name = 'leads_tsai';
		    		break;
		    	}
                return '<div class="action-list d-inline-flex"><a href="'.route('lead_view', ['table_name' => $lead_table_name, 'lead_id' => $data->lead_id]).'" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['action', 'total_score'])
            ->toJson();
    }
    public function get_lp_leads_data(Request $request){
        if(isset($request->from_date) && isset($request->to_date)){
            $from_date = Carbon::parse($request->from_date);
            $to_date = Carbon::parse($request->to_date);
        }
        else{
            $from = date('Y-m-d', strtotime('today - 29 days'));
            $from_date = Carbon::parse($from);
            $to_date = now();
        }
        $total_leads = QueryBuilder::for(LpLeads::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lp_id')->whereBetween('created_at', [$from_date, $to_date])->get()->count();
        $fresh_leads = QueryBuilder::for(LpLeads::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lp_id')->whereBetween('created_at', [$from_date, $to_date])->where('leadsquared_submited', '=', 'Yes')->get()->count();
        $exist_leads = QueryBuilder::for(LpLeads::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lp_id')->whereBetween('created_at', [$from_date, $to_date])->whereNull('leadsquared_submited')->get()->count();

        $dashboad = new \stdClass;
        $dashboad->total_lead_count = $total_leads;
        $dashboad->total_fresh_leads = $fresh_leads;
        $dashboad->total_exist_leads = $exist_leads;
        return response()->json($dashboad, 200);

    }
    public function get_leads_data(Request $request){

        if(isset($request->from_date) && isset($request->to_date)){
	    	$from_date = Carbon::parse($request->from_date)->setTimezone('Asia/Kolkata')->format('Y-m-d');
	    	$to_date = Carbon::parse($request->to_date)->addHours(23)->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
        }
        else{
            $from = date('Y-m-d', strtotime('today - 29 days'));
	    	$from_date = Carbon::parse($from);
            $to_date = now();
            // $to_date = now();
        }
		if(isset($request->soft_skills)){
			$soft_skills_data = explode(',', $request->soft_skills);
			$a_from = $soft_skills_data[0];
			$a_to = $soft_skills_data[1];
		}
		else{
			$a_from = 0;
			$a_to = 100;
		}
		if(isset($request->product_knowledge)){
			$product_knowledge_data = explode(',', $request->product_knowledge);
			$b_from = $product_knowledge_data[0];
			$b_to = $product_knowledge_data[1];
		}
		else{
			$b_from = 0;
			$b_to = 100;
		}
		if(isset($request->lms_update)){
			$lms_update_data = explode(',', $request->lms_update);
			$c_from = $lms_update_data[0];
			$c_to = $lms_update_data[1];
		}
		else{
			$c_from = 0;
			$c_to = 100;
		}
		if(isset($request->zero_tolerance)){
			$zero_tolerance_data = explode(',', $request->zero_tolerance);
			$d_from = $zero_tolerance_data[0];
			$d_to = $zero_tolerance_data[1];
		}
		else{
			$d_from = 0;
			$d_to = 100;
		}
		if(isset($request->total_score)){
			$total_score_data = explode(',', $request->total_score);
			$e_from = $total_score_data[0];
			$e_to = $total_score_data[1];
		}
		else{
			$e_from = 0;
			$e_to = 100;
		}


		$leads_agr = LeadsAgr::whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_hg = LeadsHg::whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_os = LeadsOS::whereBetween('created_on', [$from_date, $to_date])->get()->count();

		$leads_jr = LeadsJR::whereBetween('created_on', [$from_date, $to_date])->get()->count();

		$leads_vib = LeadsVIB::where('project', 'VIB')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_eternity = LeadsVIB::where('project', 'Eternity')->whereBetween('created_on', [$from_date, $to_date])->get()->count();

		$leads_siruseri = LeadsSiruseri::where('project', 'Siruseri')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_padur = LeadsSiruseri::where('project', 'Padur')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_js = LeadsSiruseri::where('project', 'JS')->whereBetween('created_on', [$from_date, $to_date])->get()->count();

		$leads_ameenpur = LeadsHyd::where('project', 'Ameenpur')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_bachu = LeadsHyd::where('project', 'Bachupally')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
        $leads_bp = LeadsBP::where('project', 'Bachupally')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
		$leads_gandimaisamma = LeadsHyd::where('project', 'Gandimaisamma')->whereBetween('created_on', [$from_date, $to_date])->get()->count();
        if(isset($request->filter['project'])){
        	switch($request->filter['project']){
        		case 'AGR':
                $total_leads = $leads_agr;
        		break;
        		case 'HG':
                $total_leads = $leads_hg;
        		break;
        		case 'OS':
                $total_leads = $leads_os;
        		break;
                case 'BP':
                $total_leads = $leads_bp;
                break;
        		case 'VIB':
                $total_leads = $leads_vib;
        		break;
        		case 'Eternity':
                $total_leads = $leads_eternity;
        		break;
        		case 'JR':
                $total_leads = $leads_jr;
        		break;
        		case 'JS':
                $total_leads = $leads_js;
        		break;
        		case 'Padur':
                $total_leads = $leads_padur;
        		break;
        		case 'Siruseri':
                $total_leads = $leads_siruseri;
        		break;
        		case 'Ameenpur':
                $total_leads = $leads_ameenpur;
        		break;
        		case 'Bachupally':
                $total_leads = $leads_bachu;
        		break;
        		case 'Gandimaisamma':
                $total_leads = $leads_gandimaisamma;
        		break;
        		default:
    			$total_leads = $leads_agr + $leads_hg + $leads_os + $leads_bp + $leads_vib + $leads_eternity + $leads_js + $leads_padur + $leads_siruseri + $leads_jr + $leads_ameenpur + $leads_bachu + $leads_gandimaisamma;
    			break;
        	}
        }else{
            
                $total_leads = $leads_agr + $leads_hg + $leads_bp + $leads_os + $leads_vib + $leads_eternity + $leads_js + $leads_padur + $leads_siruseri + $leads_jr + $leads_ameenpur + $leads_bachu + $leads_gandimaisamma;
        }

		$all_leads = QueryBuilder::for(LeadAudit::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])->get()->count();

		$total_lead_owners = QueryBuilder::for(LeadAudit::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])->select('lead_owner')->distinct()->get()->count();

		$total_leads_audited = QueryBuilder::for(LeadAudit::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])->select('lead_number')->distinct()->get()->count();
        $number_of_days_count = QueryBuilder::for(LeadAudit::class)->allowedFilters(AllowedFilter::scope('start'), AllowedFilter::scope('end'), 'project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])->select('created_at')->distinct()->get();
        $get_number_of_days_count = [];
        foreach ($number_of_days_count as $audits){
            $newArray = [];
            if($audits->created_at != ''){
                $newArray[] = $audits->created_at->format('Y-m-d');
                array_push($get_number_of_days_count, $newArray);
            }
        }
		$lead_audited = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->get()->count();

		$fresh_lead_count = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('type', 'fresh')
		->get()->count();
		$zero_tol_count = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('block_4', '>', '100')
		->get()->count();

		$record_not_found = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('record_not_found', '=', 'Yes')
		->get()->count();

		// $tat_is_high = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		// ->whereRaw("find_in_set('TAT is high',lat_feedback)")
		// ->get()->count();

		$tat_is_high = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('lat_feedback', 'regexp', 'TAT is high')
		->get()->count();

		$missed_followup = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('lat_feedback', 'regexp', 'Missed the follow up task')
		->get()->count();

		$false_enquiry = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('lat_feedback', 'regexp', 'Task Creation not done')
		->get()->count();

		$followup_lead_count = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->where('type', 'followup')
		->get()->count();

		$red_alert = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])->where('red_alert', 'Yes')
		->get()->count();

		$total_score = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->whereBetween('created_at', [$from_date, $to_date])
		->get()->avg('total_score');

		$soft_skills_count = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->where('block_1', '!=', 'NA')->whereBetween('created_at', [$from_date, $to_date])
		->get()->avg('block_1');

		$product_knowledge_count = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->where('block_2', '!=', 'NA')->whereBetween('created_at', [$from_date, $to_date])
		->get()->avg('block_2');

		$lms_update_count = QueryBuilder::for(LeadAudit::class)->allowedFilters('project', 'lead_source', 'lead_stage', 'lead_owner', 'lat_executive', 'total_score', 'audit_list', 'type', 'record_not_found', 'lat_feedback', 'red_alert', 'soft_skills', 'product_knowledge', 'lms_update')->where('block_3', '!=', 'NA')->whereBetween('created_at', [$from_date, $to_date])
		->get()->avg('block_3');
    	$dashboad = new \stdClass;
    	$dashboad->all_leads = $total_leads;
		$dashboad->lead_audited = $lead_audited;
		$dashboad->total_agents = $total_lead_owners;
		$dashboad->total_leads_audited = $total_leads_audited;
		$dashboad->fresh_lead_count = $fresh_lead_count;
		$dashboad->zero_tol_count = $zero_tol_count;
		$dashboad->record_not_found = $record_not_found;
		$dashboad->tat_is_high = $tat_is_high;
		$dashboad->missed_followup = $missed_followup;
		$dashboad->false_enquiry = $false_enquiry;
        $dashboad->day_length = 0;
		// $dashboad->day_length = ceil($lead_audited/$day_length+1);
        // $dashboad->day_length = ceil($lead_audited/collect($get_number_of_days_count)->unique()->count());
        // $dashboad->days_audited = collect($get_number_of_days_count)->unique();
		$dashboad->followup_lead_count = $followup_lead_count;
		$dashboad->red_alert = $red_alert;
        // $dashboad->red_alert = $to_date;
		$dashboad->total_score = ceil($total_score).'%';
		$dashboad->soft_skills_count = ceil($soft_skills_count).'%';
		$dashboad->product_knowledge_count = ceil($product_knowledge_count).'%';
		$dashboad->lms_update_count = ceil($lms_update_count).'%';
    	return response()->json($dashboad, 200);
    }
    public function index($project){
    	switch($project){
    		case 'agr':
   			$current_project = 'AGR';
	    	$all_status = LeadsAgr::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsAgr::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsAgr::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'hg':
    		$current_project = 'HG';
	    	$all_status = LeadsHg::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsHg::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsHg::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
            case 'bp':
            $current_project = 'BP';
            $all_status = LeadsBP::select('lead_stage')->distinct()->get();
            $all_source = LeadsBP::select('lead_source')->distinct()->get();
            $lead_owners = LeadsBP::select('lead_owner')->distinct()->get();
            return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
            break;

    		case 'os':
    		$current_project = 'OS';
	    	$all_status = LeadsOS::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsOS::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsOS::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'vib':
    		$current_project = 'VIB';
	    	$all_status = LeadsVIB::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsVIB::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsVIB::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'et':
    		$current_project = 'Eternity';
	    	$all_status = LeadsVIB::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsVIB::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsVIB::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'jr':
    		$current_project = 'JR';
	    	$all_status = LeadsJR::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsJR::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsJR::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'js':
    		$current_project = 'JS';
	    	$all_status = LeadsSiruseri::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsSiruseri::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsSiruseri::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'padur':
    		$current_project = 'Padur';
	    	$all_status = LeadsSiruseri::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsSiruseri::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsSiruseri::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'siruseri':
    		$current_project = 'Siruseri';
	    	$all_status = LeadsSiruseri::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsSiruseri::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsSiruseri::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'ameenpur':
    		$current_project = 'Ameenpur';
	    	$all_status = LeadsHyd::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsHyd::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsHyd::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'bachupally':
    		$current_project = 'Bachupally';
	    	$all_status = LeadsHyd::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsHyd::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsHyd::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'gandimaisamma':
    		$current_project = 'Gandimaisamma';
	    	$all_status = LeadsHyd::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsHyd::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsHyd::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		case 'tsai':
    		$current_project = 'TSAI Apartments';
	    	$all_status = LeadsTsai::select('lead_stage')->distinct()->get();
	    	$all_source = LeadsTsai::select('lead_source')->distinct()->get();
	    	$lead_owners = LeadsTsai::select('lead_owner')->distinct()->get();
	        return view('leads.index', compact(array('all_status', 'all_source', 'current_project', 'lead_owners')));
    		break;
    		// case 'hyd':
	    	// $all_status = LeadsHyd::select('lead_stage')->distinct()->get();
	    	// $all_source = LeadsHyd::select('lead_source')->distinct()->get();
	     //    return view('leads.index', compact(array('all_status', 'all_source')));
    		// break;
    		
    		// default:
    		// break;
    	}
    }
    public function view($table_name, $lead_id){
    	$lead = DB::table($table_name)->where('lead_id', $lead_id)->first();
    	if($lead->contact_number){
    		$lead->contact_number = preg_replace('/.{8}$/', '********',  $lead->contact_number);
    	}
    	if($lead->email){
    		$lead->email = $this->hide_mail($lead->email);
    	}
    	$lsq_act = $this->get_activity($lead->project, $lead_id);
    	$users = User::where('role_id', '11')->get();
    	switch ($lead->project) {
    		case 'AGR':
            $current_lead = LeadsAgr::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'agr').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to AGR Leads</a>';
    		break;
    		case 'HG':
            $current_lead = LeadsHg::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'hg').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to HG Leads</a>';
    		break;
            case 'BP':
            $current_lead = LeadsBP::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'bp').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to BP Leads</a>';
            break;
    		case 'OS':
            $current_lead = LeadsOS::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'os').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to OS Leads</a>';
    		break;
    		case 'VIB':
            $current_lead = LeadsVIB::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'vib').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to VIB Leads</a>';
    		break;
    		case 'Eternity':
            $current_lead = LeadsVIB::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'et').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Eternity Leads</a>';
    		break;
    		case 'JR':
            $current_lead = LeadsJR::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'jr').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to JR Leads</a>';
    		break;
    		case 'JS':
            $current_lead = LeadsSiruseri::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'js').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to JS Leads</a>';
    		break;
    		case 'Padur':
            $current_lead = LeadsSiruseri::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'padur').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Padur Leads</a>';
    		break;
    		case 'Siruseri':
            $current_lead = LeadsSiruseri::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'siruseri').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Siruseri Leads</a>';
    		break;
    		case 'Ameenpur':
            $current_lead = LeadsHyd::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'ameenpur').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Ameenpur Leads</a>';
    		break;
    		case 'Bachupally':
            $current_lead = LeadsHyd::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'bachu').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Bachupally Leads</a>';
    		break;
    		case 'Gandimaisamma':
            $current_lead = LeadsHyd::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'gandimaisamma').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Gandimaisamma Leads</a>';
    		break;
    		case 'TSAI Apartments':
            $current_lead = LeadsTsai::where('lead_id', $lead->lead_id)->withCount('audit')->first();
            $back_url = '<a href="'.route('leads_index', 'tsai').'" class="btn btn-danger btn-bold"><i class="fa fa-undo"></i> Back to Tsai Leads</a>';
    		break;
    		// case 'Ameenpur':
      //       $current_lead = LeadsHyd::where('lead_id', $lead->lead_id)->first();
    		// break;
    		// case 'Bachupally':
      //       $current_lead = LeadsHyd::where('lead_id', $lead->lead_id)->first();
    		// break;
    		// case 'Gandimaisamma':
      //       $current_lead = LeadsHyd::where('lead_id', $lead->lead_id)->first();
    		// break;
    	}
    	return view('leads.view', compact(array('lead', 'lsq_act', 'users', 'current_lead', 'back_url')));
    }
    public function hide_mail($email){
        $new_mail = "";
        $mail_part1 = explode("@", $email);
        $mail_part2 = substr($mail_part1[0],4); // Sub string after fourth character.
        $new_mail = substr($mail_part1[0],0,4); // Add first four character part.
        $new_mail .= str_repeat("*", strlen($mail_part2))."@"; // Replace *. And add @
        $new_mail .= $mail_part1[1]; // Add last part.
        return $new_mail;
    }
    public function store_lead_audit(Request $request){
    	$na_json = '';
        if(Auth::check()){
            $user = Auth::user();
        }
        if(isset($request->lat_feedback)){
        	$lat_feedback = implode(',', $request->get('lat_feedback'));
        }
        else{
        	$lat_feedback = NULL;
        }
        if($request->record_not_found =='yes'){
	        $record_not_found = 'Yes';
        }
        else{
	        $record_not_found = 'No';
        }
        if($request->get('type') == "fresh"){
        	$block_1 = NULL;
        	$block_2 = NULL;
        	$block_3 = NULL;
        	$block_4 = NULL;
        	$block_count_1 = NULL;
        	$block_count_2 = NULL;
        	$block_count_3 = NULL;
        	$block_count_4 = NULL;

        	if($request->input('new_na_block.a1') != "1"){
        		$block_1 += $request->score[1];
        		$block_count_1 += 6;
        	}
        	if($request->input('new_na_block.a2') != "1"){
        		$block_1 += $request->score[2];
        		$block_count_1 += 6;
        	}
        	if($request->input('new_na_block.a3') != "1"){
        		$block_1 += $request->score[3];
        		$block_count_1 += 6;
        	}
        	if($request->input('new_na_block.a4') != "1"){
        		$block_1 += $request->score[4];
        		$block_count_1 += 7;
        	}

        	if($request->input('new_na_block.b1') != "1"){
        		$block_2 += $request->score[5];
        		$block_count_2 += 5;
        	}
        	if($request->input('new_na_block.b2') != "1"){
        		$block_2 += $request->score[6];
        		$block_count_2 += 5;
        	}
        	if($request->input('new_na_block.b3') != "1"){
        		$block_2 += $request->score[7];
        		$block_count_2 += 2;
        	}
        	if($request->input('new_na_block.b4') != "1"){
        		$block_2 += $request->score[8];
        		$block_count_2 += 2;
        	}
        	if($request->input('new_na_block.b5') != "1"){
        		$block_2 += $request->score[9];
        		$block_count_2 += 4;
        	}
        	if($request->input('new_na_block.b6') != "1"){
        		$block_2 += $request->score[10];
        		$block_count_2 += 2;
        	}

        	if($request->input('new_na_block.c1') != "1"){
        		$block_3 += $request->score[11];
        		$block_count_3 += 10;
        	}
        	if($request->input('new_na_block.c2') != "1"){
        		$block_3 += $request->score[12];
        		$block_count_3 += 5;
        	}
        	if($request->input('new_na_block.c3') != "1"){
        		$block_3 += $request->score[13];
        		$block_count_3 += 5;
        	}

        	if($request->input('new_na_block.d1') != "1"){
        		$block_4 += $request->score[14];
        		$block_count_4 += 10;
        	}
        	if($request->input('new_na_block.d2') != "1"){
        		$block_4 += $request->score[15];
        		$block_count_4 += 10;
        	}
        	if($request->input('new_na_block.d3') != "1"){
        		$block_4 += $request->score[16];
        		$block_count_4 += 15;
        	}
        	// $block_1_score = ceil($block_1/$block_count_1*100);
        	// $block_2_score = ceil($block_2/$block_count_2*100);
        	// $block_3_score = ceil($block_3/$block_count_3*100);
        	$all_block_score = NULL;
        	$total_blocks = NULL;
        	$zero_tolerance = false;

        	if($request->block_1_na == 1 || $block_count_1 == 0){
        		$block_1_score = 'NA';
        	}
        	else{
        		$block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
        		$block_1_onlyforcount = ceil($block_1/$block_count_1*100);
        		$all_block_score += $block_1_onlyforcount;
        		$total_blocks = 1;
        	}
        	if($request->block_2_na == 1 || $block_count_2 == 0){
        		$block_2_score = 'NA';
        	}
        	else{
        		$block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
        		$block_2_onlyforcount = ceil($block_2/$block_count_2*100);
        		$all_block_score += $block_2_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->block_3_na == 1 || $block_count_3 == 0){
        		$block_3_score = 'NA';
        	}
        	else{
        		$block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);
        		$block_3_onlyforcount = ceil($block_3/$block_count_3*100);
        		$all_block_score += $block_3_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->block_4_na == 1 || $block_count_4 == 0){
        		$block_4_score = 'NA';
        	}
        	else{
        		$block_4_score = $block_count_4 == 0? 100:ceil($block_4/$block_count_4*100);
        		$block_4_onlyforcount = ceil($block_4/$block_count_4*100);
        		$all_block_score += $block_4_onlyforcount;
        		$total_blocks += 1;
        		if($block_4_onlyforcount<100){
        			$zero_tolerance = true;
        		}
        	}

	        // $block_1 = $request->score[1] + $request->score[2] + $request->score[3] + $request->score[4];
	        // $block_2 = $request->score[5] + $request->score[6] + $request->score[7];
	        // $block_3 = $request->score[8] + $request->score[9] + $request->score[10];

	        // $total_score = $block_3_score + $block_2_score + $block_1_score;
        	if($zero_tolerance == true){
        		$total_score = 0;
        	}
        	elseif(is_numeric($all_block_score) && $total_blocks > 0) {
	        	$total_score = ceil($all_block_score/$total_blocks);
        	}
        	else{
        		$total_score = 'NA';
        	}

	        // $block_1_score = $request->score[1] + $request->score[2] + $request->score[3] + $request->score[4];
	        // $block_2_score = $request->score[5] + $request->score[6] + $request->score[7] + $request->score[8];
	        // $block_3_score = $request->score[9] + $request->score[10] + $request->score[11];
	        // $total_score = $block_3_score + $block_2_score + $block_1_score;
	        $na_json = json_encode($request->get('new_na_block'));
        }
        elseif($request->get('type') == "followup"){
        	$block_1 = NULL;
        	$block_2 = NULL;
        	$block_3 = NULL;
        	$block_4 = NULL;
        	$block_count_1 = NULL;
        	$block_count_2 = NULL;
        	$block_count_3 = NULL;
        	$block_count_4 = NULL;

        	if($request->input('follow_na_block.a1') != "1"){
        		$block_1 += $request->score[1];
        		$block_count_1 += 5;
        	}
        	if($request->input('follow_na_block.a2') != "1"){
        		$block_1 += $request->score[2];
        		$block_count_1 += 3;
        	}
        	if($request->input('follow_na_block.a3') != "1"){
        		$block_1 += $request->score[3];
        		$block_count_1 += 2;
        	}
        	if($request->input('follow_na_block.a4') != "1"){
        		$block_1 += $request->score[4];
        		$block_count_1 += 5;
        	}

        	if($request->input('follow_na_block.b1') != "1"){
        		$block_2 += $request->score[5];
        		$block_count_2 += 15;
        	}
        	if($request->input('follow_na_block.b2') != "1"){
        		$block_2 += $request->score[6];
        		$block_count_2 += 20;
        	}

        	if($request->input('follow_na_block.c1') != "1"){
        		$block_3 += $request->score[7];
        		$block_count_3 += 5;
        	}
        	if($request->input('follow_na_block.c2') != "1"){
        		$block_3 += $request->score[8];
        		$block_count_3 += 2;
        	}
        	if($request->input('follow_na_block.c3') != "1"){
        		$block_3 += $request->score[9];
        		$block_count_3 += 3;
        	}

        	if($request->input('follow_na_block.d1') != "1"){
        		$block_4 += $request->score[10];
        		$block_count_4 += 15;
        	}
        	if($request->input('follow_na_block.d2') != "1"){
        		$block_4 += $request->score[11];
        		$block_count_4 += 10;
        	}
        	if($request->input('follow_na_block.d3') != "1"){
        		$block_4 += $request->score[12];
        		$block_count_4 += 10;
        	}


        	$all_block_score = NULL;
        	$total_blocks = NULL;
        	$zero_tolerance = false;

        	// if($request->input('follow_na_block.d1') != "1"){
        	// 	$zero_tolerance = false;
        	// }
        	// elseif($request->input('follow_na_block.d2') != "1"){
        	// 	$zero_tolerance = false;
        	// }
        	// elseif($request->input('follow_na_block.d3') != "1"){
        	// 	$zero_tolerance = false;
        	// }
        	// elseif($request->score[10] == 0){
        	// 	$zero_tolerance = true;
        	// }
        	// elseif($request->score[11] == 0){
        	// 	$zero_tolerance = true;
        	// }
        	// elseif($request->score[12] == 0){
        	// 	$zero_tolerance = true;
        	// }
        	if($request->block_1_na == 1 || $block_count_1 == 0){
        		$block_1_score = 'NA';
        	}
        	else{
        		$block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
        		$block_1_onlyforcount = ceil($block_1/$block_count_1*100);
        		$all_block_score += $block_1_onlyforcount;
        		$total_blocks = 1;
        	}
        	if($request->block_2_na == 1 || $block_count_2 == 0){
        		$block_2_score = 'NA';
        	}
        	else{
        		$block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
        		$block_2_onlyforcount = ceil($block_2/$block_count_2*100);
        		$all_block_score += $block_2_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->block_3_na == 1 || $block_count_3 == 0){
        		$block_3_score = 'NA';
        	}
        	else{
        		$block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);
        		$block_3_onlyforcount = ceil($block_3/$block_count_3*100);
        		$all_block_score += $block_3_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->block_4_na == 1 || $block_count_4 == 0){
        		$block_4_score = 'NA';
        	}
        	else{
        		$block_4_score = $block_count_4 == 0? 100:ceil($block_4/$block_count_4*100);
        		$block_4_onlyforcount = ceil($block_4/$block_count_4*100);
        		$all_block_score += $block_4_onlyforcount;
        		$total_blocks += 1;
        		if($block_4_onlyforcount<100){
        			$zero_tolerance = true;
        		}
        	}

        	// $block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
        	// $block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
        	// $block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);

	        // $block_1 = $request->score[1] + $request->score[2] + $request->score[3] + $request->score[4];
	        // $block_2 = $request->score[5] + $request->score[6] + $request->score[7];
	        // $block_3 = $request->score[8] + $request->score[9] + $request->score[10];
        	
        	if($zero_tolerance == true){
        		$total_score = 0;
        	}
        	elseif (is_numeric($all_block_score) && $total_blocks > 0) {
	        	$total_score = ceil($all_block_score/$total_blocks);
        	}
        	else{
        		$total_score = 'NA';
        	}
	        // $total_score = $block_3_score + $block_2_score + $block_1_score;
	        // $total_score = ceil($total_score/3);
	        $na_json = json_encode($request->get('follow_na_block'));
        }
        if($request->red_alert =='yes'){





            //$mail_cc = array('leadaudits@alliancein.com');
        $mail_cc = array('rajendrajoshi@alliancein.com','mohammedidris@alliancein.com', 'vijay.narayana@alliancein.com', 'gayathri.r@alliancein.com', 'suhailahmed.s@alliancein.com', 'john.prashanth@alliancein.com', 'parmitha.g@alliancein.com','udayakumar.n@alliancein.com', $request->get('lead_owner_email'), 'rajanish.dixit@alliancein.com');
        	if($request->get('project') =='JS' || $request->get('project') =='Padur' || $request->get('project') =='Siruseri'){
        		// $mail_to = array('mohammedidris@alliancein.com');
        		$mail_to = array('radhakrishnan@alliancein.com', 'pemmaiah@alliancein.com');
        		$to_name = 'Radhakrishnan';
        	}
        	elseif($request->get('project') =='AGR' || $request->get('project') =='JR'){
        		// $mail_to = array('mohammedidris@alliancein.com');
        		$mail_to = array('vinesh@urbanrise.in', 'kamalraj@alliancein.com');
        		$to_name = 'Vinesh';
        	}

            elseif($request->get('project') =='BP' || $request->get('project') =='BP'){
                // $mail_to = array('mohammedidris@alliancein.com');
                $mail_to = array('cmo@urbanrise.in', 'sudhakar@urbanrise.in');
                $to_name = 'Vinesh';
            }

        	elseif($request->get('project') =='VIB' || $request->get('project') =='Eternity' || $request->get('project') =='TSAI Apartments'){
        		$mail_to = array('anoop.p@urbanrise.in', 'madhu@alliancein.com', 'sathya.c@alliancein.com', 'rajkumar.sp@alliancein.com');
        		// $mail_to = array('madhu@alliancein.com');
        		$to_name = 'Anoop';
        	}
            elseif($request->get('project') =='Ameenpur'){
                $mail_to = array('cmo@urbanrise.in', 'sudhakar@urbanrise.in');
                // $mail_to = array('madhu@alliancein.com');
                $to_name = '';
            }
        	else{
        		$mail_to = NULL;
        		$to_name = NULL;
        	}

        	// $to_name = 'Vijay S';
	        $red_alert = 'Yes';
        	// $mail_cc = array('vijay.cs@alliancein.com', 'gayathri.r@alliancein.com', 'mohammedidris@alliancein.com', 'gayathri.r@alliancein.com', 'suhailahmed.s@alliancein.com', 'parmitha.g@alliancein.com');
        	// $mail_to = $user->email;


        	if(!empty($mail_to)){
		        $mdata = array(
		            'to' => $mail_to,
		            'cc' => $mail_cc,
		            'to_name' => $to_name,
		            'from' => $user->email,
		            'from_name' => $user->name,
		            'subject' => ' RED ALERT - '.$request->get('lead_number'),
		            'email_content' => $request->get('email_content'),
		            'lead_number' => $request->get('lead_number'),
		            'lead_owner' => $request->get('lead_owner'),
		            'project' => $request->get('project'),
		            'detailed_remark' => $request->get('detailed_remark'),
		            'lead_name' => $request->get('lead_name'),
		            'lead_source' => $request->get('lead_source'),
		            'lead_stage' => $request->get('lead_stage'),
		            'created_time' => date('Y-m-d H:i:s')
		        );
		        Mail::to($mdata['to'])->cc($mdata['cc'])->send(new SendRedAlert($mdata));
		        Mail::to('vijay.cs@alliancein.com')->send(new SendRedAlert($mdata));
        	}
        }
        else{
        	$red_alert = 'No';
        }
    	$store_lead_audit = new LeadAudit([
		'lead_number' => $request->get('lead_number'),
		'project' => $request->get('project'),
		'lead_name' => $request->get('lead_name'),
		'created_on' => $request->get('created_on'),
		'lead_id' => $request->get('lead_id'),
		'lead_stage' => $request->get('lead_stage'),
		'lead_source' => $request->get('lead_source'),
		'contact_number' => $request->get('contact_number'),
		'email' => $request->get('email'),
		'url' => $request->get('url'),
		'lead_owner' => $request->get('lead_owner'),
		'lat_feedback' => $lat_feedback,
		'detailed_remark' => $request->get('detailed_remark'),
		'lat_executive' => $user->name,
		'lat_action' => $request->get('lat_action'),
		'block_1' => $block_1_score,
		'block_2' => $block_2_score,
		'block_3' => $block_3_score,
		'block_4' => $block_4_score,
		'type' => $request->get('type'),
		'score' => json_encode($request->get('score')),
		'follow_na_block' => $na_json,
		'total_score' => $total_score,
		'record_not_found' => $record_not_found,
		'red_alert' => $red_alert,
		'created_by' => $user->name,
    	]);
    	$store_lead_audit->save();
    	return Redirect::back()->with('success','Lead Audit Added Successfully!');
    }
    public function send_red_alert_email(){
        $get_red_alert = LeadAudit::where('project', 'TSAI Apartments')->where('red_alert', 'Yes')->whereDate('created_at', Carbon::today())->get();
        foreach ($get_red_alert as $audit){
            
            //$mail_cc = array('leadaudits@alliancein.com');
          $mail_cc = array('rajendrajoshi@alliancein.com', 'mohammedidris@alliancein.com', 'vijay.narayana@alliancein.com', 'gayathri.r@alliancein.com', 'john.prashanth@alliancein.com', 'suhailahmed.s@alliancein.com', 'parmitha.g@alliancein.com','udayakumar.n@alliancein.com', 'rajanish.dixit@alliancein.com');
            $mail_to = array('anoop.p@urbanrise.in', 'madhu@alliancein.com', 'hariharan.k@proptiger.com', 'sathya.c@alliancein.com', 'rajkumar.sp@alliancein.com');
            $to_name = 'Anoop';

        if(Auth::check()){
            $user = Auth::user();
        }
            $mdata = array(
                'to' => $mail_to,
                'cc' => $mail_cc,
                'to_name' => $to_name,
                'from' => '',
                'from_name' => $user->name,
                'subject' => ' RED ALERT - '.$audit->lead_number,
                'email_content' => $audit->email_content,
                'lead_number' => $audit->lead_number,
                'lead_owner' => $audit->lead_owner,
                'project' => $audit->project,
                'detailed_remark' => $audit->detailed_remark,
                'lead_name' => $audit->lead_name,
                'lead_source' => $audit->lead_source,
                'lead_stage' => $audit->lead_stage,
                'created_time' => date('Y-m-d H:i:s')
            );
            echo $audit->lead_name;
            echo '<br>';
            Mail::to($mdata['to'])->cc($mdata['cc'])->send(new SendRedAlert($mdata));
        }
    }
    public function reupdate_lead_audit(){

        $from = date('Y-m-d', strtotime('today - 20 days'));
    	$from_date = Carbon::parse($from);
        $to_date = now();
    	$all_audits = LeadAudit::whereBetween('created_at', [$from_date, $to_date])->get();
    	foreach ($all_audits as $audit) {
    		$na_block = json_decode($audit->follow_na_block);
    		$score = json_decode($audit->score);
    		// print_r($na_block);

	        if($audit->type == "fresh"){
	        	$block_1 = NULL;
	        	$block_2 = NULL;
	        	$block_3 = NULL;
	        	$block_4 = NULL;
	        	$block_count_1 = NULL;
	        	$block_count_2 = NULL;
	        	$block_count_3 = NULL;
	        	$block_count_4 = NULL;

	        	if(empty($na_block->a1)){
	        		$block_1 += $score->{1};
	        		$block_count_1 += 6;
	        	}
	        	if(empty($na_block->a2)){
	        		$block_1 += $score->{2};
	        		$block_count_1 += 6;
	        	}
	        	if(empty($na_block->a3)){
	        		$block_1 += $score->{3};
	        		$block_count_1 += 6;
	        	}
	        	if(empty($na_block->a4)){
	        		$block_1 += $score->{4};
	        		$block_count_1 += 7;
	        	}

	        	if(empty($na_block->b1)){
	        		$block_2 += $score->{5};
	        		$block_count_2 += 5;
	        	}
	        	if(empty($na_block->b2)){
	        		$block_2 += $score->{6};
	        		$block_count_2 += 5;
	        	}
	        	if(empty($na_block->b3)){
	        		$block_2 += $score->{7};
	        		$block_count_2 += 2;
	        	}
	        	if(empty($na_block->b4)){
	        		$block_2 += $score->{8};
	        		$block_count_2 += 2;
	        	}
	        	if(empty($na_block->b5)){
	        		$block_2 += $score->{9};
	        		$block_count_2 += 4;
	        	}
	        	if(empty($na_block->b6)){
	        		$block_2 += $score->{10};
	        		$block_count_2 += 2;
	        	}

	        	if(empty($na_block->c1)){
	        		$block_3 += $score->{11};
	        		$block_count_3 += 10;
	        	}
	        	if(empty($na_block->c2)){
	        		$block_3 += $score->{12};
	        		$block_count_3 += 5;
	        	}
	        	if(empty($na_block->c3)){
	        		$block_3 += $score->{13};
	        		$block_count_3 += 5;
	        	}

	        	if(empty($na_block->d1)){
	        		$block_4 += $score->{14};
	        		$block_count_4 += 10;
	        	}
	        	if(empty($na_block->d2)){
	        		$block_4 += $score->{15};
	        		$block_count_4 += 10;
	        	}
	        	if(empty($na_block->d3)){
	        		$block_4 += $score->{16};
	        		$block_count_4 += 15;
	        	}
	        	// $block_1_score = ceil($block_1/$block_count_1*100);
	        	// $block_2_score = ceil($block_2/$block_count_2*100);
	        	// $block_3_score = ceil($block_3/$block_count_3*100);
	        	$all_block_score = NULL;
	        	$total_blocks = NULL;
	        	$zero_tolerance = false;


	        	if($audit->block_1 == 'NA' || $block_count_1 == 0){
	        		$block_1_score = 'NA';
	        	}
	        	else{
	        		$block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
	        		$block_1_onlyforcount = ceil($block_1/$block_count_1*100);
	        		$all_block_score += $block_1_onlyforcount;
	        		$total_blocks = 1;
	        	}
	        	if($audit->block_2 == 'NA' || $block_count_2 == 0){
	        		$block_2_score = 'NA';
	        	}
	        	else{
	        		$block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
	        		$block_2_onlyforcount = ceil($block_2/$block_count_2*100);
	        		$all_block_score += $block_2_onlyforcount;
	        		$total_blocks += 1;
	        	}
	        	if($audit->block_3 == 'NA' || $block_count_3 == 0){
	        		$block_3_score = 'NA';
	        	}
	        	else{
	        		$block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);
	        		$block_3_onlyforcount = ceil($block_3/$block_count_3*100);
	        		$all_block_score += $block_3_onlyforcount;
	        		$total_blocks += 1;
	        	}
	        	if($audit->block_4 == 'NA' || $block_count_4 == 0){
	        		$block_4_score = 'NA';
	        	}
	        	else{
	        		$block_4_score = $block_count_4 == 0? 100:ceil($block_4/$block_count_4*100);
	        		$block_4_onlyforcount = ceil($block_4/$block_count_4*100);
	        		$all_block_score += $block_4_onlyforcount;
	        		$total_blocks += 1;
	        		if($block_4_onlyforcount<100){
	        			$zero_tolerance = true;
	        		}
	        	}

	        	if($zero_tolerance == true){
	        		$total_score = 0;
	        	}
	        	elseif(is_numeric($all_block_score) && $total_blocks > 0) {
		        	$total_score = ceil($all_block_score/$total_blocks);
	        	}
	        	else{
	        		$total_score = 'NA';
	        	}

	        }
	        if($audit->type == "followup"){
	        	$block_1 = NULL;
	        	$block_2 = NULL;
	        	$block_3 = NULL;
	        	$block_4 = NULL;
	        	$block_count_1 = NULL;
	        	$block_count_2 = NULL;
	        	$block_count_3 = NULL;
	        	$block_count_4 = NULL;

	        	if(empty($na_block->a1)){
	        		$block_1 += $score->{1};
	        		$block_count_1 += 5;
	        	}
	        	if(empty($na_block->a2)){
	        		$block_1 += $score->{2};
	        		$block_count_1 += 3;
	        	}
	        	if(empty($na_block->a3)){
	        		$block_1 += $score->{3};
	        		$block_count_1 += 2;
	        	}
	        	if(empty($na_block->a4)){
	        		$block_1 += $score->{4};
	        		$block_count_1 += 5;
	        	}

	        	if(empty($na_block->b1)){
	        		$block_2 += $score->{5};
	        		$block_count_2 += 15;
	        	}
	        	if(empty($na_block->b2)){
	        		$block_2 += $score->{6};
	        		$block_count_2 += 20;
	        	}

	        	if(empty($na_block->c1)){
	        		$block_3 += $score->{7};
	        		$block_count_3 += 5;
	        	}
	        	if(empty($na_block->c2)){
	        		$block_3 += $score->{8};
	        		$block_count_3 += 2;
	        	}
	        	if(empty($na_block->c3)){
	        		$block_3 += $score->{9};
	        		$block_count_3 += 3;
	        	}

	        	if(empty($na_block->d1)){
	        		$block_4 += $score->{10};
	        		$block_count_4 += 15;
	        	}
	        	if(empty($na_block->d2)){
	        		$block_4 += $score->{11};
	        		$block_count_4 += 10;
	        	}
	        	if(empty($na_block->d3)){
	        		$block_4 += $score->{12};
	        		$block_count_4 += 10;
	        	}

	        	$all_block_score = NULL;
	        	$total_blocks = NULL;
	        	$zero_tolerance = false;

	        	// if(!empty($na_block->d1)){
	        	// 	$zero_tolerance = false;
	        	// }
	        	// elseif(!empty($na_block->d2)){
	        	// 	$zero_tolerance = false;
	        	// }
	        	// elseif(!empty($na_block->d3)){
	        	// 	$zero_tolerance = false;
	        	// }
	        	// elseif($score->{10} == 0){
	        	// 	$zero_tolerance = true;
	        	// }
	        	// elseif($score->{11} == 0){
	        	// 	$zero_tolerance = true;
	        	// }
	        	// elseif($score->{12} == 0){
	        	// 	$zero_tolerance = true;
	        	// }
	        	if($audit->block_1 == 'NA' || $block_count_1 == 0){
	        		$block_1_score = 'NA';
	        	}
	        	else{
	        		$block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
	        		$block_1_onlyforcount = ceil($block_1/$block_count_1*100);
	        		$all_block_score += $block_1_onlyforcount;
	        		$total_blocks = 1;
	        	}
	        	if($audit->block_2 == 'NA' || $block_count_2 == 0){
	        		$block_2_score = 'NA';
	        	}
	        	else{
	        		$block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
	        		$block_2_onlyforcount = ceil($block_2/$block_count_2*100);
	        		$all_block_score += $block_2_onlyforcount;
	        		$total_blocks += 1;
	        	}
	        	if($audit->block_3 == 'NA' || $block_count_3 == 0){
	        		$block_3_score = 'NA';
	        	}
	        	else{
	        		$block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);
	        		$block_3_onlyforcount = ceil($block_3/$block_count_3*100);
	        		$all_block_score += $block_3_onlyforcount;
	        		$total_blocks += 1;
	        	}
	        	if($audit->block_4 == 'NA' || $block_count_4 == 0){
	        		$block_4_score = 'NA';
	        	}
	        	else{
	        		$block_4_score = $block_count_4 == 0? 100:ceil($block_4/$block_count_4*100);
	        		$block_4_onlyforcount = ceil($block_4/$block_count_4*100);
	        		$all_block_score += $block_4_onlyforcount;
	        		$total_blocks += 1;
	        		if($block_4_onlyforcount<100){
	        			$zero_tolerance = true;
	        		}
	        	}

	        	if($zero_tolerance == true){
	        		$total_score = 0;
	        	}
	        	elseif (is_numeric($all_block_score) && $total_blocks > 0) {
		        	$total_score = ceil($all_block_score/$total_blocks);
	        	}
	        	else{
	        		$total_score = 'NA';
	        	}
	        }
	        if($audit->block_1 == 'NA'){
	        	$final_block_1_score = 'NA';
	        }
	        else{
	        	$final_block_1_score = $block_1_score;
	        }
	        if($audit->block_2 == 'NA'){
	        	$final_block_2_score = 'NA';
	        }
	        else{
	        	$final_block_2_score = $block_2_score;
	        }
	        if($audit->block_3 == 'NA'){
	        	$final_block_3_score = 'NA';
	        }
	        else{
	        	$final_block_3_score = $block_3_score;
	        }
	        if($audit->block_4 == 'NA'){
	        	$final_block_4_score = 'NA';
	        }
	        else{
	        	$final_block_4_score = $block_4_score;
	        }

	    	$lead_audit = LeadAudit::find($audit->id);
			$lead_audit->block_4 = $final_block_4_score;
			$lead_audit->total_score = $total_score;
	    	$lead_audit->save();
	    	echo 'Updated!<br>';
    		
    	}

    }
    public function update_lead_audit(Request $request, $id){

    	$update_lead_audit = LeadAudit::find($id);
        if(Auth::check()){
            $user = Auth::user();
        }
        if(isset($request->lat_feedback)){
        	$lat_feedback = implode(',', $request->get('lat_feedback'));
        }
        else{
        	$lat_feedback = NULL;
        }
        if($request->record_not_found =='yes'){
	        $record_not_found = 'Yes';
        }
        else{
	        $record_not_found = 'No';
        }
        $score_lable_name = 'score_'.$id;
        $edit_na_block_name = 'edit_na_block_'.$id;
        $edit_block_1_na = 'edit_block_1_na'.$id;
        $edit_block_2_na = 'edit_block_2_na'.$id;
        $edit_block_3_na = 'edit_block_3_na'.$id;
        $edit_block_4_na = 'edit_block_4_na'.$id;
        // $output = $request->$score_lable_name[1];
        // print_r($output);
        if($update_lead_audit->type == "fresh"){
        	$block_1 = NULL;
        	$block_2 = NULL;
        	$block_3 = NULL;
        	$block_4 = NULL;
        	$block_count_1 = NULL;
        	$block_count_2 = NULL;
        	$block_count_3 = NULL;
        	$block_count_4 = NULL;

        	if($request->input($edit_na_block_name.'.a1') != "1"){
        		$block_1 += $request->$score_lable_name[1];
        		$block_count_1 += 6;
        	}
        	if($request->input($edit_na_block_name.'.a2') != "1"){
        		$block_1 += $request->$score_lable_name[2];
        		$block_count_1 += 6;
        	}
        	if($request->input($edit_na_block_name.'.a3') != "1"){
        		$block_1 += $request->$score_lable_name[3];
        		$block_count_1 += 6;
        	}
        	if($request->input($edit_na_block_name.'.a4') != "1"){
        		$block_1 += $request->$score_lable_name[4];
        		$block_count_1 += 7;
        	}

        	if($request->input($edit_na_block_name.'.b1') != "1"){
        		$block_2 += $request->$score_lable_name[5];
        		$block_count_2 += 5;
        	}
        	if($request->input($edit_na_block_name.'.b2') != "1"){
        		$block_2 += $request->$score_lable_name[6];
        		$block_count_2 += 5;
        	}
        	if($request->input($edit_na_block_name.'.b3') != "1"){
        		$block_2 += $request->$score_lable_name[7];
        		$block_count_2 += 2;
        	}
        	if($request->input($edit_na_block_name.'.b4') != "1"){
        		$block_2 += $request->$score_lable_name[8];
        		$block_count_2 += 2;
        	}
        	if($request->input($edit_na_block_name.'.b5') != "1"){
        		$block_2 += $request->$score_lable_name[9];
        		$block_count_2 += 4;
        	}
        	if($request->input($edit_na_block_name.'.b6') != "1"){
        		$block_2 += $request->$score_lable_name[10];
        		$block_count_2 += 2;
        	}

        	if($request->input($edit_na_block_name.'.c1') != "1"){
        		$block_3 += $request->$score_lable_name[11];
        		$block_count_3 += 10;
        	}
        	if($request->input($edit_na_block_name.'.c2') != "1"){
        		$block_3 += $request->$score_lable_name[12];
        		$block_count_3 += 5;
        	}
        	if($request->input($edit_na_block_name.'.c3') != "1"){
        		$block_3 += $request->$score_lable_name[13];
        		$block_count_3 += 5;
        	}

        	if($request->input($edit_na_block_name.'.d1') != "1"){
        		$block_4 += $request->$score_lable_name[14];
        		$block_count_4 += 10;
        	}
        	if($request->input($edit_na_block_name.'.d2') != "1"){
        		$block_4 += $request->$score_lable_name[15];
        		$block_count_4 += 5;
        	}
        	if($request->input($edit_na_block_name.'.d3') != "1"){
        		$block_4 += $request->$score_lable_name[16];
        		$block_count_4 += 5;
        	}
        	// $block_1_score = ceil($block_1/$block_count_1*100);
        	// $block_2_score = ceil($block_2/$block_count_2*100);
        	// $block_3_score = ceil($block_3/$block_count_3*100);
        	$all_block_score = NULL;
        	$total_blocks = NULL;
        	$zero_tolerance = false;
        	if($request->$edit_block_1_na == 1){
        		$block_1_score = 'NA';
        	}
        	else{
        		$block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
        		$block_1_onlyforcount = ceil($block_1/$block_count_1*100);
        		$all_block_score += $block_1_onlyforcount;
        		$total_blocks = 1;
        	}
        	if($request->$edit_block_2_na == 1){
        		$block_2_score = 'NA';
        	}
        	else{
        		$block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
        		$block_2_onlyforcount = ceil($block_2/$block_count_2*100);
        		$all_block_score += $block_2_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->$edit_block_3_na == 1){
        		$block_3_score = 'NA';
        	}
        	else{
        		$block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);
        		$block_3_onlyforcount = ceil($block_3/$block_count_3*100);
        		$all_block_score += $block_3_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->$edit_block_4_na == 1){
        		$block_4_score = 'NA';
        	}
        	else{
        		$block_4_score = $block_count_4 == 0? 100:ceil($block_4/$block_count_4*100);
        		$block_4_onlyforcount = ceil($block_4/$block_count_4*100);
        		$all_block_score += $block_4_onlyforcount;
        		$total_blocks += 1;
	        		if($block_4_onlyforcount<100){
	        			$zero_tolerance = true;
	        		}
        	}

        	if($zero_tolerance == true){
        		$total_score = 0;
        	}
        	elseif(is_numeric($all_block_score) && $total_blocks > 0) {
	        	$total_score = ceil($all_block_score/$total_blocks);
        	}
        	else{
        		$total_score = 'NA';
        	}

	        // $block_1 = $request->score[1] + $request->score[2] + $request->score[3] + $request->score[4];
	        // $block_2 = $request->score[5] + $request->score[6] + $request->score[7];
	        // $block_3 = $request->score[8] + $request->score[9] + $request->score[10];

	        // $total_score = $block_3_score + $block_2_score + $block_1_score;
	        // $total_score = ceil($all_block_score/$total_blocks);

	        // $block_1_score = $request->score[1] + $request->score[2] + $request->score[3] + $request->score[4];
	        // $block_2_score = $request->score[5] + $request->score[6] + $request->score[7] + $request->score[8];
	        // $block_3_score = $request->score[9] + $request->score[10] + $request->score[11];
	        // $total_score = $block_3_score + $block_2_score + $block_1_score;
	        $na_json = json_encode($request->$edit_na_block_name);
        }
        elseif($update_lead_audit->type == "followup"){
        	$block_1 = NULL;
        	$block_2 = NULL;
        	$block_3 = NULL;
        	$block_4 = NULL;
        	$block_count_1 = NULL;
        	$block_count_2 = NULL;
        	$block_count_3 = NULL;
        	$block_count_4 = NULL;
        	if($request->input($edit_na_block_name.'.a1') != "1"){
        		$block_1 += $request->$score_lable_name[1];
        		$block_count_1 += 5;
        	}
        	if($request->input($edit_na_block_name.'.a2') != "1"){
        		$block_1 += $request->$score_lable_name[2];
        		$block_count_1 += 3;
        	}
        	if($request->input($edit_na_block_name.'.a3') != "1"){
        		$block_1 += $request->$score_lable_name[3];
        		$block_count_1 += 2;
        	}
        	if($request->input($edit_na_block_name.'.a4') != "1"){
        		$block_1 += $request->$score_lable_name[4];
        		$block_count_1 += 5;
        	}

        	if($request->input($edit_na_block_name.'.b1') != "1"){
        		$block_2 += $request->$score_lable_name[5];
        		$block_count_2 += 15;
        	}
        	if($request->input($edit_na_block_name.'.b2') != "1"){
        		$block_2 += $request->$score_lable_name[6];
        		$block_count_2 += 20;
        	}

        	if($request->input($edit_na_block_name.'.c1') != "1"){
        		$block_3 += $request->$score_lable_name[7];
        		$block_count_3 += 4;
        	}
        	if($request->input($edit_na_block_name.'.c2') != "1"){
        		$block_3 += $request->$score_lable_name[8];
        		$block_count_3 += 3;
        	}
        	if($request->input($edit_na_block_name.'.c3') != "1"){
        		$block_3 += $request->$score_lable_name[9];
        		$block_count_3 += 3;
        	}

        	if($request->input($edit_na_block_name.'.d1') != "1"){
        		$block_3 += $request->$score_lable_name[10];
        		$block_count_3 += 4;
        	}
        	if($request->input($edit_na_block_name.'.d2') != "1"){
        		$block_3 += $request->$score_lable_name[11];
        		$block_count_3 += 3;
        	}
        	if($request->input($edit_na_block_name.'.d3') != "1"){
        		$block_3 += $request->$score_lable_name[12];
        		$block_count_3 += 3;
        	}
        	$all_block_score = NULL;
        	$total_blocks = NULL;

        	$zero_tolerance = false;
        	if($request->$edit_block_1_na == 1){
        		$block_1_score = 'NA';
        	}
        	else{
        		$block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
        		$block_1_onlyforcount = ceil($block_1/$block_count_1*100);
        		$all_block_score += $block_1_onlyforcount;
        		$total_blocks = 1;
        	}
        	if($request->$edit_block_2_na == 1){
        		$block_2_score = 'NA';
        	}
        	else{
        		$block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
        		$block_2_onlyforcount = ceil($block_2/$block_count_2*100);
        		$all_block_score += $block_2_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->$edit_block_3_na == 1){
        		$block_3_score = 'NA';
        	}
        	else{
        		$block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);
        		$block_3_onlyforcount = ceil($block_3/$block_count_3*100);
        		$all_block_score += $block_3_onlyforcount;
        		$total_blocks += 1;
        	}
        	if($request->$edit_block_4_na == 1){
        		$block_4_score = 'NA';
        	}
        	else{
        		$block_4_score = $block_count_4 == 0? 100:ceil($block_4/$block_count_4*100);
        		$block_4_onlyforcount = ceil($block_4/$block_count_4*100);
        		$all_block_score += $block_4_onlyforcount;
        		$total_blocks += 1;
	        		if($block_4_onlyforcount<100){
	        			$zero_tolerance = true;
	        		}
        	}

        	if($zero_tolerance == true){
        		$total_score = 0;
        	}
        	elseif (is_numeric($all_block_score) && $total_blocks > 0) {
	        	$total_score = ceil($all_block_score/$total_blocks);
        	}
        	else{
        		$total_score = 'NA';
        	}
        	// $block_1_score = $block_count_1 == 0? 100:ceil($block_1/$block_count_1*100);
        	// $block_2_score = $block_count_2 == 0? 100:ceil($block_2/$block_count_2*100);
        	// $block_3_score = $block_count_3 == 0? 100:ceil($block_3/$block_count_3*100);

	        // $block_1 = $request->score[1] + $request->score[2] + $request->score[3] + $request->score[4];
	        // $block_2 = $request->score[5] + $request->score[6] + $request->score[7];
	        // $block_3 = $request->score[8] + $request->score[9] + $request->score[10];
	        // $total_score = ceil($all_block_score/$total_blocks);
	        // $total_score = $block_3_score + $block_2_score + $block_1_score;
	        // $total_score = ceil($total_score/3);
	        $na_json = json_encode($request->$edit_na_block_name);
        }
        if($request->red_alert =='yes'){
             //$mail_cc = array('leadaudits@alliancein.com');
        $mail_cc = array('rajendrajoshi@alliancein.com', 'mohammedidris@alliancein.com', 'vijay.narayana@alliancein.com', 'gayathri.r@alliancein.com', 'suhailahmed.s@alliancein.com', 'john.prashanth@alliancein.com', 'parmitha.g@alliancein.com', 'udayakumar.n@alliancein.com', 'rajanish.dixit@alliancein.com');
        	if($request->get('project') =='JS' || $request->get('project') =='Padur' || $request->get('project') =='Siruseri'){
        		$mail_to = array('mohammedidris@alliancein.com');
        		$mail_to = array('radhakrishnan@alliancein.com', 'pemmaiah@alliancein.com');
        		$to_name = 'Radhakrishnan';
        	}
        	elseif($request->get('project') =='AGR' || $request->get('project') =='JR'){
        		$mail_to = array('mohammedidris@alliancein.com');
        		$mail_to = array('vinesh@urbanrise.in', 'kamalraj@alliancein.com');
        		$to_name = 'Vinesh';
        	}
        	else{
        		$mail_to = NULL;
        		$to_name = NULL;
        	}
        	// $to_name = 'Mahimai Alex';
	        $red_alert = 'Yes';
        	
        	// $mail_cc = array('mahimai@alliancein.com', 'gayathri.r@alliancein.com', 'mohammedidris@alliancein.com', 'gayathri.r@alliancein.com', 'suhailahmeds@alliancein.com', 'parmitha.g@alliancein.com');
        	// $mail_to = $user->email;


        	if(!empty($mail_to)){
		        $mdata = array(
		            'to' => $mail_to,
		            'cc' => $mail_cc,
		            'to_name' => $to_name,
		            'from' => $user->email,
		            'from_name' => $user->name,
		            'subject' => ' RED ALERT - '.$request->get('lead_number'),
		            'email_content' => $request->get('email_content'),
		            'lead_number' => $request->get('lead_number'),
		            'lead_owner' => $request->get('lead_owner'),
		            'project' => $request->get('project'),
		            'detailed_remark' => $request->get('detailed_remark'),
		            'lead_name' => $request->get('lead_name'),
		            'lead_source' => $request->get('lead_source'),
		            'lead_stage' => $request->get('lead_stage'),
		            'created_time' => date('Y-m-d H:i:s')
		        );
		        Mail::to($mdata['to'])->cc($mdata['cc'])->send(new SendRedAlert($mdata));
		        Mail::to('vijay.cs@alliancein.com')->send(new SendRedAlert($mdata));
        	}
        }
        else{
        	$red_alert = 'No';
        }

		$update_lead_audit->lat_feedback = $lat_feedback;
		$update_lead_audit->detailed_remark = $request->get('detailed_remark');
		// $update_lead_audit->lat_executive = $request->get('lat_executive');
		$update_lead_audit->lat_action = $request->get('lat_action');
		$update_lead_audit->record_not_found = $record_not_found;
		$update_lead_audit->block_1 = $block_1_score;
		$update_lead_audit->block_2 = $block_2_score;
		$update_lead_audit->block_3 = $block_3_score;
		$update_lead_audit->block_4 = $block_4_score;
		$update_lead_audit->score = json_encode($request->get($score_lable_name));
		$update_lead_audit->follow_na_block = $na_json;
		$update_lead_audit->total_score = $total_score;
		$update_lead_audit->red_alert = $red_alert;

		$update_lead_audit->created_by = $user->name;
    	$update_lead_audit->save();
    	return Redirect::back()->with('success','Lead Audit Updated Successfully!');
    }
    public function get_activity($selected_project, $lead_id){

            $data_string = '{"Paging":{"Offset":"0","RowCount":"50"}}';
            //API List
            
            if($selected_project == 'AGR'){
                $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
                $notes_post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
            }
            if($selected_project == 'HG'){
                $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
                $notes_post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
            }

            if($selected_project == 'BP'){
                $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246";
                $notes_post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246";
            }


            if($selected_project == 'OS'){
                $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
                $notes_post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
            }
            if($selected_project == 'VIB'){
                $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
                $notes_post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
            }
            if($selected_project == 'Eternity'){
                $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
                $notes_post_uri = "https://api.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
            }
            if($selected_project == 'Padur'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
            }
            if($selected_project == 'JS'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
            }
            if($selected_project == 'Siruseri'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
            }
            if($selected_project == 'JR'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
            }
            if($selected_project == 'Ameenpur'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
            }
            if($selected_project == 'Bachupally'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
            }
            if($selected_project == 'Gandimaisamma'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
            }
            if($selected_project == 'TSAI Apartments'){
                $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814&leadId='.$lead_id;
                $notes_post_uri = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/RetrieveNote?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814';
            }

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $post_uri,
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
                "cache-control: no-cache"
              ),
            ));
            $activity_response = curl_exec($curl);
            $activity_response = json_decode($activity_response);
            curl_close($curl);
			$notes_data_string = '{"Parameter":{"RelatedId":"'.$lead_id.'","Id":""},"Paging":{"PageIndex":1,"PageSize":200},"Sorting":{"ColumnName":"CreatedOn","Direction":1}}';
            //Get Notes
            $notes_curl = curl_init();
            curl_setopt_array($notes_curl, array(
            CURLOPT_URL => $notes_post_uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $notes_data_string,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "cache-control: no-cache"
              ),
            ));
            $note_response = curl_exec($notes_curl);
            $note_response = json_decode($note_response);
            curl_close($notes_curl);
	        $act = array();
	        if(!empty($activity_response->ProspectActivities)){
		        foreach ($activity_response->ProspectActivities as $value) {
		            $act[] = $value;
		        }
	        }
	        // print_r($note_response);
	        if(!empty($note_response->List)){   
	            foreach ($note_response->List as $value) {
	                $act[] = $value;
	            }
	        }
	        $act = collect($act)->sortByDesc('CreatedOn');
	        return $act;
    }
    public function get_today_stage_activity($selected_project){

            $act = array();
            $imoprt_repeater = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12','13');
            foreach($imoprt_repeater as $repeater){
                $data_string = '{"Parameter": {"FromDate": "2021-07-12 00:00:00", "ToDate": "2021-07-12 23:59:59", "ActivityType":26},  "Paging": {"PageIndex": '.$repeater.', "PageSize": 1000 }, "Sorting": {"ColumnName": "CreatedOn","Direction": 1}}';
                switch($selected_project){
                    case 'agr':
                    $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
                    break;
                    case 'hg':
                    $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
                    break;
                    case 'bp':
                    $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246";
                    break;
                    case 'os':
                    $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
                    break;
                    case 'vib':
                    $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
                    break;
                    case 'eternity':
                    $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
                    break;
                    case 'padur':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
                    break;
                    case 'js':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
                    break;
                    case 'siruseri':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
                    break;
                    case 'jr':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
                    break;
                    case 'ameenpur':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
                    break;
                    case 'bachupally':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
                    break;
                    case 'gandimaisamma':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
                    break;
                    case 'tsai':
                    $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/RetrieveRecentlyModified?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814';
                    break;
                }

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $post_uri,
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
                    "cache-control: no-cache"
                  ),
                ));
                $activity_response = curl_exec($curl);
                $activity_response = json_decode($activity_response);
                curl_close($curl);

                if(!empty($activity_response->ProspectActivities)){
                    foreach ($activity_response->ProspectActivities as $value){
                        if($value->ActivityType == 26){
                            $act[] = $value->RelatedProspectId;
                        }
                    }
                }
            }
            $act = collect($act)->unique();
            // $activity_response = $activity_response->unique('id')
            // echo '<pre>';
            // print_r($act);
            // echo '</pre>';
            // echo count($act);
            $report = [];
            foreach ($act as $lead_id) {
                switch($selected_project){
                    case 'agr':
                    $get_lead = $this->get_lead_by_id('agr', $lead_id);
                    break;
                    case 'hg':
                    $get_lead = $this->get_lead_by_id('hg', $lead_id);
                    break;
                    case 'bp':
                    $get_lead = $this->get_lead_by_id('bp', $lead_id);
                    break;
                    case 'os':
                    $get_lead = $this->get_lead_by_id('os', $lead_id);
                    break;
                    case 'vib':
                    $get_lead = $this->get_lead_by_id('vib', $lead_id);
                    break;
                    case 'eternity':
                    $get_lead = $this->get_lead_by_id('vib', $lead_id);
                    break;
                    case 'padur':
                    $get_lead = $this->get_lead_by_id('siruseri', $lead_id);
                    break;
                    case 'js':
                    $get_lead = $this->get_lead_by_id('siruseri', $lead_id);
                    break;
                    case 'siruseri':
                    $get_lead = $this->get_lead_by_id('siruseri', $lead_id);
                    break;
                    case 'jr':
                    $get_lead = $this->get_lead_by_id('jr', $lead_id);
                    break;
                    case 'ameenpur':
                    $get_lead = $this->get_lead_by_id('hyd', $lead_id);
                    break;
                    case 'bachupally':
                    $get_lead = $this->get_lead_by_id('hyd', $lead_id);
                    break;
                    case 'gandimaisamma':
                    $get_lead = $this->get_lead_by_id('hyd', $lead_id);
                    break;
                    case 'tsai':
                    $get_lead = $this->get_lead_by_id('tsai', $lead_id);
                    break;
                }
                if(!empty($get_lead)){
                    $report[]['source'] = $get_lead[0]->Source;
                    $report[]['stage'] = $get_lead[0]->ProspectStage;
                }
            }
            echo '<pre>';
            print_r($report);
            echo '</pre>';
    }

    public function get_lead_by_id($project, $id){
        switch($project){
            case 'agr':
                $agr_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a&id=', $id);
                $email_response = (array)json_decode($agr_email_response);
            break;
            case 'hg':
                $hg_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8&id=', $id);
                $email_response = (array)json_decode($hg_email_response);
            break;
            

             case 'bp':
                $bp_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246&id=', $id);
                $email_response = (array)json_decode($hg_email_response);
            break;




            case 'os':
                $os_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf&id=', $id);
                $email_response = (array)json_decode($os_email_response);
            break;
            case 'vib':
                $vib_email_response = $this->get_lead('https://api.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&id=', $id);
                $email_response = (array)json_decode($vib_email_response);
            break;
            case 'jr':
                $jr_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd&id=', $id);
                $email_response = (array)json_decode($jr_email_response);
            break;
            case 'siruseri':
                $cngs_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&id=', $id);
                $email_response = (array)json_decode($cngs_email_response);
            break;
            case 'hyd':
                $hyd_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&id=', $id);
                $email_response = (array)json_decode($hyd_email_response);
            break;
            case 'tsai':
                $tsai_email_response = $this->get_lead('https://api-in21.leadsquared.com/v2/LeadManagement.svc/Leads.GetById?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814&id=', $id);
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

    public function export_lead_audit(Request $request)
    {
    	$file_name = 'lead_audit_list'.now().'.xlsx';
        return (new ExportLeadAudit)->download($file_name);
    }
    public function delete_lead_audit($id)
    {
    	$lead_audit = LeadAudit::find($id);
    	$lead_audit->delete();
    	return Redirect::back();
    }
    public function get_google_analytics(){
        // $data = Analytics::fetchVisitorsAndPageViews(Period::days(265));
        $analyticsData = Analytics::performQuery(
            Period::days(1),
            'ga:pageviews',
            // 'ga:users',
			    [
			        'metrics' => 'ga:sessions, ga:pageviews',
			        // 'metrics' => 'ga:sessions, ga:pageviews',
			        'dimensions' => 'ga:userType,ga:userDefinedValue,ga:source,ga:landingPagePath'

			        // 'metrics' => 'ga:sessions, ga:pageviews',
			        // // 'metrics' => 'ga:sessions, ga:pageviews',
			        // 'dimensions' => 'ga:mobileDeviceInfo,ga:source,ga:landingPagePath'
			    ]

        );
        echo '<pre>';
        print_r($analyticsData);
        // print_r($analyticsData['totalsForAllResults']);
        echo '</pre>';
    }
    public function internal_leads_datatables(Request $request){
    	$datas = LpLeads::orderBy('created_at','desc');
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
        //Order Status Filter
        if(isset($request->filter['project'])){
            $datas->whereIn('project', $request->filter['project']);
        }
        if(isset($request->filter['lp_id'])){
            $datas->where('lp_id', $request->filter['lp_id']);
        }
        $datas = $datas->get();
    	return DataTables::of($datas)
            // ->addColumn('leadsquared_status', function(LeadsAgr $data){
            // 	$contact_number = preg_replace('/.{8}$/', '********',  $data->contact_number);
            // 	return $contact_number;
            // })
            // ->rawColumns(['action', 'lead_audit'])
            ->toJson();
    }
    public function internal_leads_index(){
        $lp_id = LpLeads::select('lp_id')->distinct()->get();
        $projects = LpLeads::select('project')->distinct()->get();
        return view('leads.internal', compact(array('lp_id', 'projects')));
    }
    
     public function internal_leads_index1(){
        $lp_id = LpLeads::select('lp_id')->distinct()->get();
        $projects = LpLeads::select('project')->distinct()->get();
        return view('leads.internal', compact(array('lp_id', 'projects')));
    }
    
    
}
