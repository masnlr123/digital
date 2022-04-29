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
                                        All Expense</h3>
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
                                            Expense
                                            <small>List of Recent Expense</small>
                                        </h3>
                                    </div>
                                <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('exp_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Expense
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
                                                <th title="Field #3">Date</th>
                                                <th title="Field #1">Ad Account / Team</th>
                                                <th title="Field #2">Initiated by</th>
                                                <th title="Field #3">Platform</th>
                                                <th width="17%" title="Field #3">Project</th>
                                                <th title="Field #3">Currency</th>
                                                <th title="Field #6">Amount</th>
                                                <th title="Field #6">Card</th>
                                                <th title="Field #6">Card Holder</th>
                                                <th title="Field #6">Verification</th>
                                                <th title="Field #7">Action</th>
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
               ajax: '{{ route('exp_datatable') }}',
               columns: [
                        { data: 'date', name: 'date' },
                        { data: 'account_team', name: 'account_team' },
                        { data: 'initiated_by', name: 'initiated_by' },
                        { data: 'platform', name: 'platform' },
                        { data: 'project', name: 'project' },
                        { data: 'currency', name: 'currency' },
                        { data: 'amount', name: 'amount' },
                        { data: 'card_no', name: 'card_no' },
                        { data: 'card_holder', name: 'card_holder' },
                        { data: 'transaction_verification', name: 'transaction_verification' },
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