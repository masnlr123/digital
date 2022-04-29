@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
                    <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('task/web') }}"><i class="fa fa-undo"></i> Back to Web Task</a>
            <h3 class="kt-subheader__title">Add Web Task</h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" action="{{ route('store_web') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Task Details
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Task Name</label>
                <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="">
            </div>
            <div class="col-md-3">
                <label>Choose Project</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_user" required="" name="project">
                    <option value="">** Select a User</option>
                        @foreach($projects as $project)
                        <option value="{{ $project->shortcode }}">{{ $project->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Task Assignee</label>

                <select style="width: 100%" class="form-control kt-select2" id="select_user" required="" name="assignee">
                    <option value="">** Select a User</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label>Activity Type</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" required="" name="activity">
                    <option value="">** Select a Activity Type</option>
                    <option value="Landing page">Landing page</option>
                    <option value="Website">Website</option>
                    <option value="SEO Optimization">SEO Optimization</option>
                    <option value="Custom Software Requirements">Custom Software Requirements</option>
                    <option value="Projects Update">Projects Update</option>
                    <option value="Leadsqaured Works">Leadsqaured Works</option>
                    <option value="Server Maintanace">Server Maintanace</option>
                    <option value="Server Based Requirements">Server Based Requirements</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Campaign</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_campaign" required="" name="campaign">
                    <option value="">** Select a Campaign</option>
                    <option value="0">Non Campaign Task</option>
                    @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">                
                <label>ETA From Task Owner</label>
                <div class="input-group date">
                    <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">                
                <label>Priority From Task Owner</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_priority" required=""  name="priority">
                    <option value="">** </option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-9">
                <label>Task Brief</label>
                <input type="text" title="Task Brief" placeholder="" class="form-control" name="brief" id="brief" value="">
            </div>
            <div class="col-md-3 platform_display">
                <label>Platform</label>
                <input type="text" title="Platform" placeholder="" class="form-control" name="platform" id="brief" value="">
            </div>
        </div>
                <div id="kt_repeater_4">
                    <div class="form-group  row mt-4">
            <div class="col-md-12">
                <label>Sub Task List</label>
            </div>
                        <div data-repeater-list="sub_task_list" class="col-lg-12">
                            <div data-repeater-item class="row kt-margin-b-10">
                                <div class="col-lg-5">
                                    <input type="text" name="name" class="form-control" placeholder="Sub task name">
                                </div>
                                <div class="col-lg-3">
                                    <input type="text" name="activity" class="form-control" placeholder="Sub task Activity">
                                </div>
                                <div class="col-lg-3">
                                    <input type="date" name="eta" class="form-control" placeholder="Sub task ETA">
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
                                    <span>Add More Sub Task</span>
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
@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.platform_display').hide();
                $('#select_creative_type').on('change', function(){
                    if($(this).val() == 'Landing page'){
                        $('.platform_display').show();
                    }
                });
                if($('#platform_display').hide();
            })
        </script>
@endsection