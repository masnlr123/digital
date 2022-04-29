@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
                    <!-- <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('task/web') }}"><i class="fa fa-undo"></i> Back to Web Task</a> -->
            <h3 class="kt-subheader__title">
                   {{ $task->department }} Task &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $task->name }}</strong></h3>
        </div>
        <div class="kt-subheader__toolbar">
            <p style="margin-bottom: 0;margin-right: 30px;">Status: <span class="badge badge-info"><strong>{{ strtoupper($task->status) }}</strong></span></p>
            @if(!empty($task->campaign))
            <a href="{{ route('campaign_details', $task->campaign) }}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> Campaign Page</a>
            @endif
            <a href="{{ route('campaign_index') }}" class="btn btn-warning btn-elevate btn-icon-sm"><i class="fa fa-undo"></i>Project Campagins</a>
            <a href="{{ route('all_ad_camp_index') }}" class="btn btn-warning btn-elevate btn-icon-sm"><i class="fa fa-undo"></i>Ad Campagins</a>
            @if(!empty($task->department))
            <a href="{{ route('task_list_index', $task->department) }}" class="btn btn-success btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> All Task</a>
            @endif
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-12"><div id="notification"></div></div>
    </div>
</div>

<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-8">
    <div class="kt-portlet kt-portlet--tabs task_view_portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_details" role="tab">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab">
                            <i class="fab fa-gitter" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="kt-subheader__toolbar">
                @if(empty($task->score))
                <span class="d-inline-block mt-2 badge badge-info"><i class="flaticon-warning-sign"></i> Score Not Found</span>
                @else
                <span class="d-inline-block mt-2">Score:<span class="badge badge-brand"><strong>{{ $task->score }}%</strong></span></span>
                @endif
                @if(empty($task->priority))
                <span class="d-inline-block mt-2 badge badge-warning"><i class="flaticon-warning-sign"></i> Priority Not Found</span>
                @else
                <span class="d-inline-block mt-2">Priority:<span class="badge badge-brand"><strong>{{ strtoupper($task->priority) }}</strong></span></span>
                @endif
                @if(empty($task->duration))
                <span class="d-inline-block mt-2 badge badge-danger"><i class="flaticon-warning-sign"></i> Duration Not Found</span>
                @else
                <span class="d-inline-block mt-2">Duration:<span class="badge badge-brand"><strong>{{ strtoupper($task->duration) }}</strong></span></span>
                @endif
            </div>

        </div>
    <div class="kt-portlet__body task_view_portlet_body">
        <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_details" role="tabpanel">

        <div class="row">
        <div class="kt-widget1 col-md-12" style="padding:4px 0px 0px;">
            <div class="row task_top_list">
                <div class="col-4">
                    <i class="btn flaticon2-user"></i>
                    <span class="assignee_lable">Assignee</span>
                    <span class="assignee_lable_value">{{ $task->responsible }}</span>
                </div>
                <div class="col-2">
                    <i class="btn flaticon2-chronometer"></i>
                    <span class="task_eta_day">{{ Carbon\Carbon::parse($task->eta)->format('d-m-Y') }}</span>
                    <span class="task_eta_time">{{ Carbon\Carbon::parse($task->eta)->format('g:i:s A') }}</span>
                </div>
                <div class="col-6">
                    <i class="btn flaticon2-chart2"></i>
                    <span class="assignee_lable">Activity/Milestone</span>
                    <span class="assignee_lable_value">{{ $task->activity }}</span>
                    <span></span>
                </div>
            </div>
            <hr style="margin-top: 7px;">
            <div class="task_brief_block">
                {!! $task->brief !!}
            </div>
            @if($task->lp_url)
            <h5>Landing Page Details:</h5>
            <table class="table table-bordered table-striped table-large">
                <tbody>
                    
                    <tr>
                        <td>Landing Page URL</td>
                        <td data-visible="false"><a href="{{ $task->lp_url }}" target="_blank"> {{ $task->lp_url }}</a></td>
                    </tr>
                    <tr>
                        <td>LP Live Status</td>
                        <td>{{ $task->live }}</td>
                        <td><strong>LP Platform</strong></td>
                        <td>{{ $task->platform }}</td>
                    </tr>
                    <tr>
                        <td>LP Month</td>
                        <td colspan="3">{{ \Carbon\Carbon::parse($task->month)->format('F - Y') }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
            







            <!-- <table class="table table-bordered table-striped table-info">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Details</th>
                        <th style="width: 20%;">Status</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($sub_task as $stask)
                <tr>
                    <td>{{ $stask->name }}</td>
                    <td>
                        <strong>Activity Type:</strong> {{ $stask->activity }}<br>
                        <strong>ETA:</strong> {{ $stask->eta }}<br>
                        <strong>Deliverable:</strong> {{ $stask->deliverable }}<br>
                        <strong>Duration:</strong> {{ $stask->duration }}<br>
                    </td>
                    <td>
                        {{ $stask->status }}
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table> -->
        </div>
    </div>
</div>
            <div class="tab-pane" id="kt_portlet_logs" role="tabpanel">
                <h4 style="margin: 15px 0;">Activity Logs</h4>
                <!--Begin::Timeline 3 -->
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">

                        @foreach($activity as $act)
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">{{ $act->created_at->format('H:i') }}</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text  kt-padding-top-5">
                                {!! $act->description !!}<br>
                                at <span class="kt-font-info">{{ $act->created_at->format('H:i:s d:m:Y') }}</span>, By <span class="kt-font-success">{{ $act->created_by }}</span>
                            </div>
                        </div>
                        @endforeach


<!--                         <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">12:45</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-success"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                AEOL Meeting With
                            </div>
                            <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                <a href="#"><img src="assets/media/users/100_4.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_13.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_11.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_14.jpg" title=""></a>
                            </div>
                        </div> -->


                    </div>
                </div>
                <!--End::Timeline 3 -->
            </div>
            <div class="tab-pane" id="kt_portlet_edit" role="tabpanel">
<form class="kt-form" method="post" action="{{ route('update_task_details', $task->id) }}">
    @csrf
    {{ method_field('PUT') }}
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Task Name</label>
                        <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="{{ $task->name }}">
                    </div>
                    <div class="col-md-6">
                        <label>Activity Type</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" name="activity">
                            <option value="">** Select a Activity Type</option>
                            <option {{ $task->activity == "Landing page"? "selected": " " }} value="Landing page">Landing page</option>
                            <option {{ $task->activity == "Website"? "selected": " " }} value="Website">Website</option>
                            <option {{ $task->activity == "SEO Optimization"? "selected": " " }} value="SEO Optimization">SEO Optimization</option>
                            <option {{ $task->activity == "Custom Software Requirements"? "selected": " " }} value="Custom Software Requirements">Custom Software Requirements</option>
                            <option {{ $task->activity == "Projects Update"? "selected": " " }} value="Projects Update">Projects Update</option>
                            <option {{ $task->activity == "Leadsqaured Works"? "selected": " " }} value="Leadsqaured Works">Leadsqaured Works</option>
                            <option {{ $task->activity == "Server Maintanace"? "selected": " " }} value="Server Maintanace">Server Maintanace</option>
                            <option {{ $task->activity == "Server Based Requirements"? "selected": " " }} ="Server Based Requirements">Server Based Requirements</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Priority</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_priority" name="priority">
                            <option value="">** </option>
                            <option {{ $task->priority == "high" ? "selected": " " }} value="high">High</option>
                            <option {{ $task->priority == "medium" ? "selected": " " }} value="medium">Medium</option>
                            <option {{ $task->priority == "low" ? "selected": " " }} value="low">Low</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>ETA</label>
                        
                            <input type="datetime-local" class="form-control" name="eta" value="{{ $task->eta }}" />
                            
                    </div>
                    @if(!empty($task->department))
                    <div class="col-md-6">
                        <label>Assignee - {{ $task->department }}</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_for" name="responsible">
                            <option value="">** Select a Option</option>
                            @php
                            if($task->department == 'Analytics/Tableau'){
                                $get_department = App\Setting::find(219);
                                $get_user = json_decode($get_department->value);
                                $get_user = json_decode($get_user->users);
                            }
                            else{

                                $get_department = App\Setting::where('name', 'task_department')->where('value', 'like', '%"name":"'.$task->department.'"%')->first();
                                $get_user = json_decode($get_department->value);
                                $get_user = json_decode($get_user->users);
                            }
                    @endphp
                    @foreach($get_user as $user)
                    @php $department_user = App\User::find($user); @endphp
                    <option value="{{ $department_user->name }}" @if($task->responsible == $department_user->name) selected @endif>{{ $department_user->name }}</option>
                    @endforeach
                        </select>
                    </div>
                    @endif
                </div>
                @if($task->department == 'Web')
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Platform</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="platform" value="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Live Status</label>
                        <select style="width: 100%" class="form-control" id="select_priority"  name="live">
                            <option value="">** </option>
                            <option value="Live">Live</option>
                            <option value="Pause">Pause</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Month</label>
                        <div class="input-group date">
                            <input type="month" class="form-control" name="month" value="" />
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-12">

                <label>Task Brief</label>
                <textarea id="kt-tinymce-4" name="brief" class="tox-target">
                    {!! $task->brief !!}
                </textarea>

                    </div>
                </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </div>
</form>
            </div>


        </div>
    </div>
</div>
    </div>
    <div class="col-md-4">
<!--begin::Portlet-->
<form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('task_update_status', $task->id) }}">
    @csrf
    {{ method_field('PUT') }}
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Change Task Status
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-4 status_col_lable">
                <label>Current Status</label>
            </div>
            <div class="col-md-8">
                <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="status" ng-model="TaskStatus">
                    <option value=""> --- </option>
                    <option value="new">New</option>
                    <option value="wip">WIP</option>
                    <option value="correction_updates">Correction Updates</option>
                    <option value="review">Under Review</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-md-4 status_col_lable">
                <label>Total Duration</label>
            </div>
            <div class="col-md-4">
                <select class="form-control" name="duration_hr">
                    <option value="">Hour</option>
                    <option value="00">0</option>
                    <option value="1 Hour">1</option>
                    <option value="2 Hours">2</option>
                    <option value="3 Hours">3</option>
                    <option value="4 Hours">4</option>
                    <option value="5 Hours">5</option>
                    <option value="6 Hours">6</option>
                    <option value="7 Hours">7</option>
                    <option value="8 Hours">8</option>
                    <option value="9 Hours">9</option>
                    <option value="10 Hours">10</option>
                    <option value="11 Hours">11</option>
                    <option value="12 Hours">12</option>
                </select>
                <!-- <input type="number" class="form-control" name="duration" placeholder="Total Duration in Minutes" /> -->
            </div>
            <div class="col-md-4">
                <select class="form-control" name="duration_minit">
                    <option value="">Minite</option>
                    <option value="00">0</option>
                    <option value="02 Minutes">2</option>
                    <option value="05 Minutes">5</option>
                    <option value="10 Minutes">10</option>
                    <option value="15 Minutes">15</option>
                    <option value="20 Minutes">20</option>
                    <option value="25 Minutes">25</option>
                    <option value="30 Minutes">30</option>
                    <option value="35 Minutes">35</option>
                    <option value="40 Minutes">40</option>
                    <option value="45 Minutes">45</option>
                    <option value="50 Minutes">50</option>
                    <option value="55 Minutes">55</option>
                </select>
                    <!-- <input type="number" class="form-control" name="duration" placeholder="Total Duration in Minutes" /> -->
            </div>
            <div class="col-md-12 mt-2 mb-3">                
                <label>Score</label>
                <div class="kt-ion-range-slider ">
                    <input type="hidden" name="task_score" id="task_score" />
                </div>
            </div>
            <div class="col-md-12">                
                <label>Notes</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="status_notes" placeholder="Status Notes" />
                </div>
            </div>
        </div> 
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>

</form>

</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label" style="width: 100%;">
                     <h5 class="text-warning" style="    width: 100%;margin: 0;line-height: 48px;">Sub Task List
                        <div class="btn btn-sm btn-success" id="add_new_sub_task" style="background: #44e402;border: none;cursor: pointer;float: right;margin-top: 9px;">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Add Sub Task</span>
                            </span>
                        </div>
                    </h5>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-12" style="padding:0px !important;">
                        <div id="load_sub_task"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end::Portlet-->

</div>


<div class="modal fade task_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title task_title" style="width: 100%;" id="taskTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding-top: 0;">
      </div>
    </div>
  </div>
</div>
<section>
    <div id="ChangeUserPopover" class="d-none">
        <div class="change_users">
            <h4 style="font-size: 14px;">Sub Task ETA:</h4>
            <input type="datetime-local" class="form-control sub_task_eta">
            <div style="margin-top: 15px; text-align: right">
                <button class="btn btn-sm btn-brand submit_sub_task_eta">Add ETA</button>
            </div>
        </div>
    </div>
</section>


@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        $(document).ready(function(){
            var task_brief_block_height = $('.task_brief_block').height();
            if(task_brief_block_height>200){

                $('.task_brief_block').css({
                    'display': 'block',
                    'height': '200px',
                    'overflow-y': 'scroll'
                })
            }
            @if($task->score)
            $('#task_score').ionRangeSlider({
                min: 0,
                max: 100,
                from: {{ $task->score }}
            });
            @else
            $('#task_score').ionRangeSlider({
                min: 0,
                max: 100,
            });
            @endif
        });
        $('.new-correction-block').hide();
        $('.assigner-block').hide();
        $('.process-transfer-block').hide();
        $('.internal-reiview-block').hide();
        @if($task->status == 'internal_review')
        $('.creative-upload-block').show();
        @elseif($task->status == 'external_review')
        $('.creative-upload-block').show();
        @elseif($task->status == 'completed')
        $('.creative-upload-block').show();
        @else
        $('.creative-upload-block').hide();
        @endif;
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'new_needed') {
                $('.new-correction-block').show();
            }else {
                $('.new-correction-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'assigned') {
                $('.assigner-block').show(); 
            } else {
                $('.assigner-block').hide(); 
            } 
        });

        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'process_transfer') {
                $('.process-transfer-block').show(); 
            } else {
                $('.process-transfer-block').hide(); 
            } 
        });

        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'internal_review') {
                $('.creative-upload-block').show(); 
            } else {
                $('.creative-upload-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'external_review') {
                $('.creative-upload-block').show(); 
                $('.internal-reiview-block').show(); 
            } else {
                $('.internal-reiview-block').hide();
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'completed') {
                $('.creative-upload-block').show(); 
            }
        });

        var creative_image_height = $('.creative-row').height();
        $('.creative-action-block').height(creative_image_height);
        @if(!empty($creative_updated))
            swal.fire({
                        title: 'Deleted!',
                        text: "The Creative Image has been deleted Successfuly!",
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK!'
                    }).then(function(result) {
                        if (result.value) {
                            location.reload();
                        }
                    });

        @endif

        $('.deleteCreativeImg').click(function(e){
            var id = $(this).data("id");
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax(
                    {
                        url: "{{ url('/task/creative_image/delete/') }}/"+id,
                        type: 'delete', // replaced from put
                        dataType: "JSON",
                        data: {
                            "id": id // method and token not needed in data
                        },
                        success: function (response)
                        {
                            swal.fire({
                                title: 'Deleted!',
                                text: "The Creative Image has been deleted Successfuly!",
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'OK!'
                            }).then(function(result) {
                                if (result.value) {
                                    location.reload();
                                }
                            });


                            // swal.fire("Deleted!", "The Creative Image has been deleted Successfuly!", "error");
                            
                        },
                        error: function(xhr) {
                             console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        function delete_sub_task(task_id){
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                buttons: true,
                dangerMode: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((isConfirm) => {
                if(isConfirm.value){
                    $.get( "{{ route('delete_sub_task') }}", {task_id: task_id});
                    swal.fire({
                        title: 'Deleted!',
                        text: "The Sub Task has been deleted Successfuly!",
                        type: 'error',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#load_sub_task').empty();
                    load_sub_task();
                    ini_update_sub_task();
                }
                else{
                    swal.fire({
                        title: 'Safe!',
                        text: "Your Sub Task is Safe!",
                        type: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000
                    });

                }
                // $.get( "{{ route('delete_sub_task') }}", {task_id: task_id});
                // swal.fire({
                //     title: 'Deleted!',
                //     text: "The Sub Task has been deleted Successfuly!",
                //     type: 'error',
                //     showCancelButton: false,
                //     confirmButtonText: 'OK!'
                // }).then(function(result){
                //     $('#load_sub_task').empty();
                //     load_sub_task();
                //     ini_update_sub_task();
                // });
            });
        }
        function clone_sub_task(task_id){
            $.get( "{{ route('clone_sub_task') }}", {task_id: task_id});
            swal.fire({
                title: 'Duplicated!',
                text: "The Sub Task has been Duplicated Successfuly!",
                type: 'success',
                showConfirmButton: false,
                timer: 1000
            });
            $('#load_sub_task').empty();
            load_sub_task();
            ini_update_sub_task();
        }
        function add_new_task(task_id){
            $.get( "{{ route('add_new_task') }}", {task_id: task_id, parent_id: {{ $task->id }} }, function(result){
                if(result){
                    swal.fire({
                        title: 'New Task Added!',
                        text: "The New Task has been added Successfuly!",
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    $('#load_sub_task').empty();
                    load_sub_task();
                    ini_update_sub_task();
                }
            });
            
        }
        load_sub_task();
        ini_update_sub_task();
        function view_sub_task(task_id, task_name){
            $('#view_'+task_id).click(function(){
                $('#taskTitle').text(task_name);
                $('#exampleModal').modal('show').find('.modal-body').load("{{ url('') }}/tasks/sub_task_modal_view/" + task_id);
            });
        }
        function update_sub_task(task_id, field){
            $('#'+field+'_'+task_id).bind("change paste", function() {
              var current_value = $(this).val();
              $.get( "{{ route('update_sub_task') }}", {task_id: task_id, field: field, value: current_value}, function(result){
                if(result){
                    swal.fire({
                        title: 'Updated!',
                        text: "Sub Task Due Date Updated Successfuly!",
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
              });
            });
        }
        function task_completed(task_id){
            $('#status_'+task_id).change(function() {
                if($(this).is(":checked")){
                    $.get( "{{ route('update_sub_task') }}", {task_id: task_id, field: 'status', value: 'completed'});
                    swal.fire({
                        title: 'Completed!',
                        text: "The Sub Task has been Completed Successfuly!",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK!'
                    });
                    $('#load_sub_task').empty();
                    load_sub_task();
                    ini_update_sub_task();
                }
                else{
                    $.get( "{{ route('update_sub_task') }}", {task_id: task_id, field: 'status', value: 'New'});
                    swal.fire({
                        title: 'Updated!',
                        text: "New Status Updated Successfuly!",
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'OK!'
                    });
                    $('#load_sub_task').empty();
                    load_sub_task();
                    ini_update_sub_task();
                }
            });
        }

        // function load_sub_task_eta(el, task_id){
        //     var skin = el.data('skin') ? 'popover-' + el.data('skin') : '';
        //     var triggerValue = el.data('trigger') ? el.data('trigger') : 'hover';
        //     $('#ChangeUserPopover').find(".sub_task_eta").attr('id', 'sub_task_eta_'+task_id);
        //     $('#ChangeUserPopover').find(".submit_sub_task_eta").attr('id', 'submit_sub_task_eta_'+task_id);
        //     el.popover({
        //         html: true,
        //         trigger: 'click',
        //         // content: 'And here\'s some amazing <input type="date" name="date" />',
        //         content: function() {
        //             return $('#ChangeUserPopover').find(".change_users").clone();
        //         },
        //         template: '\
        //         <div class="popover ' + skin + '" role="tooltip">\
        //             <div class="arrow"></div>\
        //             <h3 class="popover-header"></h3>\
        //             <div class="popover-body">\
        //             </div>\
        //         </div>'
        //     });
        // }
        // function update_sub_task_eta(task_id){
        //     var due_date_value = $('#sub_task_eta_'+task_id).val();
        //     alert(due_date_value);
        //     $.get( "{{ route('update_sub_task') }}", {task_id: task_id, field: 'due_date', value: due_date_value}, function(result){
        //         if(result){
        //             swal.fire({
        //                 title: 'Updated!',
        //                 text: "Sub Task Due Date Updated Successfuly!",
        //                 type: 'success',
        //                 showConfirmButton: false,
        //                 timer: 1000
        //             });
        //             $('#load_sub_task').empty();
        //             load_sub_task();
        //         }
        //     });
        // }

        var output_all_sub_task = '';
        function load_sub_task(){
            var all_sub_task = $.get('{{ route('load_all_sub_task') }}', {task_id: {{ $task->id }} }, function(result){
                sub_task_output = '';
                if(result){
                    $.each(result, function(index, value){
                        sub_task_output += '<div class="sub_task_list" style="margin-bottom: 5px;">';
                        sub_task_output += '<input type="hidden" name="id" value="" />';
                        sub_task_output += '<div class="input-group">';
                        sub_task_output += '<div class="input-group-prepend">';
                        sub_task_output += '<span class="input-group-text" style="padding: 0px 7px;">';
                        sub_task_output += '<label class="kt-checkbox kt-checkbox--single kt-checkbox--success">';
                        sub_task_output += '<input type="checkbox" name="status" id="status_'+ value.id +'" value="Completed">';
                        sub_task_output += '<span></span>';
                        sub_task_output += '</label>';
                        sub_task_output += '</span>';
                        sub_task_output += '</div>';
                        sub_task_output += '<input type="text" class="form-control form-control-danger" placeholder="Enter Sub Task" id="name_'+ value.id +'" value="'+ value.name +'">';
                        sub_task_output += '<div class="input-group-append">';
                        sub_task_output += '<select name="assignee" class="form-control" style="width:140px;background: #fff;" id="assignee_'+ value.id +'">';
                        sub_task_output += '<option value="">No Assignee</option>';
                        @foreach(App\User::whereIn('role_id', ['1', '2', '3', '4', '5', '6', '7', '8', '16'])->get() as $assignee)
                        var current_user = {{ $assignee->id }};
                        var task_user = value.assignee;
                        var user_selected = '';
                        if(current_user == task_user){
                            user_selected = 'selected';
                        }
                        sub_task_output += '<option value="{{ $assignee->id }}" '+user_selected+'>{{ $assignee->name }}</option>';
                        @endforeach
                        sub_task_output += '</select>';
                        sub_task_output += '<input style="width:220px;border-right: 0;border-left: 0;background: #fff;" type="datetime-local" id="due_date_'+ value.id +'" class="form-control" value="'+ value.due_date +'">';
                        sub_task_output += '<button class="btn input-group-text btn-icon" id="view_'+ value.id +'">';
                        sub_task_output += '<i class="la la-eye"></i>';
                        sub_task_output += '</button>';

                        // sub_task_output += '<button class="btn input-group-text btn-icon popover_update_eta" data-toggle="kt-popover" data-original-title="'+ value.name +'" id="eta_'+ value.id +'">';
                        // sub_task_output += '<i class="la la-clock-o"></i>';
                        // sub_task_output += '</button>';
                        // sub_task_output += '<button class="btn input-group-text btn-icon" id="add_user_'+ value.id +'">';
                        // sub_task_output += '<i class="la la-user-plus"></i>';
                        // sub_task_output += '</button>';
                        if(value.main_task_id){
                            sub_task_output += '<a href="{{ url('') }}/tasks/view_task/'+ value.main_task_id +'" class="btn input-group-text btn-success btn-icon" target="_blank">';
                            sub_task_output += '<i class="la la-external-link"></i>';
                            sub_task_output += '</a>';
                        }
                        else{
                            sub_task_output += '<button class="btn input-group-text btn-icon" id="add_new_'+ value.id +'">';
                            sub_task_output += '<i class="la la-plus"></i>';
                            sub_task_output += '</button>';
                        }

                        sub_task_output += '<button class="btn input-group-text btn-icon" id="clone_'+ value.id +'">';
                        sub_task_output += '<i class="la la-clone"></i>';
                        sub_task_output += '</button>';
                        sub_task_output += '<button class="btn input-group-text btn-icon" id="delete_'+ value.id +'" style="background: #ffebee;">';
                        sub_task_output += '<i class="la la-close"></i>';
                        sub_task_output += '</button>';
                        sub_task_output += '</div>';
                        sub_task_output += '</div>';
                        sub_task_output += '</div>';
                        // sub_task_output += '<h5>' + sub_task.task_id + '</h5>';
                    });
                }
                else{
                    sub_task_output = 'Sub Task Not found!.';
                }
                $('#load_sub_task').html(sub_task_output);
            });

        }
        function ini_update_sub_task(){
            var all_sub_task = $.get('{{ route('load_all_sub_task') }}', {task_id: {{ $task->id }} }, function(result){
                if(result){
                    $.each(result, function(index, value){
                        update_sub_task(value.id, 'name');
                        update_sub_task(value.id, 'status');
                        update_sub_task(value.id, 'assignee');
                        update_sub_task(value.id, 'due_date');
                        view_sub_task(value.id, value.name);
                        // delete_sub_task(value.id);
                        $('#load_sub_task').on('click', '#delete_'+value.id, function(){
                            delete_sub_task(value.id);
                        });
                        $('#load_sub_task').on('click', '#status_'+value.id, function(){
                            task_completed(value.id)
                        });
                        $('#load_sub_task').on('unbind', '#clone_'+value.id, function(){
                            clone_sub_task(value.id);
                        });
                        $('#add_new_'+value.id).unbind().click(function() {
                            if(value.assignee == null){
                                swal.fire({
                                    title: 'No Assignee Found!',
                                    text: "Kindly assign one user to this sub task!",
                                    type: 'warning',
                                    showCancelButton: false,
                                    confirmButtonText: 'OK!'
                                });
                            }
                            else{
                                add_new_task(value.id);
                            }
                        });
                        $('#clone_'+value.id).unbind().click(function() {
                                clone_sub_task(value.id);
                            });

                        // $('#load_sub_task').on('click', '.popover_update_eta', function(){
                        //     load_sub_task_eta($(this), value.id);
                        // });
                        // $('body').on('click', '#submit_sub_task_eta_'+value.id, function(){
                        //     update_sub_task_eta(value.id);
                        // });
                        if(value.status == 'completed'){
                            $('#status_'+value.id).attr('checked', 'checked');
                            $('#name_'+ value.id).attr('disabled', 'disabled');
                            $('#eta_'+ value.id).attr('disabled', 'disabled');
                            $('#assignee_'+ value.id).attr('disabled', 'disabled');
                            $('#due_date_'+ value.id).attr('disabled', 'disabled');
                        }
                        if(value.name == null){
                            $('#name_'+ value.id).val('');
                        }
                        $('button[rel=popover]').popover({
                            html: true,
                            placement: 'bottom'
                        });
                    });
                }
            });

        }

        $('#add_new_sub_task').click(function(){
            $.get('{{ route('add_new_sub_task') }}', {task_id: {{ $task->id }} }, function(result){
                if(result){
                    $('#load_sub_task').empty();
                    load_sub_task();
                    ini_update_sub_task();
                    swal.fire({
                        title: 'Created!',
                        text: "New Sub Task has been created Successfuly!",
                        type: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            });
        });

        // $(".deleteCreativeImg").click(function(){

        //     var id = $(this).data("id");
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax(
        //     {
        //         url: "{{ url('/task/creative_image/delete/') }}/"+id,
        //         type: 'delete', // replaced from put
        //         dataType: "JSON",
        //         data: {
        //             "id": id // method and token not needed in data
        //         },
        //         success: function (response)
        //         {
        //             swal.fire("Deleted!", "The Creative Image has been deleted Successfuly!", "error");
        //             location.reload();
        //         },
        //         error: function(xhr) {
        //          console.log(xhr.responseText); // this line will save you tons of hours while debugging
        //         // do something here because of error
        //        }
        //     });
        // });
        

        




    });


        // $(document).on('change', '#select_task_status', function () {
        //     if ($(this).val() == 'assigned') {
        //         $('.assigner-block').show();
        //     }
        //     else {
        //         $('.assigner-block').hide();
        //     }
        // });

    </script>

@endsection