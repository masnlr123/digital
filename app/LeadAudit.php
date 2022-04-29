<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use \Carbon\Carbon;

class LeadAudit extends Model
{
	protected $table = 'lead_audits';
    protected $fillable = [
		'lead_number',
        'project',
		'lead_name',
		'created_on',
		'lead_id',
		'lead_stage',
		'lead_source',
		'contact_number',
		'email',
		'url',
		'lead_owner',
		'lat_feedback',
		'detailed_remark',
		'lat_executive',
		'lat_action',
		'block_1',
		'block_2',
		'block_3',
        'block_4',
		'type',
        'score',
        'follow_na_block',
		'total_score',
        'record_not_found',
        'red_alert',
        'email_content',
		'created_by',
		'created_at',
		'updated_at'
    ];
    public function agr()
    {
        return $this->hasMany('App\LeadsAgr', 'lead_id');
    }
    public function hg()
    {
        return $this->belongsTo('App\Models\LeadsHg');
    }
    public function os()
    {
        return $this->belongsTo('App\Models\LeadsOS');
    }
    public function vib()
    {
        return $this->belongsTo('App\Models\LeadsVIB');
    }
    public function jr()
    {
        return $this->belongsTo('App\Models\LeadsJR');
    }
    public function bp()
    {
        return $this->belongsTo('App\Models\LeadsBP');
    }
    public function siruseri()
    {
        return $this->belongsTo('App\Models\LeadsSiruseri');
    }
    public function hyd()
    {
        return $this->belongsTo('App\Models\LeadsHyd');
    }

    public function scopeStart(Builder $query, $date): Builder
    {
        return $query->where('created_at', '<', Carbon::parse($date));
    }
    public function scopeEnd(Builder $query, $date): Builder
    {
        return $query->where('created_at', '>', Carbon::parse($date));
    }

    public function block_1_avg($agent, $from_date = NULL, $to_date = NULL, $project = NULL)
    {
        $na_count = LeadAudit::select('lead_owner', 'block_1')->where('lead_owner', $agent)->where('block_1', '=', 'NA')->get();
        $all_count = LeadAudit::select('lead_owner', 'block_1')->where('lead_owner', $agent)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::select('lead_owner', 'block_1')->where('lead_owner', $agent)->where('block_1', '!=', 'NA')->get();
            // if(isset($request->from_date) && isset($request->to_date)){
            //     $from = $request->from_date;
            //     $to = $request->to_date;
            //     $get_agents->whereBetween('created_at', [$from, $to]);
            // } 
            // if(isset($request->project)){
            //     $project = $request->project;
            //     $get_agents->where('project', $project);
            // }
            if(!empty($audits)){
                return round($audits->avg('block_1'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function block_2_avg($agent)
    {
        $na_count = LeadAudit::select('lead_owner', 'block_2')->where('lead_owner', $agent)->where('block_2', '=', 'NA')->get();
        $all_count = LeadAudit::select('lead_owner', 'block_2')->where('lead_owner', $agent)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::select('lead_owner', 'block_2')->where('lead_owner', $agent)->where('block_2', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_2'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function block_3_avg($agent)
    {
        $na_count = LeadAudit::select('lead_owner', 'block_3')->where('lead_owner', $agent)->where('block_3', '=', 'NA')->get();
        $all_count = LeadAudit::select('lead_owner', 'block_3')->where('lead_owner', $agent)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::select('lead_owner', 'block_3')->where('lead_owner', $agent)->where('block_3', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_3'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function block_4_avg($agent)
    {
        $na_count = LeadAudit::select('lead_owner', 'block_4')->where('lead_owner', $agent)->where('block_4', '=', 'NA')->get();
        $all_count = LeadAudit::select('lead_owner', 'block_4')->where('lead_owner', $agent)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::select('lead_owner', 'block_4')->where('lead_owner', $agent)->where('block_4', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('block_4'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function total_score_avg($agent)
    {
        $na_count = LeadAudit::select('lead_owner', 'total_score')->where('lead_owner', $agent)->where('total_score', '=', 'NA')->get();
        $all_count = LeadAudit::select('lead_owner', 'total_score')->where('lead_owner', $agent)->get();
        if($na_count->count() == $all_count->count()){
            return 'NA';
        }
        else{
            $audits = LeadAudit::select('lead_owner', 'total_score')->where('lead_owner', $agent)->where('total_score', '!=', 'NA')->get();
            if(!empty($audits)){
                return round($audits->avg('total_score'));
            }
            else{
                return 'NILL';
            }
        }
    }
    public function lat_feedback_colud($agent)
    {
        $get_lat_feedback = LeadAudit::select('lead_owner', 'lat_feedback')->where('lead_owner', $agent)->get();
        $lat_count = array();
        foreach($get_lat_feedback as $feeback){
            $feedabcks = explode(',', $feeback->lat_feedback);
            if(count($feedabcks)>0){
                foreach($feedabcks as $feed){
                    if(array_key_exists($feed, $lat_count)){
                        $lat_count[$feed] += 1;
                    }else{
                        $lat_count[$feed] = 1;
                    }
                }
            }
            else{
                if(array_key_exists($feeback->lat_feedback, $lat_count)){
                    $lat_count[$feeback->lat_feedback] += 1;
                }else{
                    $lat_count[$feeback->lat_feedback] = 1;
                }
            }
        }
        arsort($lat_count);
        $feedback_output = '';
        foreach($lat_count as $key => $val){
            if(!empty($key)){
                $lat_name = $key;
                if($key == 'On Follow Up' || $key == 'False Enquiry' || $key == 'No Feedback'){
                }
                else{
                    $feedback_output .= '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #607d8b;border-radius: 2px !important;margin-right: 3px;font-weight: 500;">'.$lat_name.' - '.$val.'</span>';
                }
                // $lat_name = 'No Feedback';
            }
            // else{
            //     $lat_name = $key;
            // }
            
        }
        return $feedback_output;
    }

    // public function block_1_avg() {
    //     $get_all_audits = $this->where('lead_number', $this->lead_number)->get();
    //     $total = 0;
    //     $num = 0;
    //     foreach ($get_all_audits as $audit) {
    //         if ($audit->block_1 != "NA") {
    //             $total += $audit->block_1;
    //             ++$num;
    //         }
    //     }
    //     $get_avg = $total / $num;
    //     return $get_avg;
    // }

}

