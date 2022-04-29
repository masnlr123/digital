<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadsAgr extends Model
{
    protected $table = 'leads_agr';
    protected $fillable = [
    	    'project',
            'created_on',
            'first_name',
            'last_name',
            'lead_id',
            'lead_number',
            'lead_stage',
            'lead_source',
            'lead_sub_source',
            'lead_origin',
            'interested_to_buy',
            'notes',
            'source_referrer_url',
            'contact_number',
            'email',
            'lead_url',
            'lead_owner',
            'lead_owner_email',
            'lead_age',
            'track_id',
    ];
    public function audit()
    {
        return $this->hasMany('App\LeadAudit', 'lead_id', 'lead_id');
    }
    public function block_1_avg()
    {
        $na_count = LeadAudit::where('lead_id', $this->lead_id)->where('block_1', '=', 'NA')->get();
        $all_count = LeadAudit::where('lead_id', $this->lead_id)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::where('lead_id', $this->lead_id)->where('block_1', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_1'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function block_2_avg()
    {
        $na_count = LeadAudit::where('lead_id', $this->lead_id)->where('block_2', '=', 'NA')->get();
        $all_count = LeadAudit::where('lead_id', $this->lead_id)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::where('lead_id', $this->lead_id)->where('block_2', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_2'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function block_3_avg()
    {
        $na_count = LeadAudit::where('lead_id', $this->lead_id)->where('block_3', '=', 'NA')->get();
        $all_count = LeadAudit::where('lead_id', $this->lead_id)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::where('lead_id', $this->lead_id)->where('block_3', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_3'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function block_4_avg()
    {
        $na_count = LeadAudit::where('lead_id', $this->lead_id)->where('block_4', '=', 'NA')->get();
        $all_count = LeadAudit::where('lead_id', $this->lead_id)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::where('lead_id', $this->lead_id)->where('block_4', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_4'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function total_avg()
    {
        $na_count = LeadAudit::where('lead_id', $this->lead_id)->where('total_score', '=', 'NA')->get();
        $all_count = LeadAudit::where('lead_id', $this->lead_id)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::where('lead_id', $this->lead_id)->where('total_score', '!=', 'NA')->get();
            if(!empty($audits)){
                foreach($audits as $audit){
                    if($audit->block_4 < 100){
                        return 0;
                        break;
                    }
                }
                return round($audits->avg('total_score'));
            }
            else{
                return 'NILL';
            }
        }

    }
}
