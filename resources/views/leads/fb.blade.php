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
                                        Imported Lead List</h3>
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
                                            Imported Lead List
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
                                    <form class="kt-form" method="post" action="{{ route('facebook_lead_store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="kt-container">
                    <div class="form-group row">
                        <div class="col-md-4 col-4 mt-3">
                            <label>List Name*</label>
                            <input type="text" name="list_name" class="form-control" placeholder="Enter List Name" required>
                        </div>
                        <div class="col-md-2 col-2 mt-3">
                            <label>Project*</label>
                            <select id="select_project" class="form-control quick_input" name="project" required>
                                <option value="">Choose one...</option>
                                <option value="AGR">Alliance Galleria Residences</option>
                                <option value="HG">Humming Gardens</option>
                                <option value="OS">Orchidspringss</option>
                                <option value="TSAI Apartments">TSAI Apartments</option>
                                <option value="BP">Bachupally</option>
                                <option value="Eternity">Eternity</option>
                                <option value="Eternity">Eternity</option>
                                <option value="Jubilee Residences">Jubilee Residences</option>
                                <option value="Project Jasmine Springs">Project Jasmine Springs</option>
                                <option value="Project Padur">Project Padur</option>
                                <option value="Project Siruseri">Project Siruseri</option>
                                <option value="Project Ameenpur">Project Ameenpur</option>
                                <option value="Project Bachupally">Project Bachupally</option>
                                <option value="Project Gandimaisamma">Project Gandimaisamma</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-2 mt-3">
                            <label>CSV File*</label>
                            <input required type="file" class="form-control" name="leads_csv" placeholder="address">
                        </div>
                        <div class="col-md-2 col-2 mt-3">
                            <label>Check Duration (Optional)</label>
                            <select class="form-control quick_input" name="duration">
                                <option value="">Choose one...</option>
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="3">3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                                <option value="6">6 Days</option>
                                <option value="7">7 Days</option>
                            </select>
                        </div>
                        <div class="col-md-1 col-1">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" style="margin-top: 34px;border-radius: 2px" type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-upload"></i> Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <input type="submit" name="submit" class="dropdown-item" value="Lead Check">
                                    <input type="submit" name="submit" class="dropdown-item" value="Lead Check & Import" disabled>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    </div><hr style="margin-bottom: 0;">
            </form>
            
                                <div class="dashboard_block lead_audit_header_2" style="padding: 7px 0px;background: #f3fdff;padding-top: 20px;">
                                    <div class="kt-container">
                                    <div class="row">
                                        <!-- <div class="col-4">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Date Range Filter</h5>
                                                <div id="reportrange" class="custom_date_range">
                                                    <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong>
                                                    <span class="date"></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Project</h5>
                                                <select class="form-control" id="filter_project" multiple>
                                                    <option value="">All</option>
                                                    @foreach($projects as $project)
                                                    <option value="{{ $project->project }}">{{ $project->project }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Import List</h5>
                                                <select class="form-control" id="filter_list" multiple>
                                                    <option value="">All</option>
                                                    @foreach($list_name as $project)
                                                    <option value="{{ $project->list_name }}">{{ $project->list_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Status</h5>
                                                <select class="form-control" id="filter_activity" multiple>
                                                    <option value="">All</option>
                                                    @foreach($activity as $project)
                                                    <option value="{{ $project->activity }}">{{ $project->activity }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Stage</h5>
                                                <select class="form-control" id="filter_stage" multiple>
                                                    <option value="">All</option>
                                                    @foreach($stage as $project)
                                                    <option value="{{ $project->stage }}">{{ $project->stage }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button id="datatable_refresh" class="btn btn-brand btn-elevate" style="border-radius: 2px;width: 100%;margin-top: 23px;"><i class="flaticon2-refresh"></i>Refresh</button>
                                        </div>
                                    </div>

                                    <div class="row dashboard_report mt-3 mb-3">
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_7 kt-callout--diagonal-bg">
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
                                            <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Fresh Leads</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count fresh_lead_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                            <div class="audit_count_box kt-callout audit_count_11 kt-callout--diagonal-bg">
                                                <div class="kt-portlet__body">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title">Total Leads Exist</h3>
                                                            <p class="kt-callout__desc">
                                                                <span class="lead_count exist_lead_count">0</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 table-contents">
                                                <form method="get" action="{{ route('update_lead_import_list') }}">
                                            <div class="row">
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="filter_list" name="list_name">
                                                            <option value="">All</option>
                                                            @foreach($list_name as $project)
                                                            <option value="{{ $project->list_name }}">{{ $project->list_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" style="border-radius: 2px" type="button" class="btn btn-brand dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-upload"></i> Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <input type="submit" name="delete" class="dropdown-item" value="Delete">
                                    <input type="submit" name="submit" class="dropdown-item" value="Import to Leadsqaured" disabled>
                                </div>
                            </div>
                                                    </div>
                                            </div>
                                                </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="camp_index kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <table class="table table-striped table-bordered table-hover display nowrap" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>List Name</th>
                                                <th>Project</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th width="120">Contact</th>
                                                <!-- <th width="300">Is New Lead</th> -->
                                                <th width="75">Status</th>
                                                <th width="75">Import Activity</th>
                                                <th width="75">Date</th>
                                                <!-- <th width="300">Lead ID</th> -->
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
            // $('#kt_table_1 thead tr').clone(true).appendTo( '#kt_table_1 thead' );
            //     $('#kt_table_1 thead tr:eq(1) th').each( function (i) {
            //         var title = $(this).text();
            //         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
             
            //         $( 'input', this ).on( 'keyup change', function () {
            //             if ( table.column(i).search() !== this.value ) {
            //                 table
            //                     .column(i)
            //                     .search( this.value )
            //                     .draw();
            //             }
            //         } );
            //     } );

$(document).ready(function(){

    $('#filter_project').select2({
        placeholder: "Select project"
    });
    $('#filter_list').select2({
        placeholder: "Select Import List"
    });
    $('#filter_stage').select2({
        placeholder: "Select Status"
    });
    $('#filter_activity').select2({
        placeholder: "Select Activity"
    });

    // var from_date = '';
    // var to_date = '';
    var project = '';
    var list_name = '';
    var stage = '';
    var activity = '';
    load_data();
    $("#filter_project, #filter_stage, #filter_list, #filter_activity").on('change', function(){
        project = $("#filter_project").val();
        stage = $("#filter_stage").val();
        list_name = $("#filter_list").val();
        activity = $("#filter_activity").val();
        $('#kt_table_1').DataTable().destroy();
        // if(){
        //     alert('Working');
        // }else{

        //     alert('Not Working');
        // }
        load_data(project, list_name, stage, activity);
    });
    $('#datatable_refresh').click(function(){
        window.location.reload();
    });
    function load_data(project = '', list_name = '', stage = '', activity = ''){
        $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');

        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               scroll: true,
               pageLength: 50,
               lengthMenu: [ [10, 25, 50, 100, 200, 500, 1000, -1], [10, 25, 50, 100, 200, 500, 1000, "All"] ],
               ajax: {
                url:'{{ route('fb_leads_datatables') }}',
                data:{
                    filter:{
                        project:project,
                        list_name:list_name,
                        stage:stage,
                        activity:activity,
                    }
                }
               },
               columns: [
                        { data: 'list_name', name: 'list_name' },
                        { data: 'project', name: 'project' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'contact', name: 'contact' },
                        // { data: 'is_new_lead', name: 'is_new_lead' },
                        { data: 'stage', name: 'stage' },
                        { data: 'activity', name: 'activity' },
                        { data: 'created_at', name: 'created_at' },
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
            });

        $.ajax({  //create an ajax request to display.php
            type: "GET",
            data:{
                filter:{
                    project:project,
                    list_name:list_name,
                    stage:stage,
                    activity:activity,
                }
            },
            url: "{{ route('get_imported_leads_data') }}",       
            success: function(data){
                console.log(data);
                $(".total_lead_count").html(data.total_lead_count);
                $(".fresh_lead_count").html(data.fresh_lead_count);
                $(".exist_lead_count").html(data.exist_lead_count);
            }
        });
    };

                if($('#kt_table_1').find('thead').width() < $('#kt_table_1').width()){
                    let tr_count = $('#kt_table_1').find('thead th').length;
                    let find_width = $('#kt_table_1').width()/tr_count;
                    // alert(find_width);
                    // alert(tr_count);
                    // alert(find_width);
                    $('#kt_table_1').find('thead th').attr('width', find_width).attr('test', 'alex');
                }

});


        </script>

        <!-- <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js') }}"></script> -->
@endsection