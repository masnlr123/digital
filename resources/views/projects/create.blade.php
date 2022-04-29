@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add New Project </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" action="{{ route('store_project') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Project Details
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-md-9">
                <label>Project Name</label>
                <input type="text" title="Project Name" placeholder="" required="" class="form-control" name="name" id="name" value="">
            </div>
            <div class="col-md-3">
                <label>Shortcode</label>
                <input type="text" placeholder="Shortcode" class="form-control" name="shortcode" id="shortcode">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label>Project Type</label>
                <input type="text" placeholder="" class="form-control" name="project_type" id="project_type">
            </div>
            <div class="col-md-3">
                <label>Launch Date</label>
                <input type="text" placeholder="" class="form-control" name="launch_date" id="launch_date">
            </div>

            <div class="col-md-3">
                <label>Business Name</label>
                <input type="text" placeholder="" class="form-control" name="business_name" id="business_name">
            </div>

            <div class="col-md-3">
                <label>Developer</label>
                <input type="text" placeholder="" class="form-control" name="developer" id="developer">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-3">
                <label>Gated Community</label>
                <input type="text" placeholder="" class="form-control" name="gated_community" id="gated_community">
            </div>

            <div class="col-md-3">
                <label>Ownership</label>
                <input type="text" placeholder="" class="form-control" name="ownership" id="ownership">
            </div>

            <div class="col-md-3">
                <label>Current Status</label>
                <input type="text" placeholder="" class="form-control" name="current_status" id="current_status">
            </div>

            <div class="col-md-3">
                <label>Hand Over Date</label>
                <input type="text" placeholder="" class="form-control" name="hand_over_date" id="hand_over_date">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-3">
                <label>Rera No</label>
                <input type="text" placeholder="" class="form-control" name="rera_no" id="rera_no">
            </div>

            <div class="col-md-3">
                <label>LMS</label>
                <input type="text" placeholder="" class="form-control" name="lms" id="lms">
            </div>

            <div class="col-md-3">
                <label>Furnishing Status</label>
                <input type="text" placeholder="" class="form-control" name="furnishing_status" id="furnishing_status">
            </div>

            <div class="col-md-3">
                <label>Target Audience</label>
                <input type="text" placeholder="" class="form-control" name="target_audience" id="target_audience">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Awards</label>
                <input type="text" placeholder="" class="form-control" name="awards" id="awards">
            </div>

            <div class="col-md-6">
                <label>Website</label>
                <input type="text" placeholder="" class="form-control" name="website" id="website">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Site Address</label>
                <input type="text" placeholder="" class="form-control" name="site_address" id="site_address">
            </div>

            <div class="col-md-3">
                <label>Email</label>
                <input type="text" placeholder="" class="form-control" name="email" id="email">
            </div>

            <div class="col-md-3">
                <label>Acres</label>
                <input type="text" placeholder="" class="form-control" name="acres" id="acres">
            </div>
        </div>
        <div class="form-group row">


            <div class="col-md-3">
                <label>Blocks</label>
                <input type="text" placeholder="" class="form-control" name="blocks" id="blocks">
            </div>
            <div class="col-md-3">
                <label>Floors</label>
                <input type="text" placeholder="" class="form-control" name="floors" id="floors">
            </div>

            <div class="col-md-3">
                <label>Units</label>
                <input type="text" placeholder="" class="form-control" name="units" id="units">
            </div>

            <div class="col-md-3">
                <label>Total Floors</label>
                <input type="text" placeholder="" class="form-control" name="total_floors" id="total_floors">
            </div>

        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Status</label>
                <input type="text" placeholder="" class="form-control" name="status" id="status">
            </div>
            <div class="col-md-6">
                <label>Product Range</label>
                <input type="text" placeholder="" class="form-control" name="product_range" id="product_range">
            </div>

        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Amenities</label>
                <input type="text" placeholder="" class="form-control" name="amenities" id="amenities">
            </div>

            <div class="col-md-6">
                <label>Top Competitor</label>
                <input type="text" placeholder="" class="form-control" name="top_competitor" id="top_competitor">
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
@endsection