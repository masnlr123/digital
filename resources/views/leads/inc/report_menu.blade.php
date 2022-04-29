<div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-toolbar">
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link @if($current_route_name == 'audit_index') active @endif" href="{{ route('audit_index') }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>Overall Reports
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link @if($current_route_name == 'agent_report') active @endif" href="{{ route('agent_report') }}">
                                                    <i class="fa fa-user" aria-hidden="true"></i>Reports By Agent
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link @if($current_route_name == 'red_alert') active @endif" href="{{ route('red_alert') }}">
                                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Red Alert
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link @if($current_route_name == 'zero_tolerance') active @endif" href="{{ route('zero_tolerance') }}">
                                                    <i class="fa fa-user-times" aria-hidden="true"></i>Zero Tolerance
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>