<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
    @if($user->id != 40)
                            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout- ">
                                <ul class="kt-menu__nav ">
                                    @auth
                                    @if(in_array(Auth::user()->role_id, array('1', '2', '4', '5', '6', '7', '8', '16')))
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="{{ url('/projects') }}" class="kt-menu__link"><span class="kt-menu__link-text">Projects</span><!-- <i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i> --></a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="{{ route('media_plan_list') }}" class="kt-menu__link"><span class="kt-menu__link-text">Media Plans</span><!-- <i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i> --></a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="{{ route('all_ad_camp_index') }}" class="kt-menu__link"><span class="kt-menu__link-text">Ad Campaigns</span><!-- <i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i> --></a>
                                    </li>
                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="{{ route('task_list_index', 'all') }}" class="kt-menu__link"><span class="kt-menu__link-text">All Task</span></a>
                                    </li>
                                    <!--<li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Creative Reports</span></a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('get_creative_report') }}?project=all" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-rocket"></i><span class="kt-menu__link-text">All Projects (Long Req)</span></a></li>
                                                @foreach(config('dtms.projects') as $project => $shortcode)
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('get_creative_report') }}?project={{ $shortcode }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-rocket"></i><span class="kt-menu__link-text">{{ $project }}</span></a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>-->
                                    
                                    
                                    <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle quick_add_menu" style="background: #8BC34F;"><i class="kt-menu__hor-arrow la la-plus"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                            <ul class="kt-menu__subnav">
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('carbon_index', 'all') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-rocket"></i><span class="kt-menu__link-text">New Task</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('utm_create') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-rocket"></i><span class="kt-menu__link-text">New UTM Link</span></a></li>
                                                <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('exp_create') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-rocket"></i><span class="kt-menu__link-text">New Expense</span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="kt-menu__item" data-toggle="kt-popover" data-placement="bottom" data-title="Mail Inbox" data-content='Click to view all Mail Inbox'><a href="{{ route('mail_inbox') }}" class="kt-menu__link quick_add_menu" style="background: #f18686;"><i class="kt-menu__hor-arrow la la-envelope"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    </li>
                                    
                                    @endif
                                    @if(in_array(Auth::user()->role_id, array('3', '17')))

                                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="{{ route('media_plan_list') }}" class="kt-menu__link"><span class="kt-menu__link-text">Media Plans</span><!-- <i class="kt-menu__hor-arrow la la-angle-down"></i><i class="kt-menu__ver-arrow la la-angle-right"></i> --></a>
                                    </li>
                                    @endif
                                    @endauth
                                </ul>
                            </div>
                            @endif
                        </div>
                        <!-- end: Header Menu -->
