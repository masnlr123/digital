<div ng-controller="MediaPlanIndexController" class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    All Media Plans</h3>
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
                        Media Plans - <span class="month_name"></span>
                        <small>List of Recent Media Plans for <span class="month_name"></span></small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions" style="margin-right: 10px;">
                            

                            <select style="width: 100%; margin: 0!important;" ng-change="changeMonth()" class="form-control kt-select2 mt-2" required="" name="month" ng-model="month">
                                <option value="May 2021" selected>May 2021</option>
                                <option value="June 2021">June 2021</option>
                                <option value="July 2021">July 2021</option>
                                 <option value="August 2021">August 2021</option>
                                 <option value="September 2021">September 2021</option>
                                 <option value="October 2021">October 2021</option>
                                 <option value="November 2021">November 2021</option>
                                 <option value="December 2021">December 2021</option>
                                 <option value="January 2022">January 2022</option>
                                   <option value="February 2022">February 2022</option>
                                     <option value="March 2022">March 2022</option>
{{--                                 @php $months = App\Campaigns::select('month')->distinct()->get(); @endphp
                                @foreach($months as $month)
                                @if($month->month != NULL)
                                <option value="{{ $month->month }}" {{ $month->month == 'May 2021'? 'selected': '' }}>{{ $month->month }}</option>
                                @endif
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="kt-portlet__head-actions">
                            <a href="#!/create" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Media Plans
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="camp_index kt-portlet__body kt-portlet__body--fit">
                <div class="row media_plan_result dashboard_report">
                    <div class="col-sm-4 table-contents pr-0">
                        <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Spend Projection</h3>
                                        <p class="kt-callout__desc">
                                            <!-- <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ getTotalBudgetCount() }]</span> -->
                                            <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ mediaplanTotalBudget() }] </span>
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
                                            <span class="lead_count product_knowledge_count">[{ getTotalLeads() }] </span>
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
                                            <span class="lead_count lms_update_count">[{ mediaplanTotalValidLeads() }] </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pr-0 pl-0">
                        <div class="audit_count_box kt-callout audit_count_11 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Valid Leads %</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count lms_update_count">[{ mediaplanTotalValidLeadsPer() }] %</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pl-0">
                        <div class="audit_count_box kt-callout audit_count_18 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Total Walk-In</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count total_score">[{ mediaplantotalWalkIn() }] </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pr-0">
                        <div class="audit_count_box kt-callout audit_count_12 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Total Sales</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count lms_update_count">[{ mediaplantotalSales() }] </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pr-0 pl-0">
                        <div class="audit_count_box kt-callout audit_count_7 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Sales on Revenue</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count total_lead_count">[{ totalSOR() }] %</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 table-contents pr-0  pl-0">
                        <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Total Revenue</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i>[{ mediaplantotalRevenue() }] </span>
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
                                            <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i>[{ totalCPL() }]  </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pl-0">
                        <div class="audit_count_box kt-callout audit_count_5 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Cost Per Walk-in</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i>[{ totalCPW() }] </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pr-0">
                        <div class="audit_count_box kt-callout audit_count_4 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">Cost Per Sale</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i>[{ totalCPS() }] </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 table-contents pr-0 pl-0">
                        <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                            <div class="kt-portlet__body">
                                <div class="kt-callout__body">
                                    <div class="kt-callout__content">
                                        <h3 class="kt-callout__title">VLTW %</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count soft_skills_count">[{ mediaplanAvgVLTW() }]%</span>
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
                                            <span class="lead_count total_lead_count">[{ mediaplanAvgWTS() }] %</span>
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
                                        <h3 class="kt-callout__title">VLTS %</h3>
                                        <p class="kt-callout__desc">
                                            <span class="lead_count product_knowledge_count">[{ totalVLTS() }] %</span>
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
                                            <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i>[{ totalDailySpend() }] </span>
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
                                            <span class="lead_count lms_update_count">[{ totalDailyLeads() }] </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="camp_index kt-portlet__body kt-portlet__body--fit">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <table class="table table-bordered">
                                <thead class="get_font_size_sm bg-primary bg-gradient text-white">
                                    <th width="140">Name</th>
                                    <th>Project</th>
                                    <th>Spend Projection <i class="fa fa-rupee-sign"></i></th>
                                    <th>Leads</th>
                                    <th>Leads</th>
                                    <th>Valid%</th>
                                    <th>Walk-In</th>
                                    <th>Sales</th>
                                    <th>Revenue <i class="fa fa-rupee-sign"></i></th>
                                    <th>CPL <i class="fa fa-rupee-sign"></i></th>
                                    <th>CPW <i class="fa fa-rupee-sign"></i></th>
                                    <th>CPS <i class="fa fa-rupee-sign"></i></th>
                                    <th>SOR</th>
                                    <th>VLTW</th>
                                    <th>WTS</th>
                                    <th>VLTS</th>
                                    <th><span style="font-size: 9px;display: inherit;">Daily</span> Spend <i class="fa fa-rupee-sign"></i></th>
                                    <th><span style="font-size: 9px;display: inherit;">Daily</span> Leads</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <tr class="media_plan_list_tr" data-ng-repeat="list in media_plan_list">
                                        <td>[{ list.name }]</td>
                                        <td>[{ list.project }]</td>
                                        <td>[{ list.metrix_data.total_spend }]</td>
                                        <td>[{ list.metrix_data.total_leads }]</td>
                                        <td>[{ list.metrix_data.total_valid_leads }]</td>
                                        <td>[{ list.metrix_data.valid_valid_leads_per }]%</td>
                                        <td>[{ list.metrix_data.total_walk_in }]</td>
                                        <td>[{ list.metrix_data.total_sales }]</td>
                                        <td>[{ list.metrix_data.total_rev }]</td>
                                        <td>[{ list.metrix_data.total_cpl }]</td>
                                        <td>[{ list.metrix_data.total_cpw }]</td>
                                        <td>[{ list.metrix_data.total_cps }]</td>
                                        <td>[{ list.metrix_data.total_sor }]%</td>
                                        <td>[{ list.metrix_data.total_vltw }]%</td>
                                        <td>[{ list.metrix_data.total_wts }]%</td>
                                        <td>[{ list.metrix_data.total_vlts | number : 2 }]%</td>
                                        <td>[{ list.metrix_data.total_daily_spend }]</td>
                                        <td>[{ list.metrix_data.total_daily_leads }]</td>
                                        <td>
                                            <a href="{{ url('/') }}/campaigns/details/[{ list.id }]" target="_blank" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-2"> <i class="fas fa-eye"></i></a>
                                            <a href="#!/edit_media_plan/[{ list.id }]" class="btn btn-sm btn-success btn-icon btn-icon-sm kt-mr-2"> <i class="fas fa-edit"></i></a>
                                            <a href="{{ url('/') }}/campaigns/clone_campaign/[{ list.id }]" target="_blank"  class="btn btn-sm btn-primary btn-icon btn-icon-sm kt-mr-2"> <i class="fas fa-clone"></i></a>
                                            <a href="{{ url('/') }}/delete_project_camp/[{ list.id }]" class="btn btn-sm btn-danger btn-icon btn-icon-sm kt-mr-2"> <i class="flaticon2-trash"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div id="top_x_div" style="width:100%;height: 300px;padding: 20px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                        <div class="row">
                            <div class="col-12">
                                 <div id="piechart_3" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                            <div class="col-12">
                                <div id="piechart_4" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div id="piechart_budget" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                        <div class="row">
                            <div class="col-12">
                                <div id="piechart_2" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                            <div class="col-12">
                                 <div id="piechart_1" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>