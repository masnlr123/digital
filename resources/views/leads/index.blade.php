@extends('layouts.app')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        {{ $current_project }} Lead List </h3>
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
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            {{ $current_project }} Lead
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions mr-3" style="width: 200px;">
                                            <select class="form-control" id="filter_owner">
                                                <option value="">Filter By Lead Owner</option>
                                                @foreach($lead_owners as $lead_owner)
                                                <option value="{{ $lead_owner->lead_owner }}">{{ $lead_owner->lead_owner }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="kt-portlet__head-actions mr-3" style="width: 150px;">
                                            <select class="form-control " id="filter_stage">
                                                <option value="">Filter By Status</option>
                                                @foreach($all_status as $status)
                                                <option value="{{ $status->lead_stage }}">{{ $status->lead_stage }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="kt-portlet__head-actions mr-3" style="width: 200px;">
                                            <select class="form-control" id="filter_source">
                                                <option value="">Filter By Source</option>
                                                @foreach($all_source as $source)
                                                <option value="{{ $source->lead_source }}">{{ $source->lead_source }}</option>
                                                @endforeach
                                            </select>
                                            </div>
<!--                                             <div class="kt-portlet__head-actions mr-3">
                                            <select class="form-control" id="filter_source">
                                                <option value="">Filter by Lead Audits</option>
                                                <option value="Audit Done">Audit Done</option>
                                                <option value="Not Started">Not Started</option>
                                            </select>
                                            </div> -->
                                            <div class="kt-portlet__head-actions mr-3">
                                            <div id="reportrange" class="custom_date_range">
                                                <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong>
                                                <span class="date"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                            </div>
                                            <div class="kt-portlet__head-actions">
                                            <button id="datatable_refresh" class="btn btn-brand btn-elevate btn-icon btn-icon-sm"> <i class="fas fa-sync"></i></button>
                                            
                                            </div>
                                        </div>
                                    </div> 

<!--                                         <div class="row datatable-filter-area">
                                        <div class="col-sm-3 table-contents">
                                            <select class="form-control" id="order_status">
                                                <option value="">Filter By Status</option>
                                                <option value="New">New</option>
                                                <option value="Confirmed">Confirmed</option>
                                                <option value="Dispatched">Dispatched</option>
                                                <option value="Delivered">Delivered</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Returned">Returned</option>
                                                <option value="Return Received">Return Received</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3 table-contents">
                                        </div>
                                        <div class="col-sm-4 table-contents">
                                        </div>
                                        <div class="col-sm-2 table-contents">
                                        </div>
                                        </div> -->
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
                                                <th width="4%">#</th>
                                                <th>Lead Stage</th>
                                                <th width="18%">Name</th>
                                                <th>Lead Source</th>
                                                <!-- <th>Lead Orgin</th> -->
                                                <th width="15%">Created On</th>
                                                <th width="3%">Age</th>
                                                <th>Lead Owner</th>
                                                <th>Lead Audit</th>
                                                <th width="4%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>

                        <!-- end:: Content -->
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

@section('footer_js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
@php
switch ($current_project) {
    case 'AGR':
    $datatable_url = route('agr_leads_datatable');
    break;
    case 'HG':
    $datatable_url = route('hg_leads_datatable');
    break;
    case 'OS':
    $datatable_url = route('os_leads_datatable');
    break;
    case 'VIB':
    $datatable_url = route('vib_leads_datatable');
    break;
    case 'Eternity':
    $datatable_url = route('et_leads_datatable');
    break;
    case 'JR':
    $datatable_url = route('jr_leads_datatable');
    break;
    case 'BP':
    $datatable_url = route('bp_leads_datatable');
    break;
    case 'JS':
    $datatable_url = route('js_leads_datatable');
    break;
    case 'Padur':
    $datatable_url = route('padur_leads_datatable');
    break;
    case 'Siruseri':
    $datatable_url = route('siruseri_leads_datatable');
    break;
    case 'Ameenpur':
    $datatable_url = route('ameenpur_leads_datatable');
    break;
    case 'Bachupally':
    $datatable_url = route('bachu_leads_datatable');
    break;
    case 'Gandimaisamma':
    $datatable_url = route('gandimaisamma_leads_datatable');
    break;
    case 'TSAI Apartments':
    $datatable_url = route('tsai_leads_datatable');
    break;
}
@endphp

$(document).ready(function(){

    load_data();
    var lead_source = '';
    var lead_stage = '';
    var lead_owner = '';
    var current_from_date = '';
    var current_to_date = '';

    function load_data(from_date = '', to_date = '', stage = '', source = '', owner = ''){
        $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
        var table = $('#kt_table_1').DataTable({
           ordering: false,
           processing: true,
           serverSide: true,
           pageLength: 50,
           ajax: {
            url:'{{ $datatable_url }}',
            data:{from_date:from_date, to_date:to_date, stage:stage, source:source, owner:owner}
           },
           columns: [
                    { data: 'lead_number', name: 'lead_number' },
                    { data: 'lead_stage', name: 'lead_stage' },
                    { data: 'first_name', name: 'first_name' },
                    { data: 'lead_source', name: 'lead_source' },
                    // { data: 'lead_origin', name: 'lead_origin' },
                    { data: 'created_on', name: 'created_on' },
                    { data: 'lead_age', name: 'lead_age' },
                    { data: 'lead_owner', name: 'lead_owner' },
                    { data: 'lead_audit', name: 'lead_audit' },
                    // { data: 'status', searchable: false, orderable: false},
                    { data: 'action', searchable: false, orderable: false }

                 ],
            "createdRow": function( row, data, dataIndex ) {
                if (data['lead_stage'] == "Invalid") {
                  $(row).addClass( 'bg-invalid' );
                }
              }
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
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            $('#kt_table_1').DataTable().destroy();
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            $('#kt_table_1').DataTable().destroy();
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            $('#kt_table_1').DataTable().destroy();
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        } else if (label == 'This Month') {
            title = 'This Month';
            $('#kt_table_1').DataTable().destroy();
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            $('#kt_table_1').DataTable().destroy();
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            $('#kt_table_1').DataTable().destroy();
            current_from_date = start.format('YYYY-MM-DD H:i:s');
            current_to_date = end.format('YYYY-MM-DD H:i:s');
            load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);
        }
        else{
            title = 'Last 30 Days';
            // $('#kt_table_1').DataTable().destroy();
            // load_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'), '', '');
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
    
    $("#filter_stage, #filter_source, #filter_owner").on('change', function(){

        // selected_date = $('#reportrange span.date').text();
        // selected_date = selected_date.replace(/ /g, '');
        // selected_date = selected_date.split("-");
        // current_from_date = selected_date[0] + ' 00:00:00';
        // current_to_date = selected_date[1] + ' 00:00:00';

        lead_source = $("#filter_source").val();
        lead_stage = $("#filter_stage").val();
        lead_owner = $("#filter_owner").val();
        $('#kt_table_1').DataTable().destroy();
        // alert(current_from_date);
        // alert(current_to_date);
        // alert(lead_stage);
        // alert(lead_source);
        // alert(ead_owner);
        load_data(current_from_date, current_to_date, lead_stage, lead_source, lead_owner);

    });
    $('#datatable_refresh').click(function(){
        $('#kt_table_1').DataTable().destroy();
        $("#filter_stage").val('');
        $("#filter_source").val('');
        cb(start, end);
        load_data();
    })

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