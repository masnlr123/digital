@extends('layouts.app')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        Lead Audits Task List </h3>
                                    <span class="kt-subheader__separator kt-hidden"></span>
                                </div>
                            </div>
                        </div>

                        <!-- end:: Subheader -->

                        <!-- begin:: Content -->
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Lead Audits Task
                                            <small>List of Recent Lead Audits Task</small>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                 <button type="button" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#upload_lead_audits">Upload Lead Audits Task</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($message_file_upload_success = Session::get('file_upload_success'))
                                <div class="alert alert-success fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $message_file_upload_success }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                @if($file_upload_error = Session::get('file_upload_error'))
                                @foreach($file_upload_error as $error)
                                <div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $error }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @if($message = Session::get('leads_added'))
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
                                <div class="kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <!-- <table class="kt-datatable" id="html_table" width="100%"> -->
                                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th title="Field #1">Task ID</th>
                                                <th title="Field #2">Project</th>
                                                <th title="Field #3">Created On</th>
                                                <th title="Field #4">Lead Number</th>
                                                <th title="Field #5">Lead Stage</th>
                                                <th title="Field #6">Lead Source</th>
                                                <th title="Field #7">Contact Number</th>
                                                <th title="Field #8">Lead Owner</th>
                                                <th title="Field #10">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>

                        <!-- end:: Content -->
                    </div>
<div class="modal fade" id="upload_lead_audits" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('import_lead_audits') }}">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Upload Lead Audit CSV file</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Upload Lead Audits</label>
                                <div class="input-group">
                                    <input required type="file" class="form-control" name="leads_csv" placeholder="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Upload CSV">
                    </div>
                </form>
                </div>
            </div>
        </div>

@endsection

@section('footer_js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
        <script type="text/javascript">

        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               pageLength: 50,
               ajax: '{{ route('lead_audits_datatable') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'project', name: 'project' },
                        { data: 'created_on', name: 'created_on' },
                        { data: 'lead_number', name: 'lead_number' },
                        { data: 'lead_stage', name: 'lead_stage' },
                        { data: 'lead_source', name: 'lead_source' },
                        { data: 'contact_number', name: 'contact_number' },
                        { data: 'lead_owner', name: 'lead_owner' },
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

      //   $(function() {
      //   $(".btn-area").append('<div class="col-sm-4 table-contents">'+
      //       '<a class="add-btn" data-href="{{route('task_creative_create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
      //     '<i class="fas fa-plus"></i> Add New Brand'+
      //     '</a>'+
      //     '</div>');
      // });

        </script>

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
        <script type="text/javascript">
            $('.kt-datatable__head th:nth-child(1)').css('max-width', '90px');
        </script>
@endsection