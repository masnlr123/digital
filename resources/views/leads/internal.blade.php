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
                                        All Lead List</h3>
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
                                            Lead List
                                            <small>List of Recent Lead List</small>
                                        </h3>
                                    </div>
<!--                                 <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('content_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Content Task
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="camp_index kt-portlet__body kt-portlet__body--fit">

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
                                        <div class="col-4">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Landing Page</h5>
                                                <select class="form-control" id="filter_lp">
                                                    <option value="">All</option>
                                                    @foreach($lp_id as $lpid)
                                                    <option value="{{ $lpid->lp_id }}">{{ $lpid->lp_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button id="datatable_refresh" class="btn btn-brand btn-elevate" style="border-radius: 2px;width: 100%;margin-top: 23px;">Refresh</button>
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
                                        </div><div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_14 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Submitted Leads</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count total_fresh_leads">0</span>
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
                                                            <h3 class="kt-callout__title">Failed Leads</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count total_exist_leads">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <!--begin: Datatable -->
                                    <table class="table table-striped table-bordered table-hover display nowrap" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>Date</th>
                                                <th>Project</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th width="120">Contact</th>
                                                <th width="75">LSQ Status</th>
                                                <th width="300">Lead ID</th>
                                                <th width="300">Track ID</th>
                                                <th width="300">LP ID</th>
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
$(document).ready(function(){
    $('#filter_project').select2({
        placeholder: "Select Project"
    });
    $('#filter_lp').select2({
        placeholder: "Select LP"
    });
    var from_date = '';
    var to_date = '';
    var project = '';
    var lp_id = '';
    load_data();
    $("#filter_project, #filter_lp").on('change', function(){
        project = $("#filter_project").val();
        lp_id = $("#filter_lp").val();

        $('#kt_table_1').DataTable().destroy();
        load_data(from_date, to_date, project, lp_id);
    });
    $('#datatable_refresh').click(function(){
        window.location.reload();
    });

    function load_data(from_date = '', to_date = '', project = '', lp_id = ''){
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
            url:'{{ route('internal_leads_datatables') }}',
            data:{
                from_date:from_date,
                to_date:to_date,
                filter:{
                    project:project,
                    lp_id:lp_id,
                }
            }
           },
           columns: [
                        { data: 'created_at', name: 'created_at' },
                        { data: 'project', name: 'project' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'contact', name: 'contact' },
                        { data: 'leadsquared_submited', name: 'leadsquared_submited' },
                        { data: 'lead_id', name: 'lead_id' },
                        { data: 'track_id', name: 'track_id' },
                        { data: 'lp_id', name: 'lp_id' }
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
                filter:{
                    project:project,
                    lp_id:lp_id,
                }
            },
            url: "{{ route('get_lp_leads_data') }}",       
            success: function(data){
                console.log(data);
                $(".total_lead_count").html(data.total_lead_count);
                $(".total_fresh_leads").html(data.total_fresh_leads);
                $(".total_exist_leads").html(data.total_exist_leads);
            }
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
            load_data(from_date, to_date, project, lp_id);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lp_id);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lp_id);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lp_id);
        } else if (label == 'This Month') {
            title = 'This Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lp_id);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lp_id);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, lp_id);
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
});

        // var table = $('#kt_table_1').DataTable({
        //        ordering: false,
        //        processing: true,
        //        serverSide: true,
        //        scroll: true,
        //        pageLength: 50,
        //        ajax: '{{ route('internal_leads_datatables') }}',
        //        columns: [
        //                 { data: 'created_at', name: 'created_at' },
        //                 { data: 'project', name: 'project' },
        //                 { data: 'name', name: 'name' },
        //                 { data: 'email', name: 'email' },
        //                 { data: 'contact', name: 'contact' },
        //                 { data: 'leadsquared_submited', name: 'leadsquared_submited' },
        //                 { data: 'lead_id', name: 'lead_id' },
        //                 { data: 'track_id', name: 'track_id' },
        //                 { data: 'lp_id', name: 'lp_id' }

        //              ],
        //     });

        </script>

        <!-- <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js') }}"></script> -->
@endsection