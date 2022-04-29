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
                                        All Lead List</h3>
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
                                            Lead List
                                            <small>List of Recent Lead List</small>
                                        </h3>
                                    </div>
<!--                                 <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('content_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Content Task
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="camp_index kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <table class="table table-striped table-bordered table-hover display nowrap" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <!-- <th>ID</th> -->
                                                <th>Date</th>
                                                <th>Project</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th width="120">Contact</th>
                                                <th width="75">LSQ Status</th>
                                                <th width="300">Lead ID</th>
                                                <th width="300">Track ID</th>
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
            // $('#kt_table_1 thead tr').clone(true).appendTo( '#kt_table_1 thead' );
            //     $('#kt_table_1 thead tr:eq(1) th').each( function (i) {
            //         var title = $(this).text();
            //         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
             
            //         $( 'input', this ).on( 'keyup change', function () {
            //             if ( table.column(i).search() !== this.value ) {
            //                 table
            //                     .column(i)
            //                     .search( this.value )
            //                     .draw();
            //             }
            //         } );
            //     } );
        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               scroll: true,
               // orderCellsTop: true,
               // fixedHeader: true,
               // fixedHeader: {
               //      footer: true
               //  },
               pageLength: 50,
               ajax: '{{ route('fb_leads_datatables') }}',
               columns: [
                        // { data: 'id', name: 'id' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'project', name: 'project' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'contact', name: 'contact' },
                        { data: 'leadsquared_submited', name: 'leadsquared_submited' },
                        { data: 'lead_id', name: 'lead_id' },
                        { data: 'track_id', name: 'track_id' }
                        // { data: 'status', searchable: false, orderable: false},
                        // { data: 'action', searchable: false, orderable: false }

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