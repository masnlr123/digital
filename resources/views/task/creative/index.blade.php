<?php 
use App\CreativeImages;
if(Auth::user()->role_id == '9'){
    $creative_task = $gobrand_creative_task;
}
elseif(Auth::user()->role_id == '10'){
    $creative_task = $astra_creative_task;
}
else{
    $creative_task = $all_creative_task;
}
?>
@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        Creative Task List </h3>
                                         @if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8')))
                                    <!-- <span class="kt-subheader__separator kt-hidden"></span> -->
                                    @endif
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
                                            Creative Task
                                            <small>List of Recent Creative task</small>
                                        </h3>
                                    </div>

                                    <div class="col-md-6 kt-margin-b-20-tablet-and-mobile mt-3">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">

                                                <!-- <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la la-download"></i> Export
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__section kt-nav__section--first">
                                                                <span class="kt-nav__section-text">Choose an option</span>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                                    <span class="kt-nav__link-text">Print</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                                    <span class="kt-nav__link-text">Copy</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                                    <span class="kt-nav__link-text">Excel</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                    <span class="kt-nav__link-text">CSV</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                    <span class="kt-nav__link-text">PDF</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> -->
                                                &nbsp;
                                                <a href="{{ route('task_creative_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    Create New Task
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
                                <div class="kt-portlet__body">
                                    <!--begin: Search Form -->
                                    <div class="kt-form kt-form--label-right kt-margin-t-10">
                                        <div class="row align-items-center">
                                            <div class="col-xl-8 order-2 order-xl-1">
                                                <div class="row align-items-center">


                                                    <div class="kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-form__group kt-form__group--inline">
                                                            <div class="kt-form__control">
                                                                <select class="form-control bootstrap-select" id="project_filter">
                                                                    <option value="">Choolse Project</option>
                                                                     @foreach($projects as $project)
                    <option value="{{ $project->shortcode }}">{{ $project->name }}</option>
                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-form__group kt-form__group--inline">
                                                            <div class="kt-form__control">
                                                                <select class="form-control bootstrap-select" id="task_campaigns">
                                                                    <option value="">Choose Campaigns</option>
                                                                    @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->name }}"  data-count="{{ $campaign->creative_count }}" data-id="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-form__group kt-form__group--inline">
                                                            <div class="kt-form__control">
                                                                <select class="form-control bootstrap-select" id="task_creator">
                                                                    <option value="">Choose Creator</option>
                                                                     @foreach($users as $creator)
                    <option value="{{ $creator->name }}" data-id="{{ $creator->id }}">{{ $creator->name }}</option>
                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-form__group kt-form__group--inline">
                                                            <div class="kt-form__control">
                                                                <select class="form-control bootstrap-select" id="creative_owner">
                                                                    <option value="">Choose Creative Owner</option>
                                                                     @foreach($creative_users as $creator)
                    <option value="{{ $creator->name }}" data-id="{{ $creator->id }}">{{ $creator->name }}</option>
                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-form__group kt-form__group--inline">
                                                            <div class="kt-form__control">
                                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                                    <option value="">Choose Staus</option>

                    <option value=""> --- </option>
                    <option value="new">New</option>
                    <option value="new_needed">New - Correction Needed</option>
                    <option value="new_updated">New - Correction Updated</option>
                    <option value="assigned">Assigned</option>
                    <option value="processed">On Progress</option>
                    <option value="process_transfer">Progress Transfer</option>
                    <option value="review">Review</option>
                    <option value="internal_review">Internal Review</option>
                    <option value="external_review">External Review</option>
                    <option value="completed">Completed</option>
                    <option value="on_hold">On Hold</option>
                    <option value="discard">Discard</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                                <a href="#" class="btn btn-default kt-hidden">
                                                    <i class="la la-cart-plus"></i> New Order
                                                </a>
                                                <!-- <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div> -->
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Search Form -->
                                </div>
                                <div class="creative_index kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <table class="kt-datatable" id="html_table" width="100%">
                                        <thead>
                                            <tr>
                                                <th title="Field #1">#</th>
                                                <th title="Field #1">Thumb</th>
                                                <th title="Field #2">Project</th>
                                                <th title="Field #3">Campaign</th>
                                                <th title="Field #4">Tasks</th>
                                                <th title="Field #5">Task Creator</th>
                                                <th title="Field #7">Cre Owner</th>
                                                <th title="Field #8">Status</th>
                                                <th title="Field #9">Action</th>
                                                <th title="Field #10"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($creative_task as $task)

                        <?php 
                        $test_creatives = CreativeImages::where('creative_id', $task->id)->get();
                        $creative_status = $task->status;
                        switch ($creative_status) {
                            case 'new':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                                break;
                            case 'new_needed':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-needed kt-badge--inline kt-badge--pill">New - Correction Needed</span>';
                                break;
                            case 'new_updated':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--new-correction-updated kt-badge--inline kt-badge--pill">New - Correction Updated</span>';
                                break;
                            case 'assigned':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--assigned kt-badge--inline kt-badge--pill">Assigned</span>';
                                break;
                            case 'processed':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--onprogress kt-badge--inline kt-badge--pill">On Process</span>';
                                break;
                            case 'process_transfer':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--progress-transfer kt-badge--danger kt-badge--pill">Process Transfer</span>';
                                break;
                            case 'internal_review':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--internal-review kt-badge--inline kt-badge--pill">Internal Review</span>';
                                break;
                            case 'review':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill">Review</span>';
                                break;
                            case 'external_review':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--external-review kt-badge--inline kt-badge--pill">External Review</span>';
                                break;
                            case 'completed':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                                break;
                            case 'completed':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--completed kt-badge--inline kt-badge--pill">Completed</span>';
                                break;
                            case 'on_hold':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--onhold kt-badge--inline kt-badge--pill">On Hold</span>';
                                break;
                            
                            case 'discard':
                                $creative_status_tag = '<span class="kt-badge  kt-badge--discard kt-badge--inline kt-badge--pill">Discard</span>';
                                break;
                            
                            default:
                                $creative_status_tag = '<span class="kt-badge kt-badge--new kt-badge--inline kt-badge--pill">New</span>';
                                break;
                        }
                         ?>

                                            <tr>
                                                <td>{{ $task->id }}</td>
                                                <td><img class="creative_placeholder" src="{{ asset('assets/images/creative_placeholder.jpg') }}" alt="Creative placeholder" /></td>
                                                <td>{{ ucfirst($task->project) }}</td>
                                                <td>{{ ucfirst($task->campaign) }}</td>
                                                <?php $tasks = explode(',' , $task->creative_type); ?>
                                                <td>
                                                    @foreach($tasks as $ntask)
                                                    <span>{{ $ntask }} | </span>
                                                    @endforeach
                                                </td>
                                                <td>{{ ucfirst($task->created_by) }}</td>

                                                @if($task->process_transfer_to)
                                                <td>{{ ucfirst($task->task_for) }} - {{ $task->process_transfer_to }}</td>
                                                @elseif($task->processed_by)
                                                <td>{{ ucfirst($task->task_for) }} - {{ $task->processed_by }}</td>
                                                @elseif($task->assigned_to)
                                                <td>{{ ucfirst($task->task_for) }} - {{ $task->assigned_to }}</td>
                                                @else
                                                <td>{{ ucfirst($task->task_for) }}</td>
                                                @endif
                                                <td>{!! $creative_status_tag !!}</td>
                                                <td data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell">
                                                    <span style="overflow: visible; position: relative; width: 110px;">
@if(!$test_creatives->isEmpty())
@if($task->status =='internal_review' || $task->status =='review' || $task->status =='external_review')
<a title="Click to View" class="btn btn-sm btn-view btn-icon btn-icon-sm" href="{{ url('/task/creative/view/') }}/{{ $task->id }}" target="_blank"><i class="fa fa-eye" style="color: #fff;"></i></a>

@if($current_user->role_id == '1' || $current_user->role_id == '2' || $current_user->role_id == '3' )
<a title="Click to Approval" class="btn btn-sm btn-primary btn-icon btn-icon-sm" href="{{ url('/task/creative/approval/') }}/{{ $task->id }}"><i class="flaticon2-checkmark" style="color: #fff;"></i></a>
@endif
@endif
@endif
                                                        <a title="Edit details" class="btn btn-sm btn-info btn-icon btn-icon-sm" href="{{ url('/task/creative/edit/') }}/{{ $task->id }}">
                                                            <i class="flaticon-edit"></i>
                                                        </a>
                                                        @if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8')))
                                                        <form action="{{ url('/task/creative/delete/') }}/{{ $task->id }}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                               <button title="Delete details" class="btn btn-sm btn-danger btn-icon btn-icon-sm" href="{{ url('/task/creative/delete/') }}/{{ $task->id }}">
                                                            <i class="flaticon2-trash"></i>
                                                               </button>
                                                        </form>
                                                        <!-- <a title="Delete details" class="btn btn-sm btn-danger btn-icon btn-icon-sm" href="{{ url('/task/creative/delete/') }}/{{ $task->id }}">
                                                            <i class="flaticon2-trash"></i>
                                                        </a> -->
                                                        @endif
                                                        <!-- <a title="Delete" class="btn btn-sm btn-danger btn-icon btn-icon-sm">
                                                            <i class="flaticon2-trash"></i>
                                                        </a> -->

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
                        </div>

                        <!-- end:: Content -->
                    </div>
@endsection
@section('footer_js')


        <script type="text/javascript">
            "use strict";
// Class definition

var KTDatatableHtmlTableDemo = function() {
    // Private functions

    // demo initializer
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
                // columns: [
                //  {
                //      field: 'DepositPaid',
                //      type: 'number',
                //  },
                //  {
                //      field: 'OrderDate',
                //      type: 'date',
                //      format: 'YYYY-MM-DD',
                //  }, {
                //      field: 'Status',
                //      title: 'Status',
                //      autoHide: false,
                //      // callback function support for column rendering
                //      template: function(row) {
                //          var status = {
                //              1: {'title': 'Pending', 'class': 'kt-badge--brand'},
                //              2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
                //              3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
                //              4: {'title': 'Success', 'class': ' kt-badge--success'},
                //              5: {'title': 'Info', 'class': ' kt-badge--info'},
                //              6: {'title': 'Danger', 'class': ' kt-badge--danger'},
                //              7: {'title': 'Warning', 'class': ' kt-badge--warning'},
                //          };
                //          return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
                //      },
                //  }, {
                //      field: 'Type',
                //      title: 'Type',
                //      autoHide: false,
                //      // callback function support for column rendering
                //      template: function(row) {
                //          var status = {
                //              1: {'title': 'Online', 'state': 'danger'},
                //              2: {'title': 'Retail', 'state': 'primary'},
                //              3: {'title': 'Direct', 'state': 'success'},
                //          };
                //          return '<span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +status[row.Type].state + '">' + status[row.Type].title + '</span>';
                //      },
                //  },
                // ],
            });
            // $('#kt_form_status').on('change', function() {
            //   datatable.search($(this).val().toLowerCase(), 'Status');
            // });
            // $('#project_filter').on('change', function(){
            //   datatable.search($(this).val().toLowerCase(), 'Project');
            // });
            // $('#kt_form_status,#kt_form_status2,#project_filter').selectpicker();

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
@endsection