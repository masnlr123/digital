@extends('layouts.app')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                All Reports </h3>
        </div>
    </div>
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                @include('backend.reports.reports_menu')
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_3_3_tab_content" role="tabpanel">
                    
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
    @if($message = Session::get('warning'))
    <div class="alert alert-warning fade show" role="alert">
        <div class="alert-icon"><i class="la la-close"></i></div>
        <div class="alert-text">{{ $message }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
    @endif
    <div class="pt-2 pb-3 creative_index kt-portlet__body kt-portlet__body--fit">
        
                                <div class="dashboard_block lead_audit_header_2" style="padding: 7px 0px;">
                                    <form action="{{ route('creative_report_generate') }}" method="post">
                                    @csrf
                                        <input type="hidden" id="start_date" name="from_date">
                                        <input type="hidden" id="end_date" name="to_date">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Date Range Filter</h5>
                                                <div id="reportrange" class="custom_date_range">
                                                    <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong>
                                                    <span class="date"></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Project</h5>
                                                    <select class="form-control" id="filter_project">
                                                        <option value="">All Project</option>
                                                        <option value="AGR">AGR</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Source</h5>
                                                    <select class="form-control" id="filter_campaign">
                                                        <option value="">All Source</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Google">Google</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Lead Type</h5>
                                                    <select class="form-control" id="filter_department">
                                                        <option value="">Valid Leads</option>
                                                        <option value="">Invalid Leads</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-success" style="margin-top: 23px;border-radius: 2px;"><i class="fas fa-search"></i> Search</button>
                                            </div>
                                    </div>
                                    </form>
                                    {{-- <form method="post" action="{{ route('get_water_meter_data') }}">
                                        @csrf
                                        <input type="submit" name="submit" class="btn btn-success" value="Refresh">
                                    </form> --}}
                                    @if(isset($creative_leads))
                                    <table class="table table-inverse table-bordered table-striped mt-4">
                                        <thead>
                                            <tr>
                                                <th>Creative (Ad Name) - {{ $get_agr_leads->count() }}</th>
                                                <th>Project</th>
                                                <th>Leads</th>
                                                <th>Valid</th>
                                                <th>Valid %</th>
                                                <th>Walk-int</th>
                                                <th>Sales</th>
                                                <th>Rev</th>
                                                <th>CPL</th>
                                                <th>CPW</th>
                                                <th>CPS</th>
                                                <th>SOR</th>
                                                <th>VLTW</th>
                                                <th>WTS</th>
                                                <th>VLTS</th>
                                                <th>Impresion</th>
                                                <th>Reach</th>
                                                <th>CDR</th>
                                                <th>Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($creative_leads as $creatives)
                                            @php
                                            $total_leads = 0;
                                            $total_valid_leads = 0;
                                            $total_site_visit = 0;
                                            $total_booking = 0;

       foreach(json_decode($get_leads) as $lead){
           if($creatives->ad_name == $lead->ad_name){

                $total_leads += 1;
                if($lead->is_valid == true){
                    $total_valid_leads += 1;
                };
                if($lead->lead_stage == 'Site Visit Done'){
                    $total_site_visit += 1;
                };
                if($lead->is_valid == 'Booked'){
                    $total_booking += 1;
                };
            }
        }
        $valid_per = ($total_valid_leads/$total_leads)*100;
                                            @endphp
                                            <tr>
                                                <td>{{ $creatives->ad_name }} </td>
                                                <td>{{ $creatives->project }} </td>
                                                <td>{{ $total_leads }} </td>
                                                <td>{{ $total_valid_leads }} </td>
                                                <td>{{ round($valid_per) }}%</td>
                                                <td>{{ $total_site_visit }} </td>
                                                <td>{{ $total_booking }} </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
        @if(isset($leads_data))
                                        <div class="row dashboard_report task_report mt-3">
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">Total Leads</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count total_task_count">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_2 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">Valid Leads</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count todo_task">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_3 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">Site Visit</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count wip_task">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_4 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">Booking</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count review_task">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_5 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">Total Budget</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count completed_task">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">DashBoard Leads</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count completed_task">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     
        <table class="table table-striped table-bordered table-hover table-checkable" id="report_table_1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Lead Stage</th>
                    <th>Lead Source</th>
                    <th>Campaign</th>
                    <th>Page</th>
                    <th>Form</th>
                    <th>Ad Name</th>
                    <th>Ad Set</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($leads_data as $lead)
                <tr>
                        @if(isset($lead['name']))<td>{{ $lead['name'] }}</td> @else <td></td> @endif
                        @if(isset($lead['contact']))<td>{{ $lead['contact'] }}</td>@else <td></td> @endif
                        @if(isset($lead['lead_stage']))<td>{{ $lead['lead_stage'] }}</td>@else <td></td> @endif
                        @if(isset($lead['lead_source']))<td>{{ $lead['lead_source'] }}</td>@else <td></td> @endif
                        @if(isset($lead['campaign']))<td>{{ $lead['campaign'] }}</td>@else <td></td> @endif
                        @if(isset($lead['page']))<td>{{ $lead['page'] }}</td>@else <td></td> @endif
                        @if(isset($lead['form']))<td>{{ $lead['form'] }}</td>@else <td></td> @endif
                        @if(isset($lead['ad_name']))<td>{{ $lead['ad_name'] }}</td>@else <td></td> @endif
                        @if(isset($lead['ad_set']))<td>{{ $lead['ad_set'] }}</td>@else <td></td> @endif
                        @if(isset($lead['created_on']))<td>{{ $lead['created_on'] }}</td>@else <td></td> @endif
                </tr>
                    @endforeach
            </tbody>
        </table>
        @endif
    </div>

                </div>
                
            </div>
        </div>
    </div>
    </div>

    <!-- end:: Content -->
    </div>

@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer_js')
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            $('#report_table_1').DataTable();
    jQuery(document).ready(function(){
        var from_date = '';
        var to_date = '';
        var project = '';
        var department = '';
        var campaign = '';
        var status = '';
        var assigned_by = '';
        var assigned_to = '';

        load_data();
    $("#filter_project, #filter_campaign, #filter_department, #filter_status, #filter_assigned_to, #filter_assigned_by").on('change', function(){
        project = $("#filter_project").val();
        department = $("#filter_department").val();
        campaign = $("#filter_campaign").val();
        status = $("#filter_status").val();
        assigned_by = $("#filter_assigned_by").val();
        assigned_to = $("#filter_assigned_to").val();
        $('#kt_table_1').DataTable().destroy();
        load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        // alert('Loaded!');
    });
    $('#datatable_refresh').click(function(){
        window.location.reload();
    });
        function load_data(from_date = '', to_date = '', project = '', department = '', campaign = '',  status = '', assigned_by = '', assigned_to = ''){
        $.fn.dataTable.ext.errMode = () => alert('Error while loading the table data. Please refresh');
        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               pageLength: 50,
               lengthMenu: [ [10, 25, 50, 100, 200, 500, 1000, -1], [10, 25, 50, 100, 200, 500, 1000, "All"] ],
               ajax: {
                url:'',
                data:{
                    from_date:from_date,
                    to_date:to_date,
                    filter:{
                        project_id:project,
                        department:department,
                        camp_id:campaign,
                        status:status,
                        created_by:assigned_by,
                        responsible:assigned_to,
                    }
                }
               },
               columns: [
                        // { data: 'id', name: 'id' },
                        { data: 'project', name: 'project' },
                        { data: 'campaign', name: 'campaign' },
                        { data: 'name', name: 'name' },
                        { data: 'department', name: 'department' },
                        // { data: 'types', orderable: false },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'responsible', name: 'responsible' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'end_time', name: 'end_time' },
                        { data: 'day_duration', name: 'day_duration'  },

                        { data: 'duration', name: 'duration', visible: false  },
                        { data: 'priority', name: 'priority', visible: false  },
                        { data: 'score', name: 'score', visible: false  },
                        { data: 'is_from_sub_task', name: 'is_from_sub_task', visible: false  },
                        { data: 'approval', name: 'approval', visible: false  },

                        { data: 'status', name: 'status' },
                        // { data: 'status', searchable: false, orderable: false},
                        { data: 'timer', name: 'timer', visible: false },
                        { data: 'action', searchable: false, orderable: false }

                     ],
                     dom: "<'row'<'col-2'l><'col-7'B><'col-sm-12 col-md-3'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
            $.ajax({
                type: "GET",
                data:{
                    from_date:from_date,
                    to_date:to_date,
                    filter:{
                        project_id:project,
                        department:department,
                        camp_id:campaign,
                        status:status,
                        created_by:assigned_by,
                        responsible:assigned_to,
                    }
                },
                url: "",
  beforeSend: function(jqXHR, settings) {
    console.log(settings.url);
  },      
                success: function(data){
                    console.log(data);
                    $(".total_task_count").html(data.all_task);
                    $(".todo_task").html(data.todo_task);
                    $(".wip_task").html(data.wip_task);
                    $(".review_task").html(data.review_task);
                    $(".completed_task").html(data.completed_task);
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
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'This Month') {
            title = 'This Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'All Time') {
            title = 'All Time';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            $('#start_date').val(from_date);
            $('#end_date').val(to_date);
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
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
        alwaysShowCalendars: true,
        showDropdowns: true,
        timePicker: true,
        autoApply: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 15 Days': [moment().subtract(14, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'All Time': ['01/01/2020', moment()],
        }
    }, cb);

    cb(start, end);

        $('.creative_block').hide();
        $('#department').change(function(){
            if($(this).val() == 'Creative'){
                $('.creative_block').show();
            }
            else{
                $('.creative_block').hide();
            }
            if($(this).val() == 'Non-Campaign'){
                $('#campaign_task').hide();
            }
            else{
                $('#campaign_task').show();
            }
        });
        $('#projects').select2({
            placeholder: 'Select one prpoject',
        });
        $('.select_activity').select2({
            placeholder: 'Select one  activity',
        });
        $('#open_new_task').click(function(){
            if($('#department').val() == 'Creative'){
                $('.creative_block').show();
                $('#open_new_task').attr("disabled", "disabled");
            }
            else{
                $('.creative_block').hide();
            }

            if($('#department').val() == 'Non-Campaign'){
                $('#campaign_task').hide();
            }
            else{
                $('#campaign_task').show();
            }
            // $('#open_new_task').prop('disabled', true);
        });

        $('#projects').change(function(){
            var get_project = $('#projects').val();
            $('#campaign').empty();
            $('#ad_campaign').empty();
            $('#milestone').empty();
            $.get("{{ route('task_get_campaign') }}", {project: get_project}, function(results){
                 $("#campaign").append(results);
            });
        });
        $('#campaign').change(function(){
            var get_campaign = $('#campaign').val();
            $('#ad_campaign').empty();
            $('#milestone').empty();
            $.get("{{ route('task_get_ad_campaign') }}", {campaign: get_campaign}, function(results){
                 $("#ad_campaign").append(results);
            });
        });
        $('#ad_campaign').change(function(){
            var get_ad_campaign = $('#ad_campaign').val();
            $('#milestone').empty();
            $.get("{{ route('task_get_milestone') }}", {campaign: get_ad_campaign}, function(results){
                 $("#milestone").append(results);
            });
        });
    });
        </script>
@endsection