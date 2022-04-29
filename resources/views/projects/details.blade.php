@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Project &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $projects->name }}</strong></h3>
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
                            <i class="fa fa-eye" aria-hidden="true"></i>Project Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                            <i class="fa fa-edit" aria-hidden="true"></i>Edit Project
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
            <table class="table table-bordered table-striped table-success">
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ $projects->name }}</td>
                    </tr>
                    <tr>
                        <td>Shortcode</td>
                        <td>{{ $projects->shortcode }}</td>
                    </tr>
                    <tr>
                        <td>Project Type</td><td>
                                {{ $projects->project_type }}</td>
                    </tr>
                    <tr>
                        <td>Launch Date</td><td>
                                {{ $projects->launch_date }}</td>
                    </tr>
                    <tr>
                        <td>Business Name</td><td>
                                {{ $projects->business_name }}</td>
                    </tr>
                    <tr>
                        <td>Developer</td><td>
                                {{ $projects->developer }}</td>
                    </tr>
                    <tr>
                        <td>Gated Community</td><td>
                                {{ $projects->gated_community }}</td>
                    </tr>
                    <tr>
                        <td>Ownership</td><td>
                                {{ $projects->ownership }}</td>
                    </tr>
                    <tr>
                        <td>Current Status</td><td>
                                {{ $projects->current_status }}</td>
                    </tr>
                    <tr>
                        <td>Hand Over Date</td><td>
                                {{ $projects->hand_over_date }}</td>
                    </tr>
                    <tr>
                        <td>rera_no</td><td>
                                {{ $projects->rera_no }}</td>
                    </tr>
                    <tr>
                        <td>LMS</td><td>
                                {{ $projects->lms }}</td>
                    </tr>
                    <tr>
                        <td>Furnishing Status</td><td>
                                {{ $projects->furnishing_status }}</td>
                    </tr>
                    <tr>
                        <td>Target Audience</td><td>
                                {{ $projects->target_audience }}</td>
                    </tr>
                    <tr>
                        <td>Awards</td><td>
                                {{ $projects->awards }}</td>
                    </tr>
                    <tr>
                        <td>Site Address</td><td>
                                {{ $projects->site_address }}</td>
                    </tr>
                    <tr><td>Website</td><td>
                                {{ $projects->website }}</td>
                    </tr>
                                            <td>Email</td><td>
                                {{ $projects->email }}</td>
                    </tr>
                    <tr>
                        <td>Product_range</td><td>
                                {{ $projects->product_range }}</td>
                    </tr>
                    <tr>
                        <td>Acres</td><td>
                                {{ $projects->acres }}</td>
                    </tr>
                    <tr>
                        <td>Blocks</td><td>
                                {{ $projects->blocks }}</td>
                    </tr>
                    <tr>
                        <td>Floors</td><td>
                                {{ $projects->floors }}</td>
                    </tr>
                    <tr><td>Units</td><td>
                                {{ $projects->units }}</td>
                    </tr>
                        <td>Total_floors</td><td>
                                {{ $projects->total_floors }}</td>
                    </tr>
                    <tr>
                        <td>Amenities</td><td>
                                {{ $projects->amenities }}</td>
                    </tr>
                    <tr>
                        <td>Top_competitor</td><td>
                                {{ $projects->top_competitor }}</td>
                    </tr>
                </tbody>
            </table>

                </div>
            </div>
        </div>
            <div class="tab-pane" id="kt_portlet_edit" role="tabpanel">
                <h4 style="margin: 15px 0;">Edit Project</h4>

<form id="UpdateProject" class="kt-form" enctype="multipart/form-data" method="post">
    @csrf
    {{ method_field('PUT') }}
        <div class="form-group row">
            <div class="col-md-6">
                <label>Project Name</label>
                <input type="text" title="Project Name" placeholder="" required="" class="form-control" name="name" id="name" value="{{ $projects->name }}">
            </div>
            <div class="col-md-6">
                <label>Shortcode</label>
                <input type="text" placeholder="" class="form-control" name="shortcode" id="shortcode" value="{{ $projects->shortcode }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Project Type</label>
                <input type="text" placeholder="" class="form-control" name="project_type" id="project_type" value="{{ $projects->project_type }}">
            </div>
            <div class="col-md-6">
                <label>Launch Date</label>
                <input type="text" placeholder="" class="form-control" name="launch_date" id="launch_date" value="{{ $projects->launch_date }}">
            </div>

            <div class="col-md-6">
                <label>Business Name</label>
                <input type="text" placeholder="" class="form-control" name="business_name" id="business_name" value="{{ $projects->business_name }}">
            </div>

            <div class="col-md-6">
                <label>Developer</label>
                <input type="text" placeholder="" class="form-control" name="developer" id="developer" value="{{ $projects->developer }}">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Gated Community</label>
                <input type="text" placeholder="" class="form-control" name="gated_community" id="gated_community" value="{{ $projects->gated_community }}">
            </div>

            <div class="col-md-6">
                <label>Ownership</label>
                <input type="text" placeholder="" class="form-control" name="ownership" id="ownership" value="{{ $projects->ownership }}">
            </div>

            <div class="col-md-6">
                <label>Current Status</label>
                <input type="text" placeholder="" class="form-control" name="current_status" id="current_status" value="{{ $projects->current_status }}">
            </div>

            <div class="col-md-6">
                <label>Hand Over Date</label>
                <input type="text" placeholder="" class="form-control" name="hand_over_date" id="hand_over_date" value="{{ $projects->hand_over_date }}">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Rera No</label>
                <input type="text" placeholder="" class="form-control" name="rera_no" id="rera_no" value="{{ $projects->rera_no }}">
            </div>

            <div class="col-md-6">
                <label>LMS</label>
                <input type="text" placeholder="" class="form-control" name="lms" id="lms" value="{{ $projects->lms }}">
            </div>

            <div class="col-md-6">
                <label>Furnishing Status</label>
                <input type="text" placeholder="" class="form-control" name="furnishing_status" id="furnishing_status" value="{{ $projects->furnishing_status }}">
            </div>

            <div class="col-md-6">
                <label>Target Audience</label>
                <input type="text" placeholder="" class="form-control" name="target_audience" id="target_audience" value="{{ $projects->target_audience }}">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Awards</label>
                <input type="text" placeholder="" class="form-control" name="awards" id="awards" value="{{ $projects->awards }}">
            </div>

            <div class="col-md-6">
                <label>Website</label>
                <input type="text" placeholder="" class="form-control" name="website" id="website" value="{{ $projects->website }}">
            </div>
        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Site Address</label>
                <input type="text" placeholder="" class="form-control" name="site_address" id="site_address" value="{{ $projects->site_address }}">
            </div>

            <div class="col-md-6">
                <label>Email</label>
                <input type="text" placeholder="" class="form-control" name="email" id="email" value="{{ $projects->email }}">
            </div>

            <div class="col-md-6">
                <label>Acres</label>
                <input type="text" placeholder="" class="form-control" name="acres" id="acres" value="{{ $projects->acres }}">
            </div>
        </div>
        <div class="form-group row">


            <div class="col-md-6">
                <label>Blocks</label>
                <input type="text" placeholder="" class="form-control" name="blocks" id="blocks" value="{{ $projects->blocks }}">
            </div>
            <div class="col-md-6">
                <label>Floors</label>
                <input type="text" placeholder="" class="form-control" name="floors" id="floors" value="{{ $projects->floors }}">
            </div>

            <div class="col-md-6">
                <label>Units</label>
                <input type="text" placeholder="" class="form-control" name="units" id="units" value="{{ $projects->units }}">
            </div>

            <div class="col-md-6">
                <label>Total Floors</label>
                <input type="text" placeholder="" class="form-control" name="total_floors" id="total_floors" value="{{ $projects->total_floors }}">
            </div>

        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Status</label>
                <input type="text" placeholder="" class="form-control" name="status" id="status" value="{{ $projects->status }}">
            </div>
            <div class="col-md-6">
                <label>Product Range</label>
                <input type="text" placeholder="" class="form-control" name="product_range" id="product_range" value="{{ $projects->product_range }}">
            </div>

        </div>
        <div class="form-group row">

            <div class="col-md-6">
                <label>Amenities</label>
                <input type="text" placeholder="" class="form-control" name="amenities" id="amenities" value="{{ $projects->amenities }}">
            </div>

            <div class="col-md-6">
                <label>Top Competitor</label>
                <input type="text" placeholder="" class="form-control" name="top_competitor" id="top_competitor" value="{{ $projects->top_competitor }}">
            </div>
        </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <input type="submit" id="btn-update-project" class="btn btn-primary" value="Submit">
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>

</form>
            </div>
            <div class="tab-pane" id="kt_portlet_logs" role="tabpanel">
                <h4 style="margin: 15px 0;">Activity Logs</h4>
                <!--Begin::Timeline 3 -->
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">


                    </div>
                </div>
                <!--End::Timeline 3 -->
            </div>
        </div>
    </div>
</div>
    </div>
    <div class="col-md-6">
<!--begin::Portlet-->
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Campaigns Details 
                
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body" style="    padding: 5px;">
        <!--begin::Accordion-->
        <div class="accordion accordion-light  accordion-toggle-arrow" id="campaign_info">
        <?php 
        $i ='1';
        foreach ($campaigns as $campaign): ?>
            <div class="card campp-task-add">
                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                    <div class="card-title" data-toggle="collapse" data-target="#campaign_collapse<?php echo $i; ?>" aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>" aria-controls="campaign_collapse<?php echo $i; ?>">
                        <span class="task-heading-section">{{ $campaign->name }}</span>
                        <span class="btn btn-success btn-camp-status">{{ $campaign->status }}</span>
                    </div>
                </div>
                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                    <div class="card-body">
                        <div class="row">
                            <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                             <table class="table table-bordered table-striped table-info">
                <tbody>
                    <tr>
                        <td>Project Name</td>
                        <td>{{ $projects->name }}</td>
                    </tr>
                            <tr>
                        <td>Campaign Name</td>
                        <td>{{ $campaign->name }}</td>
                    </tr>
                            <tr>
                        <td>Project Shortcode</td>
                        <td>{{ $campaign->project }}</td>
                    </tr>
                            <tr>
                        <td>Campaign Type</td>
                        <td>{{ $campaign->type }}</td>
                    </tr>
                            <tr>
                        <td>Campaign status</td>
                        <td>{{ $campaign->status }}</td>
                    </tr>
                            <tr>
                        <td>Campaign source</td>
                        <td>{{ $campaign->source }}</td>
                    </tr>
                            <tr>
                        <td>Campaign Target Audience</td>
                        <td>{{ $campaign->target_audience }}</td>
                    </tr>
                            <tr>
                        <td>Campaign Budget</td>
                        <td>{{ $campaign->budget_cost }}</td>
                    </tr>
                            
                            <tr>
                        <td>Campaign Expected Leads</td>
                        <td>{{ $campaign->expected_leads_count }}</td>
                    </tr>
                    @if($campaign->valid_leads)
                            <tr>
                        <td>Campaign Valid Leads</td>
                        <td>{{ $campaign->valid_leads }}%</td>
                    </tr>
                    @endif
                    <tr><td>Campaign Expected Site Visit</td>
                            <td>{{ $campaign->expected_site_visit_count }}</td>
                        </tr>
                            <tr>
                        <td>Campaign Expected SOR</td>
                        <td>{{ $campaign->expected_sor }}</td>
                    </tr>
                            <tr>
                        <td>Sales</td>
                        <td>{{ $campaign->sales_count }}</td>
                    </tr>
                            <tr>
                        <td>Campaign Expected Close Date</td>
                        <td>{{ $campaign->expected_close_date }}</td>
                    </tr>
                            <tr>
                        <td>description</td>
                        <td>{{ $campaign->description }}</td>
                    </tr>
                </tbody>
            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php $i++; endforeach; ?>
        </div>

                                            <!--end::Accordion-->
    </div>
    <div class="kt-portlet__foot">
<!--         <div class="kt-form__actions">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
        </div> -->
    </div>
</div>

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
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script type="text/javascript">
        $('input#btn-update-project').click( function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax(
                {
                    url: "{{ url('/projects/update/') }}/<?php echo $projects->id; ?>",
                    type: 'put',
                    dataType: "JSON",
                    data: $("#UpdateProject").serialize(),
                    success: function (response)
                    {
                        swal.fire({
                            title: 'Updated!',
                            text: "The Project details updated Successfuly!",
                            type: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function(result) {
                            window.location.href;
                                location.reload();
                        });
                    }
                });

            });
    </script>
@endsection