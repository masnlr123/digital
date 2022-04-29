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
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Name</h3>
                                <span class="kt-widget1__desc">{{ $projects->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Project Type</h3>
                                <span class="kt-widget1__desc">{{ $projects->project_type }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Launch Date</h3>
                                <span class="kt-widget1__desc">{{ $projects->launch_date }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Business Name</h3>
                                <span class="kt-widget1__desc">{{ $projects->business_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Developer</h3>
                                <span class="kt-widget1__desc">{{ $projects->developer }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Gated Community</h3>
                                <span class="kt-widget1__desc">{{ $projects->gated_community }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Ownership</h3>
                                <span class="kt-widget1__desc">{{ $projects->ownership }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Current Status</h3>
                                <span class="kt-widget1__desc">{{ $projects->current_status }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Hand Over Date</h3>
                                <span class="kt-widget1__desc">{{ $projects->hand_over_date }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">rera_no</h3>
                                <span class="kt-widget1__desc">{{ $projects->rera_no }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">LMS</h3>
                                <span class="kt-widget1__desc">{{ $projects->lms }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Furnishing Status</h3>
                                <span class="kt-widget1__desc">{{ $projects->furnishing_status }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-4" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Target Audience</h3>
                                <span class="kt-widget1__desc">{{ $projects->target_audience }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Awards</h3>
                                <span class="kt-widget1__desc">{{ $projects->awards }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Site Address</h3>
                                <span class="kt-widget1__desc">{{ $projects->site_address }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-6" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Website</h3>
                                <span class="kt-widget1__desc">{{ $projects->website }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-6" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Email</h3>
                                <span class="kt-widget1__desc">{{ $projects->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Product_range</h3>
                                <span class="kt-widget1__desc">{{ $projects->product_range }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="kt-widget1 col-md-12" style="padding:20px 10px 0;border-bottom: 1px solid #efefef;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Project outline</h3>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-2" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Acres</h3>
                                <span class="kt-widget1__desc">{{ $projects->acres }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-2" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Blocks</h3>
                                <span class="kt-widget1__desc">{{ $projects->blocks }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-2" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Floors</h3>
                                <span class="kt-widget1__desc">{{ $projects->floors }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-3" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Units</h3>
                                <span class="kt-widget1__desc">{{ $projects->units }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-3" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Total_floors</h3>
                                <span class="kt-widget1__desc">{{ $projects->total_floors }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Amenities</h3>
                                <span class="kt-widget1__desc">{{ $projects->amenities }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                        <div class="kt-widget1__item">
                            <div class="kt-widget1__info">
                                <h3 class="kt-widget1__title">Top_competitor</h3>
                                <span class="kt-widget1__desc">{{ $projects->top_competitor }}</span>
                            </div>
                        </div>
                    </div>

                </div>
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
    <div class="kt-portlet__body">
        
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
    <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
@endsection