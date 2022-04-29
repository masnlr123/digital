@extends('layouts.app')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        Lead Audits Dashboard</h3>
                                    <span class="kt-subheader__separator kt-hidden"></span>
                                </div>
                                <div class="kt-subheader__toolbar">
                                    <a href="#" class="">
                                    </a>
                                    <a href="{{ route('export_lead_audit') }}" class="btn btn-brand btn-bold">
                                        Export Lead Audit </a>
                                </div>
                            </div>
                        </div>

                        <!-- end:: Subheader -->

                        <!-- begin:: Content -->
                        <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="row">
                                <div class="">
                                    
                            <div class="kt-portlet kt-portlet--tabs">

                                <div class="kt-portlet__head kt-portlet__head--lg">
<!--                                     <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Lead Audits
                                        </h3>
                                    </div> -->
                                    
                                @include('leads.inc.report_menu')
                                </div>

                    <div class="kt-portlet__body">
                                <div class="dashboard_block lead_audit_header_2" style="padding: 7px 0px;">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Date Range Filter</h5>
                                                <div id="reportrange" class="custom_date_range">
                                                    <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong>
                                                    <span class="date"></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Project</h5>
                                                <select class="form-control" id="filter_project" multiple>
                                                    @foreach($projects as $project)
                                                    <option value="{{ $project->project }}">{{ $project->project }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Lead Stage</h5>
                                                <select class="form-control" id="filter_stage">
                                                    <option value="">All</option>
                                                    @foreach($lead_stage as $agent)
                                                    <option value="{{ $agent->lead_stage }}">{{ $agent->lead_stage }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Lead Source</h5>
                                                <select class="form-control" id="filter_source">
                                                    <option value="">All</option>
                                                    @foreach($lead_source as $agent)
                                                    <option value="{{ $agent->lead_source }}">{{ $agent->lead_source }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <button id="datatable_refresh" class="btn btn-brand btn-elevate" style="border-radius: 2px;width: 100%;margin-top: 23px;">Refresh</button>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Lead Agent</h5>
                                                <select class="form-control" id="filter_agent">
                                                    <option value="">All</option>
                                                    @foreach($agents as $agent)
                                                    <option value="{{ $agent->lead_owner }}">{{ $agent->lead_owner }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Audit Person</h5>
                                                <select class="form-control" id="filter_user">
                                                    <option value="">All</option>
                                                        @foreach($audit_users as $user)
                                                        <option value="{{ $user->lat_executive }}">{{ $user->lat_executive }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Call Type</h5>
                                                <select class="form-control" id="filter_audit_type">
                                                    <option value="">All Call Type</option>
                                                    <option value="fresh">Fresh Audit</option>
                                                    <option value="followup">Followup Audit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Call Record</h5>
                                                <select class="form-control" id="filter_call_record">
                                                    <option value="">All</option>
                                                    <option value="Yes">Call Record Not found</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>LAT Feedback</h5>
                                                <select class="form-control" id="filter_feedback">
                                                    <option value="">All</option>
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
                                                    <option value="Wrong Disposition">Wrong Disposition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Red Alert</h5>
                                                <select class="form-control" id="filter_red_alert">
                                                    <option value="">All</option>
                                                    <option value="Yes">Only Red Alert</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row dashboard_report mt-3">
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Leads</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count total_lead_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_14 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Soft Skills</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count soft_skills_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Product Knowledge</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count product_knowledge_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_16 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">LMS Update</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count lms_update_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_17 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Zero Tolerance</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count lms_update_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_18 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Overall Score</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count total_score">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_2 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Lead Audited</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count total_leads_audited">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_3 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Calls Audited</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count lead_audited">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_4 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Fresh Calls</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count fresh_lead_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_5 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Followup Calls</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count followup_lead_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Audit/Day</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count day_length">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_7 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Agents Audited</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count total_agents">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents mt-3">
                                            <div class="audit_count_box kt-callout audit_count_8 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Zero Tolerance</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count zero_tol_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents mt-3">
                                            <div class="audit_count_box kt-callout audit_count_9 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">No Call record</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count record_not_found">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents mt-3">
                                            <div class="audit_count_box kt-callout audit_count_10 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Missed Followps</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count missed_followup">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents mt-3">
                                            <div class="audit_count_box kt-callout audit_count_11 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">TAT is High</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count tat_is_high">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents mt-3">
                                            <div class="audit_count_box kt-callout audit_count_12 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">No Task Creation</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count false_enquiry">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents mt-3">
                                            <div class="audit_count_box kt-callout audit_count_13 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Red Alert</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count red_alert">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($message_file_upload_success = Session::get('file_upload_success'))
                                <div class="alert alert-success fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $message_file_upload_success }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                @if($file_upload_error = Session::get('file_upload_error'))
                                @foreach($file_upload_error as $error)
                                <div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $error }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @if($message = Session::get('leads_added'))
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
                                <div class="kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <!-- <table class="kt-datatable" id="html_table" width="100%"> -->
                                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Call Type</th>
                                                <th>Project</th>
                                                <th>Lead Owner</th>
                                                <th>Lead Stage</th>
                                                <th>Lead Source</th>
                                                <th>LAT Feedback</th>
                                                <th>LAT Action</th>
                                                <th width="11%">LAT Executive</th>
                                                <th width="3%">Score</th>
                                                <th>Audit Date</th>
                                                <th width="4%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!--end: Datatable -->
                                </div>
                    </div>
                </div>
                                </div>
                            </div>
            </div>
        </div>
<div class="modal fade" id="upload_lead_audits" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('import_lead_audits') }}">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Lead Audit CSV file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Upload Lead Audits</label>
                                <div class="input-group">
                                    <input required type="file" class="form-control" name="leads_csv" placeholder="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Upload CSV">
                    </div>
                </form>
                </div>
            </div>
        </div>

@endsection

@section('header_css')
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer_js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
        <script type="text/javascript">

$(document).ready(function(){

    $('#filter_project').select2({
        placeholder: "Select project"
    });
    $('#filter_stage').select2({
        placeholder: "Select stage"
    });
    $('#filter_source').select2({
        placeholder: "Select source"
    });
    $('#filter_agent').select2({
        placeholder: "Select agent"
    });
    $('#filter_user').select2({
        placeholder: "Select User"
    });
    $('#filter_total_score').select2({
        placeholder: "Select a score rage"
    });
    $('#filter_audit_list').select2({
        placeholder: "Select one"
    });
    $('#filter_audit_type').select2({
        placeholder: "Select a audit type"
    });
    $('#filter_call_record').select2({
        placeholder: "Select a Call Record"
    });
    $('#filter_feedback').select2({
        placeholder: "Select a Feedback"
    });
    $('#filter_red_alert').select2({
        placeholder: "Select a Red alert"
    });
    $('#filter_soft_skills').select2({
        placeholder: "Select a Soft skills"
    });
    $('#filter_product_knowledge').select2({
        placeholder: "Select a Product Knowledge"
    });
    $('#filter_zero_tolerance').select2({
        placeholder: "Select a Zero Tolerance"
    });
    $('#filter_lms_update').select2({
        placeholder: "Select a LMS Update"
    });
    var from_date = '';
    var to_date = '';
    var project = '';
    var lead_source = '';
    var lead_stage = '';
    var lead_owner = '';
    var lat_executive = '';
    var total_score = '';
    var audit_list = '';
    var audit_type = '';
    var record_not_found = '';
    var lat_feedback = '';
    var red_alert = '';
    var soft_skills = '';
    var product_knowledge = '';
    var lms_update = '';
    var zero_tolerance = '';

    load_data();

    $("#filter_project, #filter_stage, #filter_source, #filter_agent, #filter_user, #filter_total_score, #filter_audit_list, #filter_audit_type, #filter_call_record, #filter_feedback, #filter_red_alert, #filter_soft_skills, #filter_product_knowledge, #filter_lms_update, #filter_zero_tolerance").on('change', function(){
        project = $("#filter_project").val();
        lead_source = $("#filter_source").val();
        lead_stage = $("#filter_stage").val();
        lead_owner = $("#filter_agent").val();
        lat_executive = $("#filter_user").val();
        total_score = $("#filter_total_score").val();
        audit_list = $("#filter_audit_list").val();
        audit_type = $("#filter_audit_type").val();
        record_not_found = $("#filter_call_record").val();
        lat_feedback = $("#filter_feedback").val();
        red_alert = $("#filter_red_alert").val();
        soft_skills = $("#filter_soft_skills").val();
        product_knowledge = $("#filter_product_knowledge").val();
        lms_update = $("#filter_lms_update").val();
        zero_tolerance = $("#filter_zero_tolerance").val();


        $('#kt_table_1').DataTable().destroy();
        load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update, zero_tolerance);
    });

    // $('#datatable_refresh').click(function(){
    //     $("#filter_project").trigger("change");
    //     $("#filter_source").trigger("change");
    //     $("#filter_stage").trigger("change");
    //     $("#filter_agent").trigger("change");
    //     $("#filter_user").trigger("change");
    //     $("#filter_total_score").trigger("change");
    //     $("#filter_audit_list").trigger("change");
    //     $("#filter_audit_type").trigger("change");
    //     $("#filter_call_record").trigger("change");
    //     $("#filter_feedback").trigger("change");
    //     $("#filter_red_alert").trigger("change");
    //     $("#filter_soft_skills").trigger("change");
    //     $("#filter_product_knowledge").trigger("change");
    //     $("#filter_lms_update").trigger("change");
    //     load_data();
    // });

    $('#datatable_refresh').click(function(){
        window.location.reload();
    });

    function load_data(from_date = '', to_date = '', project = '', lead_source = '', lead_stage = '',  lead_owner = '', lat_executive = '', total_score = '', audit_list = '', audit_type = '', record_not_found = '', lat_feedback = '', red_alert = '', soft_skills = '', product_knowledge = '', lms_update = '', zero_tolerance = ''){
        $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
        var table = $('#kt_table_1').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
               // scroll: true,
               // orderCellsTop: true,
           pageLength: 50,
               lengthMenu: [ [10, 25, 50, 100, 200, 500, 1000, -1], [10, 25, 50, 100, 200, 500, 1000, "All"] ],
           ajax: {
            url:'{{ route('audit_index_datatable') }}',
            data:{
                from_date:from_date,
                to_date:to_date,
                audit_list:audit_list,
                soft_skills:soft_skills,
                product_knowledge:product_knowledge,
                lms_update:lms_update,
                zero_tolerance:zero_tolerance,
                total_score:total_score,
                filter:{
                    project:project,
                    lead_source:lead_source,
                    lead_stage:lead_stage,
                    lead_owner:lead_owner,
                    lat_executive:lat_executive,
                    lat_feedback:lat_feedback,
                    red_alert:red_alert,
                    record_not_found:record_not_found,
                    type:audit_type,
                }
            }
           },
           columns: [
                    { data: 'lead_number', name: 'lead_number' },
                    { data: 'type', name: 'type' },
                    { data: 'project', name: 'project' },
                    { data: 'lead_owner', name: 'lead_owner' },
                    { data: 'lead_stage', name: 'lead_stage' },
                    { data: 'lead_source', name: 'lead_source' },
                    { data: 'lat_feedback', name: 'lat_feedback' },
                    { data: 'lat_action', name: 'lat_action' },
                    { data: 'lat_executive', name: 'lat_executive' },
                    { data: 'total_score', name:'total_score' },
                    { data: 'created_at', name: 'created_at' },
                    // { data: 'status', searchable: false, orderable: false},
                    { data: 'action', searchable: false, orderable: false }
                 ],

                     dom: "<'row'<'col-2'l><'col-5'B><'col-sm-12 col-md-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                     columnDefs: [
                            {
                                targets: 1,
                                className: 'noVis'
                            }
                        ],
                        buttons: [
                        'copy', 'excel', 'csv', 'pdf', 'print',
                            {
                                extend: 'colvis',
                                columns: ':not(.noVis)',
                                 text: 'Coloumns',
                                 collectionLayout: 'fixed three-column'
                            }
                        ],
            // "createdRow": function( row, data, dataIndex ) {
            //     if (data['lead_stage'] == "Invalid") {
            //       $(row).addClass( 'bg-invalid' );
            //     }
            //   }
            // language : {
            //     processing: '<img src="{{asset('assets/images/loader.jpg')}}">'
            // },
            // drawCallback : function( settings ) {
            //         $('.select').niceSelect();
            // }
            // fnRowCallback : function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //   if (aData[2] == "Invalid") {
            //     $('td', nRow).css('background-color', '#FFCCBC');
            //   }
            // }
        });
        $.ajax({  //create an ajax request to display.php
            type: "GET",
            data:{
                from_date:from_date,
                to_date:to_date,
                audit_list:audit_list,
                soft_skills:soft_skills,
                product_knowledge:product_knowledge,
                lms_update:lms_update,
                zero_tolerance:zero_tolerance,
                total_score:total_score,
                filter:{
                    project:project,
                    lead_source:lead_source,
                    lead_stage:lead_stage,
                    lead_owner:lead_owner,
                    lat_executive:lat_executive,
                    lat_feedback:lat_feedback,
                    red_alert:red_alert,
                    record_not_found:record_not_found,
                    type:audit_type,
                }
            },
            url: "{{ route('get_leads_data') }}",       
            success: function(data){
                console.log(data);
                $(".lead_count").html(data.all_leads);
                $(".lead_audited").html(data.lead_audited);
                $(".total_leads_audited").html(data.total_leads_audited);
                $(".fresh_lead_count").html(data.fresh_lead_count);
                $(".followup_lead_count").html(data.followup_lead_count);
                $(".total_agents").html(data.total_agents);

                $(".day_length").html(data.day_length);
                $(".zero_tol_count").html(data.zero_tol_count);
                $(".record_not_found").html(data.record_not_found);
                $(".tat_is_high").html(data.tat_is_high);
                $(".missed_followup").html(data.missed_followup);
                $(".false_enquiry").html(data.false_enquiry);
                
                $(".red_alert").html(data.red_alert);
                $(".total_score").html(data.total_score);
                $(".soft_skills_count").html(data.soft_skills_count);
                $(".product_knowledge_count").html(data.product_knowledge_count);
                $(".lms_update_count").html(data.lms_update_count);
            }
        });

            // $('#kt_table_1 thead tr').clone(true).appendTo('#kt_table_1 thead');
            //     $('#kt_table_1 thead tr:eq(1) th').each( function(i) {
            //         if($(this).text() == 'Action'){
            //             $(this).text('');
            //         }
            //         else{
            //             var title = $(this).text();
            //             $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            //         }
             
            //         $( 'input', this ).on( 'keyup change', function () {
            //             if ( table.column(i).search() !== this.value ) {
            //                 table
            //                     .column(i)
            //                     .search( this.value )
            //                     .draw();
            //             }
            //         });
            //     });
     }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end, label) {
        if (label == 'Today') {
            title = 'Today';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        } else if (label == 'This Month') {
            title = 'This Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        }
        else{
            title = 'Last 30 Days';
            // $('#kt_table_1').DataTable().destroy();
            // load_data(from_date, to_date, project, lead_source, lead_stage,  lead_owner, lat_executive, total_score, audit_list, audit_type, record_not_found, lat_feedback, red_alert, soft_skills, product_knowledge, lms_update);
        }
        $('#reportrange span').html(start.format('MM/D/YYYY') + ' - ' + end.format('MM/D/YYYY'));
        $('#reportrange span.reportrange_lable').html(title);
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);


});


        </script>

        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#22b9ff",
                        "light": "#ffffff",
                        "dark": "#282a3c",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };

        </script>
        <script type="text/javascript">
            $('.kt-datatable__head th:nth-child(1)').css('max-width', '90px');
        </script>
@endsection