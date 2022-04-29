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
                                        All Landing Pages</h3>
                                </div>
                            </div>
                        </div>
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Landing Pages
                                            <small>List of Recent Landing Page</small>
                                        </h3>
                                    </div>
                                <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('web_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Landing Page
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="camp_index kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th title="Field #1">ID</th>
                                                <th width="11%" title="Field #3">Month</th>
                                                <th title="Field #3">Project</th>
                                                <th width="52%" title="Field #2">Landing Page URL</th>
                                                <th title="Field #3">Status</th>
                                                <th title="Field #3">Live Status</th>
                                                <th width="7%" title="Field #6">Platform</th>
                                                <th title="Field #6">Date</th>
                                                <th width="4%" title="Field #7">Action</th>
                                            </tr>
                                        </thead>
                                    </table>

                                    <!--end: Datatable -->
                                </div>
                            </div>
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
               ajax: '{{ route('web_lp_datatable') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'month', name: 'month' },
                        { data: 'project', name: 'project' },
                        { data: 'lp', searchable: false, orderable: false},
                        { data: 'lp_status', name: 'lp_status' },
                        { data: 'live', name: 'live' },
                        { data: 'platform', name: 'platform' },
                        { data: 'updated_at', name: 'updated_at' },
                        // { data: 'status', searchable: false, orderable: false},
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