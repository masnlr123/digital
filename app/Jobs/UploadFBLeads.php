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
        $lead_check_email_response = $lead_controller->get_lead_email($project_name, $email);
        if(count($lead_check_response) == 0 && count($lead_check_email_response) == 0){
            $lead->activity = 'Fresh Lead';
        }
        elseif(count($lead_check_response) > 0 && count($lead_check_email_response) > 0){
            $lead->stage = $lead_check_response[0]->ProspectStage;
            $lead->activity = 'Lead Exists';
            $lead->lead_id = $lead_check_response[0]->ProspectID;
            $lead->source_orgin = $lead_check_response[0]->Source;
        }
        elseif(count($lead_check_response) > 0){
            $lead->stage = $lead_check_response[0]->ProspectStage;
            $lead->activity = 'Lead Exists';
            $lead->lead_id = $lead_check_response[0]->ProspectID;
            $lead->source_orgin = $lead_check_response[0]->Source;
        }
        elseif(count($lead_check_email_response) > 0){
            $lead->stage = $lead_check_email_response[0]->ProspectStage;
            $lead->activity = 'Lead Exists';
            $lead->lead_id = $lead_check_email_response[0]->ProspectID;
            $lead->source_orgin = $lead_check_email_response[0]->Source;
        }
        else{
            $lead->activity = 'API Problem';
        }
        $lead->api_response = $lead_check_response;
        $lead->save();
    }
}
