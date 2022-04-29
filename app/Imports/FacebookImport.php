<?php

namespace App\Imports;

use Auth;
use App\FBLeads;
use App\Http\Controllers\LeadImportController;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;

class FacebookImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
	use Importable;
    protected $project;
    protected $lead_sub_project;

    public function __construct($project, $lead_sub_project)
    {
        $this->project = $project;
        $this->lead_sub_project = $lead_sub_project;
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
        	$lead_controller = new LeadImportController();
			$fname = $row[6];
			$phone = $row[4];
			$email = $row[5];
			$ad_name = $row[1];
			$adset_name = $row[2];
			$campaign_name = $row[3];
			$imported_by = Auth::user()->name;
			$lead_source ='Facebook';
			$lead_sub_source ='Facebook Bulk Upload';
	        if($this->project == 'siruseri' ||$this->project == 'vib' ||$this->project == 'hyd'){
	            $sub_project = $this->lead_sub_project;
	        }
	        else{
	            $sub_project = NULL;
	        }
	        //API List
	        $post_uri_agr = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r101729ec766c0f0bcf1ac5fcd4dc884a&secretKey=5437608506c5f4b13773ba4fcb4e932ab2df294a";
	        $post_uri_hg = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r2fc623c84409d3bcc18d29be98caa0f8&secretKey=ba09c9eadde001c7a33d2defd681785f99ae80e8";
	        $post_uri_os = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r82026083899c8b86ea1762c93c68b421&secretKey=ef71e8b25cfdf1ac9daee40788b47b3e1f686ecf";
	        $post_uri_vib = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$rb4093458df51f5f657556da5ef326a2e&secretKey=84afdcf82b6a9cd947b2f617fd51b7ef47bafd87";
	        $post_uri_bv = "https://api.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u\$r3e1b53d0bf80244ec3bb5564f93189f7&secretKey=ea1fd88b33df235aa8abd8d8f80c09d54abaca0b";
	        $post_uri_cngs = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$r9830a9a140a0b451e6e638c9d001d297&secretKey=4b65d9a34cee51db65eea8fd935d27eedc43e798';
	        $post_uri_jr = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$r63f08372eaa2f9198c77b19a5e99f302&secretKey=48d0ba58dd6b3322562c3c7b4dc6d2504e938bbd';
	        $post_uri_hyd = 'https://api-in21.leadsquared.com/v2/LeadManagement.svc/Lead.Capture?accessKey=u$rd75b9d9753960c3b0405cf84747db4d0&secretKey=645288d91bbdfb06ec5141d12b18850378dbbe93';

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
	                    "Value": "'.$lead_source.'"
	                },
	                {
	                    "Attribute": "mx_Sub_Source",
	                    "Value": "'.$lead_sub_source.'"
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
	                "Attribute": "Phone",
	                "Value": "'.$phone.'"
	            },
	            {
	                "Attribute": "Source",
	                "Value": "'.$lead_source.'"
	            },
	            {
	                "Attribute": "mx_First_Sub_Source",
	                "Value": "'.$lead_sub_source.'"
	            }
	        ]';
	        $siruseri_data_string = '[
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
	                "Value": "'.$lead_source.'"
	            },
	            {
	                "Attribute": "mx_First_Sub_Source",
	                "Value": "'.$lead_sub_source.'"
	            },
	            {
	                "Attribute": "mx_Project",
	                "Value": "'.$sub_project.'"
	            },
	            {
	                "Attribute": "SourceCampaign",
	                "Value": "'.$campaign_name.'"
	            },
	            {
	                "Attribute": "mx_Facebook_Ad_Name",
	                "Value": "'.$ad_name.'"
	            },
	            {
	                "Attribute": "mx_Facebook_Adset_Name",
	                "Value": "'.$adset_name.'"
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
	                "Attribute": "Phone",
	                "Value": "'.$phone.'"
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
	                "Attribute": "mx_Projects",
	                "Value": "'.$sub_project.'"
	            }
	        ]';
	        $hyd_data_string = '[
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
	                "Value": "'.$lead_source.'"
	            },
	            {
	                "Attribute": "mx_Sub_Source",
	                "Value": "'.$lead_sub_source.'"
	            }
	        ]';
	        switch($this->project){
	            case 'agr':
	            $res_data = $lead_controller->store_lead($post_uri_agr, $data_string);
	            break;
	            case 'hg':
	            $res_data = $lead_controller->store_lead($post_uri_hg, $data_string);
	            break;
	            case 'os':
	            $res_data = $lead_controller->store_lead($post_uri_os, $data_string);
	            break;
	            case 'vib':
	            $res_data = $lead_controller->store_lead($post_uri_vib, $vib_data_string);
	            break;
	            case 'jr':
	            $res_data = $lead_controller->store_lead($post_uri_jr, $jr_data_string);
	            break;
	            case 'siruseri':
	            $res_data = $lead_controller->store_lead($post_uri_cngs, $siruseri_data_string);
	            break;
	            case 'hyd':
	            $res_data = $lead_controller->store_lead($post_uri_hyd, $hyd_data_string);
	            break;
	        }
	        $api_response = $res_data;
	        // $status = "Success";
	        // $activity = "Lead submitted successfully";
            FBLeads::create([
				'name' => $fname,
				'contact' => $phone,
				'email' => $email,
				'ad_name' => $ad_name,
				'adset_name' => $adset_name,
				'campaign_name' => $campaign_name,
				'imported_by' => $imported_by,
				'project' => $project,
				'sub_project' => $sub_project,
				'status' => $api_response,
            ]);
        }
    }

  //   public function model(array $row)
  //   {
  //       return new FBLeads([
		// 'name' => $row[0],
		// 'contact' => $row[1],
		// 'email' => $row[2],
		// 'ad_name' => $row[3],
		// 'adset_name' => $row[4],
		// 'campaign_name' => $row[5],
		// 'first_time_home_buyer' => $row[6],
		// 'imported_by' => $row[7],
		// 'status' => $row[8],
  //       ]);
  //   }
}
