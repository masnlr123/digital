
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
                        @endif</div>@endforeach</div>
                                    </div>
                                </div>
                            </div>
                        </div>