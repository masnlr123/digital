@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
                    <!-- <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('task/web') }}"><i class="fa fa-undo"></i> Back to Web Task</a> -->
            <h3 class="kt-subheader__title">
                   Task Name &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $web_task->name }}</strong></h3>
        </div>
        <div class="kt-subheader__toolbar">
            @if(!empty($web_task->campaign))
            <a href="{{ route('campaign_details', $web_task->campaign) }}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> Campaign Page</a>
            @endif
            <a href="{{ route('campaign_index') }}" class="btn btn-warning btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> Campagins</a>
            <a href="{{ route('web_index') }}" class="btn btn-success btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> Web Task</a>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-6">

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_details" role="tab">
                            <i class="fa fa-eye" aria-hidden="true"></i>Task Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                            <i class="fa fa-edit" aria-hidden="true"></i>Edit Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab">
                            <i class="fab fa-gitter" aria-hidden="true"></i>Activity Logs
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_details" role="tabpanel">

        <div class="row">
        <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
            <table class="table table-bordered table-striped table-large">
                <tbody>
                    <tr>
                        <td width="26%">Name</td>
                        <td>{{ $web_task->name }}</td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>{{ $web_task->project }}</td>
                    </tr>
                    <tr>
                        <td>Campaign</td>
                        <td>{{ $web_task->campaign }}</td>
                    </tr>
                    <tr>
                        <td>Activity TYpe</td>
                        <td>{{ $web_task->activity }}</td>
                    </tr>
                    <tr>
                        <td>Task Owner ETA</td>
                        <td>{{ $web_task->task_owner_eta }}</td>
                    </tr>
                    <tr>
                        <td>Priority</td>
                        <td>{{ $web_task->priority }}</td>
                    </tr>
                    <tr>
                        <td>Task Status</td>
                        <td>{{ $web_task->status }}</td>
                    </tr>
                    <tr>
                        <td>Completed Duration</td>
                        <td>{{ $web_task->duration }}</td>
                    </tr>
                    <tr>
                        <td>Live Status</td>
                        <td>{{ $web_task->live }}</td>
                    </tr>
                    <tr>
                        <td>Platform</td>
                        <td>{{ $web_task->platform }}</td>
                    </tr>
                    <tr>
                        <td>Month</td>
                        <td>{{ \Carbon\Carbon::parse($web_task->month)->format('F - Y') }}</td>
                    </tr>
                    @if($web_task->lp_url)
                    <tr>
                        <td>Landing Page URL</td>
                        <td data-visible="false"><a href="{{ $web_task->lp_url }}" target="_blank"> {{ $web_task->lp_url }}</a></td>
                    </tr>
                    @endif
                </tbody>
                
            </table>
            <h5>Task Brief</h5>
            <hr>
            <div style="display: block;overflow: scroll;">
                {!! $web_task->brief !!}
            </div>
            <hr>
            <h5>Sub Task List</h5>
            <table class="table table-bordered table-striped table-info">
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
            </table>
            
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
                <h4 style="margin: 15px 0;">Edit Details</h4>

<form class="kt-form" method="post" action="{{ route('update_web', $web_task->id) }}">
    @csrf
    {{ method_field('PUT') }}
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Task Name</label>
                        <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="{{ $web_task->name }}">
                    </div>
                    <div class="col-md-6">
                        <label>Choose Project</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_user" required="" name="project">
                            <option value="">** Select a User</option>
                                @foreach($projects as $project)
                                <option  {{ $web_task->project == $project->shortcode? "selected": " " }} value="{{ $project->shortcode }}">{{ $project->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Activity Type</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" required="" name="activity">
                            <option value="">** Select a Activity Type</option>
                            <option {{ $web_task->activity == "Landing page"? "selected": " " }} value="Landing page">Landing page</option>
                            <option {{ $web_task->activity == "Website"? "selected": " " }} value="Website">Website</option>
                            <option {{ $web_task->activity == "SEO Optimization"? "selected": " " }} value="SEO Optimization">SEO Optimization</option>
                            <option {{ $web_task->activity == "Custom Software Requirements"? "selected": " " }} value="Custom Software Requirements">Custom Software Requirements</option>
                            <option {{ $web_task->activity == "Projects Update"? "selected": " " }} value="Projects Update">Projects Update</option>
                            <option {{ $web_task->activity == "Leadsqaured Works"? "selected": " " }} value="Leadsqaured Works">Leadsqaured Works</option>
                            <option {{ $web_task->activity == "Server Maintanace"? "selected": " " }} value="Server Maintanace">Server Maintanace</option>
                            <option {{ $web_task->activity == "Server Based Requirements"? "selected": " " }} ="Server Based Requirements">Server Based Requirements</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Campaign</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_campaign" required="" name="campaign">
                            <option value="">** Select a Campaign</option>
                            @if($web_task->campaign == 0)
                            <option value="0" selected>Non Campaign Task</option>
                            @foreach($campaigns as $campaign)
                            <option {{ $web_task->campaign == $campaign->id ? "selected": " " }}  value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                            @endforeach
                            @else
                            <option value="0">Non Campaign Task</option>
                            @foreach($campaigns as $campaign)
                            <option {{ $web_task->campaign == $campaign->id ? "selected": " " }}  value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>ETA From Task Owner</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" value="{{ $web_task->task_owner_eta }}" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Priority From Task Owner</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_priority" required=""  name="priority">
                            <option value="">** </option>
                            <option {{ $web_task->priority == "high" ? "selected": " " }} value="high">High</option>
                            <option {{ $web_task->priority == "medium" ? "selected": " " }} value="medium">Medium</option>
                            <option {{ $web_task->priority == "low" ? "selected": " " }} value="low">Low</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Platform</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="platform" value="{{ $web_task->platform }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Live Status</label>
                        <select style="width: 100%" class="form-control" id="select_priority" required=""  name="live">
                            <option value="">** </option>
                            <option {{ $web_task->live == "Live" ? "selected": " " }} value="Live">Live</option>
                            <option {{ $web_task->live == "Pause" ? "selected": " " }} value="Pause">Pause</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Month</label>
                        <div class="input-group date">
                            <input type="month" class="form-control" name="month" value="{{ $web_task->month }}" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">

                <label>Task Brief</label>
                <textarea id="kt-tinymce-4" name="brief" class="tox-target">
                    {!! $web_task->brief !!}
                </textarea>

                    </div>
                </div>


                <div id="sub_task_repeater">
                    <div class="form-group  row mt-4">
            <div class="col-md-12">
                <label>Sub Task List</label>
            </div>
                        <div data-repeater-list="sub_task_list" class="col-lg-12">
@if(count($sub_task) != 0)
                @foreach($sub_task as $task)
                            <div data-repeater-item class="row kt-margin-b-10">
                                <input type="hidden" name="id" value="{{ $task->id }}" />
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" placeholder="Sub task name" value="{{ $task->name }}">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <input type="text" name="activity" class="form-control" placeholder="Sub task Activity" value="{{ $task->activity }}">
                                </div>
                                <div class="col-lg-5 mt-3">
                                    <input type="date" name="eta" class="form-control" placeholder="Sub task ETA" value="{{ $task->due_date }}">
                                </div>
                                <div class="col-lg-1 mt-3">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                        <i class="la la-remove"></i>
                                    </a>
                                </div>
                            </div>

                @endforeach
                @else
                            <div data-repeater-item class="row kt-margin-b-10">
                                <input type="hidden" name="id" value="" />
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" placeholder="Sub task name">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <input type="text" name="activity" class="form-control" placeholder="Sub task Activity">
                                </div>
                                <div class="col-lg-5 mt-3">
                                    <input type="date" name="eta" class="form-control" placeholder="Sub task ETA">
                                </div>
                                <div class="col-lg-1 mt-3">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                        <i class="la la-remove"></i>
                                    </a>
                                </div>
                            </div>
                @endif
                        </div>
                    </div>
                    <div class="row mb-4">   
                        <div class="col">
                            <div data-repeater-create="" class="btn btn btn-brand">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add More Sub Task</span>
                                </span>
                            </div>
                        </div>
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
    <div class="col-md-6">
<!--begin::Portlet-->
<form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('update_web_task', $web_task->id) }}">
    @csrf
    {{ method_field('PUT') }}
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Task Status 
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Current Status</label>

                <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="status" ng-model="TaskStatus">
                    <option value=""> --- </option>
                    <option value="new">New</option>
                    <option value="New Updates">New Updates</option>
                    <option value="WIP">WIP</option>
                    <option value="Correction Updates">Correction Updates</option>
                    <option value="Under Review">Under Review</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Total Duration</label>
                    <input type="number" class="form-control" name="duration" placeholder="Total Duration in Minutes" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">                
                <label>Landing Page URL</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="lp_url" placeholder="Status Notes" />
                </div>
            </div>
        </div> 
        <div class="form-group row">
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

<!--end::Form-->
<!--begin::Portlet-->
<form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('update_web_sub_task', $web_task->id) }}">
    @csrf
    {{ method_field('PUT') }}
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Sub Task Updates
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
    <div id="kt_repeater_4">
        <div class="form-group row mt-4">
            <div data-repeater-list="sub_task_update" class="col-lg-12">
                <div data-repeater-item class="row kt-margin-b-10">
                    <div class="col-lg-8 mb-3">
                        <select class="form-control" name="id">
                            <option value=""></option>
                            @foreach($sub_task as $stask)
                            <option value="{{ $stask->id }}">{{ $stask->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select class="form-control" name="status">
                            <option value=""></option>
                            <option value="WIP">WIP</option>
                            <option value="Under Review">Under Review</option>
                            <option value="Completed">Completed</option>
                            <option value="Canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="col-lg-7">
                        <input type="text" name="deliverable" class="form-control" placeholder="Enter the Task deliverable">
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="duration" class="form-control" placeholder="Task Duration">
                    </div>
                    <div class="col-lg-1">
                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                            <i class="la la-remove"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">   
            <div class="col">
                <div data-repeater-create="" class="btn btn btn-brand">
                    <span>
                        <i class="la la-plus"></i>
                        <span>Add More Status</span>
                    </span>
                </div>
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

<!--end::Form-->

</div>
</div>
</div>
<!--end::Portlet-->

</div>


@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        $('.new-correction-block').hide();
        $('.assigner-block').hide();
        $('.process-transfer-block').hide();
        $('.internal-reiview-block').hide();
        @if($web_task->status == 'internal_review')
        $('.creative-upload-block').show();
        @elseif($web_task->status == 'external_review')
        $('.creative-upload-block').show();
        @elseif($web_task->status == 'completed')
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