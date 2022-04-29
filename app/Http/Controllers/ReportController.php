<?php

namespace App\Http\Controllers;
use App\LeadAudit;
use App\LeadsAgr;
use App\LeadsHg;
use App\LeadsOS;
use App\LeadsVIB;
use App\LeadsSiruseri;
use App\LeadsJR;
use App\LeadsBP;
use App\LeadsHyd;
use App\LeadsTsai;
use App\Creatives;
use App\Activity;
use App\FBLeads;
use App\Setting;
use App\Models\LpLeads;
use App\Models\CreativeReport;
use App\Models\SavedCreativeReport;
use Illuminate\Http\Request;
use App\Exports\ExportLeadAudit;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCreativeTask;
use App\Mail\SendRedAlert;
use App\Jobs\CreativeReportUpdate;
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

class ReportController extends Controller
{
    //

    public function creative_report(){
        return view('backend.reports.creative_reports');
    }
    public function get_water_meter_data(Request $request){
        $post_uri = 'https://cntdev.ru/api';
        $data_string = '{
        "offset": 0,
        "count": 100
        }';
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
                "Authorization: n3udupa@yahoo.co.in:vRHrHYbwCaCABzkvN2wrl0Z4GMkdU7Uf",
                "Connection: keep-alive",
                "Content-Type: application/json",
                "cache-control: no-cache"
              ),
            ));
            $activity_response = curl_exec($curl);
            $activity_response = json_decode($activity_response);
            curl_close($curl);
            echo '<pre>';
            print_r($activity_response);
            echo '</pre>';
    }
    public function creative_report_update(){
        CreativeReport::truncate();
        $project_list = array('AGR', 'HG', 'OS', 'BP', 'VIB', 'Eternity', 'Padur', 'JS', 'Siruseri', 'JR', 'Ameenpur', 'Bachupally', 'Gandimaisamma', 'TSAI Apartments');
        foreach ($project_list as $list) {
            $this->creative_report_generate($list);
        }
        return 'Updated!';
    }

    public function turncate_creative_report(){
        CreativeReport::truncate();
        return 'Updated!';
    }
    public function agr_creative_report(){
        $this->creative_report_generate('AGR');
        return 'Updated!';
    }
    public function hg_creative_report(){
        $this->creative_report_generate('HG');
        return 'Updated!';
    }
    public function os_creative_report(){
        $this->creative_report_generate('OS');
        return 'Updated!';
    }
    public function vib_creative_report(){
        $this->creative_report_generate('VIB');
        return 'Updated!';
    }
    public function bp_creative_report(){
        $this->creative_report_generate('BP');
        return 'Updated!';
    }
    public function eternity_creative_report(){
        $this->creative_report_generate('Eternity');
        return 'Updated!';
    }
    public function padur_creative_report(){
        $this->creative_report_generate('Padur');
        return 'Updated!';
    }
    public function js_creative_report(){
        $this->creative_report_generate('JS');
        return 'Updated!';
    }
    public function siruseri_creative_report(){
        $this->creative_report_generate('SIRUSERI');
        return 'Updated!';
    }
    public function ameenpur_creative_report(){
        $this->creative_report_generate('Ameenpur');
        return 'Updated!';
    }
    public function bachupally_creative_report(){
        $this->creative_report_generate('Bachupally');
        return 'Updated!';
    }
    public function gandimaisamma_creative_report(){
        $this->creative_report_generate('Gandimaisamma');
        return 'Updated!';
    }
    public function tsai_creative_report(){
        $this->creative_report_generate('TSAI Apartments');
        return 'Updated!';
    }

    public function creative_report_generate($project){
        $get_source_list = ['Facebook-Ads', 'Facebook Ads', 'FacebookAds', 'Facebook'];
        $from_date = Carbon::parse('2021-03-01 00:00:00')->setTimezone('Asia/Kolkata');
        $to_date = now();
        switch($project){
            case 'AGR':
                $get_leads = LeadsAgr::whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'HG':
                $get_leads = LeadsHg::whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'BP':
                $get_leads = LeadsBP::whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;


            case 'OS':
                $get_leads = LeadsOS::whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'VIB':
                $get_leads = LeadsVIB::where('project', 'VIB')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'Eternity':
                $get_leads = LeadsVIB::where('project', 'Eternity')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'Padur':
                $get_leads = LeadsSiruseri::where('project', 'Padur')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'JS':
                $get_leads = LeadsSiruseri::where('project', 'JS')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'Siruseri':
                $get_leads = LeadsSiruseri::where('project', 'Siruseri')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'JR':
                $get_leads = LeadsJR::where('project', 'JR')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'Ameenpur':
                $get_leads = LeadsHyd::where('project', 'Ameenpur')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'Bachupally':
                $get_leads = LeadsHyd::where('project', 'Bachupally')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'Gandimaisamma':
                $get_leads = LeadsHyd::where('project', 'Gandimaisamma')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
            case 'TSAI Apartments':
                $get_leads = LeadsTsai::where('project', 'TSAI Apartments')->whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
                break;
        }
        
        // $leads_data = [];
        foreach ($get_leads as $i => $lead){
                $get_lead_report = CreativeReport::where('lead_number', $lead->lead_number)->first();
                if(empty($get_lead_report)){
                    $store_creative_report = new CreativeReport([
                        'name' => $lead->first_name,
                        'contact' => $lead->contact_number,
                        'created_on' => $lead->created_on,
                        'lead_stage' => $lead->lead_stage,
                        'lead_source' => $lead->lead_source,
                        'project' => $lead->project,
                        'lead_id' => $lead->lead_id,
                        'lead_number' => $lead->lead_number
                    ]);
                    $store_creative_report->save();
                    $delay_sec = $i * 2;
                    CreativeReportUpdate::dispatch($store_creative_report->id)->delay(now()->addSeconds($delay_sec));
                    $i++;
                }
            }
        // return view('backend.reports.creative_reports', compact(array('leads_data')));
    }
    public function creative_report_show($project, $lead){
        $get_source_list = ['Facebook-Ads', 'Facebook Ads', 'FacebookAds', 'Facebook'];
        $from_date = Carbon::parse('2021-03-01 00:00:00')->setTimezone('Asia/Kolkata');
        $to_date = now();
        
        $data_string = '{
          "Parameter": {"ActivityEvent": 212}
          "Paging": {"Offset": "0","RowCount": "10"}
        }';
        if($project == 'AGR'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a&leadId=".$lead;
        }
        if($project == 'HG'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8&leadId=".$lead;
        }
        if($project == 'BP'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246&leadId=".$lead;
        }
        if($project == 'OS'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf&leadId=".$lead;
        }
        if($project == 'VIB'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&leadId=".$lead;
        }
        if($project == 'Eternity'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&leadId=".$lead;
        }
        if($project == 'Padur'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead;
        }
        if($project == 'JS'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead;
        }
        if($project == 'Siruseri'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead;
        }
        if($project == 'JR'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd&leadId='.$lead;
        }
        if($project == 'Ameenpur'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead;
        }
        if($project == 'Bachupally'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead;
        }
        if($project == 'Gandimaisamma'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead;
        }
        if($project == 'TSAI Apartments'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814&leadId='.$lead;
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

        if(isset($activity_response->ProspectActivities) && count($activity_response->ProspectActivities) != 0){

            if(isset($activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_1)){
                $campaign = $activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_1;
            }
            else{
                $campaign = NULL;
            }
            if(isset($activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_2)){
                $page = $activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_2;
            }
            else{
                $page = NULL;
            }
            if(isset($activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_3)){
                $form = $activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_3;
            }
            else{
                $form = NULL;
            }
            if(isset($activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_4)){
                $ad_name = $activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_4;
            }
            else{
                $ad_name = NULL;
            }
            if(isset($activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_5)){
                $ad_set = $activity_response->ProspectActivities[0]->ActivityFields->mx_Custom_5;
            }
            else{
                $ad_set = NULL;
            }
            $valid_leads_match = array(
                'Cold',
                'Warm',
                'Hot',
                'Site Visit Scheduled',
                'Site Visit Cancelled',
                'Site Visit Done',
                'Site Visit Done & Dropped',
                'Rechurn',
                'Progressing Reengaged',
                'Reengaged',
                'Other Project Prospect',
                'Booked',
                'Booked and Cancelled',
                'Agreemented',
            );
            // if(in_array($lead->lead_stage, $valid_leads_match)){
            //     $is_valid = true;
            // }
            // else{
            //     $is_valid = false;
            // }

            echo $campaign;
            echo '<br>';
            echo $page;
            echo '<br>';
            echo $form;
            echo '<br>';
            echo $ad_name;
            echo '<br>';
            // echo $is_valid;
            echo '<br>';
            echo $ad_set;
            echo '<br>';
        }
    }
    public function get_creative_report(Request $request){
        if(isset($request->from_date) && isset($request->to_date)){
            $from_date = Carbon::parse($request->get('from_date'))->setTimezone('Asia/Kolkata')->format('Y-m-d');
            // $to_date = Carbon::parse($request->get('to_date'))->format('Y-m-d H:i:s');
            $to_date = Carbon::parse($request->get('to_date'))->addHours(24)->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
        }
        else{
            $from = date('Y-m-d', strtotime('today - 29 days'));
            $from_date = Carbon::parse($from)->setTimezone('Asia/Kolkata');

            // $from_date = Carbon::parse('2021-03-01 00:00:00')->setTimezone('Asia/Kolkata');
            $to_date = now();
        }
        switch($request->get('project')){
            case 'all':
                $get_leads = CreativeReport::whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'agr':
                $get_leads = CreativeReport::where('project', 'AGR')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'AGR')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'hg':
                $get_leads = CreativeReport::where('project', 'HG')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'HG')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;

           case 'bp':
                $get_leads = CreativeReport::where('project', 'BP')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'BP')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;


            case 'os':
                $get_leads = CreativeReport::where('project', 'OS')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'OS')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'vib':
                $get_leads = CreativeReport::where('project', 'VIB')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'VIB')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'eternity':
                $get_leads = CreativeReport::where('project', 'Eternity')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'Eternity')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'jr':
                $get_leads = CreativeReport::where('project', 'JR')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'JR')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'padur':
                $get_leads = CreativeReport::where('project', 'Padur')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'Padur')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'js':
                $get_leads = CreativeReport::where('project', 'JS')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'JS')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'siruseri':
                $get_leads = CreativeReport::where('project', 'Siruseri')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'Siruseri')->whereBetween('created_on', [$from_date, $to_date])->get();
                break;
            case 'ameenpur':
                $creative_leads = CreativeReport::where('project', 'Ameenpur')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'bachupally':
                $get_leads = CreativeReport::where('project', 'Bachupally')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'Bachupally')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'gandimaisamma':
                $get_leads = CreativeReport::where('project', 'Gandimaisamma')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'Gandimaisamma')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
            case 'tsai':
                $get_leads = CreativeReport::where('project', 'TSAI Apartments')->whereBetween('created_on', [$from_date, $to_date])->get();
                $creative_leads = CreativeReport::where('project', 'TSAI Apartments')->whereBetween('created_on', [$from_date, $to_date])->select('ad_name', 'ad_set')->distinct()->get();
                break;
        }
        $get_agr_leads = LeadsAgr::whereBetween('created_on', [$from_date, $to_date])->whereIn('lead_source', ['Facebook-Ads', 'Facebook Ads', 'Facebook'])->get();
        return view('backend.reports.creative_reports', compact(array('get_leads', 'creative_leads','from_date','to_date', 'get_agr_leads')));
    }
    public function attendance_reports(){
        return view('backend.reports.attendance_reports');
    }
    public function store_creative_report(Request $request){
     //    echo '<pre>';
    	// print_r($request->get('report'));
     //    echo '</pre>';
        // echo $request->get('data_range');
        // echo '<br>sdg';
        
        // print_r($check_input);
        $report_list = $request->get('report');
        foreach($report_list as $report){
            $check_input = SavedCreativeReport::where('data_range', $request->get('data_range'))->where('project', $request->get('project'))->where('creative', $report['ad_name'])->first();
            if(empty($check_input)){
                if(
                    $report['spend'] == NULL &
                    $report['impression'] == NULL &
                    $report['reach'] == NULL &
                    $report['clicks'] == NULL
                ){

                }
                else{
                    $save_report = new SavedCreativeReport([
                        'data_range' => $request->get('data_range'),
                        'project' => $request->get('project'),
                        'creative' => $report['ad_name'],
                        'spend' => $report['spend'],
                        'impression' => $report['impression'],
                        // 'cpm' => $report['cpm'],
                        'reach' => $report['reach'],
                        'frequency' => $report['frequency'],
                        'clicks' => $report['clicks'],
                        'ctr' => $report['ctr'],
                        'fb_leads' => $report['fb_leads'],
                        'lms_fb_leads' => $report['lms_leads'],
                        'leads_diff' => $report['diff'],
                        'valid_leads' => $report['valid_leads'],
                        'valid_leads_per' => $report['valid_per'],
                        'walk_in' => $report['walk_in'],
                        'cpl' => $report['cpl'],
                        'cpvl' => $report['cpvl'],
                        'cpw' => $report['cpw'],
                        // 'reach_to_leads' => $report['reach_to'],
                        // 'lmp_to_leads' => $report['imp_to'],
                        'clicks_to_leads' => $report['clicks_to'],
                        'vltw' => $report['vltw'],
                    ]);
                    $save_report->save();
                }
            }
        }
        return Redirect::back()->with('success', 'Creative Report Saved Successfully!');
    }
    public function show_creative_report(Request $request){
        if(isset($request->data_range)){
            $data_range = $request->get('data_range');
        }
        else{
            $data_range = NULL;
        }
        if(isset($request->project)){
            $project = $request->get('project');
        }

        else{
            $project = NULL;
        }
        $data_range =  $request->get('data_range');
        $data_range_list =  SavedCreativeReport::select('data_range', 'project')->distinct()->get();
        if(is_array($request->get('data_range'))){
            $creative_leads =  SavedCreativeReport::whereIn('data_range', $data_range)->where('project', $project)->get();
        }
        else{
            $creative_leads =  SavedCreativeReport::where('data_range', $data_range)->where('project', $project)->get();
        }
        return view('backend.reports.show_creative_reports', compact(array('creative_leads', 'data_range', 'data_range_list')));
    }
    public function get_data_range_list(Request $request){
        $data_range_list =  SavedCreativeReport::where('project', $request->get('project'))->select('data_range')->distinct()->get();
        return response()->json($data_range_list, 200);
    }
}
