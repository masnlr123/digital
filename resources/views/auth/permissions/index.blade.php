@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        Permission List </h3>
                                </div>
                            </div>
                        </div>

                        <!-- begin:: Content -->
                        <div class="kt-container lead_list kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Permissions
                                            <small>List of Recent Permissions</small>
                                        </h3>
                                    </div>
                                    <div class="col-md-6 mt-3 p-0">
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <button type="button" class="btn btn-brand btn-elevate btn-icon-sm lead_new_btn" data-toggle="modal" data-target="#kt_modal_6">
                                                    <i class="la la-plus"></i> New Permission</button>
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
                                <div class="creative_index kt-portlet__body kt-portlet__body--fit">

                                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!--begin: Datatable -->
                                   
                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>

                        <!-- end:: Content -->
                    </div>



                    <!-- Modal -->
                            <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('register-new-permissions') }}">
                                            @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">New User Permission</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="col-md-12 mt-3">
                                                    <label>Permission Name *</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Permission Name">
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label>Guard Name *</label>
                                                    <input type="text" name="guard_name" class="form-control" placeholder="Guard Name">
                                                </div>
                                               
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="" value="Create Permission" class="btn btn-primary">
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                    <!-- Modal -->
                            <div class="modal fade" id="kt_modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('register-new-permissions') }}">
                                            @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">New User Permission</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="col-md-12 mt-3">
                                                    <label>Permission Name *</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Permission Name">
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label>Guard Name *</label>
                                                    <input type="text" name="guard_name" class="form-control" placeholder="Guard Name">
                                                </div>
                                               
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="" value="Create Permission" class="btn btn-primary">
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')


        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
$(document).ready(function () {

        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
        var leadStage = getParameterByName('stage');
        var temp_search = new Array();
        temp_search = leadStage.split(",");
        // alert(leadStage);

        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               pageLength: 50,
               ajax: {
                    url: '{{ route('permissions_datatable') }}',
                    data: {
                        lead_stage: leadStage
                    }
                },
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'action', searchable: false, orderable: false }

                     ],
            });
            setInterval( function () {
                table.ajax.reload( null, false ); // user paging is not reset on reload
            }, 30000 );
            if(leadStage){
                // table.columns(5).search(leadStage).draw();
                table.columns(5).search(temp_search.join('|'), true, false, true).draw();;
            }


    });

        </script>
@endsection