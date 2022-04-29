@extends('layouts.app')
@section('content')
<div ng-app="myApp">
  <div ng-view></div>
</div>
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
<script src="https://code.angularjs.org/1.8.0/angular-route.min.js" type="text/javascript"></script>
<script>
  var app = angular.module('myApp', ['ngRoute'], function($interpolateProvider) {
          $interpolateProvider.startSymbol('[{');
          $interpolateProvider.endSymbol('}]');
  });
  app.config(function($routeProvider, $locationProvider){
      $routeProvider
          .when('/index', { 
              templateUrl: '{{ route('media_plan_index') }}',
              // template: 'Hello Digital Team!',
              controller: 'MediaPlanIndexController'
          })
          .when('/create', {
              templateUrl: '{{ route('media_plan_create') }}',
              controller: 'addCampCtrl'
          })
          .when('/edit_media_plan/:id', {
              templateUrl: '{{ route('media_plan_edit') }}',
              controller: 'editCampCtrl'
          })
          // .when('/details/', {
          //     templateUrl: '{{ route('media_plan_details') }}' + '/?id=' + get_plan_id,
          //     controller: 'detailsController'
          // })
          .otherwise({
              redirectTo: '/index'
          });
          // $locationProvider.html5Mode({
          //   enabled: true,
          //   requireBase: false
          // });
  });
  app.controller('detailsController', ['$scope', '$routeparams', function($scope, $routeparams) {
      var id = $routeparams.id;
  }]);
  function numDifferentiation(value) {
    var val = Math.abs(value)
    if (val >= 10000000) {
      val = (val / 10000000).toFixed(2) + ' Cr';
    } else if (val >= 100000) {
      val = (val / 100000).toFixed(2) + ' Lacs';
    }
    return val;
  }

  function checkFinit(number){
    var get_value_of_number;
    if(isFinite(number)){
      get_value_of_number = number;
    }
    else{
      get_value_of_number = 0;
    }
    return get_value_of_number;
  }
  app.controller('MediaPlanIndexController', function($scope, $http){
      $http({
          method: 'GET',
          url: '{{ route('media_plan_get_data') }}'
          }).then(function(response){
          // alert(JSON.stringify(response.list));
          console.log(response.data);
          angular.forEach(response.data.list, function(list) {
              list.metrix_data = JSON.parse(list.metrix);
          });
          $scope.media_plan_list = response.data.list;
          $('.month_name').text(response.data.month);
          $scope.getTotalLeads = function(){
              var get_total_leads = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  if(!isNaN(list.metrix_data.total_leads)){
                      get_total_leads += list.metrix_data.total_leads;
                  }
              }
              return get_total_leads;
          }
          $scope.mediaplanTotalBudget = function(){
              var get_total_budget = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  var tbudget = list.metrix_data.total_spend.replace(/,/g, '');
                  if(!isNaN(tbudget)){
                      get_total_budget += parseInt(tbudget);
                  }
              }

              // var x=get_total_budget;
              // x=x.toString();
              // var lastThree = x.substring(x.length-3);
              // var otherNumbers = x.substring(0,x.length-3);
              // if(otherNumbers != '')
              //     lastThree = ',' + lastThree;
              // var mediaplan_total_budget = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
              var mediaplan_total_budget = numDifferentiation(get_total_budget);
              return mediaplan_total_budget;
          }
          $scope.mediaplanTotalBudgetNumber = function(){
              var get_total_budget = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  var tbudget = list.metrix_data.total_spend.replace(/,/g, '');
                  if(!isNaN(tbudget)){
                      get_total_budget += parseInt(tbudget);
                  }
              }
              return get_total_budget;
          }
          $scope.mediaplanTotalValidLeads = function(){
              var total_valid_leads = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  if(!isNaN(list.metrix_data.total_valid_leads)){
                      total_valid_leads += list.metrix_data.total_valid_leads;
                  }
              }
              return Math.round(total_valid_leads);
              // var total_valid_leads_count = 0;
              // var valid_leads_per = $scope.mediaplanTotalValidLeadsPer();
              // var total_leads_count = $scope.getTotalLeads();
              // total_valid_leads_count = (valid_leads_per/100) * total_leads_count;
              // return Math.round(total_valid_leads_count);
          }
          $scope.mediaplanTotalValidLeadsPer = function(){
              var total_valid_per = ($scope.mediaplanTotalValidLeads()/$scope.getTotalLeads())*100;
              return Math.round(total_valid_per);
          }
            $scope.totalBasePrice = function(){
                  var total_base_price = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var plan = response.data.list[i];
                      if(!isNaN(plan.base_price)){
                          total_base_price += plan.base_price;
                      }
                  }
                  return total_base_price;
              }
            $scope.mediaplantotalWalkIn = function(){
                  var total_walk_in = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var plan = response.data.list[i];
                      if(!isNaN(plan.metrix_data.total_walk_in)){
                          total_walk_in += plan.metrix_data.total_walk_in;
                      }
                  }
                  return total_walk_in;
              }
            $scope.mediaplantotalSales = function(){
                  var total_sales = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var plan = response.data.list[i];
                      if(!isNaN(plan.metrix_data.total_sales)){
                          total_sales += plan.metrix_data.total_sales;
                      }
                  }
                  return total_sales;
              }
            $scope.mediaplantotalRevenue = function(){
                  var total_revenue = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var tbudget = list.metrix_data.total_rev.replace(/,/g, '');
                      if(!isNaN(tbudget)){
                          total_revenue += parseInt(tbudget);
                      }
                  }
                  // x = Math.round(total_revenue);
                  // x=x.toString();
                  // var lastThree = x.substring(x.length-3);
                  // var otherNumbers = x.substring(0,x.length-3);
                  // if(otherNumbers != '')
                  //     lastThree = ',' + lastThree;
                  // var get_total_revenue = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                  var get_total_revenue = numDifferentiation(total_revenue);
                  return get_total_revenue;
              }
              $scope.mediaplanAvgVLTW = function(){
                var total_valid_vltw = ($scope.mediaplantotalWalkIn()/$scope.mediaplanTotalValidLeads())*100;
                return Math.round(total_valid_vltw*100)/100;
              }
              $scope.mediaplanAvgWTS = function(){
                var total_valid_wts = ($scope.mediaplantotalSales()/$scope.mediaplantotalWalkIn())*100;
                return Math.round(total_valid_wts*100)/100;
              }

          // $scope.mediaplanAvgVLTW = function(){
          //     var total_valid_vltw = 0;
          //     for(var i = 0; i < response.data.list.length; i++){
          //         var plan = response.data.list[i];
          //         if(!isNaN(plan.metrix_data.total_vltw)){
          //             total_valid_vltw += plan.metrix_data.total_vltw;
          //         }
          //     }
          //     var mediapla_vltw = total_valid_vltw/response.data.list.length;
          //     return Math.round(mediapla_vltw);
          // }
          //   $scope.mediaplanAvgWTS = function(){
          //         var total_valid_wts = 0;
          //         for(var i = 0; i < response.data.list.length; i++){
          //             var plan = response.data.list[i];
          //             if(!isNaN(plan.metrix_data.total_wts)){
          //                 total_valid_wts += plan.metrix_data.total_wts;
          //             }
          //         }
          //         var media_wts = total_valid_wts/response.data.list.length;
          //         return Math.round(media_wts*100)/100;
          //     }
            $scope.totalRevenueNumber = function(){
                var total_revenue = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var tbudget = list.metrix_data.total_rev.replace(/,/g, '');
                      if(!isNaN(tbudget)){
                          total_revenue += parseInt(tbudget);
                      }
                  }
                  return total_revenue;
              }
            $scope.totalCPL = function(){
                  var total_cpl = 0;
                  total_cpl = $scope.mediaplanTotalBudgetNumber()/$scope.getTotalLeads();
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
                  total_cpw = $scope.mediaplanTotalBudgetNumber()/$scope.mediaplantotalWalkIn();
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
                  total_cps = $scope.mediaplanTotalBudgetNumber()/$scope.mediaplantotalSales();
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
                  total_sor = $scope.mediaplanTotalBudgetNumber()/$scope.totalRevenueNumber()*100;
                  if(total_sor>0){
                      total_sor = total_sor;
                  }
                  else{
                      total_sor = 0;
                  }
                  var get_total_sor = Math.round(total_sor*100)/100;
                  return get_total_sor;
                  // return get_total_sor == 'Infinity'? 0: get_total_sor;
              }
            $scope.totalVLTS = function(){
                  var total_vlts = 0;
                  total_vlts = $scope.mediaplantotalSales()/$scope.mediaplanTotalValidLeads()*100;
                  if(total_vlts>0){
                      total_vlts = total_vlts;
                  }
                  else{
                      total_vlts = 0;
                  }
                  return Math.round(total_vlts*100)/100;
              }
            $scope.totalDailySpend = function(){
                  var total_vlts = $scope.mediaplanTotalBudgetNumber()/30;
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
                  var total_vlts = $scope.getTotalLeads()/30;
                  return Math.round(total_vlts);
  
              }
  
              google.charts.load('current', {'language': 'hi_IN', 'packages':['bar', 'corechart']});
              google.charts.setOnLoadCallback(drawStuff);
              google.charts.setOnLoadCallback(drawChart1);
              google.charts.setOnLoadCallback(drawChart2);
              google.charts.setOnLoadCallback(drawChart3);
              google.charts.setOnLoadCallback(drawChart4);
              google.charts.setOnLoadCallback(drawChartBudget);
              function Create2DArray(rows){
                var arr = [];
                for (var i=0;i<rows;i++){
                   arr[i] = [];
                }
                return arr;
              }
              function drawStuff(){
  
                  var get_budget = Create2DArray(response.data.list.length);
  
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Budget';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var title = list.name;
                      var budget = list.metrix_data.total_budget.replace(/,/g, '');
                      get_budget[i][0] = title;
                      get_budget[i][1] = parseInt(budget);
                  }
  
                  // var data_result =  get_budget.reduce(function(result, field, index) {
                  //   result[get_title[index]] = field;
                  //   return result;
                  // }, {});
                  // console.log(get_budget);
                  var data = new google.visualization.arrayToDataTable(get_budget);
  
                  var options = {
                    title: 'All Project Budget',
                    // width: 900,
                    legend: { position: 'none' },
                    chart: { title: 'All Project Budget',
                             subtitle: 'Media Plan Budget by Projects' },
                    bars: 'horizontal', // Required for Material Bar Charts.
                    hAxis: {format: 'currency'},
                    // axes: {
                    //   x: {
                    //     0: { side: 'top', label: 'Budget'} // Top x-axis.
                    //   }
                    // },
                    // height: 500,
                    annotations: {
                      textStyle: {
                        fontName: 'Poppins',
                        fontSize: 16,
                        bold: true,
                        // italic: true,
                        // The color of the text.
                        color: '#871b47',
                        // The color of the text outline.
                        auraColor: '#d799ae',
                        // The transparency of the text.
                        opacity: 0.8
                      }
                    },
                    bar: { groupWidth: "90%" }
                  };
  
                  var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                  chart.draw(data, google.charts.Bar.convertOptions(options));
              };
              function drawChart1(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Sales';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_sales = list.metrix_data.total_sales;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_sales);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Sales Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_1'));
                  chart.draw(data, options);
              }
              function drawChart2(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Walk-In';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_walk_in = list.metrix_data.total_walk_in;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_walk_in);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Walk-In Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_2'));
                  chart.draw(data, options);
              }
              function drawChart3(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Sales';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_leads = list.metrix_data.total_leads;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_leads);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Leads Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_3'));
                  chart.draw(data, options);
              }
              function drawChart4(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Walk-In';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_valid_leads = list.metrix_data.total_valid_leads;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_valid_leads);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Valid Leads Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_4'));
                  chart.draw(data, options);
              }
              function drawChartBudget(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Walk-In';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_budget = list.metrix_data.total_budget.replace(/,/g, '');
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_budget);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      // legend: {
                      //     position: 'bottom',
                      //     textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      // },
                      pieSliceText: 'value-and-percentage',
                      is3D: true,
                      slices: {  15: {offset: 0.2},
                                1: {offset: 0.3},
                                7: {offset: 0.4},
                                10: {offset: 0.5},
                      },
                      sliceVisibilityThreshold: 0,             
                      legend: 'labeled',
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                      title: 'Budget Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_budget'));
                  chart.draw(data, options);
              }
      });
      $scope.changeMonth = function(){
          
        $http({
          method: 'GET',
          url: '{{ route('media_plan_get_data') }}',
          params: {month: $scope.month}
          }).then(function(response){
          // alert(JSON.stringify(response.list));
          console.log(response.data);
          angular.forEach(response.data.list, function(list) {
              list.metrix_data = JSON.parse(list.metrix);
          });
          $scope.media_plan_list = response.data.list;
          $('.month_name').text(response.data.month);
          $scope.getTotalLeads = function(){
              var get_total_leads = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  if(!isNaN(list.metrix_data.total_leads)){
                      get_total_leads += list.metrix_data.total_leads;
                  }
              }
              return get_total_leads;
          }
          $scope.mediaplanTotalBudget = function(){
              var get_total_budget = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  var tbudget = list.metrix_data.total_spend.replace(/,/g, '');
                  if(!isNaN(tbudget)){
                      get_total_budget += parseInt(tbudget);
                  }
              }

              // var x=get_total_budget;
              // x=x.toString();
              // var lastThree = x.substring(x.length-3);
              // var otherNumbers = x.substring(0,x.length-3);
              // if(otherNumbers != '')
              //     lastThree = ',' + lastThree;
              // var mediaplan_total_budget = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
              var mediaplan_total_budget = numDifferentiation(get_total_budget);
              return mediaplan_total_budget;
          }
          $scope.mediaplanTotalBudgetNumber = function(){
              var get_total_budget = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  var tbudget = list.metrix_data.total_spend.replace(/,/g, '');
                  if(!isNaN(tbudget)){
                      get_total_budget += parseInt(tbudget);
                  }
              }
              return get_total_budget;
          }
          $scope.mediaplanTotalValidLeads = function(){
              var total_valid_leads = 0;
              for(var i = 0; i < response.data.list.length; i++){
                  var list = response.data.list[i];
                  if(!isNaN(list.metrix_data.total_valid_leads)){
                      total_valid_leads += list.metrix_data.total_valid_leads;
                  }
              }
              return Math.round(total_valid_leads);
              // var total_valid_leads_count = 0;
              // var valid_leads_per = $scope.mediaplanTotalValidLeadsPer();
              // var total_leads_count = $scope.getTotalLeads();
              // total_valid_leads_count = (valid_leads_per/100) * total_leads_count;
              // return Math.round(total_valid_leads_count);
          }
          $scope.mediaplanTotalValidLeadsPer = function(){
              var total_valid_per = ($scope.mediaplanTotalValidLeads()/$scope.getTotalLeads())*100;
              return Math.round(total_valid_per);
          }
            $scope.totalBasePrice = function(){
                  var total_base_price = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var plan = response.data.list[i];
                      if(!isNaN(plan.base_price)){
                          total_base_price += plan.base_price;
                      }
                  }
                  return total_base_price;
              }
            $scope.mediaplantotalWalkIn = function(){
                  var total_walk_in = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var plan = response.data.list[i];
                      if(!isNaN(plan.metrix_data.total_walk_in)){
                          total_walk_in += plan.metrix_data.total_walk_in;
                      }
                  }
                  return total_walk_in;
              }
            $scope.mediaplantotalSales = function(){
                  var total_sales = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var plan = response.data.list[i];
                      if(!isNaN(plan.metrix_data.total_sales)){
                          total_sales += plan.metrix_data.total_sales;
                      }
                  }
                  return total_sales;
              }
            $scope.mediaplantotalRevenue = function(){
                  var total_revenue = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var tbudget = list.metrix_data.total_rev.replace(/,/g, '');
                      if(!isNaN(tbudget)){
                          total_revenue += parseInt(tbudget);
                      }
                  }
                  // x = Math.round(total_revenue);
                  // x=x.toString();
                  // var lastThree = x.substring(x.length-3);
                  // var otherNumbers = x.substring(0,x.length-3);
                  // if(otherNumbers != '')
                  //     lastThree = ',' + lastThree;
                  // var get_total_revenue = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
                  var get_total_revenue = numDifferentiation(total_revenue);
                  return get_total_revenue;
              }
              $scope.mediaplanAvgVLTW = function(){
                var total_valid_vltw = ($scope.mediaplantotalWalkIn()/$scope.mediaplanTotalValidLeads())*100;
                return Math.round(total_valid_vltw*100)/100;
              }
              $scope.mediaplanAvgWTS = function(){
                var total_valid_wts = ($scope.mediaplantotalSales()/$scope.mediaplantotalWalkIn())*100;
                return Math.round(total_valid_wts*100)/100;
              }

            $scope.totalRevenueNumber = function(){
                  
                var total_revenue = 0;
                  for(var i = 0; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var tbudget = list.metrix_data.total_rev.replace(/,/g, '');
                      if(!isNaN(tbudget)){
                          total_revenue += parseInt(tbudget);
                      }
                  }
                  return total_revenue;
              }
            $scope.totalCPL = function(){
                  var total_cpl = 0;
                  total_cpl = $scope.mediaplanTotalBudgetNumber()/$scope.getTotalLeads();
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
                  total_cpw = $scope.mediaplanTotalBudgetNumber()/$scope.mediaplantotalWalkIn();
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
                  total_cps = $scope.mediaplanTotalBudgetNumber()/$scope.mediaplantotalSales();
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
                  total_sor = $scope.mediaplanTotalBudgetNumber()/$scope.totalRevenueNumber()*100;
                  if(total_sor>0){
                      total_sor = total_sor;
                  }
                  else{
                      total_sor = 0;
                  }
                  var get_total_sor = Math.round(total_sor);
                  return get_total_sor;
              }
            $scope.totalVLTS = function(){
                  var total_vlts = 0;
                  total_vlts = $scope.mediaplantotalSales()/$scope.mediaplanTotalValidLeads()*100;
                  if(total_vlts>0){
                      total_vlts = total_vlts;
                  }
                  else{
                      total_vlts = 0;
                  }
                  return Math.round(total_vlts*100)/100;
              }
            $scope.totalDailySpend = function(){
                  var total_vlts = $scope.mediaplanTotalBudgetNumber()/30;
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
                  var total_vlts = $scope.getTotalLeads()/30;
                  return Math.round(total_vlts);
  
              }
  
              google.charts.load('current', {'language': 'hi_IN', 'packages':['bar', 'corechart']});
              google.charts.setOnLoadCallback(drawStuff);
              google.charts.setOnLoadCallback(drawChart1);
              google.charts.setOnLoadCallback(drawChart2);
              google.charts.setOnLoadCallback(drawChart3);
              google.charts.setOnLoadCallback(drawChart4);
              google.charts.setOnLoadCallback(drawChartBudget);
              function Create2DArray(rows) {
                var arr = [];
  
                for (var i=0;i<rows;i++) {
                   arr[i] = [];
                }
  
                return arr;
              }
              function drawStuff(){
  
                  var get_budget = Create2DArray(response.data.list.length);
  
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Budget';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var title = list.name;
                      var budget = list.metrix_data.total_budget.replace(/,/g, '');
                      get_budget[i][0] = title;
                      get_budget[i][1] = parseInt(budget);
                  }
  
                  // var data_result =  get_budget.reduce(function(result, field, index) {
                  //   result[get_title[index]] = field;
                  //   return result;
                  // }, {});
                  // console.log(get_budget);
                  var data = new google.visualization.arrayToDataTable(get_budget);
  
                  var options = {
                    title: 'All Project Budget',
                    // width: 900,
                    legend: { position: 'none' },
                    chart: { title: 'All Project Budget',
                             subtitle: 'Media Plan Budget by Projects' },
                    bars: 'horizontal', // Required for Material Bar Charts.
                    hAxis: {format: 'currency'},
                    // axes: {
                    //   x: {
                    //     0: { side: 'top', label: 'Budget'} // Top x-axis.
                    //   }
                    // },
                    // height: 500,
                    annotations: {
                      textStyle: {
                        fontName: 'Poppins',
                        fontSize: 16,
                        bold: true,
                        // italic: true,
                        // The color of the text.
                        color: '#871b47',
                        // The color of the text outline.
                        auraColor: '#d799ae',
                        // The transparency of the text.
                        opacity: 0.8
                      }
                    },
                    bar: { groupWidth: "90%" }
                  };
  
                  var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                  chart.draw(data, google.charts.Bar.convertOptions(options));
              };
              function drawChart1(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Sales';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_sales = list.metrix_data.total_sales;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_sales);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Sales Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_1'));
                  chart.draw(data, options);
              }
              function drawChart2(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Walk-In';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_walk_in = list.metrix_data.total_walk_in;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_walk_in);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Walk-In Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_2'));
                  chart.draw(data, options);
              }
              function drawChart3(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Sales';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_leads = list.metrix_data.total_leads;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_leads);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Leads Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_3'));
                  chart.draw(data, options);
              }
              function drawChart4(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Walk-In';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_valid_leads = list.metrix_data.total_valid_leads;
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_valid_leads);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Valid Leads Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_4'));
                  chart.draw(data, options);
              }
              function drawChartBudget(){
                  var get_budget = Create2DArray(response.data.list.length);
                      get_budget[0][0] = 'Media Plan';
                      get_budget[0][1] = 'Walk-In';
                  for(var i = 1; i < response.data.list.length; i++){
                      var list = response.data.list[i];
                      var total_budget = list.metrix_data.total_budget.replace(/,/g, '');
                      get_budget[i][0] = list.name;
                      get_budget[i][1] = parseInt(total_budget);
                  }
                  var data = google.visualization.arrayToDataTable(get_budget);
                  var options = {
                      // legend: {
                      //     position: 'bottom',
                      //     textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      // },
                      pieSliceText: 'value-and-percentage',
                      is3D: true,
                      slices: {  15: {offset: 0.2},
                                1: {offset: 0.3},
                                7: {offset: 0.4},
                                10: {offset: 0.5},
                      },
                      sliceVisibilityThreshold: 0,             
                      legend: 'labeled',
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                      title: 'Budget Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_budget'));
                  chart.draw(data, options);
              }
        });
      };
  });
  app.controller('addCampCtrl', function($scope, $http, $location) {
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
              "wts":""
          }
      ];
      $scope.sources = [
          @foreach(config('dtms.source') as $source)
            {medium: '{!! htmlspecialchars_decode($source['medium']) !!}', source: '{!! htmlspecialchars_decode($source['source']) !!}'},
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

        $scope.change = function(){
        for(var pi = 0; pi < $scope.plans.length; pi++){
            $scope.$watch('plans[' + pi + ']', function (newValue, oldValue) {
              newValue.vleads = Math.round((newValue.valid_leads/100) * newValue.leads);
              newValue.walk_in = Math.round((newValue.vleads/100)*newValue.vltw);
              newValue.sales = Math.round((newValue.walk_in/100)*newValue.wts);
              newValue.rev = Math.round(newValue.sales*$scope.base_price);
              newValue.cpl = Math.round(newValue.budget/newValue.leads);
              newValue.cpw = Math.round(newValue.budget/newValue.walk_in);
              newValue.cps = Math.round(newValue.budget/newValue.sales);
              newValue.sor = Math.round(newValue.budget/newValue.rev*100);
              newValue.vlts = Math.round(newValue.sales/newValue.vleads*100);
              newValue.daily_spend = Math.round(newValue.budget/30);
              newValue.daily_leads = Math.round(newValue.leads/30);
            }, true);
        };
        };
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
      $scope.getTotalValidLeads = function(){

          var total_valid_leads = 0;
          for(var i = 0; i < $scope.plans.length; i++){
              var plan = $scope.plans[i];
              if(plan.vleads){
                  total_valid_leads += plan.vleads;
              }
          }
          return total_valid_leads;
          // var total_valid_leads_count = 0;
          // var valid_leads_per = $scope.getTotalValidLeadsPerNumber();
          // var total_leads_count = $scope.getTotalLeadsCount();
          // total_valid_leads_count = (valid_leads_per/100) * total_leads_count;
          // return Math.round(total_valid_leads_count);
      }
      $scope.getTotalValidLeadsPer = function(){
          var total_valid_per = ($scope.getTotalValidLeads()/$scope.getTotalLeadsCount())*100;
          return Math.round(total_valid_per);
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
      $scope.totalWalkIn = function(){
          var total_walkin = 0;
          for(var i = 0; i < $scope.plans.length; i++){
              var plan = $scope.plans[i];
              if(!isNaN(plan.walk_in)){
                  total_walkin += plan.walk_in;
              }
          }
          return total_walkin;
      }
      $scope.totalSales = function(){
          var total_sales = 0;
          for(var i = 0; i < $scope.plans.length; i++){
              var plan = $scope.plans[i];
              if(!isNaN(plan.sales)){
                  total_sales += plan.sales;
              }
          }
          return total_sales;
      }
      $scope.getAvgVLTW = function(){
        var total_valid_vltw = ($scope.totalWalkIn()/$scope.getTotalValidLeads())*100;
        return Math.round(total_valid_vltw*100)/100;
      }
      $scope.getAvgWTS = function(){
        var total_valid_wts = ($scope.totalSales()/$scope.totalWalkIn())*100;
        return Math.round(total_valid_wts*100)/100;
      }

      $scope.totalRevenue = function(){
          var total_rev = 0;
          for(var i = 0; i < $scope.plans.length; i++){
              var plan = $scope.plans[i];
              if(!isNaN(plan.rev)){
                  total_rev += plan.rev;
              }
          }
          if(total_rev>0){
              x = Math.round(total_rev);
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
          var total_rev = 0;
          for(var i = 0; i < $scope.plans.length; i++){
              var plan = $scope.plans[i];
              if(!isNaN(plan.rev)){
                  total_rev += plan.rev;
              }
          }
          if(total_rev>0){
              get_total_revenue = Math.round(total_rev);
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
      $scope.totalCPVL = function(){
          var total_cpl = 0;
          total_cpl = $scope.getTotalBudgetCount()/$scope.getTotalValidLeads();
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
          $scope.plans.push({'id':newItemNo, objective: '', medium: '', source: '', user: '', budget: '', leads: '', valid_leads: '', vltw: '', wts: ''});
      };
      $scope.removeChoice = function(id) {
          if($scope.plans.length<=1){
              alert("Can't Delete. This Media Plan List should be one row!");
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
              alert( "Are you sure you want to delete this item?" );
          }
          $scope.plans.splice( index, 1 );
      };
      $scope.createMediaPlan = function(e){
          // e.preventdefault();
          var totalMetrix = new FormData();
          totalMetrix.total_budget = $scope.get_budget_amount();
          totalMetrix.total_spend = $scope.getTotalBudget();
          totalMetrix.total_budget_balance = $scope.get_total_budget_amount();
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
          
          // alert(JSON.stringify($scope.plans));
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
              $location.path('/#!/index');
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
  app.controller('editCampCtrl', function($scope, $http, $location, $routeParams) {
        $scope.campId = $routeParams.id;
        $scope.edit_budget_cost = '';
        $scope.edit_base_price = '';
        $http({
        method: 'GET',
        url: '{{ url('/') }}/media_plan/media_plan_edit_data/'+$scope.campId
        }).then(function(response){
            console.log(response.data);
            angular.forEach(response.data.camp.channels, function(list) {
            // if(!angular.isString(list.source)){
            //     list.source = list.source;
            // }
            // else{
            //     list.source = list.source.source;
            // }
        });
        // $scope.plan_name = '';
        // $scope.project = '';
        // $scope.month = '';
        // $scope.description = '';
        // $scope.media_plans = '';

        $scope.plan_name = response.data.camp.name; 
        $scope.project = response.data.camp.project; 
        $scope.month = response.data.camp.month; 
        $scope.edit_budget_cost = response.data.camp.budget_cost;
        $scope.edit_base_price = response.data.camp.base_price;
        // if(angular.isNumber($scope.edit_budget_cost)){
        //   alert($scope.edit_budget_cost);
        // }
        // if(angular.isNumber($scope.edit_base_price)){
        //   alert($scope.edit_base_price);
        // }

        $scope.description = response.data.camp.description; 
        $scope.media_plans = response.data.camp.channels;

        angular.forEach($scope.media_plans, function(plan){
          if(angular.isObject(plan.source)){
            plan.source = plan.source.source;
          }
          plan.vleads = checkFinit(Math.round((plan.valid_leads/100) * plan.leads));
          plan.walk_in = checkFinit(Math.round((plan.vleads/100)*plan.vltw));
          plan.sales = checkFinit(Math.round((plan.walk_in/100)*plan.wts));
          plan.rev = checkFinit(Math.round(plan.sales*$scope.edit_base_price));
          plan.cpl = checkFinit(Math.round(plan.budget/plan.leads));
          plan.cpw = checkFinit(Math.round(plan.budget/plan.walk_in));
          plan.cps = checkFinit(Math.round(plan.budget/plan.sales));
          plan.sor = checkFinit(Math.round(plan.budget/plan.rev*100));
          plan.vlts = checkFinit(Math.round(plan.sales/plan.vleads*100));
          plan.daily_spend = checkFinit(Math.round(plan.budget/30));
          plan.daily_leads = checkFinit(Math.round(plan.leads/30));
        });

        $scope.change = function(){
        for(var pi = 0; pi < $scope.media_plans.length; pi++){
            $scope.$watch('media_plans[' + pi + ']', function (newValue, oldValue) {
              newValue.vleads = checkFinit(Math.round((newValue.valid_leads/100) * newValue.leads));
              newValue.walk_in = checkFinit(Math.round((newValue.vleads/100)*newValue.vltw));
              newValue.sales = checkFinit(Math.round((newValue.walk_in/100)*newValue.wts));
              newValue.rev = checkFinit(Math.round(newValue.sales*$scope.edit_base_price));
              newValue.cpl = checkFinit(Math.round(newValue.budget/newValue.leads));
              newValue.cpw = checkFinit(Math.round(newValue.budget/newValue.walk_in));
              newValue.cps = checkFinit(Math.round(newValue.budget/newValue.sales));
              newValue.sor = checkFinit(Math.round(newValue.budget/newValue.rev*100));
              newValue.vlts = checkFinit(Math.round(newValue.sales/newValue.vleads*100));
              newValue.daily_spend = checkFinit(Math.round(newValue.budget/30));
              newValue.daily_leads = checkFinit(Math.round(newValue.leads/30));
            }, true);
        };
        };
        console.log($scope.media_plans);
        $scope.sources = [
          @foreach(config('dtms.source') as $source)
            {medium: '{{ $source['medium'] }}', source: '{{ $source['source'] }}'},
          @endforeach
        ];
        $scope.changeCr = function(value){
          var val = Math.abs(value)
          if (val >= 10000000) {
            val = (val / 10000000).toFixed(2) + ' Cr';
          } else if (val >= 100000) {
            val = (val / 100000).toFixed(2) + ' Lacs';
          }
          return val;
        };
        $scope.editTotalBudgetCount = function(){
          var total_budget = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(!isNaN(plan.budget)){
                  total_budget += plan.budget;
              }
          }
          return total_budget;
        }
        $scope.editTotalLeadsCount = function(){
          var total_leads = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(!isNaN(plan.leads)){
                  total_leads += plan.leads;
              }
          }
          return total_leads;
        }

        $scope.edited_valid_leads_per = $scope.media_plans.filter(function (item) {
              return (item.valid_leads !== 0);
        });

        $scope.editTotalValidLeadsPerNumber = function(){
          var total_valid_leads = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(plan.valid_leads !=0){
                  total_valid_leads += plan.valid_leads;
              }
          }
          return total_valid_leads/$scope.media_plans.length;
        }
        $scope.editTotalValidLeads = function(){
          var total_valid_leads = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(plan.vleads){
                  total_valid_leads += plan.vleads;
              }
          }
          return total_valid_leads;

          // var total_valid_leads_count = 0;
          // var valid_leads_per = $scope.editTotalValidLeadsPerNumber();
          // var total_leads_count = $scope.editTotalLeadsCount();
          // total_valid_leads_count = (valid_leads_per/100) * total_leads_count;
          // return Math.round(total_valid_leads_count);
        }

        $scope.editTotalValidLeadsPer = function(){
          var total_valid_per = ($scope.editTotalValidLeads()/$scope.editTotalLeadsCount())*100;
          return Math.round(total_valid_per);
        }
        $scope.editTotalBudget = function(){
          var total_budget = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
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
        $scope.edit_total_budget_amount = function(){
          var x=$scope.edit_budget_cost;
          if(x>0){
              x = x - $scope.editTotalBudgetCount();
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
        $scope.editBudgetAmount = function(){
          //return numDifferentiation(edit_budget_cost);
          var x=$scope.edit_budget_cost;
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
        $scope.edittotalWalkIn = function(){
          var total_walkin = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(!isNaN(plan.walk_in)){
                  total_walkin += plan.walk_in;
              }
          }
          return total_walkin;
        }
        $scope.edittotalSales = function(){
          var total_sales = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(!isNaN(plan.sales)){
                  total_sales += plan.sales;
              }
          }
          return total_sales;
        }
        $scope.edittotalRevenue = function(){
          var total_rev = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(!isNaN(plan.rev)){
                  total_rev += plan.rev;
              }
          }
          if(total_rev>0){
              x = Math.round(total_rev);
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

        $scope.edittotalRevenueNumber = function(){
          var get_total_revenue = 0;
          for(var i = 0; i < $scope.media_plans.length; i++){
              var plan = $scope.media_plans[i];
              if(!isNaN(plan.rev)){
                  get_total_revenue += plan.rev;
              }
          }
          if(get_total_revenue>0){
              get_total_revenue = Math.round(get_total_revenue);
          }
          else{
              get_total_revenue = 0;
          }
          return get_total_revenue;
        }

        $scope.editAvgVLTW = function(){
          var total_valid_vltw = ($scope.edittotalWalkIn()/$scope.editTotalValidLeads())*100;
          return Math.round(total_valid_vltw*100)/100;
        }
        $scope.editAvgWTS = function(){
          var total_valid_wts = ($scope.edittotalSales()/$scope.edittotalWalkIn())*100;
          return Math.round(total_valid_wts*100)/100;
        }
        $scope.edittotalCPL = function(){
          var total_cpl = 0;
          total_cpl = $scope.editTotalBudgetCount()/$scope.editTotalLeadsCount();
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
        $scope.edittotalCPVL = function(){
          var total_cpl = 0;
          total_cpl = $scope.editTotalBudgetCount()/$scope.editTotalValidLeads();
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
        $scope.edittotalCPW = function(){
          var total_cpw = 0;
          total_cpw = $scope.editTotalBudgetCount()/$scope.edittotalWalkIn();
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
        $scope.edittotalCPS = function(){
          var total_cps = 0;
          total_cps = $scope.editTotalBudgetCount()/$scope.edittotalSales();
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
        $scope.edittotalSOR = function(){
          var total_sor = 0;
          total_sor = $scope.editTotalBudgetCount()/$scope.edittotalRevenueNumber()*100;
          if(total_sor>0){
              total_sor = total_sor;
          }
          else{
              total_sor = 0;
          }
          //$scope.editTotalBudgetCount()/$scope.edittotalRevenue();
          return Math.round(total_sor*100)/100;
        }
        $scope.edittotalVLTS = function(){
          var total_vlts = 0;
          total_vlts = $scope.edittotalSales()/$scope.editTotalValidLeads()*100;
          if(total_vlts>0){
              total_vlts = total_vlts;
          }
          else{
              total_vlts = 0;
          }
          return Math.round(total_vlts*100)/100;
        }
        $scope.edittotalDailySpend = function(){
          var total_vlts = $scope.editTotalBudgetCount()/30;
          x = Math.round(total_vlts);
          x=x.toString();
          var lastThree = x.substring(x.length-3);
          var otherNumbers = x.substring(0,x.length-3);
          if(otherNumbers != '')
              lastThree = ',' + lastThree;
          var get_total_daily_spend = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
          return get_total_daily_spend;
        }
        $scope.edittotalDailyLeads = function(){
          var total_vlts = $scope.editTotalLeadsCount()/30;
          return Math.round(total_vlts);
        }
        $scope.index = $scope.media_plans.length + 1;
        // $scope.total_budget = $scope.budget.count;
        $scope.addNewEditChoice = function() {
          var newItemNo = ++$scope.index;
          $scope.media_plans.push({'id':newItemNo, objective: '', medium: '', source: '', user: '', budget: '', leads: '', valid_leads: '', vltw: '', wts: ''});
        };
        $scope.removeEditChoice = function(id){
          if($scope.media_plans.length<=1){
              alert("Can't Delete. This Media Plan List should be one row!");
              return;
          }
          var index = -1;
          var comArr = eval( $scope.media_plans );
          for( var i = 0; i < comArr.length; i++ ) {
              if( comArr[i].id === id) {
                  index = i;
                  break;
              }
          }
          if( index === -1 ) {
              alert( "Are you sure you want to delete this item?" );
          }
          $scope.media_plans.splice( index, 1 );
        };
        $scope.updateMediaPlan = function(e){
          // e.preventdefault();
          var totalMetrix = new FormData();
          totalMetrix.total_budget = $scope.editBudgetAmount();
          totalMetrix.total_budget_balance = $scope.edit_total_budget_amount();
          totalMetrix.total_spend = $scope.editTotalBudget();
          totalMetrix.total_leads = $scope.editTotalLeadsCount();
          totalMetrix.total_valid_leads = $scope.editTotalValidLeads();
          totalMetrix.valid_valid_leads_per = $scope.editTotalValidLeadsPer();
          totalMetrix.total_walk_in = $scope.edittotalWalkIn();
          totalMetrix.total_sales = $scope.edittotalSales();
          totalMetrix.total_rev = $scope.edittotalRevenue();
          totalMetrix.total_cpl = $scope.edittotalCPL();
          totalMetrix.total_cpw = $scope.edittotalCPW();
          totalMetrix.total_cps = $scope.edittotalCPS();
          totalMetrix.total_sor = $scope.edittotalSOR();
          totalMetrix.total_vltw = $scope.editAvgVLTW();
          totalMetrix.total_wts = $scope.editAvgWTS();
          totalMetrix.total_vlts = $scope.edittotalVLTS();
          totalMetrix.total_daily_spend = $scope.edittotalDailySpend();
          totalMetrix.total_daily_leads = $scope.edittotalDailyLeads();
          // alert(JSON.stringify($scope.media_plans));
          // console.log(JSON.stringify($scope.media_plans));
          
          $http({
              url: '{{ url('/') }}/campaigns/update/' + $scope.campId,
              method: "PUT",
              data: { 
                  'asaignee_list' : $scope.media_plans, 
                  'plan_name' : $scope.plan_name, 
                  'project' : $scope.project, 
                  'month' : $scope.month, 
                  'budget_cost' : $scope.edit_budget_cost, 
                  'base_price' : $scope.edit_base_price, 
                  'start_date' : $scope.start_date, 
                  'end_date' : $scope.end_date, 
                  'description' : $scope.description, 
                  'metrix' : totalMetrix,
                  '_token' : '{{ csrf_token() }}',
              }
          })
          .then(function(response){
             if(response.data.success){
              swal.fire({
                  title: 'Media Plan Updated!',
                  text: response.data.success,
                  type: 'success',
                  showCancelButton: false,
                  showConfirmButton: false,
                  timer: 1000
              });
             }
            $location.path('/#!/index');
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
           if (reason.status === 500) {
              alert(JSON.stringify(reason));
           }
          });

        };

      });
  });
</script>
@endsection