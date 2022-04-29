@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add Creative Task </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('store_creative_task') }}">
    @csrf
    <input type="hidden" name="name" id="task_name" />
    <input type="hidden" name="camp_task_count" id="camp_task_count" />
    <input type="hidden" name="camp_id" id="camp_id" />
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Task Details
                <span class="camp_name"></span>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body task_create_portlet">
        <div class="form-group row">
            <div class="col-md-3">
                <label>Campaign *</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_campaign" required name="campaign">
                    <option value="">** Select a Campaign</option>
                    <option value="0">Non Campaign Task</option>
                    @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->name }}"  data-count="{{ $campaign->creative_count }}" data-id="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Creative Theme (Optional)</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_task_cat" name="task_cat[]" multiple="multiple">
                    <option value="">** Select a Option</option>
                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_category') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Task For*</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_task_for" required="" name="task_for">
                    <option value="">** Select a Option</option>
                    <option value="inhouse">InHouse -  Alliance Digital Labs</option>
                    <option value="agency">Agency</option>
                </select>
            </div>
            <div class="col-md-3">                
                <label>Priority (Optional)</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_priority" name="creator_priority">
                    <option value="">** </option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Creatives *</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" required="" name="creative_type[]" multiple="multiple">
                    <option value="">** Select a Creative Type</option>

                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-3">                
                <label>ETA (Optional)</label>
                <div class="input-group date">
                    <input type="text" class="form-control" name="eta_from_creator" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <label>Upload Samples (Optional)</label>
                <input type="file" class="form-control" name="samples_creatives[]" multiple>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <label>Task Brief</label>

                <textarea id="kt-tinymce-4" name="task_brief" class="tox-target"></textarea>
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
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }}"></script>
@endsection