<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="">
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Digital Labs') }}</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    </head>
    <body class="kt-container kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                </div>
                <div class="kt-aside-menu-overlay"></div>
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    </body>
</html>