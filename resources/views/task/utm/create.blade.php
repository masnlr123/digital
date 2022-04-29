@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add UTM URL </h3>
        </div>
    </div>
</div>
<div ng-app="" class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('store_utm') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label" style="width: 100%;">
            <h3 class="kt-portlet__head-title" style="width: 100%;">
                <span style="float: left; display: block !important;padding-top: 10px;">Landing Page Details</span>
                <span class="lp_dynamic_switch" style="float: right; display: flex;">
                    <span style="margin-top: 17px;margin-right: 10px;">Is Dynamic Landing Page?</span>
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                        <label class="col-form-label">
                            <input type="checkbox" checked="checked" name="lp_dynamic" ng-model="lp_dynamic" ng-value="1">
                            <span></span>
                        </label>
                    </span>
                </span>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body utm_creator_wrapper">
        <div class="form-group row" ng-hide="lp_dynamic">
            <div class="col-md-12">
                <label>LP/Website URL</label>
                <input type="text" placeholder="" maxlength="255" class="form-control" name="url" id="url" value="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-5 utm_input_col" style="padding-right: 0;" ng-show="lp_dynamic">
                <label>Choose LP Template</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_lp_template" name="dynamic_url">
                    <option value="">** Select a Template</option>
                    @php $all_lp = App\Setting::where('name', 'dynamic_lp')->get();  @endphp
                            @foreach($all_lp as $lp)
                            @php $get_lp = json_decode($lp->value); @endphp
                            <option value="{{ $get_lp->url }}">{{ $get_lp->name }}</option>
                            @endforeach
                </select>
            </div>
            <div class="col-md-1" style="padding-left: 0;margin-top: 39px;" ng-show="lp_dynamic">
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#new_milestone_activity" style="border-radius: 0;padding: 5px 12px;background: #0561ab;border: none;"><i class="la la-plus" style="font-weight: bold; color: #fff;padding-right: 0;"></i> New LP</button>
            </div>
            <div class="col-md-3 utm_input_col" ng-show="lp_dynamic">
                <label>Desktop Creative</label>
                <input type="file" class="form-control" placeholder="Enter Creative URL" name="desktop_creative">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="lp_dynamic">
                <label>Mobile Creative</label>
                <input type="file" class="form-control" placeholder="Enter Creative URL" name="mobile_creative">
            </div>
            <div class="col-md-3 utm_input_col">
                <label>UTM Campaign</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_campaign" name="campaign">
                    <option value="">** Select a Campaign</option>
                    @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                    @foreach(config('dtms.campaign') as $campaign)
                    <option value="{{ $campaign['name'] }}">{{ $campaign['name'] }} (Predefined)</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 utm_input_col">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_project" ng-model="is_project" ng-value="1"> Define Project?
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_project" class="empty_input"></div>
                <select style="width: 100%" class="form-control kt-select2" id="select_campaign" name="project" ng-show="is_project">
                    <option value="">** Select a Project</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->name }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 utm_input_col" ng-show="lp_dynamic">
                <label>LP Contact Number</label>
                <input type="text" class="form-control" placeholder="Enter LP Contact Number" name="lp_contact" />
            </div>
            <div class="col-md-3 utm_input_col">
                <label>UTM Medium</label>
                <select style="width: 100%" class="form-control kt-select2" id="utm_medium" required="" name="utm_medium" ng-model="utm_medium">
                    <option value="">** Select a UTM Medium</option>
                    @php 
                        foreach(config('dtms.source') as $source){
                            $get_medium[] = $source['medium'];
                        }
                        $get_medium = array_unique($get_medium);
                    @endphp
                    @foreach($get_medium as $medium)
                        <option value="{{ $medium }}">{{ $medium }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 utm_input_col">
                <label>UTM Source</label>
                <select style="width: 100%" class="form-control" id="utm_source" required="" name="utm_source">
                    <option value="">** Select a UTM Source</option>
                    @foreach(config('dtms.source') as $source)
                    <option ng-show="utm_medium =='{{ $source['medium'] }}'" value="{{ $source['source'] }}">{{ $source['source'] }}</option>
                    @endforeach
                </select>
            </div>
<!--             <div class="col-md-3 utm_input_col">
                <label>UTM Campaign</label>
                <input type="text" placeholder="Enter UTM Campaign" class="form-control" name="utm_campaign" id="utm_campaign" value="">
            </div> -->
            <div class="col-md-3 utm_input_col">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_utm_term" ng-model="is_utm_term" ng-value="1"> UTM Term
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_utm_term" class="empty_input"></div>
                <input type="text" ng-show="is_utm_term" placeholder="Enter UTM Term" class="form-control" name="utm_term" id="utm_term" value="">
            </div>
            <div class="col-md-3 utm_input_col">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_utm_content" ng-model="is_utm_content" ng-value="1"> UTM Content
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_utm_content" class="empty_input"></div>
                <input type="text" ng-show="is_utm_content" placeholder="Enter UTM Content" class="form-control" name="utm_content" id="utm_content" value="">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="utm_medium =='Search Ads' || utm_medium =='Display Ads'">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_ad_position" ng-model="is_ad_position" ng-value="1"> UTM Ad Position
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_ad_position" class="empty_input"></div>
                <input type="text" ng-show="is_ad_position" placeholder="Enter UTM Ad Position" class="form-control" name="utm_adposition" id="utm_adposition" value="{adposition}">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="utm_medium =='Search Ads' || utm_medium =='Display Ads'">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_utm_device" ng-model="is_utm_device" ng-value="1"> UTM Device
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_utm_device" class="empty_input"></div>
                <input type="text"  ng-show="is_utm_device" placeholder="Enter UTM Device" class="form-control" name="utm_device" id="utm_device" value="{device}">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="utm_medium =='Search Ads' || utm_medium =='Display Ads'">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_utm_network" ng-model="is_utm_network" ng-value="1"> UTM Network
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_utm_network" class="empty_input"></div>
                <input type="text"  ng-show="is_utm_network" placeholder="Enter UTM Network" class="form-control" name="utm_network" id="utm_network" value="">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="utm_medium =='Search Ads' || utm_medium =='Display Ads'">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_utm_placement" ng-model="is_utm_placement" ng-value="1"> UTM Placement
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_utm_placement" class="empty_input"></div>
                <input type="text"  ng-show="is_utm_placement" placeholder="Enter UTM Placement" class="form-control" name="utm_placement" id="utm_placement" value="{placement}">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="utm_medium =='Search Ads' || utm_medium =='Display Ads'">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_utm_target" ng-model="is_utm_target" ng-value="1"> UTM Target
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_utm_target" class="empty_input"></div>
                <input type="text"  ng-show="is_utm_target" placeholder="Enter UTM Target" class="form-control" name="utm_target" id="utm_target" value="{targetid}">
            </div>
            <div class="col-md-3 utm_input_col" ng-show="utm_medium =='Search Ads' || utm_medium =='Display Ads'">
                <div class="kt-checkbox-inline">
                    <label class="kt-checkbox kt-checkbox--brand">
                        <input type="checkbox" name="is_ad_group" ng-model="is_ad_group" ng-value="1"> UTM Ad Group
                        <span></span>
                    </label>
                </div>
                <div ng-hide="is_ad_group" class="empty_input"></div>
                <input type="text"  ng-show="is_ad_group" placeholder="Enter UTM Ad" class="form-control" name="utm_ad" id="utm_ad" value="{adgroupid}">
            </div>
        </div>
                                                
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>
</form>
<iframe ng-hide="dynamic_lp" id="show_current_lp" src="" style="display: none; height: 500px; border:7px solid #222; width: 100%;"></iframe>

<!--end::Form-->
</div>
</div>
</div>
<!--end::Portlet-->


<!-- setting_store -->
<div class="modal fade" id="new_milestone_activity" tabindex="12" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('store_lp') }}">
                @csrf
                <input type="hidden" name="setting_cat" value="Activity">
                <input type="hidden" name="setting_name" value="milestone">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Dynamic Landing Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 10px 30px;">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Landing Page Name</label>
                            <input type="text" placeholder="" required="" maxlength="255" class="form-control" name="name" id="name" value="" />
                        </div>
                        <div class="col-md-8">
                            <label>Landing Page URL</label>
                            <input type="text" placeholder="" required="" maxlength="255" class="form-control" name="url" id="url" value="" />
                            <p class="mt-4">Don't Create Duplicate Landing Page - Please check the Listed Dynamic Landing Pages before creatiing a new one</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('header_css')
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
$(document).ready(function(){

    $('#select_lp_template').select2({
        placeholder: "Select LP Template"
    });
    $('#select_lp_template').change(function(){
        let current_lp = $(this).val();
        $('#show_current_lp').show();
        $('#show_current_lp').attr('src', current_lp);
    });
});
        
    </script>
@endsection