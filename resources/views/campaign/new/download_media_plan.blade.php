<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="">
        <meta charset="utf-8" />
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    </head>
    @php
    $get_metrix = json_decode($campaigns->metrix);
    @endphp
    <body class="kt-container kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                </div>
                <div class="kt-aside-menu-overlay"></div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        <h1>Test Meida Plan</h1>

        <div class="row media_plan_result dashboard_report">
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Budget</h3>
                                <p class="kt-callout__desc">
                                    <!-- <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ getTotalBudgetCount() }]</span> -->
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_budget }} </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_7 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Spend</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count soft_skills_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_spend }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Budget Balance</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>{{ $get_metrix->total_budget_balance }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Leads</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count product_knowledge_count">{{ $get_metrix->total_leads }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_10 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Valid Leads</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->total_valid_leads }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_11 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Valid Leads %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->valid_valid_leads_per }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_18 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Walk-In</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_score">{{ $get_metrix->total_walk_in }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_12 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Sales</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->total_sales }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_2 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Revenue</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_rev }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_3 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Cost Per Lead</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_cpl }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_5 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Cost Per Walk-in</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_cpw }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_4 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Cost Per Sale</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_cps }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_7 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Sales on Revenue</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_lead_count">{{ $get_metrix->total_sor }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">VLTW %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count soft_skills_count">{{ $get_metrix->total_vltw }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">WTS %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_lead_count">{{ $get_metrix->total_wts }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">VLTS %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count product_knowledge_count">{{ $get_metrix->total_vlts }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_11 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Daily Spend</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_daily_spend }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_10 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Daily Leads</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->total_daily_leads }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!--begin::Accordion-->
            <div class="col-12 mt-2 milestones-list accordion accordion-light  accordion-svg-icon" id="accordionExample7">
                
    <table class="table table-bordered media_plan_tabl">
        <thead>
            <tr>
                <th>Source</th>
                <th>Budget</th>
                <th>Leads</th>
                <th>Valid</th>
                <th>Valid%</th>
                <th>Walk-In</th>
                <th>Sales</th>
                <th>Rev</th>
                <th>CPL</th>
                <th>CPW</th>
                <th>CPS</th>
                <th>SOR</th>
                <th>VLTW</th>
                <th>WTS</th>
                <th>VLTS</th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Spend</th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Leads</th>
            </tr>
        </thead>
        <tbody class="get_medium_list_row">
            @php

                foreach(json_decode($campaigns->channels) as $camp){
                    $get_medium[] = $camp->medium;
                }
                $get_medium = array_unique($get_medium);
                $camp_i = 1;

            @endphp
        @foreach($get_medium as $medium)
        @php 
        $camp_i++;

        $camp_get_budget_amount = 0;
        $camp_getTotalBudget = 0;
        $camp_get_total_balance_budget_amount = 0;
        $camp_getTotalLeadsCount = 0;
        $camp_getTotalValidLeads = 0;
        $camp_getTotalValidLeadsPer = 0;
        $camp_totalWalkIn = 0;
        $camp_totalSales = 0;
        $camp_totalRevenue = 0;
        $camp_totalCPL = 0;
        $camp_totalCPW = 0;
        $camp_totalCPS = 0;
        $camp_totalSOR = 0;
        $camp_getAvgVLTW = 0;
        $camp_getAvgWTS = 0;
        $camp_totalVLTS = 0;
        $camp_totalDailySpend = 0;
        $camp_totalDailyLeads = 0;
        $camp_count = 0;
        $inc = 1;

        $get_budget = $camp->budget;
        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $get_walk_in = ($get_valid_leads/100)*$camp->vltw;
        $get_sales = ($get_walk_in/100)*$camp->wts;
        $get_rev = round($campaigns->base_price*$get_sales);


        if($get_valid_leads != 0){
            $get_vlts = $get_sales/$get_valid_leads*100;
            $get_vlts = round($get_vlts, 2);
        }
        else{
            $get_vlts = 0;
        }
        $get_daily_spend = round($get_budget/30);
        $get_daily_leads = round($camp->leads/30);


       foreach(json_decode($campaigns->channels) as $camp){
           if($medium == $camp->medium){

                $camp_count++;
                if(isset($camp->budget)){
                    $camp_get_budget_amount += $camp->budget;
                };
                $camp_getTotalLeadsCount += $camp->leads;
                $camp_getTotalValidLeadsPer += $camp->valid_leads;
                $camp_getAvgVLTW += $camp->vltw;
                $camp_getAvgWTS += $camp->wts;
                $camp_getTotalValidLeads += $camp->vleads;
                $camp_totalWalkIn += $camp->walk_in;
                $camp_totalSales += $camp->sales;
            }
        }

        $camp_getTotalValidLeadsPerNumber = $camp_getTotalValidLeadsPer/$camp_count;
        $camp_getTotalVLTW = round($camp_getAvgVLTW/$camp_count);
        $camp_getTotalWTS = round($camp_getAvgWTS/$camp_count);

        $camp_totalRevenue = $campaigns->base_price*$camp_totalSales;

        $camp_totalCPL = $camp_get_budget_amount/$camp_getTotalLeadsCount;
        $camp_totalWalkIn == 0? 0:$camp_totalCPW = $camp_get_budget_amount/$camp_totalWalkIn;
        $camp_totalSales == 0? 0: $camp_totalCPS = $camp_get_budget_amount/$camp_totalSales;
        $camp_totalRevenue == 0? 0: $camp_totalSOR = round($camp_get_budget_amount/$camp_totalRevenue*100, 2);;
        $camp_totalVLTS = $camp_totalSales/$camp_getTotalValidLeads*100;
        $camp_totalDailySpend = round($camp_get_budget_amount/30);
        $camp_totalDailyLeads = round($camp_getTotalLeadsCount/30);

       @endphp
        <tr class="collapsed" data-toggle="collapse" data-target="#collapseme{{ $camp_i }}" style="background: linear-gradient(45deg, #760c88, #31023e);color: #fff; cursor: pointer;">
            <td>
                <i class="li_icon flaticon2-right-arrow"></i> {{ $medium }}
            </td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp_get_budget_amount) }}</td>
            <td>{{ round($camp_getTotalLeadsCount) }}</td>
            <td>{{ round($camp_getTotalValidLeads) }}</td>
            <td>{{ round($camp_getTotalValidLeadsPerNumber) }}%</td>
            <td>{{ round($camp_totalWalkIn) }}</td>
            <td>{{ $camp_totalSales }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money(round($camp_totalRevenue)) }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money(round($camp_totalCPL)) }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money(round($camp_totalCPW)) }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money(round($camp_totalCPS)) }}</td>
            <td>{{ round($camp_totalSOR) }}%</td>
            <td>{{ round($camp_getTotalVLTW) }}%</td>
            <td>{{ round($camp_getTotalWTS) }}%</td>
            <td>{{ round($camp_totalVLTS) }}%</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp_totalDailySpend) }}</td>
            <td>{{ $camp_totalDailyLeads }}</td>
        </tr>
        @foreach(json_decode($campaigns->channels) as $camp)
        @php
        if(isset($camp->budget)){
            $get_budget = $camp->budget;
        }
        else{
            $get_budget = 0;
        }
        $get_user = App\User::find($camp->user); 
        $get_user = json_decode($get_user);
        $inc++;

        @endphp
        @if($medium == $camp->medium)
        <tr id="collapseme{{ $camp_i }}" class="collapse out" style="">
            <td style="padding-left: 22px;font-weight: 600;">
                @if(!is_object($camp->source))
                {{ $camp->source }}
                @else
                {{ $camp->source->source }}
                @endif
                <span class="source-badge kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">{{ $camp->objective }}</span></td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($get_budget) }}</td>
            <td>{{ $camp->leads }}</td>
            <td>{{ $camp->vleads }}</td>
            <td>{{ $camp->valid_leads }}%</td>
            <td>{{ $camp->walk_in }}</td>
            <td>{{ $camp->sales }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp->rev) }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp->cpl) }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp->cpw) }}</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp->cps) }}</td>
            <td>{{ $camp->sor }}%</td>
            <td>@if($camp->vltw){{ $camp->vltw }}%@endif</td>
            <td>@if($camp->wts){{ $camp->wts }}%@endif</td>
            <td>{{ $camp->vlts }}%</td>
            <td><i class="fa fa-rupee-sign"></i> {{ $campaigns->ind_money($camp->daily_spend) }}</td>
            <td>{{ $camp->daily_leads }}</td>
        </tr>
        @endif
                    @endforeach
            @endforeach
        </tbody>
    </table>
        </div>
        
    </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    </body>
</html>