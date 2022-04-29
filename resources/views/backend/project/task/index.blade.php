@extends('layouts.app')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                All Task List </h3>
        </div>
    </div>
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($current_department == 'all') active @endif" href="{{ route('task_list_index', 'all') }}">
                            <i class="flaticon2-heart-rate-monitor" aria-hidden="true"></i>All Task
                        </a>
                    </li>
                    @foreach(App\Setting::where('name', 'task_department')->get() as $result)
                    @php 
                    $department = json_decode($result->value);
                    if(\Request::is($department->url)) { 
                        $active_class = 'active';
                    }
                    else{
                        $active_class = '';
                    }
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link @if($current_route == $department->url) active @endif" href="/tasks/list/{{ $department->url }}">
                            <i class="{{ $department->icon }}" aria-hidden="true"></i>{{ $department->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
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
        
        <div class="row">
            <div class="col-9">
                @if(!empty($user->timer))
                <div class="task_panel_wrapper">
                    @php 
                    $get_user_task = App\Models\Task::find($user->live_task_id);
                    $get_timer = App\Models\Timer::find($get_user_task->timer_id);
                    @endphp
                    <span class="task_status_lable">
                        <span><i class="fas fa-pause"></i></span>
                        <span>Working Task</span>
                    </span>
                    <!-- <span class="triangle-right"></span> -->
                    <span>{{ $get_user_task->name }}</span>
                    <span class="task_action">
                        <span class="btn btn-sm btn-brand btn_task_action display_task_timer" style="margin-right: 0px;"></span>
                        <a href="{{ route('stop_timer',$get_timer->id) }}" class="btn btn-sm btn-warning btn_task_action">Stop Timer</a>
                    </span>
                </div>
                @endif
            </div>
            <div class="col-3 text-right">
                <!-- <a href="{{ route('carbon_index', $current_department) }}" class="btn btn-brand btn-sm btn-elevate btn-icon-sm"><i class="flaticon-squares-2"></i>Kanban View</a> -->
                <a href="#" class="btn btn-new btn-success btn-sm btn-elevate btn-icon-sm" data-toggle="modal" data-target="#NewTask"><i class="flaticon-plus"></i>New Task</a>
            </div>
        </div>
                                <div class="dashboard_block lead_audit_header_2" style="padding: 7px 0px;">
                                            <div class="row">
                                            <div class="col-3">
                                                <h5>Date Range Filter</h5>
                                                <div id="reportrange" class="custom_date_range">
                                                    <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong>
                                                    <span class="date"></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Project</h5>
                                                    <select class="form-control" id="filter_project">
                                                        <option value="">All Project</option>
                                                        @foreach($options_projects as $project)
                                                        @php $get_project = App\Projects::find($project->project_id); @endphp
                                                        @if(!empty($get_project))
                                                        <option value="{{ $get_project->id }}">{{ $get_project->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Campaign</h5>
                                                    <select class="form-control" id="filter_campaign">
                                                        <option value="">All Campaign</option>
                                                        @foreach($options_campaigns as $camp_id)
                                                        @if($camp_id->camp_id != 0)
                                                            @php $get_camp = App\Campaigns::find($camp_id->camp_id); @endphp
                                                            @if(!empty($get_camp))
                                                            <option value="{{ $get_camp->id }}">{{ $get_camp->name }}</option>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if($current_route == 'all')
                                            <div class="col-1">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Department</h5>
                                                    <select class="form-control" id="filter_department">
                                                        <option value="">All Department</option>
                                                        @foreach($options_department as $task)
                                                        <option value="{{ $task->department }}">{{ $task->department }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-1">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Status</h5>
                                                    <select class="form-control" id="filter_status">
                                                        <option value="">All Status</option>
                                                        @foreach($options_status as $task)
                                                        <option value="{{ $task->status }}">{{ $task->status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Assigned By</h5>
                                                    <select class="form-control" id="filter_assigned_by">
                                                        <option value="">All Assigned By</option>
                                                        @foreach($options_created_by as $task)
                                                        <option value="{{ $task->created_by }}">{{ $task->created_by }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                    <h5>Assigned To</h5>
                                                    <div class="input-group">
                                                        <select class="form-control" id="filter_assigned_to">
                                                            <option value="">All Assigned To</option>
                                                            @foreach($options_responsible as $task)
                                                            <option value="{{ $task->responsible }}">{{ $task->responsible }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button id="datatable_refresh" class="btn btn-brand btn-elevate btn-icon btn-icon-sm"><i class="fas fa-sync"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                        <div class="row dashboard_report task_report mt-3">
                                            <div class="col-2 table-contents">
                                                <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                                                    <div class="kt-portlet__body">
                                                        <div class="kt-callout__body">
                                                            <div class="kt-callout__content">
                                                                <h3 class="kt-callout__title">Total Task</h3>
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
                                                                <h3 class="kt-callout__title">Todo Task</h3>
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
                                                                <h3 class="kt-callout__title">WIP Task</h3>
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
                                                                <h3 class="kt-callout__title">Review Task</h3>
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
                                                                <h3 class="kt-callout__title">Completed Task</h3>
                                                                <p class="kt-callout__desc">
                                                                    <span class="lead_count completed_task">0</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
        <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <!-- <th>#</th> -->
                    <th>Project</th>
                    <th>Campain</th>
                    <th>Task Details</th>
                    <th>Department</th>
                    <th>Activity</th>
                    <th>Assigned By</th>
                    <th>Assigned To</th>
                    <th>Created Date</th>
                    <th>Due Date</th>
                    <th>Days<br> Diff</th>

                    <th>Duration</th>
                    <th>Priority</th>
                    <th>Score</th>
                    <th>IS From SubTask</th>
                    <th>Approval</th>
                    <th>Status</th>
                    <th>Timer</th>
                    <th>Actions</th>
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

    <!-- end:: Content -->
    </div>

@include('backend.project.task.modal.new_task')
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
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

    jQuery(document).ready(function(){
      @if(!empty($user->timer))
            $(document).ready(function () {
                var taskStartedTime = new Date('{{ $get_timer->start }}');
                $('.display_task_timer').countdown({
                    since: taskStartedTime,
                    layout: '<span class="order_countdown">{hnn}{sep}{mnn}{sep}{snn}</span>',
                    format: 'HMS'
                });

            });
        @endif
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
                url:'{{ route('task_datatable', $current_route) }}',
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
                        { data: 'activity', name: 'activity', visible: false },
                        // { data: 'types', orderable: false },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'responsible', name: 'responsible' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'end_time', name: 'end_time' },
                        { data: 'day_duration', name: 'day_duration'  },

                        { data: 'duration', name: 'duration'},
                        { data: 'priority', name: 'priority', visible: false  },
                        { data: 'score', name: 'score'},
                        { data: 'is_from_sub_task', name: 'is_from_sub_task', visible: false  },
                        { data: 'approval', name: 'approval', visible: false  },

                        { data: 'status', name: 'status' },
                        // { data: 'status', searchable: false, orderable: false},
                        { data: 'timer', name: 'timer'},
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
                url: "{{ route('get_task_data', $current_route) }}",
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
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        }
        else if (label == 'Yesterday') {
            title = 'Yesterday';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Last 7 Days') {
            title = 'Last 7 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Last 30 Days') {
            title = 'Last 30 Days';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'This Month') {
            title = 'This Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Last Month') {
            title = 'Last Month';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'Custom Range') {
            title = 'Custom Range';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
            load_data(from_date, to_date, project, department, campaign,  status, assigned_by, assigned_to);
        } else if (label == 'All Time') {
            title = 'All Time';
            $('#kt_table_1').DataTable().destroy();
            from_date = start.format('YYYY-MM-DD');
            to_date = end.format('YYYY-MM-DD');
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