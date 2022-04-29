@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
            Lead Name &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $lead->first_name }}</strong></h3>
        </div>
        <div class="kt-subheader__toolbar">
            <a target="_blank" href="{{ $lead->lead_url }}" class="btn mt-2 btn-brand btn-bold"><i class="flaticon2-paper-plane"></i> View in LeadSquared</a>
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
                </ul>
            </div>
        </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="lead_audit" role="tabpanel">
                <div class="row">
                    <div class="kt-widget1 col-md-12">
                        @php
                        use App\LeadsAgr;
                        use App\LeadsHg;
                        use App\LeadsOS;
                        use App\LeadsVIB;
                        use App\LeadsSiruseri;
                        use App\LeadsJR;
                        use App\LeadsBP;
                        use App\User;
                        $users = User::where('role_id', '11')->get();
                        if($lead->project == 'agr'){
                            $current_lead = LeadsAgr::where('lead_id', $lead->lead_id)->first();
                            //echo $current_lead->audit;
                        }
                        @endphp
                        @if(!empty($current_lead->audit))
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__media kt-hidden-">
                                    <img src="{{ asset('assets/media/users/default.jpg') }}" alt="image">
                                </div>
                                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                                    JM
                                </div>
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a href="#" class="kt-widget__username">
                                            {{ $current_lead->audit->lat_executive }}
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                        <div class="kt-widget__action">
                                            <button data-toggle="modal" data-target="#model_fb_detais" class="btn btn-sm btn-upper btn-danger btn-bold"><i class="la la-edit"></i> Edit this</button>

                            <div class="modal fade" id="model_fb_detais" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                                <form method="POST" action="{{ route('update_lead_audit', $current_lead->audit->id) }}">
                                            @csrf
                                            {{ method_field('PUT') }}
<input type="hidden" name="project" value="{{ $lead->project }}">
<input type="hidden" name="total_yes" id="total_yes" value="{{ $current_lead->audit->total_yes }}">
<input type="hidden" name="created_on" value="{{ $lead->created_on }}">
<input type="hidden" name="lead_id" value="{{ $lead->lead_id }}">
<input type="hidden" name="lead_stage" value="{{ $lead->lead_stage }}">
<input type="hidden" name="lead_source" value="{{ $lead->lead_source }}">
<input type="hidden" name="contact_number" value="{{ $lead->contact_number }}">
<input type="hidden" name="email" value="{{ $lead->email }}">
<input type="hidden" name="url" value="{{ $lead->lead_url }}">
<input type="hidden" name="lead_owner" value="{{ $lead->lead_owner }}">
                                        <div class="modal-header">
                                            <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle">New Audit <span style="float: right;">Total Yes Count: <span id="dis_check_count">{{ $current_lead->audit->total_yes }}</span></span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding: 32px;">
                                            <div class="form-group row">
                                                    <div class="row">
                                                        <div class="col-md-4">
    <label>LAT Feedback</label>
    <select name="lat_feedback" class="form-control">
        <option value="">Select One ***</option>
        <option {{ $current_lead->audit->lat_feedback == 'TAT is high'? "selected":"" }} value="TAT is high">TAT is high</option>
        <option {{ $current_lead->audit->lat_feedback == 'False Enquiry'? "selected":"" }}  value="False Enquiry">False Enquiry</option>
        <option {{ $current_lead->audit->lat_feedback == 'Pitching is bad'? "selected":"" }}  value="Pitching is bad">Pitching is bad</option>
        <option {{ $current_lead->audit->lat_feedback == 'Improper update in LMS'? "selected":"" }}  value="Improper update in LMS">Improper update in LMS</option>
        <option {{ $current_lead->audit->lat_feedback == 'No Contact Number Available'? "selected":"" }}  value="No Contact Number Available">No Contact Number Available</option>
        <option {{ $current_lead->audit->lat_feedback == 'No update in LMS'? "selected":"" }}  value="No update in LMS">No update in LMS</option>
        <option {{ $current_lead->audit->lat_feedback == 'Invalid Number'? "selected":"" }}  value="Invalid Number">Invalid Number</option>
        <option {{ $current_lead->audit->lat_feedback == 'On Follow Up'? "selected":"" }}  value="On Follow Up">On Follow Up</option>
        <option {{ $current_lead->audit->lat_feedback == 'Existing Customer Call'? "selected":"" }}  value="Existing Customer Call">Existing Customer Call</option>
        <option {{ $current_lead->audit->lat_feedback == 'Missed the follow up task'? "selected":"" }}  value="Missed the follow up task">Missed the follow up task</option>
        <option {{ $current_lead->audit->lat_feedback == 'Booked With Competitor'? "selected":"" }}  value="Booked With Competitor">Booked With Competitor</option>

    </select>
                                                        </div>
                                                        <div class="col-md-4">
    <label>LAT Executive</label>
    <select name="lat_executive" class="form-control">
        <option value="">Select One ***</option>
        @foreach($users as $user)
        <option value="{{ $user->name }}" {{ $current_lead->audit->lat_executive == $user->name? "selected":"" }}>{{ $user->name }}</option>
        @endforeach
    </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Location</label>
                                                            <input type="text" class="form-control" name="location" value="{{ $current_lead->audit->location }}">
                                                        </div>
                                                        <div class="col-md-6 mt-4">
                                                            <label>Detailed Remark</label>
                                                            <textarea class="form-control" name="detailed_remark">{{ $current_lead->audit->detailed_remark }}</textarea>
                                                        </div>
                                                        <div class="col-md-6 mt-4">
                                                            <label>LAT Action</label>
                                                            <textarea class="form-control" name="lat_action">{{ $current_lead->audit->detailed_remark }}</textarea>
                                                        </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">TAT is High?</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" name="tat_is_high" id="count_check_1" value="Yes" {{ $current_lead->audit->tat_is_high == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Update in LMS</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_2" name="improper_update_in_lms" value="Yes" {{ $current_lead->audit->improper_update_in_lms == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">No Update in LMS</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_3" name="no_update_in_lms" value="Yes" {{ $current_lead->audit->no_update_in_lms == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Pitching</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_4" name="improper_pitching" value="Yes" {{ $current_lead->audit->improper_pitching == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Missed Follow Up</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_5" name="missed_follow_up" value="Yes" {{ $current_lead->audit->missed_follow_up == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Using Unprofessional Terms</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_6" name="using_unprofessional_terms" value="Yes" {{ $current_lead->audit->using_unprofessional_terms == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Unprofessional Behavior</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_7" name="unprofessional_behavior" value="Yes" {{ $current_lead->audit->unprofessional_behavior == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Opening and closing of the call</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_8" name="improper_opening_and_closing_of_the_call" value="Yes" {{ $current_lead->audit->improper_opening_and_closing_of_the_call == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">No Recording available unable to validate?</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_9" name="no_recording_available_unable_to_validate" value="Yes" {{ $current_lead->audit->no_recording_available_unable_to_validate == 'Yes'? 'checked':'' }}>
                                                        <span></span>
                                                    </label>
                                                </span>
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








                                        </div>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="#"><i class="flaticon2-new-email"></i>
                                           info@alliancein.com
                                        </a>
                                        <a href="#"><i class="flaticon2-calendar-3"></i>Lead Audit Executive </a>
                                        <a href="#"><i class="flaticon2-placeholder"></i>Chennai Office</a>
                                    </div>
                                    <hr>
                                    <div class="kt-widget__info">
                                        <div class="kt-widget__desc">
                                            <h6 class="text-danger"><strong>Detailed Remark :</strong></h6>
                                            <p>{{ $current_lead->audit->detailed_remark }}</p>
                                        </div>
                                        <div class="kt-widget__progress">
                                            <div class="kt-widget__text">
                                                Lead Audit Score
                                            </div>
                                            <div class="progress" style="height: 5px;width: 100%;">
                                                <div class="progress-bar kt-bg-success" role="progressbar"
                                                 @if($current_lead->audit->total_yes == '1')
                                                style="width: 15%;" aria-valuenow="15" 
                                                 @elseif($current_lead->audit->total_yes == '2')
                                                style="width: 25%;" aria-valuenow="25" 
                                                 @elseif($current_lead->audit->total_yes == '3')
                                                style="width: 35%;" aria-valuenow="35" 
                                                 @elseif($current_lead->audit->total_yes == '4')
                                                style="width: 45%;" aria-valuenow="45" 
                                                 @elseif($current_lead->audit->total_yes == '5')
                                                style="width: 55%;" aria-valuenow="55" 
                                                 @elseif($current_lead->audit->total_yes == '6')
                                                style="width: 65%;" aria-valuenow="65" 
                                                 @elseif($current_lead->audit->total_yes == '7')
                                                style="width: 75%;" aria-valuenow="75" 
                                                 @elseif($current_lead->audit->total_yes == '8')
                                                style="width: 85%;" aria-valuenow="85" 
                                                 @elseif($current_lead->audit->total_yes == '9')
                                                style="width: 100%;" aria-valuenow="100" 
                                                 @endif
                                                style="width: 65%;" aria-valuenow="65" 
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="kt-widget__stats">
                                               {{ $current_lead->audit->total_yes }}/9
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-widget__bottom">
                                <div class="kt-widget__item col-md-4">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-chat-1"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">LAT Feedback</span>
                                        <span class="kt-widget__value">{{ $current_lead->audit->lat_feedback }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item col-md-4">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">LAT Action</span>
                                        <span class="kt-widget__value">{{ $current_lead->audit->lat_action }}</span>
                                    </div>
                                </div>
                                <div class="kt-widget__item col-md-4">
                                    <div class="kt-widget__icon">
                                        <i class="flaticon-location"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                        <span class="kt-widget__title">Location</span>
                                        <span class="kt-widget__value">{{ $current_lead->audit->location }}</span>
                                    </div>
                                </div>
                            </div>
                            <h5 class="mt-5 text-danger">Lead Audit Checklist</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">TAT is High?</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" name="tat_is_high" id="count_check_1" value="Yes" {{ $current_lead->audit->tat_is_high == 'Yes'? 'checked':'' }} onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Update in LMS</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_2" name="improper_update_in_lms" value="Yes" {{ $current_lead->audit->improper_update_in_lms == 'Yes'? 'checked':'' }} onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">No Update in LMS</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_3" name="no_update_in_lms" value="Yes" {{ $current_lead->audit->no_update_in_lms == 'Yes'? 'checked':'' }} onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Pitching</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_4" name="improper_pitching" value="Yes" {{ $current_lead->audit->improper_pitching == 'Yes'? 'checked':'' }} onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Missed Follow Up</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_5" name="missed_follow_up" value="Yes" {{ $current_lead->audit->missed_follow_up == 'Yes'? 'checked':'' }} onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Using Unprofessional Terms</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_6" name="using_unprofessional_terms" {{ $current_lead->audit->using_unprofessional_terms == 'Yes'? 'checked':'' }} value="Yes" onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Unprofessional Behavior</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_7" name="unprofessional_behavior" {{ $current_lead->audit->unprofessional_behavior == 'Yes'? 'checked':'' }} value="Yes" onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Opening and closing of the call</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_8" name="improper_opening_and_closing_of_the_call" {{ $current_lead->audit->improper_opening_and_closing_of_the_call == 'Yes'? 'checked':'' }} value="Yes" onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">No Recording available unable to validate?</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="count_check_9" name="no_recording_available_unable_to_validate" {{ $current_lead->audit->no_recording_available_unable_to_validate == 'Yes'? 'checked':'' }} value="Yes" onclick="return false">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        @else
                        <div class="no_audit_found">No Lead Audit Found</div>
                        <form method="POST" action="{{ route('store_lead_audit') }}">
                                            @csrf
<input type="hidden" name="project" value="{{ $lead->project }}">
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
                                            <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle">New Audit <span style="float: right;">Total Yes Count: <span id="dis_check_count_new"></span></span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body" style="padding: 32px;">
                                            <div class="form-group row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>LAT Feedback</label>
                                                            <select name="lat_feedback" class="form-control">
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
                                                        <div class="col-md-4">
                                                            <label>LAT Executive</label>
                                                            <select name="lat_executive" class="form-control">
                                                                <option value="">Select One ***</option>

        @foreach($users as $user)
        <option value="{{ $user->name }}">{{ $user->name }}</option>
        @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Location</label>
                                                            <input type="text" class="form-control" name="location">
                                                        </div>
                                                        <div class="col-md-6 mt-4">
                                                            <label>Detailed Remark</label>
                                                            <textarea class="form-control" name="detailed_remark"></textarea>
                                                        </div>
                                                        <div class="col-md-6 mt-4">
                                                            <label>LAT Action</label>
                                                            <textarea class="form-control" name="lat_action"></textarea>
                                                        </div>

                                    <div class="col-md-6 mt-3">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">TAT is High?</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" name="tat_is_high" id="new_count_check_1" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Update in LMS</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_2" name="improper_update_in_lms" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">No Update in LMS</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_3" name="no_update_in_lms" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Pitching</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_4" name="improper_pitching" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Missed Follow Up</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_5" name="missed_follow_up" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Using Unprofessional Terms</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_6" name="using_unprofessional_terms" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Unprofessional Behavior</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_7" name="unprofessional_behavior" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">Improper Opening and closing of the call</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_8" name="improper_opening_and_closing_of_the_call" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-9 col-form-label">No Recording available unable to validate?</label>
                                            <div class="col-3">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label>
                                                        <input type="checkbox" id="new_count_check_9" name="no_recording_available_unable_to_validate" value="Yes">
                                                        <span></span>
                                                    </label>
                                                </span>
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
                        @endif
                    </div>
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
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var count_inc = parseInt("1");
            @if(!empty($current_lead->audit))
            var total_count = parseInt("{{ $current_lead->audit->total_yes }}");
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

        })
    </script>
@endsection