@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
            Lead Name &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $lead->first_name }}</strong></h3>
        </div>
        <div class="kt-subheader__toolbar">
            {!! $back_url !!}
            <a href="{{ route('audit_index') }}" class="btn btn-warning btn-bold"><i class="fa fa-undo"></i> Back to All Audits</a>
            <a target="_blank" href="{{ $lead->lead_url }}" class="btn btn-brand btn-bold"><i class="flaticon2-paper-plane"></i> View in LeadSquared</a>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
        @if($message = Session::get('success'))
        <div class="alert alert-success fade show" role="alert">
            <div class="alert-icon"><i class="la la-check"></i></div>
            <div class="alert-text">{{ $message }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-4">

<div class="kt-portlet kt-portlet--solid-brand">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon"><i class="flaticon-stopwatch"></i></span>
            <h3 class="kt-portlet__head-title">Lead Details</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a class="btn btn-outline-light btn-sm btn-circle btn-icon mr-2" href="#" data-toggle="kt-popover" data-content="Edit Basic information of the Lead" data-original-title="Edit">
                <i class="flaticon-edit"></i></a>
            <a class="btn btn-outline-light btn-sm btn-circle btn-icon" href="#" data-toggle="kt-popover" data-content="Share this lead information to social media" data-original-title="Share Lead">
                <i class="fa fa-share-alt"></i></a>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-portlet__content">
            <h2><i class="flaticon2-user "></i> {{ $lead->first_name }}</h2>
            <p><strong><em>{{ $lead->lead_stage }}</em></strong></p>
            <p><i class="fa fa-building mr-1"></i></p>
            <p><i class="flaticon2-black-back-closed-envelope-shape mr-1"></i> {{ $lead->email }}</p>
            <p><i class="fa fa-phone-alt mr-1"></i> {{ $lead->contact_number }}</p>
            <p><i class="fa fa-map-marker-alt mr-1"></i> {{ $lead->first_name }}</p>
<!--             <p><i class="fa fa-user"></i> {{ $lead->contact_number }}</p>
            <p><i class="fa fa-user"></i> {{ $lead->email }}</p> -->
        </div>
    </div>
</div>

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#lead_properties" role="tab">
                            <i class="flaticon2-paper-plane" aria-hidden="true"></i>Lead Properties
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    <div class="kt-portlet__body" style="padding: 2px;">
        <div class="tab-content">
            <div class="tab-pane active" id="lead_properties" role="tabpanel">

        <div class="row">
        <div class="kt-widget1 col-md-12" style="padding:2px 10px;">
            <!-- <h5>Lead Properties</h5> -->
            <table class="table table-bordered table-striped">
                <tbody>
                    @if($lead->lead_stage)
                    <tr>
                        <td>Lead Stage</td>
                        <td>{{ $lead->lead_stage }}</td>
                    </tr>
                    @endif
                    @if($lead->lead_source)
                    <tr>
                        <td>Source</td>
                        <td>{{ $lead->lead_source }}</td>
                    </tr>
                    @endif
                    @if($lead->lead_sub_source)
                    <tr>
                        <td>Sub Source</td>
                        <td>{{ $lead->lead_sub_source }}</td>
                    </tr>
                    @endif
                    @if($lead->lead_origin)
                    <tr>
                        <td>Lead Origin</td>
                        <td>{{ $lead->lead_origin }}</td>
                    </tr>
                    @endif
                    @if($lead->notes)
                    <tr>
                        <td>Notes</td>
                        <td>{{ $lead->notes }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Lead Age</td>
                        <td>{{ $lead->lead_age }} Days</td>
                    </tr>
                </tbody>
                
            </table>
            
        </div>

    </div>
</div>


        </div>
    </div>
</div>
    </div>
    <div class="col-md-8">

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#lead_audit" role="tab">
                            <i class="flaticon2-chat" aria-hidden="true"></i>Lead Audit
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_details" role="tab">
                            <i class="flaticon2-line-chart" aria-hidden="true"></i>Activity History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                            <i class="flaticon2-paper-plane" aria-hidden="true"></i>Lead Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab">
                            <i class="flaticon2-file" aria-hidden="true"></i>Notes
                        </a>
                    </li>
                    @if($current_lead->audit_count > 0)
                    <li class="nav-item" style="right: 8px;position: absolute;top: 8px;">
                        <button data-toggle="modal" data-target="#model_new_followup_call" class="btn btn-sm btn-upper btn-info btn-bold"><i class="la la-plus"></i>New Follow up Call Audit</button>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

                            <div class="modal fade" id="model_new_followup_call" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                                <form method="POST" action="{{ route('store_lead_audit') }}">
                                            @csrf
<input type="hidden" name="type" value="followup">
<input type="hidden" name="project" value="{{ $lead->project }}">
<input type="hidden" name="lead_number" value="{{ $lead->lead_number }}">
<input type="hidden" name="lead_name" value="{{ $lead->first_name }}">
<input type="hidden" name="total_yes" id="total_yes_new" value="">
<input type="hidden" name="created_on" value="{{ $lead->created_on }}">
<input type="hidden" name="lead_id" value="{{ $lead->lead_id }}">
<input type="hidden" name="lead_stage" value="{{ $lead->lead_stage }}">
<input type="hidden" name="lead_source" value="{{ $lead->lead_source }}">
<input type="hidden" name="contact_number" value="{{ $lead->contact_number }}">
<input type="hidden" name="email" value="{{ $lead->email }}">
<input type="hidden" name="url" value="{{ $lead->lead_url }}">
<input type="hidden" name="lead_owner" value="{{ $lead->lead_owner }}">
                                        <div class="modal-header">
                                            <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle text-warning">NEW FOLLOW UP CALL AUDIT <!-- <span style="float: right;">Total Yes Count: <span id="dis_check_count_new"></span></span> --></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding: 32px;">
                                            <div class="form-group row">
                                                    <div class="row">
                                                <div class="col-md-6">
                                                    <div class="kt-checkbox-inline">
                                                        <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                            <input type="checkbox" name="record_not_found" id="record_not_found" ng-model="record_not_found" value="yes"> <strong class="text-warning">Call Record Not available</strong>
                                                            <span style="background: orange;"></span>
                                                        </label>
                                                        <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                            <input type="checkbox" name="red_alert" id="red_alert" ng-model="red_alert" value="yes"> <strong style="color:red">Red Alert</strong>
                                                            <span style="background: red;"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                </div>
                                                        <div class="col-md-12">
                                                            <label>LAT Feedback</label>
                                                            <select name="lat_feedback[]" id="select2_select" class="form-control kt-select2" multiple>
                                                                <option value="">Select One ***</option>
                                                                <option value="TAT is high">TAT is high</option>
                                                                <option value="False Enquiry">False Enquiry</option>
                                                                <option value="Pitching is bad">Pitching is bad</option>
                                                                <option value="Improper update in LMS">Improper update in LMS</option>
                                                                <option value="No Contact Number Available">No Contact Number Available</option>
                                                                <option value="No update in LMS">No update in LMS</option>
                                                                <option value="Invalid Number">Invalid Number</option>
                                                                <option value="On Follow Up">On Follow Up</option>
                                                                <option value="Existing Customer Call">Existing Customer Call</option>
                                                                <option value="Missed the follow up task">Missed the follow up task</option>
                                                                <option value="Booked With Competitor">Booked With Competitor</option>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mt-4">
                                                            <label>Detailed Remark</label>
                                                            <textarea class="form-control" name="detailed_remark"></textarea>
                                                        </div>
                                                        <div class="col-md-6 mt-4">
                                                            <label>LAT Action</label>
                                                            <textarea class="form-control" name="lat_action"></textarea>
                                                        </div>
                                                        <div class="col-md-12 mt-4" ng-show="red_alert">
                                                            <label>Red alert Email Content</label>
                                                            <textarea class="form-control" name="email_content"></textarea>
                                                        </div>
                                    <div class="audit_block_1 row" ng-hide="record_not_found">
                                    <h4>Soft Skills</h4>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Call Opening</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[1]" id="audit_score_slider_1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Was the Agent Attentive/ Patience/Maintain normal ROS</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[2]" id="audit_score_slider_2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Was the Agent Enthusiastic / confident</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[3]" id="audit_score_slider_3" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Close of action with call closing</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[4]" id="audit_score_slider_4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="audit_block_2 row" ng-hide="record_not_found">
                                    <h4>Product Knowledge</h4>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did the Agent follow up as per the scheduled date and time?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[5]" id="audit_score_slider_12" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did the agent create rapport?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[6]" id="audit_score_slider_13" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Was there a proper pitch / convincing</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[7]" id="audit_score_slider_14" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="audit_block_3 row" ng-hide="record_not_found">
                                    <h4>LMS Update</h4>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did Agent create Task ?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[8]" id="audit_score_slider_9" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did capture call remarks ?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[9]" id="audit_score_slider_10" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did correct disposition ?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[10]" id="audit_score_slider_11" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="" value="Submit the Lead Audit" class="btn btn-primary">
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>


    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="lead_audit" role="tabpanel">
                <div class="row">
                        @if($current_lead->audit_count > 0)

                        @php
                        $score_block_1 = $current_lead->audit->avg('block_1');
                        $score_block_2 = $current_lead->audit->avg('block_2');
                        $score_block_3 = $current_lead->audit->avg('block_3');
                        $score_total_avg = $current_lead->audit->avg('total_score');

                        function in_range($number, $min, $max, $inclusive = FALSE)
                        {
                                return $inclusive
                                    ? ($number >= $min && $number <= $max)
                                    : ($number > $min && $number < $max) ;

                            return FALSE;
                        }
                        if(in_range($score_block_1, 0, 20)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #F44336;">Very Poor</span>';
                        }
                        elseif(in_range($score_block_1, 20, 30)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #FF9800">Poor</span>';
                        }
                        elseif(in_range($score_block_1, 30, 40)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #d2bd06;">Average</span>';
                        }
                        elseif(in_range($score_block_1, 40, 50)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #74d606">Good</span>';  
                        }else{
                            $batch_block_1 = 'test';
                        }


                        if(in_range($score_block_2, 0, 10)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #F44336;">Very Poor</span>';
                        }
                        elseif(in_range($score_block_2, 10, 20)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #FF9800">Poor</span>';
                        }
                        elseif(in_range($score_block_2, 20, 30)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #d2bd06;">Average</span>';
                        }
                        elseif(in_range($score_block_2, 30, 40)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #74d606">Good</span>';  
                        }else{
                            $batch_block_2 = '';
                        }


                        if(in_range($score_block_3, 0, 3)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #F44336;">Very Poor</span>';
                        }
                        elseif(in_range($score_block_3, 3, 6)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #FF9800">Poor</span>';
                        }
                        elseif(in_range($score_block_3, 6, 7)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #d2bd06;">Average</span>';
                        }
                        elseif(in_range($score_block_3, 7, 10)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #74d606">Good</span>';  
                        }else{
                            $batch_block_3 = '';
                        }

                        if(in_range($score_total_avg, 0, 20)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #F44336;">Very Poor</span>';
                        }
                        elseif(in_range($score_total_avg, 20, 40)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #FF9800">Poor</span>';
                        }
                        elseif(in_range($score_total_avg, 40, 60)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #d2bd06;">Average</span>';
                        }
                        elseif(in_range($score_total_avg, 60, 80)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #74d606">Good</span>';  
                        }
                        elseif(in_range($score_total_avg, 80, 100)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="    margin-top: 3px;background: #74d606">Very Good</span>';  
                        }else{
                            $batch_score_total = '';
                        }


                        @endphp

                        <div class="kt-widget1 audit_overall_report col-8" style="padding: 0 !important;">
                            <div class="kt-ion-range-slider">
                                <input type="hidden" name="totla_score" id="audit_final_total_score" readonly />
                            </div>
                        </div>
                        <div class="col-4 pt-4">
                            <strong style="color: #0561ab;">Total Score : <span style="    color: #EF6C00;
    font-size: 16px;">{{ $current_lead->audit->avg('total_score') }}%</span> </strong>
                            {!! $batch_score_total !!}
                            
                        </div>
                        <hr>
                        <div class="kt-widget1 audit_overall_report col-md-5" style="padding: 0 !important;">
                            <div class="kt-widget12 mt-5">
                            <div class="kt-widget12__content">
                            <div class="kt-widget12__item">
                                <div class="kt-widget12__info col-12">
                                    <span class="kt-widget12__desc">Soft Skills {!! $batch_block_1 !!}</span>
                                    <div class="kt-widget12__progress">
                                        <div class="progress kt-progress--sm">
                                            <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_1/50*100 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget12__stat">
                                            {{ $score_block_1 }} / 50
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget12__item">
                                <div class="kt-widget12__info col-12">
                                    <span class="kt-widget12__desc">Product Knowledge {!! $batch_block_2 !!}</span>
                                    <div class="kt-widget12__progress">
                                        <div class="progress kt-progress--sm">
                                            <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_2/40*100 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget12__stat">
                                            {{ $score_block_2 }} /40
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget12__item">
                                <div class="kt-widget12__info col-12">
                                    <span class="kt-widget12__desc">LMS Update {!! $batch_block_3 !!}</span>
                                    <div class="kt-widget12__progress">
                                        <div class="progress kt-progress--sm">
                                            <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_3/10*100 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="kt-widget12__stat">
                                            {{ $score_block_3 }} /10
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                        <div class="kt-widget1 col-md-7" style="padding: 0 !important;">
                        </div>
                        @foreach($current_lead->audit as $audit)
                        <div class="kt-widget1 col-md-12" style="padding: 0 !important;">
                            <div class="kt-widget kt-widget--user-profile-3 mt-4">
                                <div class="kt-widget__top">
                                    <div class="kt-widget__content audit_repeater_box">
                                        <div class="kt-widget__head">
                                            <a href="#" class="kt-widget__username">
                                                <span class="badge {{ $audit->type == 'fresh'? 'badge-success':'badge-primary' }}">{{ strtoupper($audit->type) }} CALL</span>
                                                Audit By : {{ $audit->lat_executive }}
                                                <!-- <i class="flaticon2-correct"></i> -->
                                                <span style="font-size: 12px;color: #999;"><i style="font-size: 12px;color: #999; padding-right: 7px;" class="flaticon-stopwatch"></i>{{ $audit->created_at }}/10</span>
                                            </a>
                                            <div class="kt-widget__action">
                                            <button data-toggle="modal" data-target="#model_fb_detais_{{ $audit->id }}" class="btn btn-sm btn-upper btn-danger btn-bold"><i class="la la-edit"></i> Edit this</button>

                                <div class="modal fade" id="model_fb_detais_{{ $audit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                                    <form method="POST" action="{{ route('update_lead_audit', $audit->id) }}">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <input type="hidden" name="project" value="{{ $lead->project }}">
                                                <input type="hidden" name="lead_number" value="{{ $lead->lead_number }}">
                                                <input type="hidden" name="lead_name" value="{{ $lead->first_name }}">
                                                <input type="hidden" name="total_yes" id="total_yes" value="{{ $audit->total_yes }}">
                                                <input type="hidden" name="created_on" value="{{ $lead->created_on }}">
                                                <input type="hidden" name="lead_id" value="{{ $lead->lead_id }}">
                                                <input type="hidden" name="lead_stage" value="{{ $lead->lead_stage }}">
                                                <input type="hidden" name="lead_source" value="{{ $lead->lead_source }}">
                                                <input type="hidden" name="contact_number" value="{{ $lead->contact_number }}">
                                                <input type="hidden" name="email" value="{{ $lead->email }}">
                                                <input type="hidden" name="url" value="{{ $lead->lead_url }}">
                                                <input type="hidden" name="lead_owner" value="{{ $lead->lead_owner }}">
                                                <div class="modal-header">
                                                    <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle">Edit Audit <!-- <span style="float: right;">Total Yes Count: <span id="dis_check_count">{{ $audit->total_yes }}</span></span> --></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                            <div class="modal-body" style="padding: 32px;">
                                                <div class="form-group row">
                                                        <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="kt-checkbox-inline">
                                                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                                <input type="checkbox" name="record_not_found" id="record_not_found" ng-model="record_not_found" value="yes"> <strong class="text-warning">Call Record Not available</strong>
                                                                <span style="background: orange;"></span>
                                                            </label>
                                                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                                <input type="checkbox" name="red_alert" id="red_alert" ng-model="red_alert" value="yes"> <strong style="color:red">Red Alert</strong>
                                                                <span style="background: red;"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                            <div class="col-md-12">
                                                                <label>LAT Feedback</label>
                                                                @php $all_feedbacks = explode(',', $audit->lat_feedback) @endphp
                                                                <select name="lat_feedback[]" class="form-control kt-select2" id="select2_select1" multiple>
                                                                    <option value="">Select One ***</option>
                                                                    <option @if(in_array('TAT is high', $all_feedbacks)) selected @endif value="TAT is high">TAT is high</option>
                                                                    <option @if(in_array('False Enquiry', $all_feedbacks)) selected @endif  value="False Enquiry">False Enquiry</option>
                                                                    <option @if(in_array('Pitching is bad', $all_feedbacks)) selected @endif  value="Pitching is bad">Pitching is bad</option>
                                                                    <option @if(in_array('Improper update in LMS', $all_feedbacks)) selected @endif  value="Improper update in LMS">Improper update in LMS</option>
                                                                    <option @if(in_array('No Contact Number Available', $all_feedbacks)) selected @endif  value="No Contact Number Available">No Contact Number Available</option>
                                                                    <option @if(in_array('No update in LMS', $all_feedbacks)) selected @endif  value="No update in LMS">No update in LMS</option>
                                                                    <option @if(in_array('Invalid Number', $all_feedbacks)) selected @endif  value="Invalid Number">Invalid Number</option>
                                                                    <option @if(in_array('On Follow Up', $all_feedbacks)) selected @endif  value="On Follow Up">On Follow Up</option>
                                                                    <option @if(in_array('Existing Customer Call', $all_feedbacks)) selected @endif  value="Existing Customer Call">Existing Customer Call</option>
                                                                    <option @if(in_array('Missed the follow up task', $all_feedbacks)) selected @endif  value="Missed the follow up task">Missed the follow up task</option>
                                                                    <option @if(in_array('Booked With Competitor', $all_feedbacks)) selected @endif  value="Booked With Competitor">Booked With Competitor</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mt-4">
                                                                <label>Detailed Remark</label>
                                                                <textarea class="form-control" name="detailed_remark">{{ $audit->detailed_remark }}</textarea>
                                                            </div>
                                                            <div class="col-md-6 mt-4">
                                                                <label>LAT Action</label>
                                                                <textarea class="form-control" name="lat_action">{{ $audit->lat_action }}</textarea>
                                                            </div>
                                                            <div class="col-md-12 mt-4" ng-show="red_alert">
                                                                <label>Red alert Email Content</label>
                                                                <textarea class="form-control" name="email_content"></textarea>
                                                            </div>

                                        
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" name="" value="Submit the Lead Audit" class="btn btn-primary">
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>








                                            </div>
                                        </div>
                                        <div class="kt-widget__subhead">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <div class="col-8">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="totla_score" id="audit_total_score{{ $audit->id }}" readonly />
                                                    </div>
                                                </div>
                                                <label class="col-2 audit-score-label">(Total Score)</label>
                                            </div>
                                        </div>
                                        <div class="kt-widget__subhead">
                                            <a href="#"><i class="flaticon2-new-email"></i>
                                               Soft Skills: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_1 }}</span>/50
                                            </a>
                                            <a href="#"><i class="flaticon2-calendar-3"></i>Product Knowledge: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_2 }}</span>/40</a>
                                            <a href="#"><i class="flaticon2-placeholder"></i>LMS Update: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_3 }}</span>/10</a>
                                            
                                        </div>
                                        <hr>
                                        <div class="kt-widget__info">

                                            <div class="form-group row" style="margin-bottom:2px; width:100%;">
                                                <div class="col-4">
                                                    <div class="kt-widget__desc">
                                                        <h6 class="text-danger"><strong>LAT Feedback :</strong></h6>
                                                        @php
                                                        $feedbacks = explode(',', $audit->lat_feedback);
                                                        @endphp
                                                        <p>
                                                            @foreach($feedbacks as $feedback)
                                                            <span style="margin-top: 3px;background: #8E24AA;" class="kt-badge kt-badge--primary kt-badge--inline">
                                                                {{ $feedback }}
                                                            </span>
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="kt-widget__desc">
                                                        <h6 class="text-danger"><strong>LAT Action:</strong></h6>
                                                        <p>{{ $audit->lat_action }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-right">
                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                        <label><span style="line-height: 34px;padding-left: 10px;">View More</span>
                                                            <input type="checkbox" id="count_check_{{ $audit->id }}" name="no_update_in_lms{{ $audit->id }}" ng-model="view_more_{{ $audit->id }}" ng-value="1">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        <div class="form-group row" ng-show="view_more_{{ $audit->id }}" style="margin-bottom:2px; width:100%;">
                                            <div class="col-12">
                                                <div class="kt-widget__desc">
                                                    <h6 class="text-danger"><strong>Detailed Remark:</strong></h6>
                                                    <p>{{ $audit->detailed_remark }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        @if($audit->type == 'fresh')
                                        <div class="audit_block_1 row" ng-show="view_more_{{ $audit->id }}">
                                        <h4>Soft Skills</h4>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Call Opening</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[1]" id="audit_score_view_a1{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Was the Agent Attentive/ Patience/Maintain normal ROS</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[2]" id="audit_score_view_a2{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Was the Agent Enthusiastic / confident</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[3]" id="audit_score_view_a3{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Close of action with call closing</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[4]" id="audit_score_view_a4{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="audit_block_2 row" ng-show="view_more_{{ $audit->id }}">
                                        <h4>Product Knowledge</h4>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did the Agent Call within TAT</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[5]" id="audit_score_view_b1{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did the Agent understand customer's requirements</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[6]" id="audit_score_view_b2{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did the Agent gave project details and benefits</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[7]" id="audit_score_view_b3{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Was there a proper pitch / convincing / Rapport creation</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[8]" id="audit_score_view_b4{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="audit_block_3 row" ng-show="view_more_{{ $audit->id }}">
                                        <h4>LMS Update</h4>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did Agent create Task ?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[9]" id="audit_score_view_c1{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did capture call remarks ?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[10]" id="audit_score_view_c2{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did correct disposition ?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[11]" id="audit_score_view_c3{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @else
                                        <div class="audit_block_1 row" ng-show="view_more_{{ $audit->id }}">
                                        <h4>Soft Skills</h4>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Call Opening</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[1]" id="audit_score_view_a1{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Was the Agent Attentive/ Patience/Maintain normal ROS</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[2]" id="audit_score_view_a2{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Was the Agent Enthusiastic / confident</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[3]" id="audit_score_view_a3{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Close of action with call closing</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[4]" id="audit_score_view_a4{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="audit_block_2 row" ng-show="view_more_{{ $audit->id }}">
                                        <h4>Product Knowledge</h4>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did the Agent follow up as per the scheduled date and time?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[5]" id="audit_score_view_b1{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did the agent create rapport?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[6]" id="audit_score_view_b2{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Was there a proper pitch / convincing</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[7]" id="audit_score_view_b3{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="audit_block_3 row" ng-show="view_more_{{ $audit->id }}">
                                        <h4>LMS Update</h4>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did Agent create Task ?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[8]" id="audit_score_view_c1{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did capture call remarks ?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[9]" id="audit_score_view_c2{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 audit-score-wrap">
                                            <div class="form-group row" style="margin-bottom:2px;">
                                                <label class="col-8 audit-score-label">Did correct disposition ?</label>
                                                <div class="col-4">
                                                    <div class="kt-ion-range-slider">
                                                        <input type="hidden" name="score[10]" id="audit_score_view_c3{{ $audit->id }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="kt-widget1 col-md-12" style="padding: 0 !important;">
                        <div class="no_audit_found">No Lead Audit Found</div>
                        <form method="POST" action="{{ route('store_lead_audit') }}">
                            @csrf
                            <input type="hidden" name="type" value="fresh">
                            <input type="hidden" name="project" value="{{ $lead->project }}">
                            <input type="hidden" name="lead_number" value="{{ $lead->lead_number }}">
                            <input type="hidden" name="lead_name" value="{{ $lead->first_name }}">
                            <input type="hidden" name="total_yes" id="total_yes_new" value="">
                            <input type="hidden" name="created_on" value="{{ $lead->created_on }}">
                            <input type="hidden" name="lead_id" value="{{ $lead->lead_id }}">
                            <input type="hidden" name="lead_stage" value="{{ $lead->lead_stage }}">
                            <input type="hidden" name="lead_source" value="{{ $lead->lead_source }}">
                            <input type="hidden" name="contact_number" value="{{ $lead->contact_number }}">
                            <input type="hidden" name="email" value="{{ $lead->email }}">
                            <input type="hidden" name="url" value="{{ $lead->lead_url }}">
                            <input type="hidden" name="lead_owner" value="{{ $lead->lead_owner }}">
                            <div class="modal-header">
                                <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle text-warning">
                                    <span class="row">
                                    <span class="col-md-6">Fresh Call Audit</span>
                                    <span class="col-md-6">
                                        <div class="kt-checkbox-inline">
                                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                <input type="checkbox" name="record_not_found" id="record_not_found" ng-model="record_not_found" value="yes"> <strong class="text-warning">Call Record Not available</strong>
                                                <span style="background: orange;"></span>
                                            </label>
                                            <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                <input type="checkbox" name="red_alert" id="red_alert" ng-model="red_alert" value="yes"> <strong style="color:red">Red Alert</strong>
                                                <span style="background: red;"></span>
                                            </label>
                                        </div>
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body" style="padding: 32px;">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>LAT Feedback</label>
                                        <select name="lat_feedback[]" id="select2_select1" class="form-control kt-select2" multiple>
                                            <option value="">Select One ***</option>
                                            <option value="TAT is high">TAT is high</option>
                                            <option value="False Enquiry">False Enquiry</option>
                                            <option value="Pitching is bad">Pitching is bad</option>
                                            <option value="Improper update in LMS">Improper update in LMS</option>
                                            <option value="No Contact Number Available">No Contact Number Available</option>
                                            <option value="No update in LMS">No update in LMS</option>
                                            <option value="Invalid Number">Invalid Number</option>
                                            <option value="On Follow Up">On Follow Up</option>
                                            <option value="Existing Customer Call">Existing Customer Call</option>
                                            <option value="Missed the follow up task">Missed the follow up task</option>
                                            <option value="Booked With Competitor">Booked With Competitor</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label>Detailed Remark</label>
                                        <textarea class="form-control" name="detailed_remark"></textarea>
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label>LAT Action</label>
                                        <textarea class="form-control" name="lat_action"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-4" ng-show="red_alert">
                                        <label>Red alert Email Content</label>
                                        <textarea class="form-control" name="email_content"></textarea>
                                    </div>

                                    <div class="audit_block_1 row" ng-hide="record_not_found">
                                    <h4>Soft Skills</h4>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Call Opening</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[1]" id="audit_score_slider_15" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Was the Agent Attentive/ Patience/Maintain normal ROS</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[2]" id="audit_score_slider_16" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Was the Agent Enthusiastic / confident</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[3]" id="audit_score_slider_17" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Close of action with call closing</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[4]" id="audit_score_slider_18" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="audit_block_2 row" ng-hide="record_not_found">
                                    <h4>Product Knowledge</h4>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did the Agent Call within TAT</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[5]" id="audit_score_slider_5" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did the Agent understand customer's requirements</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[6]" id="audit_score_slider_6" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did the Agent gave project details and benefits</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[7]" id="audit_score_slider_7" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Was there a proper pitch / convincing / Rapport creation</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[8]" id="audit_score_slider_8" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="audit_block_3 row" ng-hide="record_not_found">
                                    <h4>LMS Update</h4>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did Agent create Task ?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[9]" id="audit_score_slider_19" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did capture call remarks ?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[10]" id="audit_score_slider_20" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-8 audit-score-label">Did correct disposition ?</label>
                                            <div class="col-4">
                                                <div class="kt-ion-range-slider">
                                                    <input type="hidden" name="score[11]" id="audit_score_slider_21" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="" value="Submit the Lead Audit" class="btn btn-primary">
                            </div>
                        </form>
                        </div>
                        @endif
                </div>
            </div>
            <div class="tab-pane" id="kt_portlet_details" role="tabpanel">

        <div class="row">
        <div class="kt-widget1 col-md-12">
                <div class="kt-list-timeline">
                    <div class="kt-list-timeline__items">
            @foreach($lsq_act as $key => $act_data)
            @php 
            //print "<pre>";
            //print_r($act_data); 
            //print "</pre>";
            //echo '<br><br><br>'; 
            //print_r($act_data->ActivityFields->mx_Custom_1); 
            //echo '<br><br><br>';@endphp


            <div class="kt-list-timeline__item">
                        <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                        @if(isset($act_data->Note))
                            <span class="kt-list-timeline__text">{{ $act_data->Note }}<br>

                        @else
                            <span class="kt-list-timeline__text">{{ $act_data->EventName }}<br>
                        @endif
                        @if(!empty($act_data->EventCode))
                        @if($act_data->EventCode == '3001')
                            <span>
                                Lead Owner changed from <strong>{{ $act_data->Data[0]->Value }}</strong> to <strong>
                                {{ $act_data->Data[1]->Value }}</strong> by <strong>{{ $act_data->Data[2]->Value }}</strong>
                            </span>
                        @endif
                        @if($act_data->EventCode == '3004')
                            <span>
                                Lead Source changed from <strong>{{ $act_data->Data[0]->Value }}</strong> to <strong>
                                {{ $act_data->Data[1]->Value }}</strong> by <strong>{{ $act_data->Data[2]->Value }}</strong>
                            </span>
                        @endif
                        @if($act_data->EventCode == '103')
                            <span>
                                <strong>{{ $act_data->Data[2]->Value }}</strong> | Added by <strong>{{ $act_data->Data[0]->Value }}</strong>
                            </span>
                        @endif
                        @if($act_data->EventCode == '2001')
                            <span>
                                Sent {{ $act_data->EmailType }} with subject <strong>{{ $act_data->Data[2]->Value }}</strong> by <strong>{{ $act_data->Data[3]->Value }}</strong>
                            </span>
                        @endif
                        @if($act_data->EventCode == '212')
                            <span>
                                Lead has been received by <strong>Facebook Form</strong> <button class="btn btn-sm" data-toggle="modal" data-target="#model_fb_detais"><i class="fa fa-angle-double-right"></i> For more details</button>

                            <div class="modal fade" id="model_fb_detais" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $act_data->EventName }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <table class="table table-striped table-success">
                                                    <tr>
                                                        <td>Campaign</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Page</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Form</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_3 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ad Name</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_4 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ad Set</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_5 }}</td>
                                                    </tr>
                                                </table>
                                                </div>
                                               
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </span>
                        @endif
                        @if($act_data->EventCode == '211')
                            <span>
                                <strong>Note : </strong>
                                {{ $act_data->Data[2]->Value }} | <span style="font-style: italic;"> Added By {{ $act_data->Data[0]->Value }}</strong>
                            </span>
                            </span>
                        @endif
                        @if($act_data->EventCode == '22')
                            @if($act_data->Data[0]->Value == 'InComplete')
                            <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Did not answer a call by {{ $act_data->Data[1]->Value }} through {{ $act_data->ActivityFields->mx_Custom_1 }}.</strong>
                            </span>
                            </span>
                            @elseif($act_data->Data[0]->Value == 'Complete')
                            <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--success kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Was called by {{ $act_data->Data[1]->Value }}  through {{ $act_data->ActivityFields->mx_Custom_1 }}. Duration {{ $act_data->Data[2]->Value }} Sec</strong>
                                <audio controls>
                                <source src="{{ $act_data->Data[3]->Value }}" type="audio/ogg">
                                </audio>
                            </span>
                            </span>
                            @endif
                        @endif
                        @if($act_data->EventCode == '21')
                            @if($act_data->Data[0]->Value == 'InComplete')
                            <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Call not answer with {{ $act_data->Data[1]->Value }} through {{ $act_data->ActivityFields->mx_Custom_1 }}.</strong>
                            </span>
                            </span>
                            @elseif($act_data->Data[0]->Value == 'Complete')
                            <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--success kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Had a phone call with {{ $act_data->Data[1]->Value }}  through {{ $act_data->ActivityFields->mx_Custom_1 }}. Duration {{ $act_data->Data[2]->Value }} Sec</strong>
                                <audio controls>
                                <source src="{{ $act_data->Data[3]->Value }}" type="audio/ogg">
                                </audio>
                            </span>
                            </span>
                            @endif
                        @endif
                        @if($act_data->EventCode == '3002')
                            <span>
                                Lead Stage changed from <strong>
                                {{ $act_data->Data[0]->Value }}</strong> to <strong>{{ $act_data->Data[1]->Value }}</strong> | <span style="font-style: italic;"> by <strong>{{ $act_data->Data[2]->Value }}</strong> Comment:{{ $act_data->Data[3]->Value }}
                            </span>
                            </span>
                        @endif
                        @endif
                        </span>
                        <span class="kt-list-timeline__time">{{ $act_data->CreatedOn }}</span>
                        </div>
            @endforeach
            
        </div>
        </div>
        </div>

    </div>
</div>
            <div class="tab-pane" id="kt_portlet_edit" role="tabpanel">
                <h4 style="margin: 15px 0;">Lead Details</h4>

            </div>
            <div class="tab-pane" id="kt_portlet_logs" role="tabpanel">
                <h4 style="margin: 15px 0;">Notes</h4>
                <!--Begin::Timeline 3 -->
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">

                    </div>
                </div>
                <!--End::Timeline 3 -->
            </div>


        </div>
    </div>
</div>
    </div>
</div>
</div>
<!--end::Portlet-->

</div>


@endsection
@section('header_css')
<style type="text/css">
    .select2.select2-container{
        width:100% !important;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
  @endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/pages/crud/forms/widgets/nouislider.js') }}"></script> -->

    <script type="text/javascript">
        $(document).ready(function(){
            var count_inc = parseInt("1");
            @if($current_lead->audit_count > 0)
            var total_count = '';
            @else
            var total_count = parseInt("0");
            @endif
            function count_checktat($id){  
                $($id).click(function(){
                    if($($id).is(':checked')){
                        total_count = total_count + count_inc;
                        $('#dis_check_count').text(total_count);
                        $('#total_yes').val(total_count);
                        $('#dis_check_count_new').text(total_count);
                        $('#total_yes_new').val(total_count);
                    }
                    else{
                        total_count = total_count - count_inc;
                        $('#dis_check_count').text(total_count);
                        $('#total_yes').val(total_count);
                        $('#dis_check_count_new').text(total_count);
                        $('#total_yes_new').val(total_count);
                    }
                });
            }
            count_checktat('#count_check_1');
            count_checktat('#count_check_2');
            count_checktat('#count_check_3');
            count_checktat('#count_check_4');
            count_checktat('#count_check_5');
            count_checktat('#count_check_6');
            count_checktat('#count_check_7');
            count_checktat('#count_check_8');
            count_checktat('#count_check_9');
            count_checktat('#new_count_check_1');
            count_checktat('#new_count_check_2');
            count_checktat('#new_count_check_3');
            count_checktat('#new_count_check_4');
            count_checktat('#new_count_check_5');
            count_checktat('#new_count_check_6');
            count_checktat('#new_count_check_7');
            count_checktat('#new_count_check_8');
            count_checktat('#new_count_check_9');
            if(total_count == 0){
                $('#dis_check_count').text('0');
                $('#total_yes').val(total_count);
                $('#dis_check_count_new').text('0');
                $('#total_yes_new').val(total_count);
            }

        });


jQuery(document).ready(function() {
    audit_scrore_range(0, 10, '#audit_score_slider_1');
    audit_scrore_range(0, 10, '#audit_score_slider_2');
    audit_scrore_range(0, 10, '#audit_score_slider_3');
    audit_scrore_range(0, 20, '#audit_score_slider_4');
    audit_scrore_range(0, 5, '#audit_score_slider_5');
    audit_scrore_range(0, 5, '#audit_score_slider_6');
    audit_scrore_range(0, 15, '#audit_score_slider_7');
    audit_scrore_range(0, 15, '#audit_score_slider_8');
    audit_scrore_range(0, 4, '#audit_score_slider_9');
    audit_scrore_range(0, 3, '#audit_score_slider_10');
    audit_scrore_range(0, 3, '#audit_score_slider_11');
    audit_scrore_range(0, 15, '#audit_score_slider_12');
    audit_scrore_range(0, 10, '#audit_score_slider_13');
    audit_scrore_range(0, 15, '#audit_score_slider_14');
    audit_scrore_range(0, 10, '#audit_score_slider_15');
    audit_scrore_range(0, 10, '#audit_score_slider_16');
    audit_scrore_range(0, 10, '#audit_score_slider_17');
    audit_scrore_range(0, 20, '#audit_score_slider_18');
    audit_scrore_range(0, 4, '#audit_score_slider_19');
    audit_scrore_range(0, 3, '#audit_score_slider_20');
    audit_scrore_range(0, 3, '#audit_score_slider_21');

    @if($current_lead->audit_count > 0)

    $('#audit_final_total_score').ionRangeSlider({
        type: "double",
        min: 0,
        max: 100,
        from: 0,
        to: '{{ $current_lead->audit->avg('total_score') }}',
        postfix: "%",
        from_fixed: true,
        to_fixed: true
    });

    @foreach($current_lead->audit as $audit)
    $('#audit_total_score{{ $audit->id }}').ionRangeSlider({
        type: "double",
        min: 0,
        max: 100,
        from: 0,
        to: '{{ $audit->total_score }}',
        postfix: "%",
        from_fixed: true,
        to_fixed: true
    });
    @php
    $score_board = json_decode($audit->score);
    @endphp
    @if($audit->type =='fresh')
    edit_range(0, 10, {{ $score_board->{1} }}, '#audit_score_view_a1{{ $audit->id }}');
    edit_range(0, 10,  {{ $score_board->{2} }}, '#audit_score_view_a2{{ $audit->id }}');
    edit_range(0, 10,  {{ $score_board->{3} }}, '#audit_score_view_a3{{ $audit->id }}');
    edit_range(0, 20,  {{ $score_board->{4} }}, '#audit_score_view_a4{{ $audit->id }}');
    edit_range(0, 5,  {{ $score_board->{5} }}, '#audit_score_view_b1{{ $audit->id }}');
    edit_range(0, 5,  {{ $score_board->{6} }}, '#audit_score_view_b2{{ $audit->id }}');
    edit_range(0, 15,  {{ $score_board->{7} }}, '#audit_score_view_b3{{ $audit->id }}');
    edit_range(0, 15,  {{ $score_board->{8} }}, '#audit_score_view_b4{{ $audit->id }}');
    edit_range(0, 4,  {{ $score_board->{9} }}, '#audit_score_view_c1{{ $audit->id }}');
    edit_range(0, 3,  {{ $score_board->{10} }}, '#audit_score_view_c2{{ $audit->id }}');
    edit_range(0, 3,  {{ $score_board->{11} }}, '#audit_score_view_c3{{ $audit->id }}');
    @else
    edit_range(0, 10,  {{ $score_board->{1} }}, '#audit_score_view_a1{{ $audit->id }}');
    edit_range(0, 10,  {{ $score_board->{2} }}, '#audit_score_view_a2{{ $audit->id }}');
    edit_range(0, 10,  {{ $score_board->{3} }}, '#audit_score_view_a3{{ $audit->id }}');
    edit_range(0, 20,  {{ $score_board->{4} }}, '#audit_score_view_a4{{ $audit->id }}');
    edit_range(0, 15,  {{ $score_board->{5} }}, '#audit_score_view_b1{{ $audit->id }}');
    edit_range(0, 10,  {{ $score_board->{6} }}, '#audit_score_view_b2{{ $audit->id }}');
    edit_range(0, 15,  {{ $score_board->{7} }}, '#audit_score_view_b3{{ $audit->id }}');
    edit_range(0, 4,  {{ $score_board->{8} }}, '#audit_score_view_c1{{ $audit->id }}');
    edit_range(0, 3,  {{ $score_board->{9} }}, '#audit_score_view_c2{{ $audit->id }}');
    edit_range(0, 3,  {{ $score_board->{10} }}, '#audit_score_view_c3{{ $audit->id }}');

    @endif
    @endforeach
    @endif

});
function audit_scrore_range(start, end, selecter){
    $(selecter).ionRangeSlider({
        min: start,
        max: end
    });
}
function edit_range(start, end, from, selecter){
    $(selecter).ionRangeSlider({
        type: "double",
        min: start,
        max: end,
        from: 0,
        to: from,
        postfix: "",
        from_fixed: true,
        to_fixed: true
    });
}


    </script>
@endsection