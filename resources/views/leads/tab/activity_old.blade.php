
                        <div class="tab-pane" id="kt_portlet_details" role="tabpanel">
                            <div class="row">
                                <div class="kt-widget1 col-md-12">
                                    <div class="kt-list-timeline">
                                        <div class="kt-list-timeline__items">
                                            @foreach($lsq_act as $key => $act_data)
                                            <div class="kt-list-timeline__item"> <span class="kt-list-timeline__badge kt-list-timeline__badge--success"></span>
                                                @if(isset($act_data->Note)) <span class="kt-list-timeline__text">{{ $act_data->Note }}<br>

                        @else
                            <span class="kt-list-timeline__text">{{ $act_data->EventName }}<br>
                        @endif
                        @if(!empty($act_data->EventCode))
                        @if($act_data->EventCode == '3001')
                            <span>
                                Lead Owner changed from <strong>{{ $act_data->Data[0]->Value }}</strong> to <strong>
                                {{ $act_data->Data[1]->Value }}</strong> by <strong>{{ $act_data->Data[2]->Value }}</strong>
                            </span>
                                                @endif @if($act_data->EventCode == '3004') <span>
                                Lead Source changed from <strong>{{ $act_data->Data[0]->Value }}</strong> to <strong>
                                {{ $act_data->Data[1]->Value }}</strong> by <strong>{{ $act_data->Data[2]->Value }}</strong>
                            </span>
                                                @endif @if($act_data->EventCode == '103') <span>
                                <strong>{{ $act_data->Data[2]->Value }}</strong> | Added by <strong>{{ $act_data->Data[0]->Value }}</strong>
                            </span>
                                                @endif @if($act_data->EventCode == '2001') <span>
                                Sent {{ $act_data->EmailType }} with subject <strong>{{ $act_data->Data[2]->Value }}</strong> by <strong>{{ $act_data->Data[3]->Value }}</strong>
                            </span>
                                                @endif @if($act_data->EventCode == '212') <span>
                                Lead has been received by <strong>Facebook Form</strong> <button class="btn btn-sm" data-toggle="modal" data-target="#model_fb_detais"><i class="fa fa-angle-double-right"></i> For more details</button>

                            <div class="modal fade" id="model_fb_detais" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $act_data->EventName }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <table class="table table-striped table-success">
                                                    <tr>
                                                        <td>Campaign</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Page</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_2 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Form</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_3 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ad Name</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_4 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ad Set</td>
                                                        <td>{{ $act_data->ActivityFields->mx_Custom_5 }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </span>
                                                @endif @if($act_data->EventCode == '211') <span>
                                <strong>Note : </strong>
                                {{ $act_data->Data[2]->Value }} | <span style="font-style: italic;"> Added By {{ $act_data->Data[0]->Value }}</strong>
                            </span>
                                                </span>@endif @if($act_data->EventCode == '22') @if($act_data->Data[0]->Value == 'InComplete') <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Did not answer a call by {{ $act_data->Data[1]->Value }} @if(isset($act_data->ActivityFields->mx_Custom_1)) through {{ $act_data->ActivityFields->mx_Custom_1 }}@endif.</strong>
                            </span>
                                                </span>@elseif($act_data->Data[0]->Value == 'Complete') <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--success kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Was called by {{ $act_data->Data[1]->Value }} @if(isset($act_data->ActivityFields->mx_Custom_1)) through {{ $act_data->ActivityFields->mx_Custom_1 }}. Duration {{ $act_data->Data[2]->Value }} Sec @endif</strong>
                                <audio controls>
                                <source src="{{ $act_data->Data[3]->Value }}" type="audio/ogg">
                                </audio>
                            </span>
                                                </span>@endif @endif @if($act_data->EventCode == '21') @if($act_data->Data[0]->Value == 'InComplete') <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--warning kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Call not answer with {{ $act_data->Data[1]->Value }} through {{ $act_data->ActivityFields->mx_Custom_1 }}.</strong>
                            </span>
                                                </span>@elseif($act_data->Data[0]->Value == 'Complete') <span>
                                <strong>Status : </strong>
                                <span class="kt-badge kt-badge--success kt-badge--inline">{{ $act_data->Data[0]->Value }}</span> | <span style="font-style: italic;"> Had a phone call with {{ $act_data->Data[1]->Value }}. Duration {{ $act_data->Data[2]->Value }} Sec</strong>
                                <audio controls>
                                <source src="{{ $act_data->Data[3]->Value }}" type="audio/ogg">
                                </audio>
                            </span>
                                                </span>@endif @endif @if($act_data->EventCode == '3002') <span>
                                Lead Stage changed from <strong>
                                {{ $act_data->Data[0]->Value }}</strong> to <strong>{{ $act_data->Data[1]->Value }}</strong> | <span style="font-style: italic;"> by <strong>{{ $act_data->Data[2]->Value }}</strong> Comment:{{ $act_data->Data[3]->Value }}
                            </span>
                                                </span>@endif @endif</span> <span class="kt-list-timeline__time">{{ $act_data->CreatedOn }}</span>
                                            </div>@endforeach</div>
                                    </div>
                                </div>
                            </div>
                        </div>