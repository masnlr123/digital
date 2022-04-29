<?php

namespace App\Jobs;

use App\User;
use App\FBLeads;
use App\Http\Controllers\LeadImportController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Auth;

class UploadFBLeads implements ShouldQueue
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
        $lead = FBLeads::find($this->lead_id);
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
            case 'Eternity':
                $project_name = 'vib';
                break;
            case 'Jubilee Residences':
                $project_name = 'jr';
                break;

           case 'BP':
                $project_name = 'bp';
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
        $lead_check_email_response = $this->get_lead_email($project_name, $email);
        
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
                $lead->activity = 'Lead Exists';
            }
            else{
            $lead->lead_id = $lead_check_response[0]->ProspectID;
                $contact_stage = $lead_check_response[0]->ProspectStage;
                // $email_address_stage = $lead_check_email_response[0]->ProspectStage;
                // if(!empty($contact_stage)){
                $lead->stage = $contact_stage;
                $lead->source_orgin = $lead_check_response[0]->Source;
                // $lead->lead_id = $lead_check_response[0]->ProspectID;
                $lead->activity = 'Lead Exists';
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
        // $lead->api_response = 'Job Working!';
        // $lead->save();


        if(count($lead_check_response) == 0 && count($lead_check_email_response) == 0){
            $new_stage = 'New';
            $activity = 'New';
        }
        elseif(count($lead_check_response) > 0 && count($lead_check_email_response) > 0){
            $stage = $lead_check_response[0]->ProspectStage;
            if($stage == 'Invalid' || $stage == 'Dropped' || $stage == 'Site Visit done & Dropped' || $stage == 'Rechurn' || $stage == 'Other Project Prospect'){
                $new_stage = 'Reengaged';
                $activity = 'Lead already Exists!. But Reengaged with Lead Stage of '.$stage;
            }
            elseif($stage == 'Suspect' || $stage == 'Cold' || $stage == 'Warm' || $stage == 'Site Visit Scheduled' || $stage == 'Site Visit done & Dropped' || $stage == 'Site Visit Cancelled'){
                
                if(!empty($stage[0]->ProspectActivityDate_Max)){
                    $from_date = \Carbon\Carbon::parse($stage[0]->ProspectActivityDate_Max);
                    $todate = now();
                    $diff_in_days = $todate->diffInDays($from_date);
                    if($diff_in_days <= $duration){
                            $new_stage = 'Lead Exists';
                            $activity = 'Lead already Exists!. Lead Activity duration '.$diff_in_days.' is less than input duration.';
                    }
                    elseif($diff_in_days <= 30){
                        $new_stage = 'Progressing Reengaged';
                        $activity = 'Lead already Exists!. But Progressing Reengaged. Lead Activity duration '.$diff_in_days;
                    }
                    else{
                        $new_stage = 'Reengaged';
                        $activity = 'Lead already Exists!. But Reengaged. Lead Activity duration '.$diff_in_days;
                    }
                }
                else{
                    $new_stage = 'Lead Exists';
                    $activity = 'Lead already Exists!. Lead Activity duration not found !';
                }
            }
        }
        elseif(count($lead_check_response) > 0){
            $stage = $lead_check_response[0]->ProspectStage;
            if($stage == 'Invalid' || $stage == 'Dropped' || $stage == 'Site Visit done & Dropped' || $stage == 'Rechurn' || $stage == 'Other Project Prospect'){
                $new_stage = 'Reengaged';
                $activity = 'Lead already Exists!. But Reengaged with Lead Stage of '.$stage;
            }
            elseif($stage == 'Suspect' || $stage == 'Cold' || $stage == 'Warm' || $stage == 'Site Visit Scheduled' || $stage == 'Site Visit done & Dropped' || $stage == 'Site Visit Cancelled'){

                if(!empty($stage[0]->ProspectActivityDate_Max)){
                    $from_date = \Carbon\Carbon::parse($stage[0]->ProspectActivityDate_Max);
                    $todate = now();
                    $diff_in_days = $todate->diffInDays($from_date);
                    if($diff_in_days <= $duration){
                            $new_stage = 'Lead Exists';
                            $activity = 'Lead already Exists!. Lead Activity duration '.$diff_in_days.' is less than input duration.';
                    }
                    elseif($diff_in_days <= 30){
                        $new_stage = 'Progressing Reengaged';
                        $activity = 'Lead already Exists!. But Progressing Reengaged. Lead Activity duration '.$diff_in_days;
                    }
                    else{
                        $new_stage = 'Reengaged';
                        $activity = 'Lead already Exists!. But Reengaged. Lead Activity duration '.$diff_in_days;
                    }
                }
                else{
                    $new_stage = 'Lead Exists';
                    $activity = 'Lead already Exists!. Lead Activity duration not found !';
                }
            }
        }
        elseif(count($lead_check_email_response) > 0){

        $email_stage = $lead_check_email_response[0]->ProspectStage;
        $from_date = \Carbon\Carbon::parse($email_stage[0]->ProspectActivityDate_Max);
        $todate = now();
        $diff_in_days = $todate->diffInDays($from_date);

            if($email_stage == 'Invalid' || $email_stage == 'Dropped' || $email_stage == 'Site Visit done & Dropped' || $email_stage == 'Rechurn' || $email_stage == 'Other Project Prospect'){
                $new_email_stage = 'Reengaged';
                $activity = 'Lead already Exists!. But Reengaged with Lead Stage of '.$stage;
            }
            elseif($email_stage == 'Suspect' || $email_stage == 'Cold' || $email_stage == 'Warm' || $email_stage == 'Site Visit Scheduled' || $email_stage == 'Site Visit done & Dropped' || $email_stage == 'Site Visit Cancelled'){
                
                if(!empty($email_stage[0]->ProspectActivityDate_Max)){
                    $from_date = \Carbon\Carbon::parse($email_stage[0]->ProspectActivityDate_Max);
                    $todate = now();
                    $diff_in_days = $todate->diffInDays($from_date);
                    if($diff_in_days <= $duration){
                            $new_stage = 'Lead Exists';
                            $activity = 'Lead already Exists!. Lead Activity duration '.$diff_in_days.' is less than input duration.';
                    }
                    elseif($diff_in_days <= 30){
                        $new_stage = 'Progressing Reengaged';
                        $activity = 'Lead already Exists!. But Progressing Reengaged. Lead Activity duration '.$diff_in_days;
                    }
                    else{
                        $new_stage = 'Reengaged';
                        $activity = 'Lead already Exists!. But Reengaged. Lead Activity duration '.$diff_in_days;
                    }
                }
                else{
                    $new_stage = 'Lead Exists';
                    $activity = 'Lead already Exists!. Lead Activity duration not found !';
                }
            }
        }
        else{
            $new_stage = 'API Down';
            $activity = 'API Down';
        }
        // API List
        // $post_uri_agr = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
        // $post_uri_hg = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
        // $post_uri_os = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
        // $post_uri_vib = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
        // $post_uri_bv = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r3e1b53d0bf80244ec3bb5564f93189f7&secretKey=ea1fd88b33df235aa8abd8d8f80c09d54abaca0b";
        // $post_uri_cngs = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
        // $post_uri_jr = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
        // $post_uri_hyd = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';
        
        // if($new_stage == 'New'){
        //     $data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         }
        //     ]';
        //     $jr_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_First_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         }
        //     ]';
        //     $siruseri_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_First_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Project",
        //             "Value": "'.$sub_project.'"
        //         }
        //     ]';
        //     $vib_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Projects",
        //             "Value": "'.$sub_project.'"
        //         }
        //     ]';
        //     $hyd_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         }
        //     ]';
        //     switch($project){
        //         case 'agr':
        //         $res_data = $lead_controller->store_lead($post_uri_agr, $data_string);
        //         break;
        //         case 'hg':
        //         $res_data = $lead_controller->store_lead($post_uri_hg, $data_string);
        //         break;
        //         case 'os':
        //         $res_data = $lead_controller->store_lead($post_uri_os, $data_string);
        //         break;
        //         case 'vib':
        //         $res_data = $lead_controller->store_lead($post_uri_vib, $vib_data_string);
        //         break;
        //         case 'jr':
        //         $res_data = $lead_controller->store_lead($post_uri_jr, $jr_data_string);
        //         break;
        //         case 'siruseri':
        //         $res_data = $lead_controller->store_lead($post_uri_cngs, $siruseri_data_string);
        //         break;
        //         case 'hyd':
        //         $res_data = $lead_controller->store_lead($post_uri_hyd, $hyd_data_string);
        //         break;
        //     }
        //     $lead->api_response = $res_data;
        //     $lead->status = "Success";
        // }
        // elseif($new_stage == 'Reengaged' || $new_stage == 'Progressing Reengaged'){
        //     $reengaged_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "mx_Secondary_Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Last_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "ProspectStage",
        //             "Value": "'.$new_stage.'"
        //         }
        //     ]';
        //     $reengaged_jr_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "mx_Secondary_Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Last_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "ProspectStage",
        //             "Value": "'.$new_stage.'"
        //         }
        //     ]';
        //     $reengaged_siruseri_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "mx_Secondary_Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Last_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "ProspectStage",
        //             "Value": "'.$new_stage.'"
        //         }
        //     ]';
        //     $reengaged_vib_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "mx_Secondary_Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Last_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "ProspectStage",
        //             "Value": "'.$new_stage.'"
        //         }
        //     ]';
        //     $reengaged_hyd_data_string = '[
        //         {
        //             "Attribute": "EmailAddress",
        //             "Value": "'.$email.'"
        //         },
        //         {
        //             "Attribute": "FirstName",
        //             "Value": "'.$fname.'"
        //         },
        //         {
        //             "Attribute": "Phone",
        //             "Value": "'.$phone.'"
        //         },
        //         {
        //             "Attribute": "mx_Secondary_Source",
        //             "Value": "'.$lead_source.'"
        //         },
        //         {
        //             "Attribute": "mx_Last_Sub_Source",
        //             "Value": "'.$lead_sub_source.'"
        //         },
        //         {
        //             "Attribute": "ProspectStage",
        //             "Value": "'.$new_stage.'"
        //         }
        //     ]';
        //     switch($project){
        //         case 'agr':
        //         $res_data = $lead_controller->store_lead($post_uri_agr, $reengaged_data_string);
        //         break;
        //         case 'hg':
        //         $res_data = $lead_controller->store_lead($post_uri_hg, $reengaged_data_string);
        //         break;
        //         case 'os':
        //         $res_data = $lead_controller->store_lead($post_uri_os, $reengaged_data_string);
        //         break;
        //         case 'vib':
        //         $res_data = $lead_controller->store_lead($post_uri_vib, $reengaged_vib_data_string);
        //         break;
        //         case 'jr':
        //         $res_data = $lead_controller->store_lead($post_uri_jr, $reengaged_jr_data_string);
        //         break;
        //         case 'siruseri':
        //         $res_data = $lead_controller->store_lead($post_uri_cngs, $reengaged_siruseri_data_string);
        //         break;
        //         case 'hyd':
        //         $res_data = $lead_controller->store_lead($post_uri_hyd, $reengaged_hyd_data_string);
        //         break;
        //     }
        //     $lead->api_response = $res_data;
        //     $lead->status = "Success";
        // }
        // else{
        //     $api_response = NULL;
        //     $response_lead_id = NULL;
        //     $status = "Lead Exists";
        // }
        $lead->activity = $activity;
        $lead->save();
    }
}
