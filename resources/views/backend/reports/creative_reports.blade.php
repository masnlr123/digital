@extends('layouts.app') @section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
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
                            <a class="nav-link " href="{{ route('show_creative_report') }}"> <i class="flaticon2-heart-rate-monitor" aria-hidden="true"></i>Show Creative Report </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('get_creative_report') }}?project=agr"> <i class="flaticon2-heart-rate-monitor" aria-hidden="true"></i>Save Creative Report </a>
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
                                <form action="{{ route('get_creative_report') }}" method="get">
                                    @csrf
                                    <input type="hidden" id="start_date" name="from_date" />
                                    <input type="hidden" id="end_date" name="to_date" />
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Date Range Filter</h5>
                                            <div id="reportrange" class="custom_date_range">
                                                <i class="fa fa-calendar"></i>&nbsp; <strong><span class="reportrange_lable"></span></strong> <span class="date"></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Project</h5>
                                                <select class="form-control" id="project" name="project">
                                                    <option value="">All Project</option>
                                                    @foreach(config('dtms.projects') as $project => $shortcode)
                                                    <option value="{{ $shortcode }}" @if(app('request')->input('project') == $shortcode) selected @endif>{{ $project }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{--
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Source</h5>
                                                <select class="form-control" id="filter_campaign">
                                                    <option value="">All Source</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Google">Google</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="filter_selecct kt-portlet__head-actions mr-3">
                                                <h5>Lead Type</h5>
                                                <select class="form-control" id="filter_department">
                                                    <option value="">Valid Leads</option>
                                                    <option value="">Invalid Leads</option>
                                                </select>
                                            </div>
                                        </div>
                                        --}}
                                        <div class="col-2">
                                            <button class="btn btn-success" style="margin-top: 23px; border-radius: 2px;"><i class="fas fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                </form>
                                {{-- @foreach(json_decode($get_leads) as $lead)
                                @if($lead->ad_name == '')
                                    <a href="https://run.leadsquared.com/LeadManagement/LeadDetails?LeadID={{ $lead->lead_id }}" target="_blank">{{ $lead->name }}</a><br>
                                @endif
                                @endforeach --}}
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

                                                <th colspan="2" class="text-center">Leads Conversion Ratio</th>
                                            </tr>
                                            <tr>
                                                <th>Creative Name</th>
                                                <th>Adset Name</th>
                                                <th class="t-yellow text-center">Spend</th>
                                                <th class="t-yellow text-center">Impression</th>
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
                                                <th class="t-blue text-center">Clicks to Leads %</th>
                                                <th class="t-blue text-center">VLTW%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $index_inc = 0; @endphp
                                            @foreach($creative_leads as $creatives) 
                                            @php
                                            $index_inc++;
                                            $total_leads = 0; 
                                            $total_valid_leads = 0; 
                                            $total_site_visit = 0; 
                                            $total_booking = 0; 
                                            $total_cpm = 0; 
                                            foreach(json_decode($get_leads) as $lead){
                                                if($creatives->ad_name == $lead->ad_name){ 
                                                    $total_leads += 1; 
                                                    if($lead->is_valid == true){ 
                                                        $total_valid_leads += 1; 
                                                    }; 
                                                    if($lead->lead_stage == 'Site Visit Done'){ 
                                                        $total_site_visit += 1; 
                                                    };
                                                    if($lead->is_valid == 'Booked'){ 
                                                        $total_booking += 1; 
                                                    }; 
                                                } 
                                            } 
                                            $valid_per = ($total_valid_leads/$total_leads)*100; 
                                            @endphp

                                            <tr class="tableRow">
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][ad_name]" value="{{ $creatives->ad_name }}">
                                                    {{ $creatives->ad_name }}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][adset_name]" value="{{ $creatives->ad_set }}">
                                                    {{ $creatives->ad_set }}
                                                </td>
                                                <td>
                                                    <input type="number" name="report[{{ $index_inc }}][spend]" class="tdwidth spend" />
                                                </td>
                                                <td>
                                                    <input type="number" name="report[{{ $index_inc }}][impression]" class="tdwidth impression" />
                                                </td>
                                                <td>
                                                    <input type="number" name="report[{{ $index_inc }}][reach]" class="tdwidth reach" />
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][frequency]" class="tdwidth bb get_frequency" />
                                                    <span class="frequency"></span>
                                                </td>
                                                <td>
                                                    <input type="number" name="report[{{ $index_inc }}][clicks]" class="tdwidth clicks" /></td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][ctr]" class="tdwidth bb get_ctr" />
                                                    <span class="ctr"></span>
                                                </td>
                                                <td>
                                                    <input type="number" name="report[{{ $index_inc }}][fb_leads]" class="tdwidth fb_leads" /></td>

                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][lms_leads]" class="tdwidth bb lms_leads" value="{{ $total_leads }}" />{{ $total_leads }}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][diff]" class="get_diff" />
                                                    <span class="diff"></span></td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][valid_leads]" class="tdwidth bb valid_leads" value="{{ $total_valid_leads }}" />{{ $total_valid_leads }}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][valid_per]" class="tdwidth bb valid_per" value="{{ round($valid_per) }}" />{{ round($valid_per) }}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][walk_in]" class="tdwidth bb walk_in" value="{{ $total_site_visit }}" />{{ $total_site_visit }}
                                                </td>

                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][cpl]" class="tdwidth bb get_cpl" />
                                                    <span class="cpl"></span>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][cpvl]" class="tdwidth bb get_cpvl" />
                                                    <span class="cpvl"></span>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][cpw]" class="tdwidth bb get_cpw" />
                                                    <span class="cpw"></span>
                                                </td>
                                                
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][clicks_to]" class="tdwidth bb get_clicks_to" />
                                                    <span class="clicks_to"></span>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="report[{{ $index_inc }}][vltw]" class="tdwidth bb get_vltw" />
                                                    <span class="vltw"></span>
                                                </td>
                                            </tr>

                                            @endforeach
                                            <tr>
                                                <td colspan="17"></td>
                                                <td><input class="btn btn-secondary" type="reset" value="Reset" /></td>
                                                <td><input class="btn btn-primary" id="submit_creative_report" type="submit" value="Submit" /></td>
                                            </tr>
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

            // var start = moment('{{ $from_date }}').format('DD/MM/YYYY');
            // var end = moment('{{ $to_date }}').format('DD/MM/YYYY');

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
            $("table").on("change", "input", function () {
                var row = $(this).closest("tr");
                var spend = parseFloat(row.find(".spend").val());
                var impression = parseFloat(row.find(".impression").val());
                var cpm = 1000 * (spend / impression);
                if(cpm == "Infinity"){
                    cpm = 0;
                }
                row.find(".cpm").text(isNaN(cpm) ? "" : cpm.toFixed(2));
                row.find(".get_cpm").val(isNaN(cpm) ? "" : cpm.toFixed(2));

                var reach = parseFloat(row.find(".reach").val());
                var frequency = impression / reach;
                if(frequency == "Infinity"){
                    frequency = 0;
                }
                row.find(".frequency").text(isNaN(frequency) ? "" : frequency.toFixed(2));
                row.find(".get_frequency").val(isNaN(frequency) ? "" : frequency.toFixed(2));

                var clicks = parseFloat(row.find(".clicks").val());
                var ctr = clicks / impression;
                if(ctr == "Infinity"){
                    ctr = 0;
                }
                row.find(".ctr").text(isNaN(ctr) ? "" : ctr.toFixed(2));
                row.find(".get_ctr").val(isNaN(ctr) ? "" : ctr.toFixed(2));

                var fb_leads = parseFloat(row.find(".fb_leads").val());
                var lms_leads = parseFloat(row.find(".lms_leads").val());
                var diff = fb_leads - lms_leads;
                row.find(".diff").text(isNaN(diff) ? "" : diff);
                row.find(".get_diff").val(isNaN(diff) ? "" : diff);

                var cpl = spend / lms_leads;
                 if(cpl == "Infinity"){
                    cpl = 0;
                }
                row.find(".cpl").text(isNaN(cpl) ? "" : cpl.toFixed(2));
                row.find(".get_cpl").val(isNaN(cpl) ? "" : cpl.toFixed(2));

                var valid_leads = parseFloat(row.find(".valid_leads").val());
                var cpvl = spend / valid_leads;
                if(cpvl == "Infinity"){
                    cpvl = 0;
                }
                row.find(".cpvl").text(isNaN(cpvl) ? "" : cpvl.toFixed(2));
                row.find(".get_cpvl").val(isNaN(cpvl) ? "" : cpvl.toFixed(2));

                var walk_in = parseFloat(row.find(".walk_in").val());
                var cpw = spend / walk_in;
                if(cpw == "Infinity"){
                    cpw = 0;
                }
                row.find(".cpw").text(isNaN(cpw) ? "" : cpw.toFixed(2));
                row.find(".get_cpw").val(isNaN(cpw) ? "" : cpw.toFixed(2));

                var reach_to = (fb_leads + lms_leads) / reach;
                if(reach_to == "Infinity"){
                    reach_to = 0;
                }
                row.find(".reach_to").text(isNaN(reach_to) ? "" : reach_to.toFixed(2));
                row.find(".get_reach_to").val(isNaN(reach_to) ? "" : reach_to.toFixed(2));

                var imp_to = (fb_leads + lms_leads) / impression;
                if(imp_to == "Infinity"){
                    imp_to = 0;
                }
                row.find(".imp_to").text(isNaN(imp_to) ? "" : imp_to.toFixed(2));
                row.find(".get_imp_to").val(isNaN(imp_to) ? "" : imp_to.toFixed(2));

                var clicks_to = (fb_leads + lms_leads) / clicks;
                if(clicks_to == "Infinity"){
                    clicks_to = 0;
                }
                row.find(".clicks_to").text(isNaN(clicks_to) ? "" : clicks_to.toFixed(2));
                row.find(".get_clicks_to").val(isNaN(clicks_to) ? "" : clicks_to.toFixed(2));

                var vltw = valid_leads / (fb_leads + lms_leads);
                if(vltw == "Infinity"){
                    vltw = 0;
                }
                row.find(".vltw").text(isNaN(vltw) ? "" : vltw.toFixed(2));
                row.find(".get_vltw").val(isNaN(vltw) ? "" : vltw.toFixed(2));
            });
            // $('#report-form').submit(function(e){
            //     e.preventDefault();
            //     console.log($('#report-form').serializeArray());
            // });

            // $("form").on("submit", function(e){
            //     e.preventDefault();
            //     var tableData = new Array();
            //     $("#leads_table")
            //         .find(".tableRow")
            //         .each(function (){
            //             var tableRow = {};
            //             var jRow = $(this);
            //             tableRow.ad_name = jRow.find(".ad_name").val();
            //             tableRow.spend = jRow.find(".spend").val();
            //             tableRow.impression = jRow.find(".impression").val();
            //             tableRow.cpm = jRow.find(".cpm").val();
            //             tableRow.reach = jRow.find(".reach").val();
            //             tableRow.frequency = jRow.find(".frequency").val();
            //             tableRow.clicks = jRow.find(".clicks").val();
            //             tableRow.ctr = jRow.find(".ctr").val();
            //             tableRow.fb_leads = jRow.find(".fb_leads").val();
            //             tableRow.lms_leads = jRow.find(".lms_leads").val();
            //             tableRow.diff = jRow.find(".diff").val();
            //             tableRow.valid_leads = jRow.find(".valid_leads").val();
            //             tableRow.valid_per = jRow.find(".valid_per").val();
            //             tableRow.walk_in = jRow.find(".walk_in").val();
            //             tableRow.cpl = jRow.find(".cpl").val();
            //             tableRow.cpvl = jRow.find(".cpvl").val();
            //             tableRow.cpw = jRow.find(".cpw").val();
            //             tableRow.reach_to = jRow.find(".reach_to").val();
            //             tableRow.imp_to = jRow.find(".imp_to").val();
            //             tableRow.clicks_to = jRow.find(".clicks_to").val();
            //             tableRow.vltw = jRow.find(".vltw").val();
            //             tableData.push(tableRow);
            //         });
                    
            //     alert(JSON.stringify(tableData));
            // });
        });
    </script>
    @endsection
</div>
