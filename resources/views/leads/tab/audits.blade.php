<div class="tab-pane active" id="lead_audit" role="tabpanel">
                            @if($current_lead->audit_count > 0) 
                                
                                @php

                        $score_block_1 = $current_lead->block_1_avg();
                        $score_block_2 = $current_lead->block_2_avg();
                        $score_block_3 = $current_lead->block_3_avg();
                        $score_block_4 = $current_lead->block_4_avg();
                        $score_total_avg = $current_lead->total_avg();

                        function in_range($number, $min, $max, $inclusive = TRUE)
                        {
                            if(is_numeric($number)){
                                return $inclusive
                                    ? ($number >= $min && $number <= $max)
                                    : ($number > $min && $number < $max) ;
                            }

                            return FALSE;
                        }
                        if(in_range($score_block_1, 0, 69)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
                        }
                        elseif(in_range($score_block_1, 70, 84)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
                        }
                        elseif(in_range($score_block_1, 85, 94)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
                        }
                        elseif(in_range($score_block_1, 95, 100)){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
                        }
                        elseif($score_block_1 == 'NA'){
                            $batch_block_1 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
                        }

                        if(in_range($score_block_2, 0, 69)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
                        }
                        elseif(in_range($score_block_2, 70, 84)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
                        }
                        elseif(in_range($score_block_2, 85, 94)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
                        }
                        elseif(in_range($score_block_2, 95, 100)){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
                        }
                        elseif($score_block_2 == 'NA'){
                            $batch_block_2 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
                        }

                        if(in_range($score_block_3, 0, 69)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
                        }
                        elseif(in_range($score_block_3, 70, 84)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
                        }
                        elseif(in_range($score_block_3, 85, 94)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
                        }
                        elseif(in_range($score_block_3, 95, 100)){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
                        }
                        elseif($score_block_3 == 'NA'){
                            $batch_block_3 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
                        }


                        if(in_range($score_block_4, 0, 69)){
                            $batch_block_4 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
                        }
                        elseif(in_range($score_block_4, 70, 84)){
                            $batch_block_4 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
                        }
                        elseif(in_range($score_block_4, 85, 94)){
                            $batch_block_4 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
                        }
                        elseif(in_range($score_block_4, 95, 100)){
                            $batch_block_4 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
                        }
                        elseif($score_block_4 == 'NA'){
                            $batch_block_4 = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
                        }
                        else{
                        $batch_block_4 = '';
                    }

                        if(in_range($score_total_avg, 0, 69)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #F44336;">Poor</span>';
                        }
                        elseif(in_range($score_total_avg, 70, 84)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #FF9800">Average</span>';
                        }
                        elseif(in_range($score_total_avg, 85, 94)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #d2bd06;">Good</span>';
                        }
                        elseif(in_range($score_total_avg, 95, 100)){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #74d606">Excellent</span>';  
                        }
                        elseif($score_total_avg == 'NA'){
                            $batch_score_total = '<span class="kt-badge kt-badge--primary kt-badge--inline" style="margin-top: 3px;background: #cc01ff;">NA</span>';
                        }
                        else{
                            $batch_score_total = '';
                        }

                        @endphp
                                    <div class="row audit_overall_report_dashboard">
                                        <div class="kt-widget1 audit_overall_report col-12" style="padding: 10px !important;">
                                            <h2 class="text-center">Overall Lead Audit Report</h2>
                                        </div>
                                        <div class="kt-widget1 audit_overall_report col-8" style="padding: 10px !important;">
                                            <div class="kt-ion-range-slider">
                                                <input type="hidden" name="totla_score" id="audit_final_total_score" readonly />
                                            </div>
                                        </div>
                                        <div class="col-4 pt-4"> <strong style="color: #E1F5FE;">Total Score : <span style="color: #EF6C00;font-size: 16px;">{{ $score_total_avg }}%</span> </strong>
                                            {!! $batch_score_total !!}</div>
                                            @php //ceil($current_lead->audit->avg('total_score')); @endphp
                                        <hr>
                                        <div class="kt-widget1 audit_overall_report col-md-5" style="padding: 0 !important;">
                                            <div class="kt-widget12 mt-3">
                                                <div class="kt-widget12__content">
                                                    <div class="kt-widget12__item">
                                                        <div class="kt-widget12__info col-12"> 
                                                            <span class="kt-widget12__desc">Soft Skills {!! $batch_block_1 !!}</span>
                                                            
                                                            @if(is_numeric($score_block_1))
                                                            <div class="kt-widget12__progress">
                                                                <div class="progress kt-progress--sm">
                                                                    <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_1 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div> 
                                                                <span class="kt-widget12__stat">
                                            {{ $score_block_1 }}%
                                        </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget12__item">
                                                        <div class="kt-widget12__info col-12"> <span class="kt-widget12__desc">Product Knowledge {!! $batch_block_2 !!}</span>
                                                            @if(is_numeric($score_block_2))
                                                            <div class="kt-widget12__progress">
                                                                <div class="progress kt-progress--sm">
                                                                    <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_2 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div> <span class="kt-widget12__stat">
                                            {{ $score_block_2 }}%
                                        </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget12__item">
                                                        <div class="kt-widget12__info col-12"> <span class="kt-widget12__desc">LMS Update {!! $batch_block_3 !!}</span>
                                                            @if(is_numeric($score_block_3))
                                                            <div class="kt-widget12__progress">
                                                                <div class="progress kt-progress--sm">
                                                                    <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_3 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div> <span class="kt-widget12__stat">
                                            {{ $score_block_3 }}%
                                        </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget12__item">
                                                        <div class="kt-widget12__info col-12"> <span class="kt-widget12__desc">Zero Tolerance {!! $batch_block_4 !!}</span>
                                                            @if(is_numeric($score_block_4))
                                                            <div class="kt-widget12__progress">
                                                                <div class="progress kt-progress--sm">
                                                                    <div class="progress-bar bg-brand" role="progressbar" style="width: {{ $score_block_4 }}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div> <span class="kt-widget12__stat">
                                            {{ $score_block_4 }}%
                                        </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-widget1 audit_overall_report col-md-7" style="padding: 0 !important;">
                                            <table class="table table-dark table-success mt-4">
                                                <thead>
                                                    <tr>
                                                        <th width="32%">Date</th>
                                                        <th>Soft Skills</th>
                                                        <th>Product Knowledge</th>
                                                        <th>LMS Update</th>
                                                        <th>Zero Tolerance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>@foreach($current_lead->audit as $audit)
                                                    <tr>
                                                        <td>{{ $audit->created_at }}</td>
                                                        <td>{{ $audit->block_1 }}</td>
                                                        <td>{{ $audit->block_2 }}</td>
                                                        <td>{{ $audit->block_3 }}</td>
                                                        <td>{{ $audit->block_4 }}</td>
                                                    </tr>@endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>Average Score</td>
                                                        <td>{{ $score_block_1 }}{{ $score_block_1 == 'NA'?'':'%' }}</td>
                                                        <td>{{ $score_block_2 }}{{ $score_block_2 == 'NA'?'':'%' }}</td>
                                                        <td>{{ $score_block_3 }}{{ $score_block_3 == 'NA'?'':'%' }}</td>
                                                        <td>{{ $score_block_4 }}{{ $score_block_4 == 'NA'?'':'%' }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="kt-widget1 col-md-7" style="padding: 0 !important;"></div>@foreach($current_lead->audit as $audit)
                                        @php
                                        $na_check = json_decode($audit->follow_na_block); 
                                        @endphp
                                        <div class="kt-widget1 col-md-12" style="padding: 0 !important;">
                                            <div class="kt-widget kt-widget--user-profile-3 mt-4">
                                                <div class="kt-widget__top">
                                                    <div class="kt-widget__content audit_repeater_box">
                                                        <div class="kt-widget__head"> <a href="#" class="kt-widget__username">
                                                        <span class="badge {{ $audit->type == 'fresh'? 'badge-success':'badge-primary' }}">
                                                            {{ strtoupper($audit->type) }} CALL</span>
                                                        Audit By : {{ $audit->lat_executive }} {{ $audit->id }}
                                                        <!-- <i class="flaticon2-correct"></i> -->
                                                        <span style="font-size: 12px;color: #999;"><i style="font-size: 12px;color: #999; padding-right: 7px;" class="flaticon-stopwatch"></i>{{ $audit->created_at }}/10</span>
                                                        </a>
                                                            <div class="kt-widget__action">
                                                                <button data-toggle="modal" data-target="#model_fb_detais_{{ $audit->id }}" class="btn btn-sm btn-upper btn-danger btn-bold"><i class="la la-edit"></i> Edit this</button>
                                                                <a href="{{ route('delete_lead_audit', $audit->id) }}" style="background: red;border-color: red;color: #fff;padding-right: 8px;" class="btn btn-sm btn-upper btn-warning btn-bold"><i class="la la-trash"></i></a>
                                                                @include('leads.inc.lead_edit')
                                                            </div>
                                                        </div>
                                                        @if($audit->record_not_found == 'No')
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
                                                            @if($audit->block_1 == 'NA')
                                                            <a href="#">Soft Skills: <span class="kt-badge kt-badge--info kt-badge--inline">NA</span></a>
                                                            @else
                                                            <a href="#">Soft Skills: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_1 }}%</span></a>
                                                            @endif

                                                            @if($audit->block_2 == 'NA')
                                                            <a href="#">Product Knowledge: <span class="kt-badge kt-badge--info kt-badge--inline">NA</span></a>
                                                            @else
                                                            <a href="#">Product Knowledge: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_2 }}%</span></a>
                                                            @endif

                                                            @if($audit->block_3 == 'NA')
                                                            <a href="#">LMS Update: <span class="kt-badge kt-badge--info kt-badge--inline">NA</span></a>
                                                            @else
                                                            <a href="#">LMS Update: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_3 }}%</span></a>
                                                            @endif

                                                            @if($audit->block_4 == 'NA')
                                                            <a href="#">LMS Update: <span class="kt-badge kt-badge--info kt-badge--inline">NA</span></a>
                                                            @else
                                                            <a href="#">LMS Update: <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $audit->block_4 }}%</span></a>
                                                            @endif

                                                            @if($audit->red_alert == 'Yes')
                                                            <a href="#">Red Alert: <span style="background: red;" class="kt-badge kt-badge--danger kt-badge--inline">Yes</span></a>
                                                            @endif
                                                        </div>
                                                        @else
                                                        <div class="alert alert-warning fade show mt-3" role="alert">
                                                            <div class="alert-icon"><i class="la la-close"></i></div>
                                                            <div class="alert-text">Call Record Not Found!</div>
                                                        </div>
                                                        @endif
                                                        <hr>
                                                        <div class="kt-widget__info">
                                                            <div class="form-group row" style="margin-bottom:2px; width:100%;">
                                                                <div class="col-4">
                                                                    <div class="kt-widget__desc">
                                                                        <h6 class="text-danger"><strong>LAT Feedback :</strong></h6>
                                                                        @php $feedbacks = explode(',', $audit->lat_feedback); @endphp
                                                                        <p>@foreach($feedbacks as $feedback) <span style="margin-top: 3px;background: #8E24AA;" class="kt-badge kt-badge--primary kt-badge--inline">
                                                                        {{ $feedback }}
                                                                    </span>
                                                                            @endforeach</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-5">
                                                                    <div class="kt-widget__desc">
                                                                        <h6 class="text-danger"><strong>LAT Action:</strong></h6>
                                                                        <p>{{ $audit->lat_action }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 text-right"> <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                <label><span style="line-height: 34px;padding-left: 10px;">View More</span>
                                                                    <input type="checkbox" id="count_check_{{ $audit->id }}" name="no_update_in_lms{{ $audit->id }}" ng-model="view_more_{{ $audit->id }}" ng-value="1"> <span></span>
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
                                                                @if($audit->block_1 == 'NA')
                                                                <h4 class="col-10">Soft Skills</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" name="block_1_na" ng-model="view_block_1_na__{{ $audit->id }}" ng-value="1" value="Yes" checked="checked" ng-init="view_block_1_na__{{ $audit->id }}=true" disabled> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>Soft Skills</h4>
                                                                @endif

                                                                @if(empty($na_check->a1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent give call opening with greeting, self intro with branding?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[1]" id="audit_score_view_a1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->a2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent display active listening?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[2]" id="audit_score_view_a2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->a3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent maintain Normal Rate of speech / sounds confident/ enthusiastic?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[3]" id="audit_score_view_a3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->a4))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent close the call properly</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[4]" id="audit_score_view_a4{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="audit_block_2 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_2 == 'NA')
                                                                <h4 class="col-10">Product Knowledge</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_2_na" ng-model="view_block_2_na_{{ $audit->id }}" ng-init="view_block_2_na_{{ $audit->id }}=true" ng-value="1" value="Yes"> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>Product Knowledge</h4>
                                                                @endif
                                                                @if(empty($na_check->b1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent probe effecively to understand customer's requirements?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[5]" id="audit_score_view_b1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->b2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent explain Location and its advantages(If required)?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[6]" id="audit_score_view_b2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->b3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the Agent explained project details and benefits</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[7]" id="audit_score_view_b3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->b4))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the Agent explain the Offers & Schemes?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[8]" id="audit_score_view_b4{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->b5))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Was there a proper pitch / Convincing / Rapport creation</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[9]" id="audit_score_view_b5{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->b6))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the Agent invite for Site Visit Along with Family</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[10]" id="audit_score_view_b6{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="audit_block_3 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_3 == 'NA')
                                                                <h4 class="col-10">LMS Update</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_3_na" ng-model="view_block_3_na_{{ $audit->id }}" ng-init="view_block_3_na_{{ $audit->id }}=true" ng-value="1" value="Yes" readonly> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>LMS Update</h4>
                                                                @endif
                                                                @if(empty($na_check->c1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_3_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent create task?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[11]" id="audit_score_view_c1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->c2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_3_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent capture call remarks?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[12]" id="audit_score_view_c2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->c3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_3_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent choose correct Disposition?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[13]" id="audit_score_view_c3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="audit_block_4 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_4 == 'NA')
                                                                <h4 class="col-10">Zero Tolerance</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_4_na" ng-model="view_block_4_na_{{ $audit->id }}" ng-init="view_block_4_na_{{ $audit->id }}=true" ng-value="1" value="Yes"> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>Zero Tolerance</h4>
                                                                @endif
                                                                @if(empty($na_check->d1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_4_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent Call within TAT?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[14]" id="audit_score_view_d1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->d2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_4_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Rude on Call / Disconnected the call / Usage of Profanity / Incorrect Information</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[15]" id="audit_score_view_d2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->d3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_4_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent ask for next Call For Action before closing the call?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[16]" id="audit_score_view_d3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            @else
                                                            <div class="audit_block_1 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_1 == 'NA')
                                                                <h4 class="col-10">Soft Skills</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_1_na" ng-model="view_block_1_na__{{ $audit->id }}" ng-init="view_block_1_na__{{ $audit->id }}=true" ng-value="1" value="Yes"> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>Soft Skills</h4>
                                                                @endif

                                                                @if(empty($na_check->a1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent give call opening with greeting, self intro with branding?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[1]" id="audit_score_view_a1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->a2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent display active listening/ sounds confident/ enthusiastic?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[2]" id="audit_score_view_a2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->a3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent maintain Normal Rate of speech / sounds confident/ enthusiastic?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[3]" id="audit_score_view_a3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->a4))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_1_na__{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent close the call properly?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[4]" id="audit_score_view_a4{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="audit_block_2 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_2 == 'NA')
                                                                <h4 class="col-10">Product Knowledge</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_2_na" ng-model="view_block_2_na_{{ $audit->id }}" ng-init="view_block_2_na_{{ $audit->id }}=true" ng-value="1" value="Yes"> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>Product Knowledge</h4>
                                                                @endif

                                                                @if(empty($na_check->b1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent create rapport?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[5]" id="audit_score_view_b1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->b2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_2_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Was there a proper pitch / convincing?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[6]" id="audit_score_view_b2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="audit_block_3 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_3 == 'NA')
                                                                <h4 class="col-10">LMS Update</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_3_na" ng-model="view_block_3_na_{{ $audit->id }}" ng-init="view_block_3_na_{{ $audit->id }}=true" ng-value="1" value="Yes"> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>LMS Update</h4>
                                                                @endif
                                                                
                                                                @if(empty($na_check->c1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_3_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did Agent create Task </label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[7]" id="audit_score_view_c1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->c2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_3_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Capture call remarks</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[8]" id="audit_score_view_c2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->c3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_3_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Correct disposition</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[8]" id="audit_score_view_c3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="audit_block_4 row" ng-show="view_more_{{ $audit->id }}">
                                                                @if($audit->block_4 == 'NA')
                                                                <h4 class="col-10">Zero Tolerance</h4>
                                                                <div class="col-2">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                                        <label class="d-inline-flex">
                                                                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                                            <input type="checkbox" id="new_block_a2" checked name="block_4_na" ng-model="view_block_4_na_{{ $audit->id }}" ng-init="view_block_4_na_{{ $audit->id }}=true" ng-value="1" value="Yes"> <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @else
                                                                <h4>Zero Tolerance</h4>
                                                                @endif
                                                                
                                                                @if(empty($na_check->c1))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_4_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the Agent follow up as per the scheduled date and time?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[10]" id="audit_score_view_d1{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->c2))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_4_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Was the agent Rude / Disconnected the call / Usage of Profanity? / Incorrect Information</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[11]" id="audit_score_view_d2{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @if(empty($na_check->c3))
                                                                <div class="col-md-12 audit-score-wrap" ng-hide="view_block_4_na_{{ $audit->id }}">
                                                                    <div class="form-group row" style="margin-bottom:2px;">
                                                                        <label class="col-8 audit-score-label">Did the agent ask for next Call For Action before closing the call?</label>
                                                                        <div class="col-4">
                                                                            <div class="kt-ion-range-slider">
                                                                                <input type="hidden" name="score[12]" id="audit_score_view_d3{{ $audit->id }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach 
                                    </div>
                                        @else
                                    <div class="row">
                                        <div class="kt-widget1 col-md-12" style="padding: 0 !important;">
                                            <div class="no_audit_found">No Lead Audit Found</div>
                                            @include('leads.inc.fresh_call')
                                        </div>
                                    </div>
                            @endif
                        </div>