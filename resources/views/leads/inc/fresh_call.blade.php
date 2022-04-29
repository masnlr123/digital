<form method="POST" action="{{ route('store_lead_audit') }}">@csrf
    <input type="hidden" name="type" value="fresh">
    <input type="hidden" name="project" value="{{ $lead->project }}">
    <input type="hidden" name="lead_number" value="{{ $lead->lead_number }}">
    <input type="hidden" name="lead_name" value="{{ $lead->first_name }}">
    <input type="hidden" name="total_yes" id="total_yes_new" value="">
    <input type="hidden" name="created_on" value="{{ $lead->created_on }}">
    <input type="hidden" name="lead_id" value="{{ $lead->lead_id }}">
    <input type="hidden" name="lead_stage" value="{{ $lead->lead_stage }}">
    <input type="hidden" name="lead_source" value="{{ $lead->lead_source }}">
    <input type="hidden" name="contact_number" value="{{ $lead->contact_number }}">
    <input type="hidden" name="email" value="{{ $lead->email }}">
    <input type="hidden" name="url" value="{{ $lead->lead_url }}">
    <input type="hidden" name="lead_owner" value="{{ $lead->lead_owner }}">
    <input type="hidden" name="lead_owner_email" value="{{ $lead->lead_owner_email }}">
    <div class="modal-header">
        <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle text-warning">
            <span class="row">
            <span class="col-md-4">Fresh Call Audit</span>
            <span class="col-md-8">
                <div class="kt-checkbox-inline">
                    <!-- <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                        <input type="checkbox" name="on_follow_up" id="on_follow_up" ng-model="on_follow_up" value="yes"> <strong>On follow up</strong>
                        <span></span>
                    </label> -->
                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                        <input type="checkbox" name="record_not_found" id="record_not_found" ng-model="record_not_found" value="yes"> <strong class="text-warning">Call Record Not available</strong>
                        <span style="background: orange;"></span>
                    </label>
                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                        <input type="checkbox" name="red_alert" id="red_alert" ng-model="red_alert" value="yes"> <strong style="color:red">Red Alert</strong>
                        <span style="background: red;"></span>
                    </label>
                </div>
            </span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" style="padding: 32px;">
        <div class="form-group row">
            <div class="col-md-12">
                <label>LAT Feedback</label>
                <hr>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="TAT is high">TAT is high<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Pitching is bad">Pitching is bad<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="On follow up">On follow up<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Improper update in LMS">Improper update in LMS<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="No Contact Number Available">No Contact Number Available<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="No update in LMS">No update in LMS<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Invalid Number">Invalid Number<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Missed the follow up task">Missed the follow up task<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Wrong Disposition">Wrong Disposition<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Unprofessional Call">Unprofessional Call<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Task Creation not done">Task Creation not done<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" value="Not Applicable">Not Applicable<span></span>
                </label>
            </div>
<!--             <div class="col-md-12">
                <label>LAT Feedback</label>
                <select name="lat_feedback[]" id="select2_select1" class="form-control kt-select2" multiple>
                    <option value="">Select One ***</option>
                    <option value="TAT is high">TAT is high</option>
                    <option value="Pitching is bad">Pitching is bad</option>
                    <option value="Improper update in LMS">Improper update in LMS</option>
                    <option value="No Contact Number Available">No Contact Number Available</option>
                    <option value="No update in LMS">No update in LMS</option>
                    <option value="Invalid Number">Invalid Number</option>
                    <option value="On Follow Up">On Follow Up</option>
                    <option value="Missed the follow up task">Missed the follow up task</option>
                    <option value="Wrong Disposition">Wrong Disposition</option>
                    <option value="Unprofessional Call">Unprofessional Call</option>
                    <option value="Task Creation not done">Task Creation not done</option>
                    <option value="Not Applicable">Not Applicable</option>
                </select>
            </div> -->
            <div class="col-md-12 mt-4">
                <label>Detailed Remark</label>
                <textarea class="form-control" name="detailed_remark"></textarea>
            </div>
            <div class="col-md-12 mt-4">
                <label>LAT Action</label>
                <textarea class="form-control" name="lat_action"></textarea>
            </div>
            <div class="col-md-12 mt-4" ng-show="red_alert">
                <label>Red alert Email Content</label>
                <textarea class="form-control" name="email_content"></textarea>
            </div>
            <div class="audit_block_1 row">
                <h4 class="col-10">Soft Skills</h4>
                <div class="col-2">
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                        <label class="d-inline-flex">
                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                            <input type="checkbox" id="new_block_a2" name="block_1_na" ng-model="block_1_na" ng-value="1" value="Yes"> <span></span>
                        </label>
                    </span>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_1_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent give call opening with greeting, self intro with branding?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_a1">
                                <input type="hidden" name="score[1]" id="fresh_slider_a1" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_a1" name="new_na_block[a1]" ng-model="new_block_a1" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_1_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent display active listening?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_a2">
                                <input type="hidden" name="score[2]" id="fresh_slider_a2" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_a2" name="new_na_block[a2]" ng-model="new_block_a2" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_1_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent maintain Normal Rate of speech / sounds confident/ enthusiastic?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_a3">
                                <input type="hidden" name="score[3]" id="fresh_slider_a3" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_a3" name="new_na_block[a3]" ng-model="new_block_a3" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_1_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent close the call properly</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_a4">
                                <input type="hidden" name="score[4]" id="fresh_slider_a4" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_a4" name="new_na_block[a4]" ng-model="new_block_a4" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="audit_block_2 row">
                <h4 class="col-10">Product Knowledge</h4>
                <div class="col-2">
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                        <label class="d-inline-flex">
                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                            <input type="checkbox" id="new_block_a2" name="block_2_na" ng-model="block_2_na" ng-value="1" value="Yes"> <span></span>
                        </label>
                    </span>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_2_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent probe effecively to understand customer's requirements?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_b1">
                                <input type="hidden" name="score[5]" id="fresh_slider_b1" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_b1" name="new_na_block[b1]" ng-model="new_block_b1" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_2_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent explain Location and its advantages(If required)?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_b2">
                                <input type="hidden" name="score[6]" id="fresh_slider_b2" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_b2" name="new_na_block[b2]" ng-model="new_block_b2" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_2_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the Agent explained project details and benefits</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_b3">
                                <input type="hidden" name="score[7]" id="fresh_slider_b3" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_b3" name="new_na_block[b3]" ng-model="new_block_b3" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_2_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the Agent explain the Offers & Schemes?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_b4">
                                <input type="hidden" name="score[8]" id="fresh_slider_b4" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_b4" name="new_na_block[b4]" ng-model="new_block_b4" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_2_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Was there a proper pitch / Convincing / Rapport creation</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_b5">
                                <input type="hidden" name="score[9]" id="fresh_slider_b5" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_b5" name="new_na_block[b5]" ng-model="new_block_b5" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_2_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the Agent invite for Site Visit Along with Family</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_b6">
                                <input type="hidden" name="score[10]" id="fresh_slider_b6" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_b6" name="new_na_block[b6]" ng-model="new_block_b6" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="audit_block_3 row">
                <h4 class="col-10">LMS Update</h4>
                <div class="col-2">
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                        <label class="d-inline-flex">
                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                            <input type="checkbox" id="new_block_a2" name="block_3_na" ng-model="block_3_na" ng-value="1" value="Yes"> <span></span>
                        </label>
                    </span>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_3_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent create task?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_c1">
                                <input type="hidden" name="score[11]" id="fresh_slider_c1" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_c1" name="new_na_block[c1]" ng-model="new_block_c1" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_3_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent capture call remarks?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_c2">
                                <input type="hidden" name="score[12]" id="fresh_slider_c2" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_c2" name="new_na_block[c2]" ng-model="new_block_c2" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_3_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent choose correct Disposition?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_c3">
                                <input type="hidden" name="score[13]" id="fresh_slider_c3" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_c3" name="new_na_block[c3]" ng-model="new_block_c3" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="audit_block_4 row">
                <h4 class="col-10">Zero Tolerance</h4>
                <div class="col-2">
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                        <label class="d-inline-flex">
                            <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                            <input type="checkbox" id="new_block_a2" name="block_4_na" ng-model="block_4_na" ng-value="1" value="Yes"> <span></span>
                        </label>
                    </span>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_4_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent Call within TAT?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_d1">
                                <input type="hidden" name="score[14]" id="fresh_slider_d1" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_d1" name="new_na_block[d1]" ng-model="new_block_d1" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_4_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Rude on Call / Disconnected the call / Usage of Profanity / Incorrect Information</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_d2">
                                <input type="hidden" name="score[15]" id="fresh_slider_d2" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_d2" name="new_na_block[d2]" ng-model="new_block_d2" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 audit-score-wrap" ng-hide="block_4_na">
                    <div class="form-group row" style="margin-bottom:2px;">
                        <label class="col-7 audit-score-label">Did the agent ask for next Call For Action before closing the call?</label>
                        <div class="col-3">
                            <div class="kt-ion-range-slider" ng-hide="new_block_d3">
                                <input type="hidden" name="score[16]" id="fresh_slider_d3" />
                            </div>
                        </div>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                <label class="d-inline-flex">
                                    <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                    <input type="checkbox" id="new_block_d3" name="new_na_block[d3]" ng-model="new_block_d3" ng-value="1" value="Yes"> <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" name="" value="Submit the Lead Audit" class="btn btn-primary">
    </div>
</form>