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
                                        All Projects</h3>
<!--                                     <span class="kt-subheader__separator kt-hidden"></span>
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            In House </a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            GoBrand </a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Astra </a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Other Angency </a>
                                    </div> -->
                                </div>
<!--                                 <div class="kt-subheader__toolbar">
                                    <div class="kt-subheader__wrapper">
                                        <a href="#" class="btn kt-subheader__btn-primary">
                                            Actions &nbsp;
                                        </a>
                                        <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="left">
                                            <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__head">
                                                        Add anything or jump to:
                                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                            <span class="kt-nav__link-text">Order</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                            <span class="kt-nav__link-text">Ticket</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
                                                            <span class="kt-nav__link-text">Goal</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                            <span class="kt-nav__link-text">Support Case</span>
                                                            <span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--success">5</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__foot">
                                                        <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
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
                                            Projects
                                            <small>List of Recent Projects</small>
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <div class="dropdown dropdown-inline">
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
                                                </div>
                                                &nbsp;
                                                <a href="{{ route('project_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New Project
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">

                                    <!--begin: Search Form -->
                                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                        <div class="row align-items-center">
                                            <div class="col-xl-8 order-2 order-xl-1">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-input-icon kt-input-icon--left">
                                                            <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                <span><i class="la la-search"></i></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                        <div class="kt-form__group kt-form__group--inline">
                                                            <div class="kt-form__label">
                                                                <label>Status:</label>
                                                            </div>
                                                            <div class="kt-form__control">
                                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                                    <option value="">New</option>
                                                                    <option value="live">Under Construction</option>
                                                                    <option value="pause">Not Started</option>
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
                                <div class="kt-portlet__body kt-portlet__body--fit">

                                    <!--begin: Datatable -->
                                    <table class="kt-datatable" id="html_table" width="100%">
                                        <thead>
                                            <tr>
                                                <!-- <th title="Field #1"><span style="width: 30px;">ID</span></th> -->
                                                <th title="Field #2">Name</th>
                                                <th title="Field #2">Shortcode</th>
                                                <!-- <th title="Field #6">Type</th> -->
                                                <!-- <th title="Field #6">Developer</th> -->
                                                <th title="Field #6">Rera No</th>
                                                <!-- <th title="Field #6">Audience</th> -->
                                                <th title="Field #6">Status</th>
                                                <th title="Field #7">Action</th>
                                                <th title="Field #8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($projects as $campaign)

                                            <tr>
                                                <!-- <td>{{ $campaign->id }}</td> -->
                                                <td>{{ ucfirst($campaign->name) }}</td>
                                                <td>{{ ucfirst($campaign->shortcode) }}</td>
                                                <!-- <td>{{ ucfirst($campaign->project_type) }}</td> -->
                                                <!-- <td>{{ ucfirst($campaign->developer) }}</td> -->
                                                <td>{{ ucfirst($campaign->rera_no) }}</td>
                                                <!-- <td>{{ ucfirst($campaign->target_audience) }}</td> -->
                                                <td>{{ ucfirst($campaign->current_status) }}</td>
                                                <td data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell">
                                                    <span style="overflow: visible; position: relative; width: 110px;">
      
                                                        <a title="View details" class="btn btn-sm btn-info btn-icon btn-icon-sm" href="{{ url('/projects/details/') }}/{{ $campaign->id }}">
                                                            <i class="flaticon-edit"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-danger btn-icon btn-icon-sm" href="{{ url('/projects/delete/') }}/{{ $campaign->id }}">
                                                            <i class="flaticon-delete"></i>
                                                        </a>
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
            "use strict";

var KTDatatableHtmlTableDemo = function() {
    var campaigns_list = function() {

        var datatable = $('.kt-datatable').KTDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#generalSearch'),
            },
            columns: [
             {
                 field: 'ID',
                 type: 'number',
             },
             // {
             //     field: 'OrderDate',
             //     type: 'date',
             //     format: 'YYYY-MM-DD',
             // }, 
             // {
             //     field: 'Status',
             //     title: 'Status',
             //     autoHide: false,
             //     // callback function support for column rendering
             //     template: function(row) {
             //         var status = {
             //             1: {'title': 'live', 'class': 'kt-badge--success'},
             //             2: {'title': 'pause', 'class': 'kt-badge--brand'},
             //         };
             //         return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
             //     }
             // }
            ],
        });

        $('#kt_form_status').on('change', function() {
          datatable.search($(this).val().toLowerCase(), 'Status');
        });

        $('#kt_form_type').on('change', function() {
          datatable.search($(this).val().toLowerCase(), 'Type');
        });

        $('#kt_form_status,#kt_form_type').selectpicker();

    };

    return {
        init: function() {
            campaigns_list();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableHtmlTableDemo.init();
});


        </script>

        <!-- <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js') }}"></script> -->
@endsection