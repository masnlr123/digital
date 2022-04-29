@extends('layouts.app') @section('content')
@php
use App\User;
@endphp
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						<!-- begin:: Content Head -->
						<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">
										Register Request
									</h3>
								</div>
								<div class="kt-subheader__toolbar">
									<a href="#" class="">
									</a>
                                    <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_6">New Request</button>
									<!-- <a href="{{ route('new_user') }}" class="btn btn-label-brand btn-bold">
										Add User </a> -->
									
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

						<!-- end:: Content Head -->

						<!-- begin:: Content -->
						<div class="kt-container users_request_index kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--begin::Portlet-->
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__body kt-portlet__body--fit">
 <!--begin: Datatable -->
                                    <table class="kt-datatable" id="html_table" width="100%">
                                        <thead>
                                            <tr>
                                                <!-- <th title="Field #1">#</th> -->
                                                <th title="Field #1">Request ID</th>
                                                <th title="Field #4">Role</th>
                                                <th title="Field #3">Valid Till</th>
                                                <th title="Field #2">Status</th>
                                                <th title="Field #2">Created By</th>
                                                <th title="Field #9">Action</th>
                                                <th title="Field #10"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reuests as $reuest)

                        <?php 
                        $role = $reuest->role_id;
                        switch ($role) {
                            case '1':
                                $reuest_role = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">Super Admin</span>';
                                break;
                            case '2':
                                $reuest_role = '<span class="kt-badge  kt-badge--assigned kt-badge--inline kt-badge--pill">Admin</span>';
                                break;
                            case '3':
                                $reuest_role = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">DST Manager</span>';
                                break;
                            case '4':
                                $reuest_role = '<span class="kt-badge  kt-badge--dst kt-badge--inline kt-badge--danger kt-badge--pill">DST</span>';
                                break;
                            case '5':
                                $reuest_role = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--danger kt-badge--pill">CP Manager</span>';
                                break;
                            case '6':
                                $reuest_role = '<span class="kt-badge  kt-badge--onprogress kt-badge--inline kt-badge--danger kt-badge--pill">CP</span>';
                                break;
                            case '7':
                                $user_role = '<span class="kt-badge  kt-badge--onprogress kt-badge--inline kt-badge--danger kt-badge--pill">BP Manager</span>';
                                break;
                            case '8':
                                $user_role = '<span class="kt-badge  kt-badge--onprogress kt-badge--inline kt-badge--danger kt-badge--pill">BP</span>';
                                break;
                        }
                        $req_status = $reuest->status;
                        switch ($req_status) {
                            case 'open':
                                $req_st = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">Open</span>';
                                break;
                            case 'closed':
                                $req_st = '<span class="kt-badge  kt-badge--assigned kt-badge--inline kt-badge--pill">Closed</span>';
                                break;
                            }

                         ?>

                                            <tr>
                                                <td>{{ $reuest->request_id }}</td>
                                                <td>{!! $reuest_role !!}</td>
                                                <td>{{ $reuest->valid_by }}</td>
                                                <td>{!! $req_st !!}</td>
                                                <td>{{ $reuest->created_by }}</td>
                                                <td data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell">
                                                    <span style="overflow: visible; position: relative; width: 110px;">
                                                        @if(in_array(Auth::user()->role_id, array('1', '2')))
                                                        @if($reuest->role_id != 1)
                                                        <form class="btn-action-delete" action="{{ url('/register-request/delete/') }}/{{ $reuest->id }}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                               <button title="Delete details" class="btn btn-sm btn-danger btn-icon btn-icon-sm" href="{{ url('/register-request/delete/') }}/{{ $reuest->id }}">
                                                            <i class="flaticon2-trash"></i>
                                                               </button>
                                                        </form>
                                                        @endif
                                                        @endif

                                                    </span>
                                                </td>
                                                <td></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                    <!--end: Datatable -->
								</div>
							</div>
							<!--end::Portlet-->
							<!--begin::Modal-->
							<div class="modal fade" id="kt_datatable_records_fetch_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Selected Records</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true"></span>
											</button>
										</div>
										<div class="modal-body">
											<div class="kt-scroll" data-scroll="true" data-height="200">
												<ul id="kt_apps_user_fetch_records_selected"></ul>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>

							<!--end::Modal-->
						</div>

						<!-- end:: Content -->
					</div>

                    <!-- Modal -->
                            <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('register-request-store') }}">
                                            @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">New User Registration Request</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row mt-4">
                                                @if($user->role_id == '1' || $user->role_id =='2')
            <div class="col-md-6">
                <label>Role *</label>
                <select style="width: 100%" class="form-control kt-select2" id="user_role" required name="role_id">
                    <option value="">** </option>
                    <option value="3">DST Manager</option>
                    <option value="4">DST</option>
                    <option value="5">CP Manager</option>
                    <option value="6">CP</option>
                    <option value="7">BP Manager</option>
                    <option value="8">BP</option>
                </select>
            </div>

            <div class="col-md-6 dst_manager_block">
                <label>Select DST Manager *</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_dst_manager" name="dst_manager_id">
                    <option value="">** </option>
                    @foreach($dst_managers as $manager)
                    @php
                    $manager_count = User::where('dst_manager_id', $manager->id)->get()->count();
                    @endphp
                    <option value="{{ $manager->id }}">{{ $manager->name }} -----<span class="kt-badge kt-badge--info  kt-badge--rounded">{{ $manager_count }}</span></option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 cp_manager_block">
                <label>Select CP Manager *</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_cp_manager"  name="cp_manager_id">
                    <option value="">** </option>
                    @foreach($cp_managers as $manager)
                    @php
                    $manager_count = User::where('cp_manager_id', $manager->id)->get()->count();
                    @endphp
                    <option value="{{ $manager->id }}">{{ $manager->name }} -----<span class="kt-badge kt-badge--info  kt-badge--rounded">{{ $manager_count }}</span></option>
                    @endforeach
                </select>
            </div>
            @elseif($user->role_id == '3')
            <input type="hidden" name="role_id" value="4">
            <input type="hidden" name="dst_manager_id" value="{{ $user->id }}">
            @elseif($user->role_id == '5')
            <input type="hidden" name="role_id" value="6">
            <input type="hidden" name="cp_manager_id" value="{{ $user->id }}">
            @endif
                                                <div class="col-md-12 mt-3">
                                                    <label>Valid Till *</label>
                                                    <input type="text" name="valid_till" class="form-control" placeholder="Valid Till Date" id="kt_datepicker_1" readonly>
                                                </div>
                                            </div>
                                               
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="" value="Create Request" class="btn btn-primary">
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

@endsection
@section('footer_js')



        <script type="text/javascript">
            "use strict";

var KTDatatableHtmlTableDemo = function() {
    var demo = function(){
        var datatable = $('.kt-datatable').KTDatatable({
                data: {
                    saveState: {cookie: false},
                    pageSize: 20,
                    },
                search: {
                    input: $('#generalSearch'),
                },
                layout: {
                    scroll: true,
                    height: 3000,
                    footer: false
                },
                sortable: true,
                pagination: true,

                rows: {
                    autoHide: false,
                },
                columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: false,
                    width: 20,
                    type: 'number',
                    selector: false,
                    textAlign: 'center',
                }
                ],
            });

            $('#kt_form_status').on('change', function() {
              datatable.search($(this).val().toLowerCase(), 'Status');
            });

            $('#project_filter').on('change', function() {
              datatable.search($(this).val().toLowerCase(), 'Project');
            });

            $('#task_campaigns').on('change', function() {
              datatable.search($(this).val().toLowerCase(), 'Campaign');
            });

            $('#task_creator').on('change', function() {
              datatable.search($(this).val().toLowerCase(), 'Task Creator');
            });

            $('#creative_owner').on('change', function() {
              datatable.search($(this).val().toLowerCase(), 'Cre Owner');
            });

            $('#kt_form_status,#project_filter,#task_campaigns,#task_creator,#date_duration,#creative_owner').selectpicker();



        };

                return {
                    // Public functions
                    init: function() {
                        // init dmeo
                        demo();
                    },
                };
            }();

            jQuery(document).ready(function() {
                KTDatatableHtmlTableDemo.init();
            }); 
        </script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('.dst_manager_block').hide();
            $('.cp_manager_block').hide();
            $('#user_role').on('change', function(){
                var user_role = $(this).val();
                if(user_role == '4'){
                    $('.dst_manager_block').show();
                }
                else{
                    $('.dst_manager_block').hide();
                }
                if(user_role == '6'){
                    $('.cp_manager_block').show();
                }
                else{
                    $('.cp_manager_block').hide();
                }
            });

        });
    </script>

@endsection