@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
                                        Activity Types Create </h3>
                                    <span class="kt-subheader__separator kt-hidden"></span>
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Activity Types </a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Activity Types Create </a>
                                    </div>
                                </div>
                                @include('admin.includes.actions')
                            </div>
                        </div>

                        <!-- end:: Subheader -->

                        <!-- begin:: Content -->
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                            <!--Begin::App-->
                            <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

                                <!--Begin:: App Aside Mobile Toggle-->
                                <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                                    <i class="la la-close"></i>
                                </button>

                                <!--End:: App Aside Mobile Toggle-->

                                @include('admin.includes.aside')
                                <!--Begin:: App Content-->
                                <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                                    <div class="row">
                                        <div class="col-12">

<form class="kt-form" method="post" enctype="multipart/form-data"  action="{{ route('store_exp') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                New Activity Type
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('activity_types_index') }}" class="btn btn-warning btn-elevate btn-icon-sm">
                        <i class="la la-reply"></i>
                        Back to All Activities
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row same-row-content">
            <div class="col-md-4">
                <label>Activity Name</label>
                <input type="text" title="Activity Type Name" placeholder="" required="" maxlength="255" class="form-control" name="account_team" id="account_team" value="">
            </div>
            <div class="col-md-8">
                <label>Description</label>
                <input type="text" class="form-control" name="description" id="description">
            </div>
            <div class="col-md-3">
                <label>Module</label>
                <select style="width: 100%" class="form-control" id="initiated_by" required name="initiated_by">
                    <option value="">** Select one</option>
                    <option value="Project">Project</option>
                    <option value="Campaign">Campaign</option>
                    <option value="Task">Task</option>
                    <option value="Creative Task">Creative Task</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Activity Type</label>
                <select style="width: 100%" class="form-control" id="initiated_by" name="type">
                    <option value="">** Select one</option>
                    <option value="Entity">Entity</option>
                    <option value="Custom">Custom</option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-5 col-form-label">Workflow Direction</label>
                    <div class="col-7">
                        <div class="kt-radio-inline">
                            <label class="kt-radio">
                                <input type="radio" name="score"> Inbound
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="score"> Outbound
                                <span></span>
                            </label>
                        </div>
                        <span class="form-text text-muted">Some help text goes here</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Delete Activity</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Track Location</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Log Activity Changes</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Allow pre-dated Activities</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Show in Activity List</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Allow Attachments</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Quick Add</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <div class="col-md-4">
                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info mt-1">
                    <label><span style="line-height: 34px;padding-left: 10px;">Lock Activity</span>
                        <input type="checkbox" id="count_check_2103" name="no_update_in_lms2103" class="ng-pristine ng-untouched ng-valid ng-empty" value="1"> <span></span>
                    </label>
                </span>
            </div>
            <hr>
            <div class="col-md-12">
                <label>Fileds</label>

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
                                </div>

                                <!--End:: App Content-->
                            </div>

                            <!--End::App-->
                        </div>

                        <!-- end:: Content -->
                    </div>
        
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
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
               pageLength: 50,
               ajax: '{{ route('activity_types_datatable') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'module', name: 'module' },
                        { data: 'type', name: 'type' },
                        { data: 'status', name: 'status' },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'action', searchable: false, orderable: false }

                     ],
                // language : {
                //     processing: '<img src="{{asset('assets/images/loader.jpg')}}">'
                // },
                // drawCallback : function( settings ) {
                //         $('.select').niceSelect();
                // }
            });

        </script>

        <!-- <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js') }}"></script> -->
@endsection