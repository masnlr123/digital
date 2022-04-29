<div class="modal fade" id="model_fb_detais_{{ $audit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('update_lead_audit', $audit->id) }}">@csrf {{ method_field('PUT') }}
                            <div class="modal-header">
                                <h5 style="width:100%;" class="modal-title" id="exampleModalLongTitle">Edit Audit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="padding: 32px;">
                                <div class="form-group row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                    <input type="checkbox" name="record_not_found" id="record_not_found" ng-model="record_not_found" value="yes"> <strong class="text-warning">Call Record Not available</strong>
                                                    <span style="background: orange;"></span>
                                                </label>
                                                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                    <input type="checkbox" name="red_alert" id="red_alert" ng-model="red_alert" value="yes"> <strong style="color:red">Send Red Alert Email</strong>
                                                    <span style="background: red;"></span>
                                                </label>
                                                @if($audit->red_alert == 'Yes')
                                                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                                                    <i class="fa fa-check"></i> <strong style="color:red">Red Alert</strong>
                                                    <span style="background: red;"></span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        @php $all_feedbacks = explode(',', $audit->lat_feedback) @endphp
            <div class="col-md-12">
                <label>LAT Feedback</label>
                <hr>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'TAT is high', $all_feedbacks)) checked @endif value="TAT is high">TAT is high<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Pitching is bad', $all_feedbacks)) checked @endif value="Pitching is bad">Pitching is bad<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'On follow up', $all_feedbacks)) checked @endif value="On follow up">On follow up<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Improper update in LMS', $all_feedbacks)) checked @endif value="Improper update in LMS">Improper update in LMS<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'No Contact Number Available', $all_feedbacks)) checked @endif value="No Contact Number Available">No Contact Number Available<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'No update in LMS', $all_feedbacks)) checked @endif value="No update in LMS">No update in LMS<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Invalid Number', $all_feedbacks)) checked @endif value="Invalid Number">Invalid Number<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Missed the follow up task', $all_feedbacks)) checked @endif value="Missed the follow up task">Missed the follow up task<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Wrong Disposition', $all_feedbacks)) checked @endif value="Wrong Disposition">Wrong Disposition<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Unprofessional Call', $all_feedbacks)) checked @endif value="Unprofessional Call">Unprofessional Call<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Task Creation not done', $all_feedbacks)) checked @endif value="Task Creation not done">Task Creation not done<span></span>
                </label>
            </div>
            <div class="col-md-4">
                <label class="kt-checkbox kt-checkbox--solid kt-checkbox--brand">
                    <input type="checkbox" name="lat_feedback[]" @if(in_array( 'Not Applicable', $all_feedbacks)) checked @endif value="Not Applicable">Not Applicable<span></span>
                </label>
            </div>
                                        <!-- <div class="col-md-12">
                                            <label>LAT Feedback</label>
                                            <select name="lat_feedback[]" class="form-control kt-select2" id="select2_select{{ $audit->id }}" multiple>
                                                <option value="">Select One ***</option>
                                                <option @if(in_array( 'TAT is high', $all_feedbacks)) selected @endif value="TAT is high">TAT is high</option>
                                                <option @if(in_array( 'False Enquiry', $all_feedbacks)) selected @endif value="False Enquiry">False Enquiry</option>
                                                <option @if(in_array( 'Pitching is bad', $all_feedbacks)) selected @endif value="Pitching is bad">Pitching is bad</option>
                                                <option @if(in_array( 'Improper update in LMS', $all_feedbacks)) selected @endif value="Improper update in LMS">Improper update in LMS</option>
                                                <option @if(in_array( 'No Contact Number Available', $all_feedbacks)) selected @endif value="No Contact Number Available">No Contact Number Available</option>
                                                <option @if(in_array( 'No update in LMS', $all_feedbacks)) selected @endif value="No update in LMS">No update in LMS</option>
                                                <option @if(in_array( 'Invalid Number', $all_feedbacks)) selected @endif value="Invalid Number">Invalid Number</option>
                                                <option @if(in_array( 'On Follow Up', $all_feedbacks)) selected @endif value="On Follow Up">On Follow Up</option>
                                                <option @if(in_array( 'Existing Customer Call', $all_feedbacks)) selected @endif value="Existing Customer Call">Existing Customer Call</option>
                                                <option @if(in_array( 'Missed the follow up task', $all_feedbacks)) selected @endif value="Missed the follow up task">Missed the follow up task</option>
                                                <option @if(in_array( 'Booked With Competitor', $all_feedbacks)) selected @endif value="Booked With Competitor">Booked With Competitor</option>
                                                <option @if(in_array( 'Wrong Disposition', $all_feedbacks)) selected @endif value="Wrong Disposition">Wrong Disposition</option>
                                                <option @if(in_array( 'Unprofessional Call', $all_feedbacks)) selected @endif value="Unprofessional Call">Unprofessional Call</option>
                                                <option  @if(in_array( 'Task Creation not done', $all_feedbacks)) selected @endif value="Task Creation not done">Task Creation not done</option>
                                            </select>
                                        </div> -->
                                        <div class="col-md-6 mt-4">
                                            <label>Detailed Remark</label>
                                            <textarea class="form-control" name="detailed_remark">{{ $audit->detailed_remark }}</textarea>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <label>LAT Action</label>
                                            <textarea class="form-control" name="lat_action">{{ $audit->lat_action }}</textarea>
                                        </div>
                                        <div class="col-md-12 mt-4" ng-show="red_alert">
                                            <label>Red alert Email Content</label>
                                            <textarea class="form-control" name="email_content"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @if($audit->type == 'fresh')
                                <div class="audit_edit_block_1 row">
                                    <h4 class="col-10">Soft Skills</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" name="edit_block_1_na{{ $audit->id }}" ng-model="edit_block_1_na{{ $audit->id }}" ng-value="1" value="Yes" checked="checked" @if($audit->block_1 == 'NA') ng-init="edit_block_1_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent give call opening with greeting, self intro with branding?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[1]" id="audit_score_edit_a1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a1" name="edit_na_block_{{ $audit->id }}[a1]" ng-model="edit_block_{{ $audit->id }}_a1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent display active listening?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[2]" id="audit_score_edit_a2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a2" name="edit_na_block_{{ $audit->id }}[a2]" ng-model="edit_block_{{ $audit->id }}_a2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent maintain Normal Rate of speech / sounds confident/ enthusiastic?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[3]" id="audit_score_edit_a3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a3" name="edit_na_block_{{ $audit->id }}[a3]" ng-model="edit_block_{{ $audit->id }}_a3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent close the call properly</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a4">
                                                    <input type="hidden" name="score_{{ $audit->id }}[4]" id="audit_score_edit_a4{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a4" name="edit_na_block_{{ $audit->id }}[a4]" ng-model="edit_block_{{ $audit->id }}_a4" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="audit_edit_block_2 row">
                                    <h4 class="col-10">Product Knowledge</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" checked name="edit_block_2_na{{ $audit->id }}" ng-model="edit_block_2_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_2 == 'NA') ng-init="edit_block_2_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>

                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent probe effecively to understand customer's requirements?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[5]" id="audit_score_edit_b1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b1" name="edit_na_block_{{ $audit->id }}[b1]" ng-model="edit_block_{{ $audit->id }}_b1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent explain Location and its advantages(If required)?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[6]" id="audit_score_edit_b2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b2" name="edit_na_block_{{ $audit->id }}[b2]" ng-model="edit_block_{{ $audit->id }}_b2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the Agent explained project details and benefits</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[7]" id="audit_score_edit_b3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b3" name="edit_na_block_{{ $audit->id }}[b3]" ng-model="edit_block_{{ $audit->id }}_b3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the Agent explain the Offers & Schemes?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b4">
                                                    <input type="hidden" name="score_{{ $audit->id }}[8]" id="audit_score_edit_b4{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b4" name="edit_na_block_{{ $audit->id }}[b4]" ng-model="edit_block_{{ $audit->id }}_b4" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Was there a proper pitch / Convincing / Rapport creation</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b5">
                                                    <input type="hidden" name="score_{{ $audit->id }}[9]" id="audit_score_edit_b5{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b5" name="edit_na_block_{{ $audit->id }}[b5]" ng-model="edit_block_{{ $audit->id }}_b5" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the Agent invite for Site Visit Along with Family</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b6">
                                                    <input type="hidden" name="score_{{ $audit->id }}[10]" id="audit_score_edit_b6{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b6" name="edit_na_block_{{ $audit->id }}[b6]" ng-model="edit_block_{{ $audit->id }}_b6" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="audit_edit_block_3 row">
                                    <h4 class="col-10">LMS Update</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" checked name="edit_block_3_na{{ $audit->id }}" ng-model="edit_block_3_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_3 == 'NA') ng-init="edit_block_3_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>

                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_3_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent create task?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_c1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[11]" id="audit_score_edit_c1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_c1" name="edit_na_block_{{ $audit->id }}[c1]" ng-model="edit_block_{{ $audit->id }}_c1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_3_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent capture call remarks?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_c2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[12]" id="audit_score_edit_c2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_c2" name="edit_na_block_{{ $audit->id }}[c2]" ng-model="edit_block_{{ $audit->id }}_c2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_3_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent choose correct Disposition?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_c3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[13]" id="audit_score_edit_c3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_c3" name="edit_na_block_{{ $audit->id }}[c3]" ng-model="edit_block_{{ $audit->id }}_c3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="audit_edit_block_4 row">
                                    <h4 class="col-10">Zero Tolerance</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" checked name="edit_block_4_na{{ $audit->id }}" ng-model="edit_block_4_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_4 == 'NA') ng-init="edit_block_4_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>

                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_4_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent Call within TAT?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_d1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[14]" id="audit_score_edit_d1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_d1" name="edit_na_block_{{ $audit->id }}[d1]" ng-model="edit_block_{{ $audit->id }}_d1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_4_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Rude on Call / Disconnected the call / Usage of Profanity / Incorrect Information</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_d2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[15]" id="audit_score_edit_d2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_d2" name="edit_na_block_{{ $audit->id }}[d2]" ng-model="edit_block_{{ $audit->id }}_d2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_4_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent ask for next Call For Action before closing the call?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_d3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[16]" id="audit_score_edit_d3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_d3" name="edit_na_block_{{ $audit->id }}[d3]" ng-model="edit_block_{{ $audit->id }}_d3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="audit_edit_block_1 row">
                                    <h4 class="col-10">Soft Skills</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" name="edit_block_1_na{{ $audit->id }}" ng-model="edit_block_1_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_1 == 'NA') ng-init="edit_block_1_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent give call opening with greeting, self intro with branding?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[1]" id="audit_score_edit_a1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a1" name="edit_na_block_{{ $audit->id }}[a1]" ng-model="edit_block_{{ $audit->id }}_a1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent display active listening/ sounds confident/ enthusiastic?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[2]" id="audit_score_edit_a2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a2" name="edit_na_block_{{ $audit->id }}[a2]" ng-model="edit_block_{{ $audit->id }}_a2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent maintain Normal Rate of speech / sounds confident/ enthusiastic?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[3]" id="audit_score_edit_a3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a3" name="edit_na_block_{{ $audit->id }}[a3]" ng-model="edit_block_{{ $audit->id }}_a3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_1_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent close the call properly?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_a4">
                                                    <input type="hidden" name="score_{{ $audit->id }}[4]" id="audit_score_edit_a4{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_a4" name="edit_na_block_{{ $audit->id }}[a4]" ng-model="edit_block_{{ $audit->id }}_a4" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="audit_edit_block_2 row">
                                    <h4 class="col-10">Product Knowledge</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" name="edit_block_2_na{{ $audit->id }}" ng-model="edit_block_2_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_2 == 'NA') ng-init="edit_block_2_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>

                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent create rapport?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[5]" id="audit_score_edit_b1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b1" name="edit_na_block_{{ $audit->id }}[b1]" ng-model="edit_block_{{ $audit->id }}_b1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_2_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Was there a proper pitch / convincing?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_b2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[6]" id="audit_score_edit_b2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_b2" name="edit_na_block_{{ $audit->id }}[b2]" ng-model="edit_block_{{ $audit->id }}_b2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="audit_edit_block_3 row">
                                    <h4 class="col-10">LMS Update</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" name="edit_block_3_na{{ $audit->id }}" ng-model="edit_block_3_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_3 == 'NA') ng-init="edit_block_3_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_3_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did Agent create Task </label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_c1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[7]" id="audit_score_edit_c1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_c1" name="edit_na_block_{{ $audit->id }}[c1]" ng-model="edit_block_{{ $audit->id }}_c1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_3_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">DCapture call remarks</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_c2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[8]" id="audit_score_edit_c2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_c2" name="edit_na_block_{{ $audit->id }}[c2]" ng-model="edit_block_{{ $audit->id }}_c2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_3_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Correct disposition</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_c3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[9]" id="audit_score_edit_c3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_c3" name="edit_na_block_{{ $audit->id }}[c3]" ng-model="edit_block_{{ $audit->id }}_c3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="audit_edit_block_4 row">
                                    <h4 class="col-10">LMS Update</h4>
                                    <div class="col-2">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                            <label class="d-inline-flex">
                                                <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                <input type="checkbox" id="new_block_a2" name="edit_block_4_na{{ $audit->id }}" ng-model="edit_block_4_na{{ $audit->id }}" ng-value="1" value="Yes" @if($audit->block_4 == 'NA') ng-init="edit_block_4_na{{ $audit->id }}=true" @endif> <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_4_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the Agent follow up as per the scheduled date and time?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_d1">
                                                    <input type="hidden" name="score_{{ $audit->id }}[10]" id="audit_score_edit_d1{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_d1" name="edit_na_block_{{ $audit->id }}[d1]" ng-model="edit_block_{{ $audit->id }}_d1" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_4_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Was the agent Rude / Disconnected the call / Usage of Profanity? / Incorrect Information</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_d2">
                                                    <input type="hidden" name="score_{{ $audit->id }}[11]" id="audit_score_edit_d2{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_d2" name="edit_na_block_{{ $audit->id }}[d2]" ng-model="edit_block_{{ $audit->id }}_d2" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 audit-score-wrap" ng-hide="edit_block_4_na{{ $audit->id }}">
                                        <div class="form-group row" style="margin-bottom:2px;">
                                            <label class="col-7 audit-score-label">Did the agent ask for next Call For Action before closing the call?</label>
                                            <div class="col-3">
                                                <div class="kt-ion-range-slider" ng-hide="edit_block_{{ $audit->id }}_d3">
                                                    <input type="hidden" name="score_{{ $audit->id }}[12]" id="audit_score_edit_d3{{ $audit->id }}" />
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--info">
                                                    <label class="d-inline-flex">
                                                        <span style="line-height: 34px;padding-left: 10px;margin-right: 15px;">N/A</span>
                                                        <input type="checkbox" id="edit_block_{{ $audit->id }}_d3" name="edit_na_block_{{ $audit->id }}[d3]" ng-model="edit_block_{{ $audit->id }}_d3" ng-value="1" value="Yes"> <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="" value="Submit the Lead Audit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>