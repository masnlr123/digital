<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->

@php
if(Auth::check()){
            $user = Auth::user();
        }
@endphp
    <head>
        <base href="">
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Digital Labs') }}</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

        <!--end::Fonts -->

        <!--begin::Page Vendors Styles(used by this page) -->
        <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--end::Page Vendors Styles -->
        @yield('header_css')
        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

        <!--end::Global Theme Styles -->

        <!--begin::Layout Skins(used by all pages) -->

        <!--end::Layout Skins -->
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
        @if(Auth::user()->role_id == '1')
        
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
          <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('9d3e4c8f6b15ce4d199d', {
              cluster: 'ap2'
            });

            var channel = pusher.subscribe('dtms');
            channel.bind('dtms_notification', function(data) {
                if(Notification.permission === "granted") {
                var notification_message = `<div class="alert alert-warning fade show" role="alert" style="margin: 25px 25px 0px;"><div class="alert-icon"><i class="la la-close"></i></div><div class="alert-text"></div>`+data+`<div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>`;
                    let body_data = `Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. `;
                    let notification = new Notification(data, {
                        body: body_data, // content for the alert
                        image: "https://www.alliancein.com/wp-content/uploads/2014/04/alliance-group-real-estate-developers-in-south-india.jpg",
                        icon: "http://allianceprojects.in/all/alliance_logo.jpg" // optional image url
                      });
                    notification.onclick = () => {
                        window.open('https://digital.allianceprojects.in/', '_blank');
                      };
                    // var notification = new Notification("Hi there!");
                    
                }

              // alert(JSON.stringify(data));  
            });

            function notifyMe() {
              // Let's check if the browser supports notifications
              if (!("Notification" in window)) {
                console.log("This browser does not support desktop notification");
              }

              // Let's check whether notification permissions have alredy been granted
              else if(Notification.permission === "granted") {
                // If it's okay let's create a notification
                var notification = new Notification("Hi there!");
              }

              // Otherwise, we need to ask the user for permission
              else if (Notification.permission !== 'denied' || Notification.permission === "default") {
                Notification.requestPermission(function (permission) {
                  // If the user accepts, let's create a notification
                  if (permission === "granted") {
                    var notification = new Notification("Hi there!");
                  }
                });
              }

              // At last, if the user has denied notifications, and you
              // want to be respectful there is no need to bother them any more.
            }
            //notifyMe();
          </script>
          @endif

    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

        <!-- begin:: Page -->

        <!-- begin:: Header Mobile -->
        <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
            <div class="kt-header-mobile__logo">
                <a href="index.html">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-7.png') }}" />
                </a>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
                <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
            </div>
        </div>

        <!-- end:: Header Mobile -->
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

                <!-- begin:: Aside -->
                <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

                    <!-- begin:: Brand -->
                    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                        <div class="kt-aside__brand-logo">
                            <a href="{{ url('/') }}">
                                <img alt="Logo" src="{{ asset('assets/media/logos/logo-7.png') }}" />
                            </a>
                        </div>
                    </div>

                    <!-- end:: Brand -->

                    <!-- begin:: Aside Menu -->
                    @php
                    if(
                    \Route::current()->getName() == 'task_creative_dataindex' ||
                    \Route::current()->getName() == 'content_index' ||
                    \Route::current()->getName() == 'seo_index' ||
                    \Route::current()->getName() == 'web_index' ||
                    \Route::current()->getName() == 'lms_index' ||
                    \Route::current()->getName() == 'utm_index'
                    ){
                        $active_url = 'kt-menu__item--open kt-menu__item--here';
                    }
                    elseif(\Route::current()->getName() == 'web_lp_index'){

                        $active_url = 'kt-menu__item--open kt-menu__item--here';
                }


                    @endphp
                    <div class="app_menu kt-aside-menu-wrapper flex-column-fluid " id="kt_aside_menu_wrapper">
                        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="1" style="padding: 0;">
                            <ul class="kt-menu__nav" style="padding:0;">
<!--
                                @if(Auth::user()->role_id != '15' && Auth::user()->role_id != '3' && Auth::user()->role_id != '17')
                                @if($user->id != 40)
                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight {{ (request()->is('task*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-sound"></i><span class="kt-menu__link-text">All Task</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <div class="kt-menu__wrapper">
                                            <ul class="kt-menu__subnav">

                                                <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Task List By Team</span></span></li>


                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('carbon_index', 'all') }}" class="kt-menu__link "><span class="kt-menu__link-text">All Task</span></a></li>
                                                <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('nct_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Non Campaign Task</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('task_creative_dataindex') }}" class="kt-menu__link "><span class="kt-menu__link-text">Creative Task</span></a></li> -->

                                                @auth
                                    @if(in_array(Auth::user()->role_id, array('1', '2', '3', '4', '5', '6', '7', '8', '16')))
                                                <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('content_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Content Requirements</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('paid_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Paid Team Task</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('aggregators_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Aggregators Task</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('seo_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">SEO Team Task</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('web_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Web Team Task</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('lms_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">LMS Team Task</span></a></li> -->
                                                <!-- <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('lead_audits_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">Lead Audits Task</span></a></li> 
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('utm_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">UTM Builder</span></a></li>
                                                @endif
                                                @endauth


                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="kt-menu__item {{ (request()->is('lp*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="Landing Pages" data-content='Click to view all Landing Pages'><a href="{{ route('web_lp_index') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-checking"></i><span class="kt-menu__link-text">Landing Pages</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                @endif-->
                                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--submenu-fullheight {{ (request()->is('leads*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="click" data-ktmenu-dropdown-toggle-class="kt-aside-menu-overlay--on"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-chat"></i><span class="kt-menu__link-text">Lead Audits</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                        <div class="kt-menu__wrapper">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Lead Audits</span></span></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('audit_index') }}" class="kt-menu__link "><span class="kt-menu__link-text">All Lead Audits</span></a></li>
                                            </ul>
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item  kt-menu__item--parent kt-menu__item--submenu-fullheight" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Leads By Project</span></span></li>

                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'agr') }}" class="kt-menu__link "><span class="kt-menu__link-text">AGR Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'hg') }}" class="kt-menu__link "><span class="kt-menu__link-text">HG Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'os') }}" class="kt-menu__link "><span class="kt-menu__link-text">OS Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'vib') }}" class="kt-menu__link "><span class="kt-menu__link-text">VIB Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'et') }}" class="kt-menu__link "><span class="kt-menu__link-text">Eternity Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'jr') }}" class="kt-menu__link "><span class="kt-menu__link-text">JR Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'bp') }}" class="kt-menu__link "><span class="kt-menu__link-text">BP Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'js') }}" class="kt-menu__link "><span class="kt-menu__link-text">Jasmine Spring Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'padur') }}" class="kt-menu__link "><span class="kt-menu__link-text">Padur Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'siruseri') }}" class="kt-menu__link "><span class="kt-menu__link-text">Siruseri Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'tsai') }}" class="kt-menu__link "><span class="kt-menu__link-text">Tsai Leads</span></a></li>

                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'ameenpur') }}" class="kt-menu__link "><span class="kt-menu__link-text">Ameenpur Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'bachupally') }}" class="kt-menu__link "><span class="kt-menu__link-text">Bachupally Leads</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('leads_index', 'gandimaisamma') }}" class="kt-menu__link "><span class="kt-menu__link-text">Gandimaisamma Leads</span></a></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="kt-menu__item {{ (request()->is('fb_leads_index*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="Imported Leads" data-content='Click to view all Imported Leads'><a href="{{ route('fb_leads_index') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-pie-chart-1"></i><span class="kt-menu__link-text">Leads Import</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                <li class="kt-menu__item {{ (request()->is('adwords_api*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="Imported Leads" data-content='Click to view all Imported Leads'><a href="/adwords_api/public/" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-line-chart" target="_blank"></i><span class="kt-menu__link-text">Adwords</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                <li class="kt-menu__item {{ (request()->is('internal_leads_index*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="LP Internal Leads" data-content='Click to view all LP Internal Leads'><a href="{{ route('internal_leads_index') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-pie-chart-2"></i><span class="kt-menu__link-text">LP Leads</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                @if($user->id != 40)
                               <!-- <li class="kt-menu__item {{ (request()->is('exp*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="Digital Expense" data-content='Click to view all Digital Expense'><a href="{{ route('exp_index') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon-safe-shield-protection"></i><span class="kt-menu__link-text">Expense</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>-->
                                
                                
                                
                                
                                
                                <li class="kt-menu__item {{ (request()->is('media*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="Media Library" data-content='Click to view all Media Library'><a href="{{ route('media_bunny_files') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-layers"></i><span class="kt-menu__link-text">Media</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                @endif

                                @auth
                                @if($user->role_id == '1' || $user->role_id == '2')
                                <li class="kt-menu__item  kt-menu__item--bottom-1 {{ (request()->is('users*')) ? 'kt-menu__item--open kt-menu__item--here' : '' }}" data-toggle="kt-popover" data-placement="right" data-title="All Users" data-content='Click to view all user details'>
                                    <a href="{{ route('all_users') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon2-user"></i><span class="kt-menu__link-text">Users</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                @endif
                                @endauth
                                @elseif(Auth::user()->role_id == '3' && Auth::user()->role_id == '17')
                                
                                @else
                                <li class="kt-menu__item" data-toggle="kt-popover" data-placement="right" data-title="UTM Link Generator" data-content='Click to view all UTM Links'><a href="{{ route('utm_index') }}" class="kt-menu__link"><i class="kt-menu__link-icon flaticon-plus"></i><span class="kt-menu__link-text">UTL Generator</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                </li>
                                @endif


                            </ul>
                        </div>
                    </div>

                    <!-- end:: Aside Menu -->
                </div>
                <div class="kt-aside-menu-overlay"></div>

                <!-- end:: Aside -->
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

                    <!-- begin:: Header -->
                    <div id="kt_header" class="kt-header kt-grid kt-grid--ver  kt-header--fixed ">

                        <!-- begin: Header Menu -->
                        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                        @include('includes.main_sidebar')
                        <!-- begin:: Header Topbar -->
                        <div class="kt-header__topbar">

                            <!--begin: Search -->
                            <div class="kt-header__topbar-item">
                                @php 
                                $start_time = \App\Attendance::whereDay('start_date', date('d'))->where('user_id', $user->id)->whereNull('end_date')->first(); 
                                @endphp
                                @if(!empty($start_time))
                                <span class="kt-menu__link kt-menu__toggle quick_add_work"><i class="kt-menu__hor-arrow la la-clock-o"></i> <span class="display_work_timer">{{ $start_time->start_date }}</span></span>
                                <a href="{{ route('stop_work') }}" class="kt-menu__link kt-menu__toggle quick_add_work_stop" style="padding: 7px !important;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path style="fill: #ffffff !important;" d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#ffffff" fill-rule="nonzero" opacity="0.9"/>
    </g>
</svg></a>
                                @else
                                <a href="{{ route('start_work') }}" class="kt-menu__link kt-menu__toggle quick_add_work">Start work <i class="la la-angle-right"></i></a>
                                @endif
                            </div>
                            <div class="kt-header__topbar-item kt-header__topbar-item--search">
                                <div class="kt-header__topbar-wrapper">
                                    <div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact" id="kt_quick_search_inline">
                                        <form method="get" class="kt-quick-search__form">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                                                <input type="text" class="form-control kt-quick-search__input header_quick-search__input" placeholder="Search..." >
                                                <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close" style="display: none;"></i></span></div>
                                            </div>
                                        </form>
                                        <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,10px"></div>
                                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                                            <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Quick actions -->
                            @auth
                            <!--begin: User bar -->
                            <div class="kt-header__topbar-item kt-header__topbar-item--user">
                                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                    <span class="kt-hidden kt-header__topbar-welcome">Hi,</span>
                                    <span class="kt-hidden kt-header__topbar-username">Nick</span>
                                    <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_21.jpg') }}" />
                                    <span class="kt-header__topbar-icon"><i class="flaticon2-user-outline-symbol"></i></span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                    <!--begin: Head -->
                                    <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                        <div class="kt-user-card__avatar">
                                            <img class="kt-hidden-" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg') }}" />

                                            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                                        </div>
                                        <div class="kt-user-card__name">
                                            {{ Auth::user()->name }}
                                        </div>
                                        <!-- <div class="kt-user-card__badge">
                                            <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>
                                        </div> -->
                                    </div>

                                    <!--end: Head -->

                                    <!--begin: Navigation -->
                                    <div class="kt-notification">
                                        <a href="{{ url('/profile/') }}/{{ $user->id }}" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-calendar-3 kt-font-success"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    My Profile
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Account settings and more
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-mail kt-font-warning"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    My Messages
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Inbox and tasks
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-rocket-1 kt-font-danger"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    My Activities
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    Logs and notifications
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#" class="kt-notification__item">
                                            <div class="kt-notification__item-icon">
                                                <i class="flaticon2-hourglass kt-font-brand"></i>
                                            </div>
                                            <div class="kt-notification__item-details">
                                                <div class="kt-notification__item-title kt-font-bold">
                                                    My Tasks
                                                </div>
                                                <div class="kt-notification__item-time">
                                                    latest tasks and projects
                                                </div>
                                            </div>
                                        </a>
                                        <div class="kt-notification__custom kt-space-between">
                                            <a href="{{ url('/logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                        </div>
                                    </div>

                                    <!--end: Navigation -->
                                </div>
                            </div>
                            @endauth

                            <!--end: User bar -->

                            <!--begin: Quick panel toggler -->
<!--                             <div class="kt-header__topbar-item kt-header__topbar-item--quickpanel" data-toggle="kt-tooltip" title="Quick panel" data-placement="top">
                                <div class="kt-header__topbar-wrapper">
                                    <span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn"><i class="flaticon2-cube-1"></i></span>
                                </div>
                            </div> -->

                            <!--end: Quick panel toggler -->
                        </div>

                        <!-- end:: Header Topbar -->
                    </div>

                    <!-- end:: Header -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        
                                @if($message = Session::get('leads_added'))
                                <div class="alert alert-success fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $message }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                @if($message = Session::get('gloabl_work_timer_stoped'))
                                <div class="alert alert-success fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $message }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                <div id="show_timer_stop"></div>
@yield('content')
                       
                        <!-- end:: Subheader -->


                        <!-- end:: Content -->
                    </div>

                    <!-- begin:: Footer -->
                    <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                        <div class="kt-container  kt-container--fluid ">
                            <div class="kt-footer__copyright">
                                &copy;&nbsp; <?php echo date('Y'); ?>&nbsp; Task Management System |&nbsp;&nbsp;<a href="mailto:vijay.cs@alliancein.com" target="_blank" class="kt-link"> Developed by Web Team</a>
                            </div>
                            <div class="kt-footer__menu">
                                <a href="#" target="_blank" class="kt-footer__menu-link kt-link">Powered By Alliance Digital Labs</a>
                            </div>
                        </div>
                    </div>

                    <!-- end:: Footer -->
                </div>
            </div>
        </div>
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
        <div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="kt-chat">
                        <div class="kt-portlet kt-portlet--last">
                            <div class="kt-portlet__head">
                                <div class="kt-chat__head ">
                                    <div class="kt-chat__left">
                                        <div class="kt-chat__label">
                                            <a href="#" class="kt-chat__title">Jason Muller</a>
                                            <span class="kt-chat__status">
                                                <span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
                                            </span>
                                        </div>
                                    </div>
                                    <div class="kt-chat__right">
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="flaticon-more-1"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-md">

                                                <!--begin::Nav-->
                                                <ul class="kt-nav">
                                                    <li class="kt-nav__head">
                                                        Messaging
                                                        <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-group"></i>
                                                            <span class="kt-nav__link-text">New Group</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-open-text-book"></i>
                                                            <span class="kt-nav__link-text">Contacts</span>
                                                            <span class="kt-nav__link-badge">
                                                                <span class="kt-badge kt-badge--brand  kt-badge--rounded-">5</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-bell-2"></i>
                                                            <span class="kt-nav__link-text">Calls</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                                            <span class="kt-nav__link-text">Settings</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__item">
                                                        <a href="#" class="kt-nav__link">
                                                            <i class="kt-nav__link-icon flaticon2-protected"></i>
                                                            <span class="kt-nav__link-text">Help</span>
                                                        </a>
                                                    </li>
                                                    <li class="kt-nav__separator"></li>
                                                    <li class="kt-nav__foot">
                                                        <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                                        <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                                    </li>
                                                </ul>

                                                <!--end::Nav-->
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                                            <i class="flaticon2-cross"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-scroll kt-scroll--pull" data-height="410" data-mobile-height="225">
                                    <div class="kt-chat__messages kt-chat__messages--solid">
                                        <div class="kt-chat__message kt-chat__message--success">
                                            <div class="kt-chat__user">
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/100_12.jpg') }}" alt="image">
                                                </span>
                                                <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                                <span class="kt-chat__datetime">2 Hours</span>
                                            </div>
                                            <div class="kt-chat__text">
                                                How likely are you to recommend our company<br> to your friends and family?
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                            <div class="kt-chat__user">
                                                <span class="kt-chat__datetime">30 Seconds</span>
                                                <a href="#" class="kt-chat__username">You</span></a>
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/300_21.jpg') }}" alt="image">
                                                </span>
                                            </div>
                                            <div class="kt-chat__text">
                                                Hey there, we’re just writing to let you know that you’ve<br> been subscribed to a repository on GitHub.
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--success">
                                            <div class="kt-chat__user">
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/100_12.jpg') }}" alt="image">
                                                </span>
                                                <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                                <span class="kt-chat__datetime">30 Seconds</span>
                                            </div>
                                            <div class="kt-chat__text">
                                                Ok, Understood!
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                            <div class="kt-chat__user">
                                                <span class="kt-chat__datetime">Just Now</span>
                                                <a href="#" class="kt-chat__username">You</span></a>
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/300_21.jpg') }}" alt="image">
                                                </span>
                                            </div>
                                            <div class="kt-chat__text">
                                                You’ll receive notifications for all issues, pull requests!
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--success">
                                            <div class="kt-chat__user">
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/100_12.jpg') }}" alt="image">
                                                </span>
                                                <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                                <span class="kt-chat__datetime">2 Hours</span>
                                            </div>
                                            <div class="kt-chat__text">
                                                You were automatically <b class="kt-font-brand">subscribed</b> <br>because you’ve been given access to the repository
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                            <div class="kt-chat__user">
                                                <span class="kt-chat__datetime">30 Seconds</span>
                                                <a href="#" class="kt-chat__username">You</span></a>
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/300_21.jpg') }}" alt="image">
                                                </span>
                                            </div>
                                            <div class="kt-chat__text">
                                                You can unwatch this repository immediately <br>by clicking here: <a href="#" class="kt-font-bold kt-link"></a>
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--success">
                                            <div class="kt-chat__user">
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/100_12.jpg') }}" alt="image">
                                                </span>
                                                <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                                <span class="kt-chat__datetime">30 Seconds</span>
                                            </div>
                                            <div class="kt-chat__text">
                                                Discover what students who viewed Learn <br>Figma - UI/UX Design Essential Training also viewed
                                            </div>
                                        </div>
                                        <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                            <div class="kt-chat__user">
                                                <span class="kt-chat__datetime">Just Now</span>
                                                <a href="#" class="kt-chat__username">You</span></a>
                                                <span class="kt-media kt-media--circle kt-media--sm">
                                                    <img src="{{ asset('assets/media/users/300_21.jpg') }}" alt="image">
                                                </span>
                                            </div>
                                            <div class="kt-chat__text">
                                                Most purchased Business courses during this sale!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-chat__input">
                                    <div class="kt-chat__editor">
                                        <textarea placeholder="Type here..." style="height: 50px"></textarea>
                                    </div>
                                    <div class="kt-chat__toolbar">
                                        <div class="kt_chat__tools">
                                            <a href="#"><i class="flaticon2-link"></i></a>
                                            <a href="#"><i class="flaticon2-photograph"></i></a>
                                            <a href="#"><i class="flaticon2-photo-camera"></i></a>
                                        </div>
                                        <div class="kt_chat__actions">
                                            <button type="button" class="btn btn-brand btn-md  btn-font-sm btn-upper btn-bold kt-chat__reply">reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>

        <!--end::Global Theme Bundle -->

        <!--begin::Page Vendors(used by this page) -->
        <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>

        <!--end::Page Vendors -->

        <!--begin::Page Scripts(used by this page) -->
        {{-- <script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script> --}}
        <script src="{{ asset('assets/js/jquery.plugin.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/jquery.countdown.min.js') }}" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-fullscreen-plugin/1.1.5/jquery.fullscreen.min.js" integrity="sha512-K3XxLG4CK66UrbadMP1F2dd3VyMupXbBeiP2yKuN/MrV4jhxJbSRkQPgu0WFlzAD4KGWuOkAqqkdDouGfBptsg==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
        <!--end::Page Scripts -->
        <script type="text/javascript">
            function close_work_timer(start_time, end_time) {
                
                var dt = new Date();

                //convert both time into timestamp
                var stt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + start_time);

                stt = stt.getTime();
                var endt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + end_time);
                endt = endt.getTime();

                var time = dt.getTime();
                if(time > stt && time < endt){
                    $("#show_timer_stop").append(
                        '<div class="alert alert-warning fade show" role="alert" style="margin: 25px 25px 0px;"><div class="alert-icon"><i class="la la-close"></i></div><div class="alert-text"></div>Today Timer going to end. Please stop the timer on 6:30PM <a href="{{ route('stop_work') }}" class="btn btn-danger btn-sm btn-font-sm">Stop Work</a><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="la la-close"></i></span></button></div></div>');

                } 
                // else {
                //     $("#a").append("<br> Expire BOx ");

                // }
        };
            function close_work_timer_force(start_time, end_time) {
                
                var dt = new Date();

                //convert both time into timestamp
                var stt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + start_time);

                stt = stt.getTime();
                var endt = new Date((dt.getMonth() + 1) + "/" + dt.getDate() + "/" + dt.getFullYear() + " " + end_time);
                endt = endt.getTime();

                var time = dt.getTime();
                if (time > stt && time < endt) {
                    $.get('{{ route('stop_work_remote') }}');
                    // location.reload();
                    window.location.reload();
                }
        };
            // setInterval(function(){
            //     close_work_timer("18:24:00", "18:29:00");
            // }, 180000);
            // setInterval(function(){ 
            //     close_work_timer_force("18:30:00", "18:30:05");
            // }, 5000);

            $(document).ready(function () {

                  $('.dataTable').each(function(){
                        if($(this).find('thead').width() < $(this).width()){
                            let tr_count = $(this).find('thead th').length;
                            let find_width = $(this).width()/tr_count;
                            $(this).find('thead th').attr('width', find_width);
                        }
                        // alert('Table working');
                        // $(this).find('tbody').attr('width', $(this).width()+'px');
                    });
                

                $('.plot_project').hide();
                $('.omr_project').hide();
                $('#select_project').change(function(){
                    if($(this).val() == 'vib'){
                        $('.plot_project').show();
                        $('.omr_project').hide();
                    }
                    else if($(this).val() == 'siruseri'){
                        $('.omr_project').show();
                        $('.plot_project').hide();
                    }
                    else{
                        $('.plot_project').hide();
                        $('.omr_project').hide();
                    }
                });
            // $('#kt_table_1').each(function(){
                // $(this).find('tbody').attr('width', $(this).width()+'px');
            // });

            // $('#kt_table_1').each(function(){
            //     if($(this).find('thead').width() < $(this).width()){
            //         let tr_count = $(this).find('thead th').length;
            //         let find_width = $(this).width()/tr_count;
            //         $(this).find('thead th').attr('width', find_width);
            //     }
            //     // $(this).find('tbody').attr('width', $(this).width()+'px');
            // });

            @if(!empty($start_time))
                var startOrderDate = new Date('{{ $start_time->start_date }}');
                $('.display_work_timer').countdown({
                    since: startOrderDate,
                    layout: '<span class="order_countdown">{hnn}{sep}{mnn}{sep}{snn}</span>',
                    format: 'HMS'
                });
            @endif

            });
            var is_fullscreen = Cookies.get('fullscreen');
            $('#fullscreen').click(function(){
                if(is_fullscreen == true){
                    // alert('FullScreen Closed!');
                    $.fullscreen.exit();
                    Cookies.remove('fullscreen');
                }
                else{
                    // alert('FullScreen Open!');
                    Cookies.set('fullscreen', true);
                    $(document).fullScreen(true);
                }
            });
            var window_height = $(window).height();
            var window_width = $(window).width();
            var screen_size = window_width +'x'+ window_height;
            Cookies.set('screen', screen_size);

        </script>

@yield('footer_js')
    </body>

    <!-- end::Body -->
</html>