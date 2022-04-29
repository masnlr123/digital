<?php 
use App\CreativeImages;
?>
@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        All Web Team Task</h3>
                                </div>
                            </div>
                        </div>
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Web Team Task
                                            <small>List of Recent Web Team Task</small>
                                        </h3>
                                    </div>
                                <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('web_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Web Task
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="camp_index kt-portlet__body kt-portlet__body--fit">
                                    <div class="dashboard_block lead_audit_header_2">
                                    <div class="row">
                                            <div class="col-md-3">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Date Range Filter</h5>
                                                <div id="reportrange" class="custom_date_range">
                                                    <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong>
                                                    <span class="date"></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Project</h5>
                                                    <select class="form-control" id="filter_project">
                                                        <option value="">All</option>
                                                        @foreach($projects as $project)
                                                        <option value="{{ $project->project }}">{{ $project->project }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Activity</h5>
                                                    <select class="form-control" id="filter_activity">
                                                        <option value="">All</option>
                                                        @foreach($activity as $act)
                                                        <option value="{{ $act->activity }}">{{ $act->activity }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Asignee</h5>
                                                    <select class="form-control" id="filter_assignee">
                                                        <option value="">All</option>
                                                        @foreach($assignees as $assignee)
                                                        @php
                                                            $get_assignee = App\User::find($assignee->assignee);
                                                            if($get_assignee != NULL){
                                                                $assignee_name = $get_assignee->name;
                                                            }
                                                            else{
                                                                $assignee_name = 'No Assignee';
                                                            }
                                                        @endphp
                                                        <option value="{{$assignee->assignee }}">{{ $assignee_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Status</h5>
                                                    <select class="form-control" id="filter_status">
                                                        <option value="">All</option>
                                                        @foreach($status as $sta)
                                                        <option value="{{ $sta->status }}">{{ $sta->status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1 mt-4">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <button id="datatable_refresh" class="btn btn-brand btn-elevate btn-icon btn-icon-sm"> <i class="fas fa-sync"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    <!--begin: Datatable -->
                                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th title="Field #1">ID</th>
                                                <th title="Field #2">Project</th>
                                                <th width="30%" title="Field #2">Name</th>
                                                <th title="Field #3">Activity Type</th>
                                                <th title="Field #3">Campaign</th>
                                                <th title="Field #3">Assignee</th>
                                                <th title="Field #6">Status</th>
                                                <th width="11%">Date</th>
                                                <th title="Field #7">Action</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>

                        <!-- end:: Content -->
                    </div>
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')

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


        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
        <script type="text/javascript">

        //var table = $('#kt_table_1').DataTable({
            //    ordering: false,
            //    processing: true,
            //    serverSide: true,
            //    pageLength: 50,
            //    ajax: '{{ route('web_datatable') }}',
            //    columns: [
            //             { data: 'id', name: 'id' },
            //             { data: 'project', name: 'project' },
            //             { data: 'name', name: 'name' },
            //             { data: 'activity', name: 'activity' },
            //             { data: 'campaign', name: 'campaign' },
            //             { data: 'assignee', name: 'assignee' },
            //             { data: 'status', name: 'status' },
            //             { data: 'updated_at', name: 'updated_at' },
            //             // { data: 'status', searchable: false, orderable: false},
            //             { data: 'action', searchable: false, orderable: false }

            //          ],
            // });

        </script>


        <script type="text/javascript">

$(document).ready(function(){
    var from_date = '';
    var to_date = '';
    var project = '';
    var activity = '';
    var assignee = '';
    var status = 'Not_Completed';
    load_data(from_date, to_date, project, activity, assignee,  status);

    $("#filter_project, #filter_status, #filter_activity, #filter_assignee").on('change', function(){
        project = $("#filter_project").val();
        activity = $("#filter_activity").val();
        assignee = $("#filter_assignee").val();
        status = $("#filter_status").val();
        $('#kt_table_1').DataTable().destroy();
        load_data(from_date, to_date, project, activity, assignee,  status);
    });


    function load_data(from_date = '', to_date = '', project = '', activity = '', assignee = '',  status = ''){
        $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
        var table = $('#kt_table_1').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
           pageLength: 50,
           ajax: {
            url:'{{ route('web_datatable') }}',
            data:{
                from_date:from_date,
                to_date:to_date,
                project:project,
                activity:activity,
                assignee:assignee,
                status:status
            }
           },
           columns: [
                    { data: 'id', name: 'id' },
                    { data: 'project', name: 'project' },
                    { data: 'name', name: 'name' },
                    { data: 'activity', name: 'activity' },
                    { data: 'campaign', name: 'campaign' },
                    { data: 'assignee', name: 'assignee' },
                    { data: 'status', name: 'status' },
                    { data: 'updated_at', name: 'updated_at' },
                    // { data: 'status', searchable: false, orderable: false},
                    { data: 'action', searchable: false, orderable: false }

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
     }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end, label) {
        if (label == 'Today') {
            title = 'Today';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        } else if (label == 'This Month') {
            title = 'This Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, activity, assignee,  status);
        }
        else{
            title = 'Last 30 Days';
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

    
    $('#datatable_refresh').click(function(){
        $("#filter_project").trigger("change");
        $("#filter_status").trigger("change");
        $("#filter_activity").trigger("change");
        $("#filter_assignee").trigger("change");
        $('#kt_table_1').DataTable().destroy();
        load_data('', '', '', '', '',  'Not_Completed');
    });


});


        </script>

        <!-- <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js') }}"></script> -->
@endsection