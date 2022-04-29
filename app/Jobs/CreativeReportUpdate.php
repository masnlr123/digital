<?php

namespace App\Jobs;

use App\User;
use App\Models\CreativeReport;
use App\Http\Controllers\ReportController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Auth;

class CreativeReportUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $lead_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($lead_id)
    {
        $this->lead_id = $lead_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $user = Auth::user();
        $lead = CreativeReport::find($this->lead_id);

        if($lead->project == 'AGR'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a&leadId=".$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 212}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'HG'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8&leadId=".$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 211}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'OS'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf&leadId=".$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 212}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'VIB'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&leadId=".$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 211}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'Eternity'){
            $post_uri = "https://api.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87&leadId=".$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 211}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'Padur'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 204}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'JS'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 204}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'Siruseri'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 204}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'JR'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 203}"Paging": {"Offset": "0","RowCount": "10"}}';
        }

        if($lead->project == 'BP'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 203}"Paging": {"Offset": "0","RowCount": "10"}}';
        }



        if($lead->project == 'Ameenpur'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 153}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'Bachupally'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd8c2f7aadd8dd7609e08abc230990943&secretKey=ae3805268bdd7c3ece47e97188f05394bb509246&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 153}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'Gandimaisamma'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 153}"Paging": {"Offset": "0","RowCount": "10"}}';
        }
        if($lead->project == 'TSAI Apartments'){
            $post_uri = 'https://api-in21.leadsquared.com/v2/ProspectActivity.svc/Retrieve?accessKey=u$r3de70d5b8dbb95946a6ba432395cb4c5&secretKey=3bed1a9912c604716f94683a6dcff2473cf94814&leadId='.$lead->lead_id;
            $data_string = '{"Parameter": {"ActivityEvent": 154}"Paging": {"Offset": "0","RowCount": "10"}}';
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
            if(in_array($lead->lead_stage, $valid_leads_match)){
                $is_valid = true;
            }
            else{
                $is_valid = false;
            }

			$lead->campaign = $campaign;
			$lead->page = $page;
			$lead->form = $form;
			$lead->ad_name = $ad_name;
			$lead->is_valid = $is_valid;
			$lead->ad_set = $ad_set;
        	$lead->save();
        }
    }
}
