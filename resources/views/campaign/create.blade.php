@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add New Campaign </h3>
        </div>
    </div>
</div>
<div ng-app="media-plan-starter" class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
                                <h3 class="kt-callout__title">Total Revenue</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> [{ totalRevenue() }]</span>
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
                    <option value="{{ date('F Y') }}">{{ date('F Y') }}</option>
                    @for($i = 1; $i < 6; $i++)
                    <option value="{{ date('F Y', strtotime("$i month")) }}">{{ date('F Y', strtotime("$i month")) }}</option>
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
            <hr>
                <div class="form-group row mt-4 mb-1">
                    <div class="col-lg-12">
                        <div class="row repeat_block">
                            <div class="col-lg-1">
                                <label>Objective</label>
                            </div>
                            <div class="col-lg-2">
                                <label>Channel/Medium</label>
                            </div>
                            <div class="col-lg-1">
                                <label>Source</label>
                            </div>
                            <div class="col-lg-1">
                                <label>Asignee</label>
                            </div>
                            <div class="col-lg-2">
                                <label>Budget</label>
                            </div>
                            <div class="col-lg-1">
                                <label>Leads</label>
                            </div>
                            <div class="col-lg-1">
                                <label>Valid %</label>
                            </div>
                            <div class="col-lg-1">
                                <label>VLTW %</label>
                            </div>
                            <div class="col-lg-1">
                                <label>WTS %</label>
                            </div>
                            <div class="col-lg-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 plan_repeators">
                <div data-ng-repeat="plan in plans">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <div class="row repeat_block">
                                <div class="col-lg-1">
                                    <select style="width: 100%" class="form-control kt-select2 choose_objective" ng-model="plan.objective" id="objective" required="" name="objective">
                                        <option value="">---</option>
                                        <option value="Lead Gen">Lead Gen</option>
                                        <option value="Project Awareness">Project Awareness</option>
                                        <option value="Ranking & Visibility">Ranking & Visibility</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <select style="width: 100%" class="form-control kt-select2 choose_medium" id="category" ng-model="plan.medium" required="" name="camp_channel">
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
                                </div>
                                <div class="col-lg-1">
                        <select style="width: 100%" class="form-control kt-select2 choose_source" id="subcategory" ng-model="plan.source" required="" name="camp_source" ng-options="source.source for source in sources | filter :{ medium: plan.medium }">
                            <option value="">---</option>
                        </select>
                                </div>
                                <div class="col-lg-1">
                        <select style="width: 100%" class="form-control kt-select2" required="" ng-model="plan.user" name="camp_user">
                            <option value="">---</option>
                            @foreach($users->whereIn('role_id', ['1', '2', '4', '5', '6', '7'])->get() as $camp_user)
                            <option value="{{ $camp_user->id }}">{{ $camp_user->name }}</option>
                            @endforeach
                        </select>
                                </div>
                                <div class="col-lg-2">
                                    <input type="number" class="form-control change_budget" ng-model="plan.budget" name="">
                                </div>
                                <div class="col-lg-1">
                                    <input type="number" class="form-control" ng-model="plan.leads" name="">
                                </div>
                                <div class="col-lg-1">
                                    <input type="number" class="form-control" ng-model="plan.valid_leads" name="">
                                </div>
                                <div class="col-lg-1">
                                    <input type="number" class="form-control" ng-model="plan.vltw" name="">
                                </div>
                                <div class="col-lg-1">
                                    <input type="number" class="form-control" ng-model="plan.wts" name="">
                                </div>
                                <div class="col-lg-1">
                                    <a href="javascript:;" ng-click="removeChoice(choice.id)" ng-if="choice.id!=index" class="btn repeator-remove btn-icon">
                                        <i class="la la-remove"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">   
                    <div class="col text-right">
                        <div ng-click="addNewChoice()" class="btn btn btn-success">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Add</span>
                            </span>
                        </div>
                    </div>
                </div>

            <hr>
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
            <button class="btn btn-primary" type="button">Save Media Plan</button>
        </div>
    </div>
</div>

</form>

<!--end::Form-->
</div>
</div>
</div>
<!--end::Portlet-->
@endsection
@section('header_css')
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer_js')
    <script>


var app = angular.module('media-plan-starter', [], function($interpolateProvider) {
            $interpolateProvider.startSymbol('[{');
            $interpolateProvider.endSymbol('}]');
    });

    app.controller('addCampCtrl', function($scope, $http) {
    $scope.selectOptions = [
    "Mobile",
                            "Office",
                            "Home"     
    ];

    $scope.plans = [
        {
            "id": 1,
            "objective":"",
            "medium":"",
            "source":"",
            "user":"",
            "budget":"",
            "leads":"",
            "valid_leads":"",
            "vltw":"",
            "wts":"",
            "valid_leads_count":"",
            "walk_in":"",
            "sales":"",
            "rev":"",
            "cpl":"",
            "cpw":"",
            "cps":"",
            "sor":"",
            "vlts":"",
            "daily_spend":"",
            "daily_leads":"",
        }
    ];

    $scope.sources = [
    @foreach(config('dtms.source') as $source)
    {medium: '{{ $source['medium'] }}', source: '{{ $source['source'] }}'},
    @endforeach
    ]
    // for(var pi = 0; pi < $scope.plans.length; pi++){
    //     $scope.$watch('plans[' + pi + ']', function (newValue, oldValue) {
    //         newValue.valid_leads_count = (newValue.valid_leads/100) * newValue.valid_leads;
    //         newValue.walk_in = (newValue.valid_leads_count/100)*newValue.vltw;
    //         newValue.sales = (newValue.walk_in/100)*newValue.wts;
    //         newValue.rev = newValue.sales*base_price;
    //         newValue.cpl = newValue.budget/newValue.leads;
    //         newValue.cpw = newValue.budget/newValue.leads;
    //         newValue.cps = newValue.budget/newValue.walk_in;
    //         newValue.sor = newValue.budget/newValue.rev*100;
    //         newValue.vlts = newValue.sales/newValue.valid_leads_count;
    //         newValue.daily_spend = newValue.budget/30;
    //         newValue.daily_leads = newValue.leads/30;
    //         newValue.get_user = $scope.plan_name;
    //         console.log(newValue.leads + ":::" + oldValue.leads);
    //     }, true);
    // }
    $scope.$watchCollection('plans', function(newPlan, oldPlan) {
         // Do anything you want here
        // $scope.uploadImage(newValue);
    });
  
  $scope.getTotalBudgetCount = function(){
        var total_budget = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.budget)){
                total_budget += plan.budget;
            }
        }
        return total_budget;
    }
  $scope.getTotalLeadsCount = function(){
        var total_leads = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.leads)){
                total_leads += plan.leads;
            }
        }
        return total_leads;
    }
  $scope.getTotalValidLeadsPer = function(){
        var total_valid_leads = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.valid_leads)){
                total_valid_leads += plan.valid_leads;
            }
        }
        return Math.round(total_valid_leads/$scope.plans.length);
    }
  $scope.getTotalValidLeadsPerNumber = function(){
        var total_valid_leads = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.valid_leads)){
                total_valid_leads += plan.valid_leads;
            }
        }
        return total_valid_leads/$scope.plans.length;
    }
  $scope.getTotalValidLeads = function(){
        var total_valid_leads_count = 0;
        var valid_leads_per = $scope.getTotalValidLeadsPerNumber();
        var total_leads_count = $scope.getTotalLeadsCount();
        total_valid_leads_count = (valid_leads_per/100) * total_leads_count;
        return Math.round(total_valid_leads_count);

    }
  $scope.getTotalBudget = function(){
        var total_budget = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.budget)){
                total_budget += plan.budget;
            }
        }
        var x=total_budget;
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var total_budget_res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

        return total_budget_res;
    }
  $scope.get_total_budget_amount = function(){
        var x=$scope.total_budget_amount;
        if(x>0){
            x = x - $scope.getTotalBudgetCount();
        }
        else{
            x =0;
        }
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_budget = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return get_total_budget;
  }
  $scope.get_budget_amount = function(){
        var x=$scope.total_budget_amount;
        if(x>0){
            x = x;
        }
        else{
            x =0;
        }
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_budget = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;

        return get_total_budget;
  }

  $scope.getAvgVLTW = function(){
        var total_valid_vltw = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.vltw)){
                total_valid_vltw += plan.vltw;
            }
        }
        var get_vltw = total_valid_vltw/$scope.plans.length;
        return Math.round(get_vltw*100)/100;
    }
  $scope.getAvgWTS = function(){
        var total_valid_wts = 0;
        for(var i = 0; i < $scope.plans.length; i++){
            var plan = $scope.plans[i];
            if(!isNaN(plan.wts)){
                total_valid_wts += plan.wts;
            }
        }
        var get_wts = total_valid_wts/$scope.plans.length;
        return Math.round(get_wts*100)/100;
    }
  $scope.totalWalkIn = function(){
        var total_walkin = ($scope.getTotalValidLeads()/100)*$scope.getAvgVLTW();
        return Math.round(total_walkin);
    }
  $scope.totalSales = function(){
        var total_sales = ($scope.totalWalkIn()/100)*$scope.getAvgWTS();
        return Math.round(total_sales);
    }
  $scope.totalRevenue = function(){
        var total_revenue = $scope.totalSales()*$scope.base_price;
        if($scope.base_price>0){
            x = Math.round(total_revenue);
        }
        else{
            x = 0;
        }
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_revenue = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return get_total_revenue;
    }
  $scope.totalRevenueNumber = function(){
        var total_revenue = $scope.totalSales()*$scope.base_price;
        if($scope.base_price>0){
            get_total_revenue = Math.round(total_revenue);
        }
        else{
            get_total_revenue = 0;
        }
        return get_total_revenue;
    }
  $scope.totalCPL = function(){
        var total_cpl = 0;
        total_cpl = $scope.getTotalBudgetCount()/$scope.getTotalLeadsCount();
        if(total_cpl>0){
            x = Math.round(total_cpl);
        }
        else{
            x = 0;
        }
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_cpl = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return get_total_cpl;
    }
  $scope.totalCPW = function(){
        var total_cpw = 0;
        total_cpw = $scope.getTotalBudgetCount()/$scope.totalWalkIn();
        if(total_cpw>0){
            x = Math.round(total_cpw);
        }
        else{
            x = 0;
        }
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_cpw = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return get_total_cpw;
    }
  $scope.totalCPS = function(){
        var total_cps = 0;
        total_cps = $scope.getTotalBudgetCount()/$scope.totalSales();
        if(total_cps>0){
            x = Math.round(total_cps);
        }
        else{
            x = 0;
        }
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_cps = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return get_total_cps;
    }
  $scope.totalSOR = function(){
        var total_sor = 0;
        total_sor = $scope.getTotalBudgetCount()/$scope.totalRevenueNumber()*100;
        if(total_sor>0){
            total_sor = total_sor;
        }
        else{
            total_sor = 0;
        }
        //$scope.getTotalBudgetCount()/$scope.totalRevenue();
        return Math.round(total_sor*100)/100;
    }
  $scope.totalVLTS = function(){
        var total_vlts = 0;
        total_vlts = $scope.totalSales()/$scope.getTotalValidLeads()*100;
        if(total_vlts>0){
            total_vlts = total_vlts;
        }
        else{
            total_vlts = 0;
        }
        return Math.round(total_vlts*100)/100;
    }
  $scope.totalDailySpend = function(){
        var total_vlts = $scope.getTotalBudgetCount()/30;
        x = Math.round(total_vlts);
        x=x.toString();
        var lastThree = x.substring(x.length-3);
        var otherNumbers = x.substring(0,x.length-3);
        if(otherNumbers != '')
            lastThree = ',' + lastThree;
        var get_total_daily_spend = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        return get_total_daily_spend;
    }
  $scope.totalDailyLeads = function(){
        var total_vlts = $scope.getTotalLeadsCount()/30;
        return Math.round(total_vlts);

    }
  $scope.index = $scope.plans.length;
  // $scope.total_budget = $scope.budget.count;
  
  $scope.addNewChoice = function() {
    var newItemNo = ++$scope.index;
    $scope.plans.push({'id':newItemNo, "type":"Mobile","name":""});
    
    
  };
    
  $scope.removeChoice = function(id) {
  
        if($scope.plans.length<=1){
            alert("input cannot be less than 1");
            return;
        }
  
  
        var index = -1;
            var comArr = eval( $scope.plans );
            for( var i = 0; i < comArr.length; i++ ) {
                if( comArr[i].id === id) {
                    index = i;
                    break;
                }
            }
            if( index === -1 ) {
                alert( "Something gone wrong" );
            }
            $scope.plans.splice( index, 1 );
  };
  $scope.createMediaPlan = function(e){
    // e.preventdefault();
    var totalMetrix = new FormData();
    totalMetrix.total_budget = $scope.get_budget_amount();
    totalMetrix.total_spend = $scope.getTotalBudget();
    totalMetrix.total_leads = $scope.getTotalLeadsCount();
    totalMetrix.total_valid_leads = $scope.getTotalValidLeads();
    totalMetrix.valid_valid_leads_per = $scope.getTotalValidLeadsPer();
    totalMetrix.total_walk_in = $scope.totalWalkIn();
    totalMetrix.total_sales = $scope.totalSales();
    totalMetrix.total_rev = $scope.totalRevenue();
    totalMetrix.total_cpl = $scope.totalCPL();
    totalMetrix.total_cpw = $scope.totalCPW();
    totalMetrix.total_cps = $scope.totalCPS();
    totalMetrix.total_sor = $scope.totalSOR();
    totalMetrix.total_vltw = $scope.getAvgVLTW();
    totalMetrix.total_wts = $scope.getAvgWTS();
    totalMetrix.total_vlts = $scope.totalVLTS();
    totalMetrix.total_daily_spend = $scope.totalDailySpend();
    totalMetrix.total_daily_leads = $scope.totalDailyLeads();

    // var PlanData = new FormData();
    // PlanData.asaignee_list = $scope.plans;
    // PlanData.plan_name = $scope.plan_name;
    // PlanData.project = $scope.project;
    // PlanData.month = $scope.month;
    // PlanData.budget_cost = $scope.budget;
    // PlanData.base_price = $scope.base_price;
    // PlanData.start_date = $scope.start_date;
    // PlanData.end_date = $scope.end_date;
    // PlanData.description = $scope.description;
    // PlanData.metrix = totalMetrix;
    // alert(JSON.stringify(PlanData));

    // alert('Test Working.');
    $http({
        url: '{{ route('campaign_store') }}',
        method: "POST",
        data: { 
            'asaignee_list' : $scope.plans, 
            'plan_name' : $scope.plan_name, 
            'project' : $scope.project, 
            'month' : $scope.month, 
            'budget_cost' : $scope.total_budget_amount, 
            'base_price' : $scope.base_price, 
            'start_date' : $scope.start_date, 
            'end_date' : $scope.end_date, 
            'description' : $scope.description, 
            'metrix' : totalMetrix,
            '_token' : '{{ csrf_token() }}',
        }
    })
    .then(function(response){
       if(response){
        // alert(JSON.stringify(response));
        swal.fire({
            title: 'Created!',
            text: response.data.success,
            type: 'success',
            showCancelButton: false,
            showConfirmButton: false,
            timer: 1000
        });
       }
    }, 
    function(response) {
        alert(JSON.stringify(response));
        swal.fire({
            title: 'Opps!',
            text: response.data.success,
            type: 'error',
            showCancelButton: false,
            showConfirmButton: false,
            timer: 1000
        });
    }).catch(function (reason) {
     // err
     if (reason.status === 500) {
        // do something
        alert(JSON.stringify(reason));
     }
  });
  };
  
});






    $(document).ready(function(){
        // $('.repeat_block').each(function(){
        //     $(this).addClass('just_another_repeat_class');
        //     var $select_source = $(this).find('.choose_source');
        //     var $optgroups = $(this).find('.choose_source > optgroup');
        //     var $select_medium = $(this).find(".choose_medium");
        //     $select_medium.on('change', function(){
        //         var selectedVal = this.value;
        //         $select_source.html($optgroups.filter('[label="'+selectedVal+'"]'));
        //      });
        // });
    //   var $optgroups = $('.choose_source > optgroup');
    //   $(".choose_medium").on("change",function(){
    //         var selectedVal = this.value;
    //         $('.choose_source').html($optgroups.filter('[label="'+selectedVal+'"]'));
    //      });  
    });

    $('#select_project').change(function(){

        if($(this).val() == 'vib'){
            $('.sub_project_list').show();
            $('#sub_project_select').attr("required", "required");
            // $('#lead_submit_btn').addClass('submit_btn_active');
            $('.plot_project').show();
            $('.omr_project').hide();
        }
        else if($(this).val() == 'siruseri'){
            $('.sub_project_list').show();
            $('#sub_project_select').attr("required", "required");
            $('.omr_project').show();
            $('.plot_project').hide();
        }
        else{
            $('.sub_project_list').hide();
            $('.plot_project').hide();
            $('.omr_project').hide();
            $('#sub_project_select').removeAttr('required');}
            // $('.sub_project_list').hide();
    })
        $(document).ready(function(){

        
            // $('#about_camp').bind("change paste", function(){
            //     $project = $('#select_projects').val();
            //     $about_camp = $('#about_camp').val();
            //     $new_camp_name = $project.toUpperCase() + ' - ' + $about_camp;
            //     $('.camp_name').text($new_camp_name);
            //     $('#campaign_name').val($new_camp_name);

            //     if($('#about_camp').val()) {
            //         $('.camp_name').show(); 
            //     } else {
            //         $('.camp_name').hide(); 
            //     } 
            // });
        });

        // $('#select_source').change(function(){
        //     var selected = $(this).find('option:selected');
        //     $camp_name = $('#select_source').val();
        //     $pro_name = $('#select_projects').val();


        //     $camp_count = selected.data('count') + 1;
        //     $source_id = selected.data('id');
        //     $('.camp_name').text($pro_name + ' ' + $camp_name + ' ' + $camp_count);
        //     $('#campaign_name').val($pro_name + ' ' + $camp_name + ' ' + $camp_count);
        //     $('#campaign_source_count').val($camp_count);
        //     $('#source_id').val($source_id);


        //     if($('#about_camp').val()) {
        //         $('.camp_name').show(); 
        //     } else {
        //         $('.camp_name').hide(); 
        //     } 
        // });
    </script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
@endsection