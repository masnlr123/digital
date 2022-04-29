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
                        <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="row">
                                <div class="">
                            <div class="kt-portlet kt-portlet--tabs">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    
                                @include('leads.inc.report_menu')
                                </div>

                    <div class="kt-portlet__body">
                            <div id="reports_by_agent" >
                                    <form action="{{ route('agent_report') }}" method="get" id="search_agent_reports">
                                <div class="row mb-3 mt-3">
                                        <input type="hidden" id="start_date" name="from_date">
                                        <input type="hidden" id="end_date" name="to_date">
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
                                                <select class="form-control" id="filter_project" name="project">
                                                    <option value="">All</option>
                                                    @foreach($projects as $project)
                                                    <option @if(request()->project == $project->project) selected @endif value="{{ $project->project }}">{{ $project->project }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button id="datatable_refresh" class="btn btn-success btn-elevate" style="border-radius: 2px;width: 100%;margin-top: 23px;"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('agent_report') }}" id="datatable_refresh2" class="btn btn-brand btn-elevate" style="border-radius: 2px;width: 100%;margin-top: 23px;"><i class="fa fa-unto"></i> Refresh</a>
                                        </div>
                                </div>
                                    </form>
                                <table class="table table-bordered table-striped" id="table_agent_report">
                                    <thead style="background: #263238;color: #fff;">
                                        <th><strong>Agent Name</strong></th>
                                        <th><strong>No. of<br> Lead<br> Audited</strong></th>
                                        <th><strong>Soft<br> Skills<br> Score</strong></th>
                                        <th><strong>Product<br> Knowledge<br> Score</strong></th>
                                        <th><strong>LMS<br> Update<br>Score</strong></th>
                                        <th><strong>Zero<br> Tolerance</strong></th>
                                        <th><strong>Total<br> Score</strong></th>
                                        <th><strong>Overall<br>Rating</strong></th>
                                        <th><strong>LAT<br>Feedback</strong></th>
                                    </thead>
                                    <tbody>
                                        @foreach($agent_report as $agent)
                                        <tr>
                                            <td>{{ $agent['lead_owner'] }}</td>
                                            <td>{{ $agent['get_lead_count'] }}</td>
                                            <td>{{ $agent['block_1_avg'] }}</td>
                                            <td>{{ $agent['block_2_avg'] }}</td>
                                            <td>{{ $agent['block_3_avg'] }}</td>
                                            <td>{{ $agent['block_4_avg'] }}</td>
                                            <td>{{ $agent['total_score_avg'] }}</td>
                                            <td>{!! $agent['total_score_tag'] !!}</td>
                                            <td>{!! $agent['feedback_colud'] !!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="font-weight: bold;background: #263238;color: #fff;">
                                        <tr>
                                            <td style="font-weight: bold;color: #fff;">Grand Total</td>
                                            <td style="font-weight: bold;color: #fff;">{{ $total_lead_count }}</td>
                                            <td style="font-weight: bold;color: #fff;">{{ $avg_count_block_1 }}%</td>
                                            <td style="font-weight: bold;color: #fff;">{{ $avg_count_block_2 }}%</td>
                                            <td style="font-weight: bold;color: #fff;">{{ $avg_count_block_3 }}%</td>
                                            <td style="font-weight: bold;color: #fff;">{{ $avg_count_block_4 }}%</td>
                                            <td style="font-weight: bold;color: #fff;">{{ $agent_total_score_avg }}%</td>
                                            <td style="font-weight: bold;color: #fff;">{!! $agent_total_score_tag !!}</td>
                                            <td style="font-weight: bold;color: #fff;"></td>
                                        </tr>
                                    </tfoot>
                                </table>
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
    var table_agent_report = $('#table_agent_report').DataTable({
            ordering: false,
            processing: true,
            pageLength: 25,
            lengthMenu: [ [10, 25, 50, 100, 200, 500, 1000, -1], [10, 25, 50, 100, 200, 500, 1000, "All"] ],
            dom: "<'row'<'col-2'l><'col-7'B><'col-sm-12 col-md-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            columnDefs: [
                {
                    targets: 1,
                    className: 'noVis'
                }
            ],
            buttons: [
            // 'copy', 'excel', 'csv', 'pdf', 
            'print',
                { extend: 'copyHtml5', footer: true },
                { extend: 'excelHtml5', footer: true },
                { extend: 'csvHtml5', footer: true },
                { extend: 'pdfHtml5', footer: true },
                {
                    extend: 'colvis',
                    columns: ':not(.noVis)',
                     text: 'Coloumns',
                     collectionLayout: 'fixed three-column'
                }
            ],
       });
    $('#table_agent_report').DataTable();
    $('#filter_project').select2({
        placeholder: "Select project"
    });

    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end, label){
        if (label == 'Today'){
            title = 'Today';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
        } else if (label == 'This Month') {
            title = 'This Month';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
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