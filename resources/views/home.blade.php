@extends('layouts.app')

@section('content')
 <!-- begin:: Subheader -->
 @if($user->id != 40 && Auth::user()->role_id != '17')
 @if(Auth::user()->role_id != '15')

                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        Dashboard </h3>
                                </div>
                                <div class="kt-subheader__toolbar">
                                    <div class="kt-subheader__wrapper">
                                        <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                                            <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">Aug 16</span>

                                            <!--<i class="flaticon2-calendar-1"></i>-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                                </g>
                                            </svg> </a>
                                        <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">
                                            <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                                    </g>
                                                </svg>

                                                <!--<i class="flaticon2-plus"></i>-->
                                            </a>
                                            <!-- <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right"> -->

                                                <!--begin::Nav-->
                                                <!-- <ul class="kt-nav">
                                                    <li class="kt-nav__head">
                                                        Add anything or jump to:
                                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                            <span class="kt-nav__link-text">Order</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                            <span class="kt-nav__link-text">Ticket</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                                            <span class="kt-nav__link-text">Goal</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                            <span class="kt-nav__link-text">Support Case</span>
                                                            <span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--success">5</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__foot">
                                                        <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                                    </li>
                                                </ul> -->

                                                <!--end::Nav-->
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>

                             <div class="kt-grid__item kt-grid__item--fluid mt-1">   
                            <div class="row">
                                <div class="col-3">
                                    <div class="kt-portlet kt-callout kt-callout--warning kt-callout--diagonal-bg">
                                        <div class="kt-portlet__body">
                                            <div class="kt-callout__body">
                                                <div class="kt-callout__content">
                                                    <h3 class="kt-callout__title">Total Campaigns</h3>
                                                    <p class="kt-callout__desc">
                                                        <span class="lead_count">{{ $total_camp }}</span>
                                                    </p>
                                                </div>
                                                <div class="kt-callout__action">
                                                    <a href="{{ url('/campaigns') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-warning">Know more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="kt-portlet kt-callout kt-callout--danger kt-callout--diagonal-bg">
                                        <div class="kt-portlet__body">
                                            <div class="kt-callout__body">
                                                <div class="kt-callout__content">
                                                    <h3 class="kt-callout__title">Total Creative Task</h3>
                                                    <p class="kt-callout__desc">
                                                        <span class="lead_count">{{ $total_creative_task }}</span>
                                                    </p>
                                                </div>
                                                <div class="kt-callout__action">
                                                    <a href="{{ url('/task/creatives') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-danger">Know more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="kt-portlet kt-callout kt-callout--info kt-callout--diagonal-bg">
                                        <div class="kt-portlet__body">
                                            <div class="kt-callout__body">
                                                <div class="kt-callout__content">
                                                    <h3 class="kt-callout__title">Total Paid Task</h3>
                                                    <p class="kt-callout__desc">
                                                        <span class="lead_count">{{ $total_paid_task }}</span>
                                                    </p>
                                                </div>
                                                <div class="kt-callout__action">
                                                    <a href="{{ url('/task/paid') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-info">Know more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="kt-portlet kt-callout kt-callout--brand kt-callout--diagonal-bg">
                                        <div class="kt-portlet__body">
                                            <div class="kt-callout__body">
                                                <div class="kt-callout__content">
                                                    <h3 class="kt-callout__title">Total SEO Task</h3>
                                                    <p class="kt-callout__desc">
                                                        <span class="lead_count">{{ $total_seo_task }}</span>
                                                    </p>
                                                </div>
                                                <div class="kt-callout__action">
                                                    <a href="{{ url('/task/seo') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand">Know more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="kt-portlet kt-callout kt-callout--primary kt-callout--diagonal-bg">
                                        <div class="kt-portlet__body">
                                            <div class="kt-callout__body">
                                                <div class="kt-callout__content">
                                                    <h3 class="kt-callout__title">Total Web Task</h3>
                                                    <p class="kt-callout__desc">
                                                        <span class="lead_count">{{ $total_web_task }}</span>
                                                    </p>
                                                </div>
                                                <div class="kt-callout__action">
                                                    <a href="{{ url('/task/web') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm btn-primary">Know more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="kt-portlet kt-callout kt-callout--success kt-callout--diagonal-bg">
                                        <div class="kt-portlet__body">
                                            <div class="kt-callout__body">
                                                <div class="kt-callout__content">
                                                    <h3 class="kt-callout__title">Total LMS Task</h3>
                                                    <p class="kt-callout__desc">
                                                        <span class="lead_count">{{ $total_lms_task }}</span>
                                                    </p>
                                                </div>
                                                <div class="kt-callout__action">
                                                    <a href="{{ url('/task/lms') }}" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-success">Know more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            </div>

                        </div>
                        @endif

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
        <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project</th>
                    <th>Campain</th>
                    <th>Task</th>
                    <th>Department</th>
                    <th>Creator</th>
                    <th>Responsible</th>
                    <th>Date</th>
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
@endif
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

        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               pageLength: 20,
               ajax: '{{ route('task_datatable', $current_route) }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'project', name: 'project' },
                        { data: 'campaign', name: 'campaign' },
                        { data: 'name', name: 'name' },
                        { data: 'department', name: 'department' },
                        // { data: 'types', orderable: false },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'responsible', name: 'responsible' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'status', name: 'status' },
                        // { data: 'status', searchable: false, orderable: false},
                        { data: 'timer', name: 'timer' },
                        { data: 'action', searchable: false, orderable: false }

                     ],
            });

      //   $(function() {
      //   $(".btn-area").append('<div class="col-sm-4 table-contents">'+
      //       '<a class="add-btn" data-href="{{route('task_creative_create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
      //     '<i class="fas fa-plus"></i> Add New Brand'+
      //     '</a>'+
      //     '</div>');
      // });
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
jQuery(document).ready(function() {
    
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
