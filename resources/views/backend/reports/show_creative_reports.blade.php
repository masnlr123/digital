@extends('layouts.app') @section('content')
<div ng-app="" class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container kt-container--fluid">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    All Reports
                </h3>
            </div>
        </div>
    </div>
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('show_creative_report') }}"> <i class="flaticon2-heart-rate-monitor" aria-hidden="true"></i>Show Creative Report </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('get_creative_report') }}?project=agr"> <i class="flaticon2-heart-rate-monitor" aria-hidden="true"></i>Save Creative Report </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_portlet_base_demo_3_3_tab_content" role="tabpanel">
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
                        @endif @if($message = Session::get('warning'))
                        <div class="alert alert-warning fade show" role="alert">
                            <div class="alert-icon"><i class="la la-close"></i></div>
                            <div class="alert-text">{{ $message }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="pt-2 pb-3 creative_index kt-portlet__body kt-portlet__body--fit">
                            <div class="dashboard_block lead_audit_header_2" style="padding: 7px 0px;">
                                @php $range_list = app('request')->input('data_range'); @endphp
                                @if(is_array($range_list))
                                <div class="kt-section__content kt-section__content--solid" style="margin-bottom: 15px;">
                                @foreach($range_list as $range)
                                    <span class="kt-badge kt-badge--primary kt-badge--inline">{{ $range }}</span>
                                @endforeach
                                </div>
                                @else
                                <div class="kt-section__content kt-section__content--solid" style="margin-bottom: 15px;">
                                    <span class="kt-badge kt-badge--primary kt-badge--inline">{{ $range_list }}</span>
                                </div>
                                @endif
                                <form action="{{ route('show_creative_report') }}" method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Project</h5>
                                                <select class="form-control" id="get_project" name="project" ng-model="get_project">
                                                    <option value="">All Project</option>
                                                    @foreach(config('dtms.projects') as $project => $shortcode)
                                                    <option value="{{ $shortcode }}" @if(app('request')->input('project') == $shortcode) selected @endif>{{ $project }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3 data_range_filter">
                                            <h5>Date Range Filter</h5>
                                            <select name="data_range[]" id="get_data_range" class="form-control">
                                                <option value=""></option>
                                                @foreach($data_range_list as $list)
                                                @php $get_data_range_value = str_replace(' - ', '_to_', $list->data_range); @endphp
                                                <option ng-show="get_project =='{{ $list->project }}'" value="{{ $list->data_range }}">{{ $list->data_range }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-success" style="margin-top: 23px; border-radius: 2px;"><i class="fas fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </form>

                                @if(isset($creative_leads))

                                <form method="post" action="{{ route('store_creative_report') }}" id="report-form">
                                    @csrf
                                    <input type="hidden" name="data_range" id="data_range">
                                    <input type="hidden" name="project" value="{{ app('request')->input('project') }}">
                                    <table class="table table-responsive table-inverse table-bordered table-striped mt-4" id="leads_table" style="font-size: 13px;">
                                        <thead>
                                            <tr>
                                                <th></th>

                                                <th colspan="3" class="text-center">Ad Spend & Impression</th>

                                                <th colspan="4" class="text-center">Reach & CTR</th>

                                                <th colspan="6" class="text-center">Leads & Validity</th>

                                                <th colspan="3" class="text-center">Cost</th>

                                                <th colspan="4" class="text-center">Leads Conversion Ratio</th>
                                            </tr>
                                            <tr>
                                                <th>Creative Name</th>
                                                <th class="t-yellow text-center">Spend</th>
                                                <th class="t-yellow text-center">Impression</th>
                                                <th class="t-yellow text-center">CPM</th>
                                                <th class="t-lightash text-center">Reach</th>
                                                <th class="t-lightash text-center">Frequency</th>
                                                <th class="t-lightash text-center">Clicks</th>
                                                <th class="t-lightash text-center">CTR</th>
                                                <th class="t-lightgreen text-center">FB Leads</th>
                                                <th class="t-lightgreen text-center">LMS Leads</th>
                                                <th class="t-lightgreen text-center">Diff</th>
                                                <th class="t-lightgreen text-center">Valid</th>
                                                <th class="t-lightgreen text-center">Valid %</th>
                                                <th class="t-lightgreen text-center">Walk-in</th>
                                                <th class="t-orange text-center">CPL</th>
                                                <th class="t-orange text-center">CPVL</th>
                                                <th class="t-orange text-center">CPW</th>
                                                <th class="t-blue text-center">Reach to Leads %</th>
                                                <th class="t-blue text-center">Imp to Leads %</th>
                                                <th class="t-blue text-center">Clicks to Leads %</th>
                                                <th class="t-blue text-center">VLTW%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $index_inc = 0; @endphp
                                            @foreach($creative_leads as $creatives)
                                            <tr class="tableRow">
                                                <td>
                                                    {{ $creatives->creative }}
                                                </td>
                                                <td>
                                                    {{ $creatives->spend }}
                                                </td>
                                                <td>
                                                    {{ $creatives->impression }}
                                                </td>
                                                <td>
                                                    {{ $creatives->cpm }}
                                                </td>
                                                <td>
                                                    {{ $creatives->reach }}
                                                </td>
                                                <td>
                                                    {{ $creatives->frequency }}
                                                </td>
                                                <td>
                                                    {{ $creatives->clicks }}
                                                </td>
                                                <td>
                                                    {{ $creatives->ctr }}
                                                </td>
                                                <td>
                                                    {{ $creatives->fb_leads }}
                                                </td>
                                                <td>
                                                    {{ $creatives->lms_fb_leads }}
                                                </td>
                                                <td>
                                                    {{ $creatives->leads_diff }}
                                                </td>
                                                <td>
                                                    {{ $creatives->valid_leads }}
                                                </td>
                                                <td>
                                                    {{ $creatives->valid_leads_per }}
                                                </td>
                                                <td>
                                                    {{ $creatives->walk_in }}
                                                </td>
                                                <td>
                                                    {{ $creatives->cpl }}
                                                </td>
                                                <td>
                                                    {{ $creatives->cpvl }}
                                                </td>
                                                <td>
                                                    {{ $creatives->cpw }}
                                                </td>
                                                <td>
                                                    {{ $creatives->reach_to_leads }}
                                                </td>
                                                <td>
                                                    {{ $creatives->lmp_to_leads }}
                                                </td>
                                                <td>
                                                    {{ $creatives->clicks_to_leads }}
                                                </td>
                                                <td>
                                                    {{ $creatives->vltw }}
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>

    @endsection @section('header_css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>

    <style>
        .t-yellow {
            background: #cff3a9;
        }
        .t-lightash {
            background: #ead3d3;
        }
        .t-lightgreen {
            background: #ccdeec;
        }
        .t-orange {
            background: #f1e5ba;
        }
        .t-blue {
            background: #efefef;
        }
        .tdwidth {
            width: 70px;
        }
        .bb {
            border: none;
            background: none;
        }
        .table td {
            padding: 4px 2px;
        }
    </style>
    @endsection @section('footer_js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $("#report_table_1").DataTable();
        jQuery(document).ready(function () {
        @if(app('request')->input('from_date'))
        var start = moment("{{ app('request')->input('from_date')}}", "YYYY-MM-DD");
        var end = moment("{{ app('request')->input('to_date')}}", "YYYY-MM-DD");
        $('#data_range').val(start.format("YYYY-MM-DD")+' - '+end.format("YYYY-MM-DD"));
        @else  
        var start = moment().subtract(29, 'days');
        var end = moment();
        $('#data_range').val(start.format("YYYY-MM-DD")+' - '+end.format("YYYY-MM-DD"));
        @endif

            function cb(start, end, label) {
                if (label == "Today") {
                    title = "Today";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "Yesterday") {
                    title = "Yesterday";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "Last 7 Days") {
                    title = "Last 7 Days";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "Last 30 Days") {
                    title = "Last 30 Days";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "This Month") {
                    title = "This Month";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "Last Month") {
                    title = "Last Month";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "Custom Range") {
                    title = "Custom Range";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else if (label == "All Time") {
                    title = "All Time";
                    $("#kt_table_1").DataTable().destroy();
                    from_date = start.format("YYYY-MM-DD");
                    to_date = end.format("YYYY-MM-DD");
                    $("#start_date").val(from_date);
                    $("#end_date").val(to_date);
                    $("#data_range").val(from_date+' - '+to_date);
                } else {
                    title = "Last 30 Days";
                }
                $("#reportrange span").html(start.format("MM/D/YYYY") + " - " + end.format("MM/D/YYYY"));
                $("#reportrange span.reportrange_lable").html(title);
            }

            $("#reportrange").daterangepicker(
                {
                    startDate: start,
                    endDate: end,
                    alwaysShowCalendars: true,
                    showDropdowns: true,
                    timePicker: true,
                    autoApply: true,
                    ranges: {
                        Today: [moment(), moment()],
                        Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                        "Last 7 Days": [moment().subtract(6, "days"), moment()],
                        "Last 15 Days": [moment().subtract(14, "days"), moment()],
                        "Last 30 Days": [moment().subtract(29, "days"), moment()],
                        "This Month": [moment().startOf("month"), moment().endOf("month")],
                        "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                        "All Time": ["01/01/2020", moment()],
                    },
                },
                cb
            );
            cb(start, end);
            // $('#get_data_range').select2();
            // $('#data_range_filter').hide();
            // $('#get_project').change(function(event) {
            //     $('#get_data_range').children().remove();
            //     $.ajax({
            //         url: '{{ route('get_data_range_list') }}',
            //         type: 'GET',
            //         data: {project: $(this).val()},
            //         success: function(response){
            //             $('#data_range_filter').show();
            //             $.each(response, function(index, val) {
            //                  $('#get_data_range').append('<option value='+val.data_range+'>'+val.data_range+'</option>');
            //             });
            //         }
            //     })
                
            // });
        });
    </script>
    @endsection
</div>
