<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add New Campaign </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" ng-submit="createMediaPlan()" ng-controller="addCampCtrl">
<!-- <form class="kt-form" method="post" ng-submit="createMediaPlan()" ng-controller="addCampCtrl" action="{{ route('campaign_store') }}"> -->
    @csrf
    <input type="hidden" name="name" id="campaign_name" />
    <input type="hidden" name="campaign_source_count" id="campaign_source_count" />
    <input type="hidden" name="source_id" id="source_id" />
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Campaign Details
                <span class="camp_name"></span>
            </h3>
        </div>
            <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="#!/index" class="btn btn-warning btn-elevate btn-icon-sm">
                                <i class="flaticon-reply"></i>
                                All Media Plans
                            </a>
                        </div>
                    </div>
                </div>
    </div> 
    <div class="kt-portlet__body" style="padding: 2px;">
        <div class="row media_plan_result dashboard_report">
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Budget</h3>
                                <p class="kt-callout__desc">
                                    <!-- <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ getTotalBudgetCount() }]</span> -->
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ get_budget_amount() }]</span>
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
                                    <span class="lead_count soft_skills_count"><i class="fa fa-rupee-sign"></i>[{ getTotalBudget() }]</span>
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
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ get_total_budget_amount() }]</span>
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
                                    <span class="lead_count product_knowledge_count">[{ getTotalLeadsCount() }]</span>
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
                                    <span class="lead_count lms_update_count">[{ getTotalValidLeads() }]</span>
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
                                    <span class="lead_count lms_update_count">[{ getTotalValidLeadsPer() }]%</span>
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
                                    <span class="lead_count total_score">[{ totalWalkIn() }]</span>
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
                                    <span class="lead_count lms_update_count">[{ totalSales() }]</span>
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
                                <h3 class="kt-callout__title">Cost Per Valid Lead</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> [{ totalCPVL() }]</span>
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
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> [{ totalCPL() }]</span>
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
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> [{ totalCPW() }]</span>
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
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> [{ totalCPS() }]</span>
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
                                    <span class="lead_count total_lead_count">[{ totalSOR() }]%</span>
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
                                    <span class="lead_count soft_skills_count">[{ getAvgVLTW() }]%</span>
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
                                    <span class="lead_count total_lead_count">[{ getAvgWTS() }]%</span>
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
                                    <span class="lead_count product_knowledge_count">[{ totalVLTS() }]%</span>
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
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> [{ totalDailySpend() }]</span>
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
                                    <span class="lead_count lms_update_count">[{ totalDailyLeads() }]</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="form-group row mt-5">
            <div class="col-md-4">
                
            </div>
        </div> -->
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row mt-3">
            <div class="col-md-4">
                <label>Campaign Name</label>
                <input type="text" placeholder="Max 40 Letters" ng-model="plan_name" maxlength="40" class="form-control mt-2" name="name" id="about_camp" value="">
            </div>
            <div class="col-md-2">
                <label>Project</label>
                <select style="width: 100%" class="form-control kt-select2 mt-2" required="" name="project" ng-model="project">
                    <option value=""> --- </option>
                    @foreach($projects as $project)
                    <option value="{{ $project->shortcode }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Month</label>
                <select style="width: 100%" class="form-control kt-select2 mt-2" required="" name="month" ng-model="month">
                    <option value=""> --- </option>
                    {{-- <option value="{{ date('F Y') }}">{{ date('F Y') }}</option> --}}
                    @php $this_month = mktime(0, 0, 0, date('m'), 1, date('Y')); @endphp
                    @for($i = 0; $i < 8; ++$i)
                    <option value="{{ date('F Y', strtotime($i.' month', $this_month)) }}">{{ date('F Y', strtotime($i.' month', $this_month)) }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <label>Budget</label>
                <input type="number" maxlength="40" class="form-control mt-2" ng-model="total_budget_amount" name="budget" id="budget" value="">
            </div>
            <div class="col-md-2">
                <label>Base Price</label>
                <input type="number" maxlength="40" class="form-control mt-2" name="base_price" id="base_price" value="" ng-model="base_price">
            </div>
<!--             <div class="col-md-2">
                <label>Start Date</label>
                <input type="date" placeholder="Max 40 Letters" ng-model="start_date" maxlength="40" class="form-control mt-2" name="start_date" id="start_date" value="">
            </div>
            <div class="col-md-2">
                <label>End Date</label>
                <input type="date" placeholder="Max 40 Letters" ng-model="end_date" maxlength="40" class="form-control mt-2" name="end_date" id="end_date" value="">
            </div> -->
            @php
            $setting = new App\Setting;
            $users  = new App\User;
            @endphp
            <div class="col-md-12 plan_repeators">

            <table class="table table-bordered table-stripped mt-3">
                <thead>
                <tr>
                    <th>
                        <label>Objective</label>
                    </th>
                    <th>
                        <label>Channel/Medium</label>
                    </th>
                    <th>
                        <label>Source</label>
                    </th>
                    <th>
                        <label>Asignee</label>
                    </th>
                    <th>
                        <label>Budget</label>
                    </th>
                    <th>
                        <label>Leads</label>
                    </th>
                    <th>
                        <label>Valid %</label>
                    </th>
                    <th>
                        <label>Valid Leads</label>
                    </th>
                    <th>
                        <label>VLTW %</label>
                    </th>
                    <th>
                        <label>WTS %</label>
                    </th>
                    <th>
                        <label>Walk_In</label>
                    </th>
                    <th>
                        <label>Sales</label>
                    </th>
                    <th>
                        <label>Revenue</label>
                    </th>
                    <th>
                        <label>CPL</label>
                    </th>
                    <th>
                        <label>CPW</label>
                    </th>
                    <th>
                        <label>CPS</label>
                    </th>
                    <th>
                        <label>SOR</label>
                    </th>
                    <th>
                        <label>VLTS</label>
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <tr class="td_with_input" data-ng-repeat="plan in plans">

                                <td>
                                    <select style="width: 100%" class="form-control kt-select2 choose_objective" ng-model="plan.objective" id="objective" required="" name="objective" ng-change="change()">
                                        <option value="">---</option>
                                        <option value="Lead Gen">Lead Gen</option>
                                        <option value="Project Awareness">Project Awareness</option>
                                        <option value="Ranking & Visibility">Ranking & Visibility</option>
                                    </select>
                                </td>
                                <td>
                                    <select style="width: 100%" class="form-control kt-select2 choose_medium" id="category" ng-model="plan.medium" required="" name="camp_channel" ng-change="change()">
                                        <option value="">---</option>
                                        @php 
                                            foreach(config('dtms.source') as $source){
                                                $get_medium[] = $source['medium'];
                                            }
                                            $get_medium = array_unique($get_medium);
                                        @endphp
                                        @foreach($get_medium as $medium)
                                        <option value="{{ $medium }}">{{ $medium }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                        <select style="width: 100%" class="form-control kt-select2 choose_source" ng-model="plan.source" ng-options="data.source for data in sources | filter :{ medium: plan.medium }" required="" ng-change="change()" >
                            <option value="">---</option>
                        </select>
                                </td>
                                <td>
                        <select style="width: 100%" class="form-control kt-select2" required="" ng-model="plan.user" name="camp_user" ng-change="change()">
                            <option value="">---</option>
                            @foreach($users->whereIn('role_id', ['1', '2', '4', '5', '6', '7'])->get() as $camp_user)
                            <option value="{{ $camp_user->id }}">{{ $camp_user->name }}</option>
                            @endforeach
                        </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control change_budget" ng-model="plan.budget" name="" ng-change="change()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" ng-model="plan.leads" name="" ng-change="change()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" ng-model="plan.valid_leads" name="" ng-change="change()">
                                </td>
                                <td>
                                    [{ plan.vleads }]
                                </td>
                                <td>
                                    <input type="number" class="form-control" ng-model="plan.vltw" name="" ng-change="change()">
                                </td>
                                <td>
                                    <input type="number" class="form-control" ng-model="plan.wts" name="" ng-change="change()">
                                </td>
                                <td>
                                    [{ plan.walk_in }]
                                </td>
                                <td>
                                    [{ plan.sales }]
                                </td>
                                <td>
                                    [{ plan.rev }]
                                </td>
                                <td>
                                    [{ plan.cpl }]
                                </td>
                                <td>
                                    [{ plan.cpw }]
                                </td>
                                <td>
                                    [{ plan.cps }]
                                </td>
                                <td>
                                    [{ plan.sor }]
                                </td>
                                <td>
                                    [{ plan.vlts }]
                                </td>
                                <td>
                                    <a href="javascript:;" ng-click="removeChoice(plan.id)" ng-if="plan.id!=index" class="btn repeator-remove btn-icon">
                                        <i class="la la-remove"></i>
                                    </a>
                                </td>
                        
                    </tr>
                    <tr>
                        <td colspan="16">
                        <td colspan="3" class="text-right p-0">
                            <div ng-click="addNewChoice()" class="add_new_media_plan_btn btn btn btn-success">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Add</span>
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="col-md-12 mt-2">
                <label>Description</label>
                <textarea rows="4" placeholder="Enter your Description" class="form-control" ng-model="description" name="description" id="description"></textarea>
            </div>
        </div>
        <div class="form-group row">
        </div>                           
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
            <!-- <button class="btn btn-primary" type="button">Save Media Plan</button> -->
        </div>
    </div>
</div>

</form>

<!--end::Form-->
</div>
</div>
</div>
    <script>


// var app = angular.module('myApp', [], function($interpolateProvider) {
//             $interpolateProvider.startSymbol('[{');
//             $interpolateProvider.endSymbol('}]');
//     });


    </script>