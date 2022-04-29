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

<script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
<script src="https://code.angularjs.org/1.8.0/angular-route.min.js" type="text/javascript"></script>
<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var app = angular.module('myApp', ['ngRoute']);
    app.config(function($routeProvider, $locationProvider) {
        $routeProvider
            .when('/spa/data_index', {
                templateUrl: '{{ route('spa_data_index') }}'
                // template: 'Hello Digital Team!',
                // controller: 'FirstController'
            })
            .when('/spa/create', {
                templateUrl: '{{ route('spa_camp_create') }}'
                // controller: 'SecondController'
            })
            .otherwise({
                redirectTo: '/spa/data_index'
            });
            $locationProvider.html5Mode({
              enabled: true,
              requireBase: false
            });
            // $locationProvider.html5Mode(true);
    });

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

<!-- <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js') }}"></script> -->
@endsection