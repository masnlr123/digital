@php
$get_metrix = json_decode($campaigns->metrix);
@endphp
        @if(!empty($pre_camp))
        @if(count($pre_camp) >=1)
        @foreach($pre_camp as $campaign)
        @if($campaign->actuals)
        @php 
        $actuals = json_decode($campaign->actuals);
        $pre_metrix = json_decode($campaign->metrix);
        $box_total_budget = str_replace(',', '', $pre_metrix->total_budget);
        $box_1_price = str_replace(',', '', $pre_metrix->total_spend);
        $box_2_price = str_replace(',', '', $pre_metrix->total_rev);
        $box_3_price = str_replace(',', '', $pre_metrix->total_cpl);
        $box_4_price = str_replace(',', '', $pre_metrix->total_cpw);
        $box_5_price = str_replace(',', '', $pre_metrix->total_cps);
        $box_cpvl = round($box_1_price/$pre_metrix->total_valid_leads);
        $box_cpvl = round($box_1_price/$pre_metrix->total_valid_leads);
        // $total_cpvl = round(str_replace(',', '', $pre_metrix->total_budget)/$get_metrix->total_valid_leads);
        // $box_6_price = str_replace(',', '', $pre_metrix->total_spend);
        @endphp
        {{-- <div class="row media_plan_result dashboard_report mb-5">
            <div class="col-12">
                <h4 style="font-size: 16px;padding-left: 10px;margin-top: 10px;margin-bottom: 11px;color: #9c27b0;font-weight: bold;">Target VS Actuals | {{ $campaign->name }} ({{ $pre_month }})</h4>
            </div>
            <div class="col-sm-4 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_6 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Budget</h3>
                                <p class="kt-callout__desc">
                                    <span class="total_lead_count metrix_old_value"><i class="fa fa-rupee-sign"></i> <span class="text_value">{{ $pre_metrix->total_spend }}</span> 
                                    @if(round($campaigns->getPercentageChange($actuals->budget, $box_1_price))<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->budget, $box_1_price), 3) }}%</span></span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->budget, $box_1_price), 3) }}%</span></span>
                                    @endif

                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i> {{ $actuals->budget }} </span>
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
                                    <span class="product_knowledge_count metrix_old_value">
                                        {{ $pre_metrix->total_leads }}
                                        @if(round($campaigns->getPercentageChange($actuals->leads, $pre_metrix->total_leads), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->leads, $pre_metrix->total_leads), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->leads, $pre_metrix->total_leads), 3) }}%</span>
                                    @endif

                                    </span>
                                    <span class="lead_count product_knowledge_count">{{ $actuals->leads }}</span>
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
                                    <span class="lms_update_count metrix_old_value">
                                        {{ $pre_metrix->total_valid_leads }}
                                        @if(round($campaigns->getPercentageChange($actuals->valid_leads, $pre_metrix->total_valid_leads), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->valid_leads, $pre_metrix->total_valid_leads), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->valid_leads, $pre_metrix->total_valid_leads), 3) }}%</span>
                                    @endif

                                    </span>
                                    <span class="lead_count lms_update_count">{{ $actuals->valid_leads }}</span>
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
                                <h3 class="kt-callout__title">Valid Leads %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lms_update_count metrix_old_value">
                                        {{ $pre_metrix->valid_valid_leads_per }}%

                                        @if(round($campaigns->getPercentageChange($actuals->valid_leads_per, $pre_metrix->valid_valid_leads_per), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->valid_leads_per, $pre_metrix->valid_valid_leads_per), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->valid_leads_per, $pre_metrix->valid_valid_leads_per), 3) }}%</span>
                                    @endif


                                    </span>
                                    <span class="lead_count lms_update_count">{{ $actuals->valid_leads_per }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_18 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Walk-In</h3>
                                <p class="kt-callout__desc">
                                    <span class="total_score metrix_old_value">
                                        {{ $pre_metrix->total_walk_in }}

                                        @if(round($campaigns->getPercentageChange($actuals->walk_in, $pre_metrix->total_walk_in), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->walk_in, $pre_metrix->total_walk_in), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->walk_in, $pre_metrix->total_walk_in), 3) }}%</span>
                                    @endif

                                    </span>
                                    <span class="lead_count total_score">{{ $actuals->walk_in }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_12 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Sales</h3>
                                <p class="kt-callout__desc">
                                    <span class="lms_update_count metrix_old_value">
                                        {{ $pre_metrix->total_sales }}

                                        @if(round($campaigns->getPercentageChange($actuals->sales, $pre_metrix->total_sales), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->sales, $pre_metrix->total_sales), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->sales, $pre_metrix->total_sales), 3) }}%</span>
                                    @endif

                                    </span>
                                    <span class="lead_count lms_update_count">{{ $actuals->sales }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_2 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Revenue</h3>
                                <p class="kt-callout__desc">
                                    <span class="lms_update_count metrix_old_value"><i class="fa fa-rupee-sign"></i> 
                                        {{ $pre_metrix->total_rev }}

                                        @if(round($campaigns->getPercentageChange($actuals->revenue, $box_2_price), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->revenue, $box_2_price), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->revenue, $box_2_price), 3) }}%</span>
                                    @endif

                                    </span>
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $actuals->revenue }}</span>
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
                                    <span class="lms_update_count metrix_old_value"><i class="fa fa-rupee-sign"></i> 
                                        {{ $pre_metrix->total_cpl }}


                                        @if(round($campaigns->getPercentageChange($actuals->cpl, $box_3_price), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->cpl, $box_3_price), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->cpl, $box_3_price), 3) }}%</span>
                                    @endif


                                    </span>
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $actuals->cpl }}</span>
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
                                <h3 class="kt-callout__title">Cost Per Valid Lead</h3>
                                <p class="kt-callout__desc">
                                    <span class="total_lead_count metrix_old_value"><i class="fa fa-rupee-sign"></i>
                                    </span>
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>{{ $actuals->cpvl }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_5 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Cost Per Walk-in</h3>
                                <p class="kt-callout__desc">
                                    <span class="lms_update_count metrix_old_value"><i class="fa fa-rupee-sign"></i> 
                                        {{ $pre_metrix->total_cpw }}

                                        @if(round($campaigns->getPercentageChange($actuals->cpw, $box_4_price), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->cpw, $box_4_price), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->cpw, $box_4_price), 3) }}%</span>
                                    @endif

                                    </span>
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $actuals->cpw }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_4 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Cost Per Sale</h3>
                                <p class="kt-callout__desc">
                                    <span class="lms_update_count metrix_old_value"><i class="fa fa-rupee-sign"></i> {{ $pre_metrix->total_cps }}


                                        @if(round($campaigns->getPercentageChange($actuals->cps, $box_5_price), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->cps, $box_5_price), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->cps, $box_5_price), 3) }}%</span>
                                    @endif

                                </span>
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $actuals->cps }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><div class="col-sm-2 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_7 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Sales on Revenue</h3>
                                <p class="kt-callout__desc">
                                    <span class="total_lead_count metrix_old_value">{{ round($pre_metrix->total_sor, 2) }}%

                                        @if(round($campaigns->getPercentageChange($actuals->sor, round($pre_metrix->total_sor, 2)), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->sor, round($pre_metrix->total_sor, 2)), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->sor, round($pre_metrix->total_sor, 2)), 3) }}%</span>
                                    @endif

                                </span>
                                    <span class="lead_count total_lead_count">{{ $actuals->sor }}%</span>
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
                                    <span class="soft_skills_count metrix_old_value">{{ round($pre_metrix->total_vltw) }}%

                                        @if(round($campaigns->getPercentageChange($actuals->vltw, round($pre_metrix->total_vltw, 2)), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->vltw, round($pre_metrix->total_vltw, 2)), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->vltw, round($pre_metrix->total_vltw, 2)), 3) }}%</span>
                                    @endif

                                </span>
                                    <span class="lead_count soft_skills_count">{{ $actuals->vltw }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 table-contents pr-0  pl-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">WTS %</h3>
                                <p class="kt-callout__desc">
                                    <span class="total_lead_count metrix_old_value">{{ round($pre_metrix->total_wts) }}%

                                        @if(round($campaigns->getPercentageChange($actuals->wts, round($pre_metrix->total_wts, 2)), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->wts, round($pre_metrix->total_wts, 2)), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->wts, round($pre_metrix->total_wts, 2)), 3) }}%</span>
                                    @endif

                                </span>
                                    <span class="lead_count total_lead_count">{{ $actuals->wts }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_1 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">VLTS %</h3>
                                <p class="kt-callout__desc">
                                    <span class="product_knowledge_count metrix_old_value">{{ round($pre_metrix->total_vlts) }}%

                                        @if(round($campaigns->getPercentageChange($actuals->wts, round($pre_metrix->total_wts, 2)), 3)<0)
                                    <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px;"></i>
                                    <span class="per_text">{{ round($campaigns->getPercentageChange($actuals->wts, round($pre_metrix->total_wts, 2)), 3) }}%</span>
                                    @else
                                    <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #139c19 !important;"></i>
                                    <span class="per_text" style="color: #139c19 !important;">{{ round($campaigns->getPercentageChange($actuals->wts, round($pre_metrix->total_wts, 2)), 3) }}%</span>
                                    @endif

                                </span>
                                    <span class="lead_count product_knowledge_count">{{ $actuals->vlts }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div class="col-12"> --}}
                <h4 style="font-size: 16px;padding-left: 10px;margin-top: 10px;margin-bottom: 11px;color: #9c27b0;font-weight: bold;">Target VS Actuals | {{ $campaign->name }} ({{ $pre_month }})
                    <span class="actuals_action_list">
                        <a href="#" data-toggle="modal" data-target="#edit_actuals"><i class="fas fa-edit"></i></a>
                        <a style="padding-left: 10px;" href="{{ route('delete_actuals', $campaign->id) }}"><i class="fas fa-trash"></i></a>
                    </span>
                </h4>
                <div class="modal fade" id="edit_actuals">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <form action="{{ route('update_actuals', $campaign->id) }}" method="post">
                                @csrf
                                <div class="modal-header" style="display: block;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title">Update Actuals for <span class="text-info">{{ $campaign->name }} ({{ $campaign->month }})</span></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-4 mb-3"><label>Budget</label><input type="number" name="actuals[budget]" class="form-control" required value="{{ $actuals->budget }}"></div>
                                        <div class="col-2 mb-3"><label>Leads</label><input type="number" name="actuals[leads]" class="form-control" required value="{{ $actuals->leads }}"></div>
                                        <div class="col-2 mb-3"><label>Valid Leads</label><input type="number" name="actuals[valid_leads]" class="form-control" required value="{{ $actuals->valid_leads }}"></div>
                                        {{-- <div class="col-2 mb-3"><label>Valid Leads Per</label><input type="number" name="actuals[valid_leads_per]" class="form-control" required></div> --}}
                                        <div class="col-2 mb-3"><label>Walk-in</label><input type="number" name="actuals[walk_in]" class="form-control" required value="{{ $actuals->walk_in }}"></div>
                                        <div class="col-2 mb-3"><label>Sales</label><input type="number" name="actuals[sales]" class="form-control" required value="{{ $actuals->sales }}"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Close</button>
                                    <button class="btn btn-primary"><i class="la la-save"></i> Update Actuals</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            {{-- </div> --}}
        <table class="table table-bordered" style="margin-bottom: 7px;">
            <tbody>
                <tr class="header_row">
                    <td class="review_box_1 header" colspan="3">Budget
                        @if(round(($actuals->budget/$box_1_price)*100, 2)>110)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_2 header" colspan="3">Leads
                        @if(round(($actuals->leads/$pre_metrix->total_leads)*100)<80)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_3 header" colspan="3">Valid Leads
                        @if(round(($actuals->valid_leads/$pre_metrix->total_valid_leads)*100)<70)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_4 header" colspan="3">Valid Leads %
                        @if(round($campaigns->getPercentageChange($actuals->valid_leads_per, $pre_metrix->valid_valid_leads_per), 2)<0)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_5 header" colspan="3">CPL

                        @if(round($campaigns->getPercentageChange($actuals->cpl, $box_3_price), 2)>10)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_6 header" colspan="3">CPVL

                        @if(round($campaigns->getPercentageChange($actuals->cpl, $box_3_price), 2)>10)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="review_box_1 text_val">Target</td>
                    <td class="review_box_1 text_val">Actual</td>
                    <td class="review_box_1 text_per" align="middle" rowspan="2">{{ round(($actuals->budget/$box_1_price)*100, 2)}}%</td>
                    <td class="review_box_2 text_val">Target</td>
                    <td class="review_box_2 text_val">Actual</td>
                    <td class="review_box_2 text_per" rowspan="2">{{ round(($actuals->leads/$pre_metrix->total_leads)*100)}}%</td>
                    <td class="review_box_3 text_val">Target</td>
                    <td class="review_box_3 text_val">Actual</td>
                    <td class="review_box_3 text_per" rowspan="2">{{ round(($actuals->valid_leads/$pre_metrix->total_valid_leads)*100)}}%</td>
                    <td class="review_box_4 text_val">Target</td>
                    <td class="review_box_4 text_val">Actual</td>
                    <td class="review_box_4 text_per" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->valid_leads_per, $pre_metrix->valid_valid_leads_per), 2) }}%</td>
                    <td class="review_box_5 text_val">Target</td>
                    <td class="review_box_5 text_val">Actual</td>
                    <td class="review_box_5 text_per" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->cpl, $box_3_price), 2) }}%</td>
                    <td class="review_box_6 text_val">Target</td>
                    <td class="review_box_6 text_val">Actual</td>
                    <td class="review_box_6 text_per" align="middle" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->cpvl, $box_cpvl), 2) }}%</td>
                </tr>
                <tr>
                    <td class="review_box_1 text_val"><i class="fa fa-rupee-sign"></i>{{ $pre_metrix->total_spend }}</td>
                    <td class="review_box_1 text_val"><i class="fa fa-rupee-sign"></i>{{ $campaigns->ind_money($actuals->budget) }}</td>
                    <td class="review_box_2 text_val">{{ $pre_metrix->total_leads }}</td>
                    <td class="review_box_2 text_val">{{ $actuals->leads }}</td>
                    <td class="review_box_3 text_val">{{ $pre_metrix->total_valid_leads }}</td>
                    <td class="review_box_3 text_val">{{ $actuals->valid_leads }}</td>
                    <td class="review_box_4 text_val">{{ $pre_metrix->valid_valid_leads_per }}</td>
                    <td class="review_box_4 text_val">{{ $actuals->valid_leads_per }}</td>
                    <td class="review_box_5 text_val"><i class="fa fa-rupee-sign"></i>{{ $pre_metrix->total_cpl }}</td>
                    <td class="review_box_5 text_val"><i class="fa fa-rupee-sign"></i>{{ $campaigns->ind_money($actuals->cpl) }}</td>
                    <td class="review_box_6 text_val"><i class="fa fa-rupee-sign"></i>{{ $campaigns->ind_money($box_cpvl) }}</td>
                    <td class="review_box_6 text_val"><i class="fa fa-rupee-sign"></i>{{ $campaigns->ind_money($actuals->cpvl) }}</td>
                </tr>
                <tr class="header_row">
                    <td class="review_box_7 header" colspan="3">Walk-In</td>
                    <td class="review_box_8 header" colspan="3">Sales</td>
                    <td class="review_box_9 header" colspan="3">CPW

                        @if(round($campaigns->getPercentageChange($actuals->cpw, $box_4_price), 2)<0)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #33ff33;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #ff0202 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_10 header" colspan="3">CPS

                        @if(round($campaigns->getPercentageChange($actuals->cps, $box_5_price), 2)<0)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color:#33ff33 ;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #ff0202 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_11 header" colspan="3">VLTW%

                        @if(round($campaigns->getPercentageChange($actuals->vltw, $pre_metrix->total_vltw), 2)<0)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                    <td class="review_box_12 header" colspan="3">VLTS%

                        @if(round($campaigns->getPercentageChange($actuals->vlts, $pre_metrix->total_vlts), 2)<0)
                        <i class="fa fa-arrow-alt-circle-down" style="margin-left: 15px;margin-right: 5px; color: #ff0202;background: #fff;border-radius: 20px;"></i>
                        @else
                        <i class="fa fa-arrow-alt-circle-up" style="margin-left: 15px;margin-right: 5px;color: #33ff33 !important;"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="review_box_7 text_val">Target</td>
                    <td class="review_box_7 text_val">Actual</td>
                    <td class="review_box_7 text_per" rowspan="2">{{ round(($actuals->walk_in/$pre_metrix->total_walk_in)*100)}}%</td>
                    <td class="review_box_8 text_val">Target</td>
                    <td class="review_box_8 text_val">Actual</td>
                    <td class="review_box_8 text_per" rowspan="2">{{ round(($actuals->sales/$pre_metrix->total_sales)*100)}}%</td>
                    <td class="review_box_9 text_val">Target</td>
                    <td class="review_box_9 text_val">Actual</td>
                    <td class="review_box_9 text_per" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->cpw, $box_4_price), 2) }}%</td>
                    <td class="review_box_10 text_val">Target</td>
                    <td class="review_box_10 text_val">Actual</td>
                    <td class="review_box_10 text_per" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->cps, $box_5_price), 2) }}%</td>
                    <td class="review_box_11 text_val">Target</td>
                    <td class="review_box_11 text_val">Actual</td>
                    <td class="review_box_11 text_per" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->vltw, $pre_metrix->total_vltw), 2) }}%</td>
                    <td class="review_box_12 text_val">Target</td>
                    <td class="review_box_12 text_val">Actual</td>
                    <td class="review_box_12 text_per" rowspan="2">{{ round($campaigns->getPercentageChange($actuals->vlts, $pre_metrix->total_vlts), 2) }}%</td>
                </tr>
                <tr>
                    <td class="review_box_7 text_val">{{ $pre_metrix->total_walk_in }}</td>
                    <td class="review_box_7 text_val">{{ $actuals->walk_in }}</td>
                    <td class="review_box_8 text_val">{{ $pre_metrix->total_sales }}</td>
                    <td class="review_box_8 text_val">{{ $actuals->sales }}</td>
                    <td class="review_box_9 text_val"><i class="fa fa-rupee-sign"></i>{{ $pre_metrix->total_cpw }}</td>
                    <td class="review_box_9 text_val"><i class="fa fa-rupee-sign"></i>{{ $campaigns->ind_money($actuals->cpw) }}</td>
                    <td class="review_box_10 text_val"><i class="fa fa-rupee-sign"></i>{{ $pre_metrix->total_cps }}</td>
                    <td class="review_box_10 text_val"><i class="fa fa-rupee-sign"></i>{{ $campaigns->ind_money($actuals->cps) }}</td>
                    <td class="review_box_11 text_val">{{ round($pre_metrix->total_vltw) }}</td>
                    <td class="review_box_11 text_val">{{ $actuals->vltw }}</td>
                    <td class="review_box_12 text_val">{{ round($pre_metrix->total_vlts) }}</td>
                    <td class="review_box_12 text_val">{{ $actuals->vlts }}</td>
                </tr>
            </tbody>
        </table>
        @endif
        @endforeach
        @endif
        @endif

        <div class="row media_plan_result dashboard_report">
            <div class="col-12">
                <h4 style="font-size: 16px;padding-left: 10px;margin-top: 10px;margin-bottom: 11px;color: #9c27b0;font-weight: bold;">Targets for {{ $campaigns->name }} ({{ $campaigns->month }})</h4>
            </div>
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Budget Allocated</h3>
                                <p class="kt-callout__desc">
                                    <!-- <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>[{ getTotalBudgetCount() }]</span> -->
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_budget }} </span>
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
                                <h3 class="kt-callout__title">Spend Projection</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count soft_skills_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_spend }}</span>
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
                                <h3 class="kt-callout__title">Budget Balance</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_lead_count"><i class="fa fa-rupee-sign"></i>{{ $get_metrix->total_budget_balance }}</span>
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
                                    <span class="lead_count product_knowledge_count">{{ $get_metrix->total_leads }}</span>
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
                                <h3 class="kt-callout__title">Total Valid Leads</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->total_valid_leads }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Valid Leads %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->valid_valid_leads_per }}%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Total Walk-In</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_score">{{ $get_metrix->total_walk_in }}</span>
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
                                <h3 class="kt-callout__title">Total Sales</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->total_sales }}</span>
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
                                <h3 class="kt-callout__title">Cost Per Lead</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_cpl }}</span>
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
                                <h3 class="kt-callout__title">Cost Per Valid Lead</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ round(str_replace(',', '', $get_metrix->total_spend)/$get_metrix->total_valid_leads) }}</span>
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
                                <h3 class="kt-callout__title">Cost Per Walk-in</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_cpw }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Cost Per Sale</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_cps }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><div class="col-sm-2 table-contents pr-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Sales on Revenue</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count total_lead_count">{{ $get_metrix->total_sor }}%</span>
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
                                <h3 class="kt-callout__title">VLTW %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count soft_skills_count">{{ $get_metrix->total_vltw }}%</span>
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
                                    <span class="lead_count total_lead_count">{{ $get_metrix->total_wts }}%</span>
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
                                <h3 class="kt-callout__title">VLTS %</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count product_knowledge_count">{{ $get_metrix->total_vlts }}%</span>
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
                                <h3 class="kt-callout__title">Daily Spend</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count"><i class="fa fa-rupee-sign"></i> {{ $get_metrix->total_daily_spend }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 table-contents pl-0">
                <div class="audit_count_box kt-callout audit_count_15 kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Daily Leads</h3>
                                <p class="kt-callout__desc">
                                    <span class="lead_count lms_update_count">{{ $get_metrix->total_daily_leads }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!--begin::Accordion-->
            <div class="col-12 mt-2 milestones-list accordion accordion-light  accordion-svg-icon" id="accordionExample5">
                
    <table class="table table-bordered media_plan_tabl">
        <thead>
            <tr>
                <th>Source</th>
                <th>User</th>
                <th>Budget <i class="fa fa-rupee-sign"></i></th>
                <th>Leads</th>
                <th>Valid</th>
                <th>Valid%</th>
                <th>Walk-In</th>
                <th>Sales</th>
                <th>Rev <i class="fa fa-rupee-sign"></i></th>
                <th>CPL <i class="fa fa-rupee-sign"></i></th>
                <th>CPW <i class="fa fa-rupee-sign"></i></th>
                <th>CPS <i class="fa fa-rupee-sign"></i></th>
                <th>SOR</th>
                <th>VLTW</th>
                <th>WTS</th>
                <th>VLTS</th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Spend <i class="fa fa-rupee-sign"></i></th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Leads</th>
            </tr>
        </thead>
        <tbody class="get_medium_list_row">
            @php

    $get_objective_name = '';
    $get_medim_budgets = '';

                foreach(json_decode($campaigns->channels) as $camp){
                    $get_objective[] = $camp->objective;
                }
                $get_objective = array_unique($get_objective);
                $camp_i = 1;

            @endphp
        @foreach($get_objective as $objective)
        @php
        $get_objective_name .= "'".$objective."',";
        $camp_i++;

        $camp_get_budget_amount = 0;
        $camp_getTotalBudget = 0;
        $camp_get_total_balance_budget_amount = 0;
        $camp_getTotalLeadsCount = 0;
        $camp_getTotalValidLeads = 0;
        $camp_getTotalValidLeadsPer = 0;
        $camp_totalWalkIn = 0;
        $camp_totalSales = 0;
        $camp_totalRevenue = 0;
        $camp_totalCPL = 0;
        $camp_totalCPW = 0;
        $camp_totalCPS = 0;
        $camp_totalSOR = 0;
        $camp_getAvgVLTW = 0;
        $camp_getAvgWTS = 0;
        $camp_totalVLTS = 0;
        $camp_totalDailySpend = 0;
        $camp_totalDailyLeads = 0;
        $camp_count = 0;
        $inc = 1;

        $get_budget = $camp->budget;
        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $get_walk_in = ($get_valid_leads/100)*$camp->vltw;
        $get_sales = ($get_walk_in/100)*$camp->wts;
        $get_rev = round($campaigns->base_price*$get_sales);


        if($get_valid_leads != 0){
            $get_vlts = $get_sales/$get_valid_leads*100;
            $get_vlts = round($get_vlts, 2);
        }
        else{
            $get_vlts = 0;
        }
        $get_daily_spend = round($get_budget/30);
        $get_daily_leads = round($camp->leads/30);


       foreach(json_decode($campaigns->channels) as $camp){
           if($objective == $camp->objective){

                $camp_count++;
                if(isset($camp->budget)){
                    $camp_get_budget_amount += $camp->budget;
                };
                $camp_getTotalLeadsCount += $camp->leads;
                $camp_getTotalValidLeadsPer += $camp->valid_leads;
                $camp_getAvgVLTW += $camp->vltw;
                $camp_getAvgWTS += $camp->wts;
                $camp_getTotalValidLeads += $camp->vleads;
                $camp_totalWalkIn += $camp->walk_in;
                $camp_totalSales += $camp->sales;
            }
        }
        $get_medim_budgets .= "$camp_get_budget_amount,";

        $camp_getTotalValidLeadsPerNumber = $camp_getTotalValidLeadsPer/$camp_count;
        $camp_getTotalVLTW = round($camp_getAvgVLTW/$camp_count);
        $camp_getTotalWTS = round($camp_getAvgWTS/$camp_count);

        $camp_totalRevenue = $campaigns->base_price*$camp_totalSales;

        $camp_totalCPL = $camp_get_budget_amount/$camp_getTotalLeadsCount;
        $camp_totalWalkIn == 0? 0:$camp_totalCPW = $camp_get_budget_amount/$camp_totalWalkIn;
        $camp_totalSales == 0? 0: $camp_totalCPS = $camp_get_budget_amount/$camp_totalSales;
        $camp_totalRevenue == 0? 0: $camp_totalSOR = round($camp_get_budget_amount/$camp_totalRevenue*100, 2);;
        $camp_totalVLTS = $camp_totalSales/$camp_getTotalValidLeads*100;
        $camp_totalDailySpend = round($camp_get_budget_amount/30);
        $camp_totalDailyLeads = round($camp_getTotalLeadsCount/30);

       @endphp
        <tr class="collapsed" data-toggle="collapse" data-target="#collapseobj{{ $camp_i }}" style="background: linear-gradient(
45deg
, #ffffff, #f0eddb);
    color: #000;
    cursor: pointer;
    font-weight: 800;">
            <td>
                <i class="li_icon flaticon2-right-arrow"></i> {{ $objective }}
            </td>
            <td></td>
            <td>{{ $campaigns->ind_money($camp_get_budget_amount) }}</td>
            <td>{{ round($camp_getTotalLeadsCount) }}</td>
            <td>{{ round($camp_getTotalValidLeads) }}</td>
            <td>{{ round($camp_getTotalValidLeadsPerNumber) }}%</td>
            <td>{{ round($camp_totalWalkIn) }}</td>
            <td>{{ $camp_totalSales }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalRevenue)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPL)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPW)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPS)) }}</td>
            <td>{{ round($camp_totalSOR) }}%</td>
            <td>{{ round($camp_getTotalVLTW) }}%</td>
            <td>{{ round($camp_getTotalWTS) }}%</td>
            <td>{{ round($camp_totalVLTS) }}%</td>
            <td>{{ $campaigns->ind_money($camp_totalDailySpend) }}</td>
            <td>{{ $camp_totalDailyLeads }}</td>
        </tr>
        @foreach(json_decode($campaigns->channels) as $camp)
        @php
        if(isset($camp->budget)){
            $get_budget = $camp->budget;
        }
        else{
            $get_budget = 0;
        }
        $get_user = App\User::find($camp->user); 
        $get_user = json_decode($get_user);

        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $inc++;

        @endphp
        @if($objective == $camp->objective)
        <tr id="collapseobj{{ $camp_i }}" class="collapse out">
            <td style="padding-left: 22px;font-weight: 600;">
                @if(!is_object($camp->source))
                {{ $camp->source }}
                @else
                {{ $camp->source->source }}
                @endif</td>
            <td style="padding: 1px;text-align: center;">
                <a href="#" class="kt-media kt-media--sm kt-media--circle kt-media--success" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="{{ $user->name }}">
                            <span style="margin: 0;display: inline-flex;font-weight: 600;">{{ substr($user->name, 0,2) }}</span>
                        </a>
            </td>
            <td>{{ $campaigns->ind_money($get_budget) }}</td>
            <td>{{ $camp->leads }}</td>
            <td>{{ $camp->vleads }}</td>
            <td>{{ $camp->valid_leads }}%</td>
            <td>{{ $camp->walk_in }}</td>
            <td>{{ $camp->sales }}</td>
            <td>{{ $campaigns->ind_money($camp->rev) }}</td>
            <td>{{ $campaigns->ind_money($camp->cpl) }}</td>
            <td>{{ $campaigns->ind_money($camp->cpw) }}</td>
            <td>{{ $campaigns->ind_money($camp->cps) }}</td>
            <td>{{ $camp->sor }}%</td>
            <td>@if($camp->vltw){{ $camp->vltw }}%@endif</td>
            <td>@if($camp->wts){{ $camp->wts }}%@endif</td>
            <td>{{ $camp->vlts }}%</td>
            <td>{{ $campaigns->ind_money($camp->daily_spend) }}</td>
            <td>{{ $camp->daily_leads }}</td>
        </tr>
        @endif
                    @endforeach
            @endforeach
        </tbody>
    </table>
        </div>
            <!--begin::Accordion-->
            <div class="col-12 mt-2 milestones-list accordion accordion-light  accordion-svg-icon" id="accordionExample7">
                
    <table class="table table-bordered media_plan_tabl">
        <thead>
            <tr>
                <th>Source</th>
                <th>User</th>
                <th>Budget <i class="fa fa-rupee-sign"></i></th>
                <th>Leads</th>
                <th>Valid</th>
                <th>Valid%</th>
                <th>Walk-In</th>
                <th>Sales</th>
                <th>Rev <i class="fa fa-rupee-sign"></i></th>
                <th>CPL <i class="fa fa-rupee-sign"></i></th>
                <th>CPW <i class="fa fa-rupee-sign"></i></th>
                <th>CPS <i class="fa fa-rupee-sign"></i></th>
                <th>SOR</th>
                <th>VLTW</th>
                <th>WTS</th>
                <th>VLTS</th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Spend <i class="fa fa-rupee-sign"></i></th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Leads</th>
                <th>SOP</th>
            </tr>
        </thead>
        <tbody class="get_medium_list_row">
            @php

    $get_medium_name = '';
    $get_medim_budgets = '';

                foreach(json_decode($campaigns->channels) as $camp){
                    $get_medium[] = $camp->medium;
                }
                $get_medium = array_unique($get_medium);
                $camp_i = 1;

            @endphp
        @foreach($get_medium as $medium)
        @php
        $get_medium_name .= "'".$medium."',";
        $camp_i++;

        $camp_get_budget_amount = 0;
        $camp_getTotalBudget = 0;
        $camp_get_total_balance_budget_amount = 0;
        $camp_getTotalLeadsCount = 0;
        $camp_getTotalValidLeads = 0;
        $camp_getTotalValidLeadsPer = 0;
        $camp_totalWalkIn = 0;
        $camp_totalSales = 0;
        $camp_totalRevenue = 0;
        $camp_totalCPL = 0;
        $camp_totalCPW = 0;
        $camp_totalCPS = 0;
        $camp_totalSOR = 0;
        $camp_getAvgVLTW = 0;
        $camp_getAvgWTS = 0;
        $camp_totalVLTS = 0;
        $camp_totalDailySpend = 0;
        $camp_totalDailyLeads = 0;
        $camp_count = 0;
        $inc = 1;

        $get_budget = $camp->budget;
        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $get_walk_in = ($get_valid_leads/100)*$camp->vltw;
        $get_sales = ($get_walk_in/100)*$camp->wts;
        $get_rev = round($campaigns->base_price*$get_sales);


        if($get_valid_leads != 0){
            $get_vlts = $get_sales/$get_valid_leads*100;
            $get_vlts = round($get_vlts, 2);
        }
        else{
            $get_vlts = 0;
        }
        $get_daily_spend = round($get_budget/30);
        $get_daily_leads = round($camp->leads/30);


       foreach(json_decode($campaigns->channels) as $camp){
           if($medium == $camp->medium){

                $camp_count++;
                if(isset($camp->budget)){
                    $camp_get_budget_amount += $camp->budget;
                };
                $camp_getTotalLeadsCount += $camp->leads;
                $camp_getTotalValidLeadsPer += $camp->valid_leads;
                $camp_getAvgVLTW += $camp->vltw;
                $camp_getAvgWTS += $camp->wts;
                $camp_getTotalValidLeads += $camp->vleads;
                $camp_totalWalkIn += $camp->walk_in;
                $camp_totalSales += $camp->sales;
            }
        }
        $get_medim_budgets .= "$camp_get_budget_amount,";

        $camp_getTotalValidLeadsPerNumber = $camp_getTotalValidLeadsPer/$camp_count;
        $camp_getTotalVLTW = round($camp_getAvgVLTW/$camp_count);
        $camp_getTotalWTS = round($camp_getAvgWTS/$camp_count);

        $camp_totalRevenue = $campaigns->base_price*$camp_totalSales;

        $camp_getTotalLeadsCount == 0? 0:$camp_totalCPL = $camp_get_budget_amount/$camp_getTotalLeadsCount;
        $camp_totalWalkIn == 0? 0:$camp_totalCPW = $camp_get_budget_amount/$camp_totalWalkIn;
        $camp_totalSales == 0? 0: $camp_totalCPS = $camp_get_budget_amount/$camp_totalSales;
        $camp_getTotalValidLeads == 0? 0:$camp_totalVLTS = $camp_totalSales/$camp_getTotalValidLeads*100;
        $camp_totalDailySpend = round($camp_get_budget_amount/30);
        $camp_totalDailyLeads = round($camp_getTotalLeadsCount/30);

       @endphp
        <tr class="collapsed" data-toggle="collapse" data-target="#collapseme{{ $camp_i }}" style="background: linear-gradient(
45deg
, #ffffff, #f0eddb);
    color: #000;
    cursor: pointer;
    font-weight: 800;">
            <td>
                <i class="li_icon flaticon2-right-arrow"></i> {{ $medium }}
            </td>
            <td></td>
            <td>{{ $campaigns->ind_money($camp_get_budget_amount) }}</td>
            <td>{{ round($camp_getTotalLeadsCount) }}</td>
            <td>{{ round($camp_getTotalValidLeads) }}</td>
            <td>{{ round($camp_getTotalValidLeadsPerNumber) }}%</td>
            <td>{{ round($camp_totalWalkIn) }}</td>
            <td>{{ $camp_totalSales }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalRevenue)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPL)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPW)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPS)) }}</td>
            <td>{{ round($camp_totalSOR) }}%</td>
            <td>{{ round($camp_getTotalVLTW) }}%</td>
            <td>{{ round($camp_getTotalWTS) }}%</td>
            <td>{{ round($camp_totalVLTS) }}%</td>
            <td>{{ $campaigns->ind_money($camp_totalDailySpend) }}</td>
            <td>{{ $camp_totalDailyLeads }}</td>
            <td><input type="checkbox" id="sop" name="sop" value="sop" check></td>
        </tr>
        @foreach(json_decode($campaigns->channels) as $camp)
        @php
        if(isset($camp->budget)){
            $get_budget = $camp->budget;
        }
        else{
            $get_budget = 0;
        }
        $get_user = App\User::find($camp->user); 
        $get_user = json_decode($get_user);

        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $inc++;

        @endphp
        @if($medium == $camp->medium)
        <tr id="collapseme{{ $camp_i }}" class="collapse out">
            <td style="padding-left: 22px;font-weight: 600;">
                @if(!is_object($camp->source))
                {{ $camp->source }}
                @else
                {{ $camp->source->source }}
                @endif
                <span class="source-badge kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">{{ $camp->objective }}</span></td>
            <td style="padding: 1px;text-align: center;">
                <a href="#" class="kt-media kt-media--sm kt-media--circle kt-media--success" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="{{ $user->name }}">
                            <span style="margin: 0;display: inline-flex;font-weight: 600;">{{ substr($user->name, 0,2) }}</span>
                        </a>
            </td>
            <td>{{ $campaigns->ind_money($get_budget) }}</td>
            <td>{{ $camp->leads }}</td>
            <td>{{ $camp->vleads }}</td>
            <td>{{ $camp->valid_leads }}%</td>
            <td>{{ $camp->walk_in }}</td>
            <td>{{ $camp->sales }}</td>
            <td>{{ $campaigns->ind_money($camp->rev) }}</td>
            <td>{{ $campaigns->ind_money($camp->cpl) }}</td>
            <td>{{ $campaigns->ind_money($camp->cpw) }}</td>
            <td>{{ $campaigns->ind_money($camp->cps) }}</td>
            <td>{{ $camp->sor }}%</td>
            <td>@if($camp->vltw){{ $camp->vltw }}%@endif</td>
            <td>@if($camp->wts){{ $camp->wts }}%@endif</td>
            <td>{{ $camp->vlts }}%</td>
            <td>{{ $campaigns->ind_money($camp->daily_spend) }}</td>
            <td>{{ $camp->daily_leads }}</td>
            <td>

                @if(!is_object($camp->source))
                <button style="padding: 2px;width: auto;height: auto;"class="btn btn-brand btn-elevate btn-icon btn-icon-sm" data-toggle="modal" data-target="#NewAdCamp" id="new_ad_camp_{{ $inc }}" data-source="{{ $camp->source }}" data-channel="{{ $camp->medium }}" data-assign="{{ $user->name }}"><i class="la la-plus" ></i></button>
                
                @else
                <button style="padding: 2px;width: auto;height: auto;"class="btn btn-brand btn-elevate btn-icon btn-icon-sm" data-toggle="modal" data-target="#NewAdCamp" id="new_ad_camp_{{ $inc }}" data-source="{{ $camp->source->source }}" data-channel="{{ $camp->medium }}" data-assign="{{ $user->name }}"><i class="la la-plus" ></i></button>
                
                @endif
                
            </td>
        </tr>
        @endif
                    @endforeach
            @endforeach
        </tbody>
    </table>
        </div>
                    <div class="col-6">
                        <div id="top_x_div" style="width:100%;height: 300px;padding: 20px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                        <div class="row">
                            <div class="col-12">
                                 <div id="piechart_3" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                            <div class="col-12">
                                <div id="piechart_4" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                                <div id="piechart_budget" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                        <div class="row">
                            <div class="col-12">
                                <div id="piechart_2" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                            <div class="col-12">
                                 <div id="piechart_1" style="width:100%;height: 300px;display: inline-table;box-shadow: 0px 0px 2px #999;margin-bottom: 15px;"></div>
                            </div>
                        </div>
                    </div>
        
    </div>



                        <div class="modal fade" id="downlaod_mediaPan">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1200px !important;">
                                <div class="modal-content">
                                    <div class="modal-header" style="display: block;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="modal-title">Download Media Plan</h4>
                                    </div>
                                    <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">

    <table class="table table-bordered media_plan_tabl" id="table2excel">
        <thead>
            <tr>
                <th>Source</th>
                <th>Medium</th>
                <th>Budget <i class="fa fa-rupee-sign"></i></th>
                <th>Leads</th>
                <th>Valid</th>
                <th>Valid%</th>
                <th>Walk-In</th>
                <th>Sales</th>
                <th>Rev <i class="fa fa-rupee-sign"></i></th>
                <th>CPL <i class="fa fa-rupee-sign"></i></th>
                <th>CPW <i class="fa fa-rupee-sign"></i></th>
                <th>CPS <i class="fa fa-rupee-sign"></i></th>
                <th>SOR</th>
                <th>VLTW</th>
                <th>WTS</th>
                <th>VLTS</th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Spend <i class="fa fa-rupee-sign"></i></th>
                <th><span style="font-size: 9px;display: inherit;">Daily</span>Leads</th>
            </tr>
        </thead>
        <tbody class="get_medium_list_row">
            @php

    $get_objective_name = '';
    $get_medim_budgets = '';

                foreach(json_decode($campaigns->channels) as $camp){
                    $get_objective[] = $camp->objective;
                }
                $get_objective = array_unique($get_objective);
                $camp_i = 1;

            @endphp
        @foreach($get_objective as $objective)
        @php
        $get_objective_name .= "'".$objective."',";
        $camp_i++;

        $camp_get_budget_amount = 0;
        $camp_getTotalBudget = 0;
        $camp_get_total_balance_budget_amount = 0;
        $camp_getTotalLeadsCount = 0;
        $camp_getTotalValidLeads = 0;
        $camp_getTotalValidLeadsPer = 0;
        $camp_totalWalkIn = 0;
        $camp_totalSales = 0;
        $camp_totalRevenue = 0;
        $camp_totalCPL = 0;
        $camp_totalCPW = 0;
        $camp_totalCPS = 0;
        $camp_totalSOR = 0;
        $camp_getAvgVLTW = 0;
        $camp_getAvgWTS = 0;
        $camp_totalVLTS = 0;
        $camp_totalDailySpend = 0;
        $camp_totalDailyLeads = 0;
        $camp_count = 0;
        $inc = 1;

        $get_budget = $camp->budget;
        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $get_walk_in = ($get_valid_leads/100)*$camp->vltw;
        $get_sales = ($get_walk_in/100)*$camp->wts;
        $get_rev = round($campaigns->base_price*$get_sales);


        if($get_valid_leads != 0){
            $get_vlts = $get_sales/$get_valid_leads*100;
            $get_vlts = round($get_vlts, 2);
        }
        else{
            $get_vlts = 0;
        }
        $get_daily_spend = round($get_budget/30);
        $get_daily_leads = round($camp->leads/30);


       foreach(json_decode($campaigns->channels) as $camp){
           if($objective == $camp->objective){

                $camp_count++;
                if(isset($camp->budget)){
                    $camp_get_budget_amount += $camp->budget;
                };
                $camp_getTotalLeadsCount += $camp->leads;
                $camp_getTotalValidLeadsPer += $camp->valid_leads;
                $camp_getAvgVLTW += $camp->vltw;
                $camp_getAvgWTS += $camp->wts;
                $camp_getTotalValidLeads += $camp->vleads;
                $camp_totalWalkIn += $camp->walk_in;
                $camp_totalSales += $camp->sales;
            }
        }
        $get_medim_budgets .= "$camp_get_budget_amount,";

        $camp_getTotalValidLeadsPerNumber = $camp_getTotalValidLeadsPer/$camp_count;
        $camp_getTotalVLTW = round($camp_getAvgVLTW/$camp_count);
        $camp_getTotalWTS = round($camp_getAvgWTS/$camp_count);

        $camp_totalRevenue = $campaigns->base_price*$camp_totalSales;

        $camp_totalCPL = $camp_get_budget_amount/$camp_getTotalLeadsCount;
        $camp_totalWalkIn == 0? 0:$camp_totalCPW = $camp_get_budget_amount/$camp_totalWalkIn;
        $camp_totalSales == 0? 0: $camp_totalCPS = $camp_get_budget_amount/$camp_totalSales;
        $camp_totalRevenue == 0? 0: $camp_totalSOR = round($camp_get_budget_amount/$camp_totalRevenue*100, 2);;
        $camp_totalVLTS = $camp_totalSales/$camp_getTotalValidLeads*100;
        $camp_totalDailySpend = round($camp_get_budget_amount/30);
        $camp_totalDailyLeads = round($camp_getTotalLeadsCount/30);

       @endphp
        @foreach(json_decode($campaigns->channels) as $camp)
        @php
        if(isset($camp->budget)){
            $get_budget = $camp->budget;
        }
        else{
            $get_budget = 0;
        }
        $get_user = App\User::find($camp->user); 
        $get_user = json_decode($get_user);

        $get_valid_leads = ($camp->valid_leads/100) * $camp->leads;
        $inc++;

        @endphp
        @if($objective == $camp->objective)
        <tr>
            <td style="font-weight: 600;">
                @if(!is_object($camp->source))
                {{ $camp->source }}
                @else
                {{ $camp->source->source }}
                @endif</td>
            <td>{{ $camp->medium }}</td>
            <td>{{ $campaigns->ind_money($get_budget) }}</td>
            <td>{{ $camp->leads }}</td>
            <td>{{ $camp->vleads }}</td>
            <td>{{ $camp->valid_leads }}%</td>
            <td>{{ $camp->walk_in }}</td>
            <td>{{ $camp->sales }}</td>
            <td>{{ $campaigns->ind_money($camp->rev) }}</td>
            <td>{{ $campaigns->ind_money($camp->cpl) }}</td>
            <td>{{ $campaigns->ind_money($camp->cpw) }}</td>
            <td>{{ $campaigns->ind_money($camp->cps) }}</td>
            <td>{{ $camp->sor }}%</td>
            <td>@if($camp->vltw){{ $camp->vltw }}%@endif</td>
            <td>@if($camp->wts){{ $camp->wts }}%@endif</td>
            <td>{{ $camp->vlts }}%</td>
            <td>{{ $campaigns->ind_money($camp->daily_spend) }}</td>
            <td>{{ $camp->daily_leads }}</td>
        </tr>
        @endif
                    @endforeach
                    
                    
        <tr style="background: linear-gradient(
45deg
, #ffffff, #f0eddb);
    color: #000;
    cursor: pointer;
    font-weight: 800;">
            <td>Total</td>
            <td></td>
            <td>{{ $campaigns->ind_money($camp_get_budget_amount) }}</td>
            <td>{{ round($camp_getTotalLeadsCount) }}</td>
            <td>{{ round($camp_getTotalValidLeads) }}</td>
            <td>{{ round($camp_getTotalValidLeadsPerNumber) }}%</td>
            <td>{{ round($camp_totalWalkIn) }}</td>
            <td>{{ $camp_totalSales }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalRevenue)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPL)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPW)) }}</td>
            <td>{{ $campaigns->ind_money(round($camp_totalCPS)) }}</td>
            <td>{{ round($camp_totalSOR) }}%</td>
            <td>{{ round($camp_getTotalVLTW) }}%</td>
            <td>{{ round($camp_getTotalWTS) }}%</td>
            <td>{{ round($camp_totalVLTS) }}%</td>
            <td>{{ $campaigns->ind_money($camp_totalDailySpend) }}</td>
            <td>{{ $camp_totalDailyLeads }}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Close</button>
                                        <button class="btn btn-primary" id="table2excel_export"><i class="la la-share"></i> Download</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->