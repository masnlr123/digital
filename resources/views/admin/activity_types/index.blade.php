<?php 
use App\CreativeImages;
?>
@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
                                        Activity Types</h3>
                                    <span class="kt-subheader__separator kt-hidden"></span>
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Activity </a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Activity Types </a>
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

        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
            <!-- begin:: Subheader -->
<!--             <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            All Activities</h3>
                    </div>
                </div>
            </div> -->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Activities
                            <small>List of Recent Activities</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <a href="{{ route('activity_types_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    New Activity
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
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
                <div class="camp_index kt-portlet__body kt-portlet__body--fit">

                    <!--begin: Datatable -->
                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th title="Field #3">Name</th>
                                <th title="Field #1">Module</th>
                                <th title="Field #3">Type</th>
                                <th title="Field #3">status</th>
                                <th title="Field #3">Created By</th>
                                <th title="Field #7">Action</th>
                            </tr>
                        </thead>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
            <!-- end:: Content -->
        </div>
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