@extends('layouts.app') @section('content')
@php use App\User; @endphp
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
						<!-- begin:: Content Head -->
						<div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">
										Users
									</h3>
									<span class="kt-subheader__separator kt-subheader__separator--v"></span>
									<div class="kt-subheader__group kt-hidden" id="kt_subheader_group_actions">
										<div class="kt-subheader__desc"><span id="kt_subheader_group_selected_rows"></span> Selected:</div>
										<div class="btn-toolbar kt-margin-l-20">
											<div class="dropdown" id="kt_subheader_group_actions_status_change">
												<button type="button" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
													Update Status
												</button>
												<div class="dropdown-menu">
													<ul class="kt-nav">
														<li class="kt-nav__section kt-nav__section--first">
															<span class="kt-nav__section-text">Change status to:</span>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="1">
																<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--bold">Approved</span></span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="2">
																<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--bold">Rejected</span></span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="3">
																<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-warning kt-badge--inline kt-badge--bold">Pending</span></span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link" data-toggle="status-change" data-status="4">
																<span class="kt-nav__link-text"><span class="kt-badge kt-badge--unified-info kt-badge--inline kt-badge--bold">On Hold</span></span>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<button class="btn btn-label-success btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_fetch" data-toggle="modal" data-target="#kt_datatable_records_fetch_modal">
												Fetch Selected
											</button>
											<button class="btn btn-label-danger btn-bold btn-sm btn-icon-h" id="kt_subheader_group_actions_delete_all">
												Delete All
											</button>
										</div>
									</div>
								</div>
								<div class="kt-subheader__toolbar">
									<a href="#" class="">
									</a>
									<a href="{{ route('new_user') }}" class="btn btn-label-brand btn-bold">
										Add User </a>
                                        
									
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
						<div class="kt-container users_index kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<!--begin::Portlet-->
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__body kt-portlet__body--fit">
 <!--begin: Datatable -->

                                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
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
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')


        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">

        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               pageLength: 50,
               ajax: '{{ route('all_users_datatable') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'contact', name: 'contact' },
                        { data: 'role', orderable: false },
                        { data: 'status', orderable: false },
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
<script type="text/javascript">
$(function() {

     var picker = $('#kt_dashboard_daterangepicker');
        var start = moment();
        var end = moment();
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };
        var current_range = getUrlParameter('range');

        function cb(start, end, label) {
            var title = '';
            var range = '';
            var url = '{{ url('/users') }}'; 
            // var separator = (window.location.href.indexOf("?")===-1)?"?":"&";

            if ((end - start) < 100 || label == 'Today') {
                title = 'Today:';
                range = start.format('YYYY-MM-DD');
                // window.location = location.href += "?range="+range;
                // url += '?range=' + range;
                // window.location.href = url;

            // window.location =  url;
             // window.stop();

            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('YYYY-MM-DD');
            window.location =  url + "?range="+range;
            } else {
                range = start.format('YYYY-MM-DD') + '--' + end.format('YYYY-MM-DD');
            window.location = url + "?range="+range;
            }

                // var separator = (document.location.href.indexOf("?")===-1)?"?":"&";
                // document.location = document.location.href + separator + "range="+range;
            if(current_range == null){
                $('#kt_dashboard_daterangepicker_date').html(range);
                $('#kt_dashboard_daterangepicker_title').html(title);
            }
            else{
                $('#kt_dashboard_daterangepicker_date').html(current_range);
                $('#kt_dashboard_daterangepicker_title').html('Date: ');

            }

            // window.location = window.location.href + separator + "range="+range;
                // location.reload();
               
        }

        picker.daterangepicker({
            direction: KTUtil.isRTL(),
            startDate: start,
            endDate: end,
            opens: 'left',
            ranges: {
                // 'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
});
</script>
@endsection