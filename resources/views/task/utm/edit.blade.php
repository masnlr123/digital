@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div>
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   UTM Link Details</h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_details" role="tab">
                            <i class="fa fa-eye" aria-hidden="true"></i>UTM Details
                        </a>
                    </li>
<!--                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                            <i class="fa fa-eye" aria-hidden="true"></i>View
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab">
                            <i class="fab fa-gitter" aria-hidden="true"></i>Activity Logs
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_details" role="tabpanel">

        <div class="row">
        <div class="kt-widget1 col-md-12 utm_output">
            <code>{{ $utm_task->output }}</code>
        </div>
        <div class="kt-widget1 col-md-5" style="padding:20px 10px;">
            <h5 style="margin: 15px 0;">View UTM Details </h5>
            <table class="table table-bordered table-success table-striped table-large">
                <tbody>
                    <tr>
                        <td>Source</td>
                        <td>{{ $utm_task->utm_source }}</td>
                    </tr>
                    <tr>
                        <td>Project</td>
                        <td>{{ $utm_task->project }}</td>
                    </tr>
                    <tr>
                        <td>Campaign</td>
                        <td>{{ $utm_task->campaign }}</td>
                    </tr>
                    <tr>
                        <td>UTM Medium</td>
                        <td>{{ $utm_task->utm_medium }}</td>
                    </tr>
                    <tr>
                        <td>UTM Campaign</td>
                        <td>{{ $utm_task->utm_campaign }}</td>
                    </tr>
                    <tr>
                        <td>UTM Term</td>
                        <td>{{ $utm_task->utm_term }}</td>
                    </tr>
                    <tr>
                        <td>UTM Content</td>
                        <td>{{ $utm_task->utm_content }}</td>
                    </tr>
                    <tr>
                        <td>utm_aUTM Adposition</td>
                        <td>{{ $utm_task->utm_adposition }}</td>
                    </tr>
                    <tr>
                        <td>UTM Device</td>
                        <td>{{ $utm_task->utm_device }}</td>
                    </tr>
                    <tr>
                        <td>UTM Network</td>
                        <td>{{ $utm_task->utm_network }}</td>
                    </tr>
                    <tr>
                        <td>UTM Placement</td>
                        <td>{{ $utm_task->utm_placement }}</td>
                    </tr>
                    <tr>
                        <td>UTM Target</td>
                        <td>{{ $utm_task->utm_target }}</td>
                    </tr>
                    <tr>
                        <td>UTM Ad Group</td>
                        <td>{{ $utm_task->utm_ad }}</td>
                    </tr>
                    <tr>
                        <td>Created By</td>
                        <td>{{ $utm_task->created_by }}</td>
                    </tr>
                </tbody>
                
            </table>
        </div>
        <div class="kt-widget1 col-md-7" style="padding:20px 10px;">

                <h5 style="margin: 15px 0;">Edit UTM Details </h5>

<form  ng-app="" class="kt-form utm_link_edit_form" method="post" action="{{ route('update_utm', $utm_task->id) }}">
    @csrf
    {{ method_field('PUT') }}
        <div class="form-group row">
            <div class="col-md-12">
                <label>LP/Website URL</label>
                <input type="text" placeholder="" required="" maxlength="255" class="form-control" name="url" id="url" value="{{ $utm_task->url }}">
            </div>
            <div class="col-md-6 mt-3">
                <label>Internal Campaign</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_campaign" name="campaign">
                    <option value="">** Select a Campaign</option>
                    <option value="0">Non Campaign Task</option>
                    @foreach($campaigns as $campaign)
                    <option {{ $campaign->name == $utm_task->campaign? 'selected': '' }} value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>UTM Medium</label>
                <select style="width: 100%" class="form-control" id="utm_medium" name="utm_medium" ng-model="utm_medium">
                    <option value="">** Select a UTM Medium</option>
                    <option {{ $utm_task->utm_medium == 'Search Ads'? 'selected': '' }} value="Search Ads">Search Ads</option>
                    <option {{ $utm_task->utm_medium == 'Display Ads'? 'selected': '' }} value="Display Ads">Display Ads</option>
                    <option {{ $utm_task->utm_medium == 'Video Ads'? 'selected': '' }} value="Video Ads">Video Ads</option>
                    <option value="Social Ads" {{ $utm_task->utm_medium == 'Social Ads'? 'selected': '' }}>Social Ads</option>
                    <option {{ $utm_task->utm_medium == 'Native Ads'? 'selected': '' }} value="Native Ads">Native Ads</option>
                    <option {{ $utm_task->utm_medium == 'Aggregators Ads'? 'selected': '' }} value="Aggregators Ads">Aggregators Ads</option>
                    <option {{ $utm_task->utm_medium == 'Support & IM'? 'selected': '' }} value="Support & IM">Support & IM</option>
                    <option {{ $utm_task->utm_medium == 'Search Organic'? 'selected': '' }} value="Search Organic">Search Organic</option>
                    <option {{ $utm_task->utm_medium == 'Social Organic'? 'selected': '' }} value="Social Organic">Social Organic</option>
                    <option {{ $utm_task->utm_medium == 'Listing Aggregators'? 'selected': '' }} value="Listing Aggregators">Listing Aggregators</option>
                    <option {{ $utm_task->utm_medium == 'Direct Traffic'? 'selected': '' }} value="Direct Traffic">Direct Traffic</option>
                    <option {{ $utm_task->utm_medium == 'Referral Sites'? 'selected': '' }} value="Referral Sites">Referral Sites</option>
                    <option {{ $utm_task->utm_medium == 'Backlinks'? 'selected': '' }} value="Backlinks">Backlinks</option>
                    <option {{ $utm_task->utm_medium == 'Internal Sites'? 'selected': '' }} value="Internal Sites">Internal Sites</option>
                    <option {{ $utm_task->utm_medium == 'Q&A'? 'selected': '' }} value="Q&A">Q&A</option>
                    <option {{ $utm_task->utm_medium == 'Corporate Website'? 'selected': '' }} value="Corporate Website">Corporate Website</option>
                    <option {{ $utm_task->utm_medium == 'Hyper Target Marketing'? 'selected': '' }} value="Hyper Target Marketing">Hyper Target Marketing</option>
                    <option {{ $utm_task->utm_medium == 'Geo Fencing'? 'selected': '' }} value="Geo Fencing">Geo Fencing</option>
                    <option {{ $utm_task->utm_medium == 'OTT Platform'? 'selected': '' }} value="OTT Platform">OTT Platform</option>
                    <option {{ $utm_task->utm_medium == 'Email Marketing'? 'selected': '' }} value="Email Marketing">Email Marketing</option>
                    <option {{ $utm_task->utm_medium == 'Video Marketing'? 'selected': '' }} value="Video Marketing">Video Marketing</option>
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>UTM Source</label>
                <select style="width: 100%" class="form-control" id="utm_source" name="utm_source">
                    <option value="">** Select a UTM Source</option>
                    <option ng-show="utm_medium =='Search Ads'" {{ $utm_task->utm_source == 'Google Text'? 'selected': '' }} value="Google Text">Google Text</option>
<option ng-show="utm_medium =='Display Ads'" {{ $utm_task->utm_source == 'Google Dsp'? 'selected': '' }} value="Google Dsp">Google Dsp</option>
<option ng-show="utm_medium =='Display Ads'" {{ $utm_task->utm_source == 'Google Disc'? 'selected': '' }} value="Google Disc">Google Disc</option>
<option ng-show="utm_medium =='Video Ads'" {{ $utm_task->utm_source == 'Youtube Ads'? 'selected': '' }} value="Youtube Ads">Youtube Ads</option>
<option ng-show="utm_medium =='Social Ads'" {{ $utm_task->utm_source == 'Facebook Ads'? 'selected': '' }} value="Facebook Ads">Facebook Ads</option>
<option ng-show="utm_medium =='Social Ads'" {{ $utm_task->utm_source == 'Linkedin Ads'? 'selected': '' }} value="Linkedin Ads">Linkedin Ads</option>
<option ng-show="utm_medium =='Social Ads'" {{ $utm_task->utm_source == 'Twitter Ads'? 'selected': '' }} value="Twitter Ads">Twitter Ads</option>
<option ng-show="utm_medium =='Social Ads'" {{ $utm_task->utm_source == 'Instagram Ads'? 'selected': '' }} value="Instagram Ads">Instagram Ads</option>
<option ng-show="utm_medium =='Native Ads'" {{ $utm_task->utm_source == 'Taboola'? 'selected': '' }} value="Taboola">Taboola</option>
<option ng-show="utm_medium =='Native Ads'" {{ $utm_task->utm_source == 'Columbia'? 'selected': '' }} value="Columbia">Columbia</option>
<option ng-show="utm_medium =='Native Ads'" {{ $utm_task->utm_source == 'Adgebra'? 'selected': '' }} value="Adgebra">Adgebra</option>
<option ng-show="utm_medium =='Native Ads'" {{ $utm_task->utm_source == 'Mounting Digital'? 'selected': '' }} value="Mounting Digital">Mounting Digital</option>
<option ng-show="utm_medium =='Native Ads'" {{ $utm_task->utm_source == 'Outbrain'? 'selected': '' }} value="Outbrain">Outbrain</option>
<option ng-show="utm_medium =='Native Ads'" {{ $utm_task->utm_source == 'Daily Hunt'? 'selected': '' }} value="Daily Hunt">Daily Hunt</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == '99acres'? 'selected': '' }} value="99acres">99acres</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'MagicBricks'? 'selected': '' }} value="MagicBricks">MagicBricks</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'Housing'? 'selected': '' }} value="Housing">Housing</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'India Property'? 'selected': '' }} value="India Property">India Property</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'Chennai Properties'? 'selected': '' }} value="Chennai Properties">Chennai Properties</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'CommonFloor'? 'selected': '' }} value="CommonFloor">CommonFloor</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'Roof&floor'? 'selected': '' }} value="Roof&floor">Roof&floor</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'Zricks'? 'selected': '' }} value="Zricks">Zricks</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'Sulekha'? 'selected': '' }} value="Sulekha">Sulekha</option>
<option ng-show="utm_medium =='Aggregators Ads'" {{ $utm_task->utm_source == 'NoBroker'? 'selected': '' }} value="NoBroker">NoBroker</option>
<option ng-show="utm_medium =='Support & IM'" {{ $utm_task->utm_source == 'Web Chat'? 'selected': '' }} value="Web Chat">Web Chat</option>
<option ng-show="utm_medium =='Support & IM'" {{ $utm_task->utm_source == 'Whatsapp'? 'selected': '' }} value="Whatsapp">Whatsapp</option>
<option ng-show="utm_medium =='Support & IM'" {{ $utm_task->utm_source == 'SMS-Digital'? 'selected': '' }} value="SMS-Digital">SMS-Digital</option>
<option ng-show="utm_medium =='Search Organic'" {{ $utm_task->utm_source == 'Organic Search'? 'selected': '' }} value="Organic Search">Organic Search</option>
<option ng-show="utm_medium =='Search Organic'" {{ $utm_task->utm_source == 'GBL'? 'selected': '' }} value="GBL">GBL</option>
<option ng-show="utm_medium =='Social Organic'" {{ $utm_task->utm_source == 'Social Posts'? 'selected': '' }} value="Social Posts">Social Posts</option>
<option ng-show="utm_medium =='Social Organic'" {{ $utm_task->utm_source == 'FB Marketplace'? 'selected': '' }} value="FB Marketplace">FB Marketplace</option>
<option ng-show="utm_medium =='Social Organic'" {{ $utm_task->utm_source == 'FB Commenting'? 'selected': '' }} value="FB Commenting">FB Commenting</option>
<option ng-show="utm_medium =='Listing Aggregators'" {{ $utm_task->utm_source == 'ClickIndia-Listing'? 'selected': '' }} value="ClickIndia-Listing">ClickIndia-Listing</option>
<option ng-show="utm_medium =='Listing Aggregators'" {{ $utm_task->utm_source == 'Makaan-Listing'? 'selected': '' }} value="Makaan-Listing">Makaan-Listing</option>
<option ng-show="utm_medium =='Listing Aggregators'" {{ $utm_task->utm_source == 'Propertywala-Listing'? 'selected': '' }} value="Propertywala-Listing">Propertywala-Listing</option>
<option ng-show="utm_medium =='Listing Aggregators'" {{ $utm_task->utm_source == 'MyPropertyBoutique-Listing'? 'selected': '' }} value="MyPropertyBoutique-Listing">MyPropertyBoutique-Listing</option>
<option ng-show="utm_medium =='Listing Aggregators'" {{ $utm_task->utm_source == 'Quickr-Listing'? 'selected': '' }} value="Quickr-Listing">Quickr-Listing</option>
<option ng-show="utm_medium =='Direct Traffic'" {{ $utm_task->utm_source == 'Direct Traffic'? 'selected': '' }} value="Direct Traffic">Direct Traffic</option>
<option ng-show="utm_medium =='Referral Sites'" {{ $utm_task->utm_source == 'Referral Sites'? 'selected': '' }} value="Referral Sites">Referral Sites</option>
<option ng-show="utm_medium =='Backlinks'" {{ $utm_task->utm_source == 'Backlinks'? 'selected': '' }} value="Backlinks">Backlinks</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'JS -Website'? 'selected': '' }} value="JS -Website">JS -Website</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'JR -Website'? 'selected': '' }} value="JR -Website">JR -Website</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'HG -Website'? 'selected': '' }} value="HG -Website">HG -Website</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'AGR Website'? 'selected': '' }} value="AGR Website">AGR Website</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'Eternity Website'? 'selected': '' }} value="Eternity Website">Eternity Website</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'VIB Website'? 'selected': '' }} value="VIB Website">VIB Website</option>

<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'bpc Website'? 'selected': '' }} value="bpc Website">bpc Website</option>
<option ng-show="utm_medium =='Internal Sites'" {{ $utm_task->utm_source == 'CNCB Website'? 'selected': '' }} value="CNCB Website">CNCB Website</option>
<option ng-show="utm_medium =='Q&A'" {{ $utm_task->utm_source == 'Quora'? 'selected': '' }} value="Quora">Quora</option>
<option ng-show="utm_medium =='Corporate Website'" {{ $utm_task->utm_source == 'LP Alliance Website'? 'selected': '' }} value="LP Alliance Website">LP Alliance Website</option>
<option ng-show="utm_medium =='Corporate Website'" {{ $utm_task->utm_source == 'LP Urbanrise Website'? 'selected': '' }} value="LP Urbanrise Website">LP Urbanrise Website</option>
<option ng-show="utm_medium =='Hyper Target Marketing'" {{ $utm_task->utm_source == 'Cross Campaign'? 'selected': '' }} value="Cross Campaign">Cross Campaign</option>
<option ng-show="utm_medium =='Geo Fencing'" {{ $utm_task->utm_source == 'Geo Fencing'? 'selected': '' }} value="Geo Fencing">Geo Fencing</option>
<option ng-show="utm_medium =='OTT Platform'" {{ $utm_task->utm_source == 'Hotstar Ads'? 'selected': '' }} value="Hotstar Ads">Hotstar Ads</option>
<option ng-show="utm_medium ==''" {{ $utm_task->utm_source == 'Zee5 Ads'? 'selected': '' }} value="Zee5 Ads">Zee5 Ads</option>
<option ng-show="utm_medium =='Email Marketing'" {{ $utm_task->utm_source == 'Internal Email DB'? 'selected': '' }} value="Internal Email DB">Internal Email DB</option>
<option ng-show="utm_medium =='Email Marketing'" {{ $utm_task->utm_source == 'External Email DB'? 'selected': '' }} value="External Email DB">External Email DB</option>
<option ng-show="utm_medium =='Video Marketing'" {{ $utm_task->utm_source == 'YouTube'? 'selected': '' }} value="YouTube">YouTube</option>

                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>UTM Campaign</label>
                <input type="text" placeholder="Enter UTM Campaign" class="form-control" name="utm_campaign" id="utm_campaign" value="{{ $utm_task->utm_campaign }}">
            </div>
            <div class="col-md-6 mt-3">
                <label>UTM Term</label>
                <input type="text" placeholder="Enter UTM Term" class="form-control" name="utm_term" id="utm_term" value="{{ $utm_task->utm_term }}">
            </div>
            <div class="col-md-6 mt-3">
                <label>UTM Content</label>
                <input type="text" placeholder="Enter UTM Content" class="form-control" name="utm_content" id="utm_content" value="{{ $utm_task->utm_content }}">
            </div>
            <div class="col-md-4 mt-3">
                <label>UTM Ad Position</label>
                <input type="text" placeholder="Enter UTM Ad Position" class="form-control" name="utm_adposition" id="utm_adposition" value="{{ $utm_task->utm_adposition }}">
            </div>
            <div class="col-md-4 mt-3">
                <label>UTM Device</label>
                <input type="text" placeholder="Enter UTM Device" class="form-control" name="utm_device" id="utm_device" value="{{ $utm_task->utm_device }}">
            </div>
            <div class="col-md-4 mt-3">
                <label>UTM Network</label>
                <input type="text" placeholder="Enter UTM Network" class="form-control" name="utm_network" id="utm_network" value="{{ $utm_task->utm_network }}">
            </div>
            <div class="col-md-4 mt-3">
                <label>UTM Placement</label>
                <input type="text" placeholder="Enter UTM Placement" class="form-control" name="utm_placement" id="utm_placement" value="{{ $utm_task->utm_placement }}">
            </div>
            <div class="col-md-4 mt-3">
                <label>UTM Target</label>
                <input type="text" placeholder="Enter UTM Target" class="form-control" name="utm_target" id="utm_target" value="{{ $utm_task->utm_target }}">
            </div>
            <div class="col-md-4 mt-3">
                <label>UTM Ad Group</label>
                <input type="text" placeholder="Enter UTM Ad" class="form-control" name="utm_ad" id="utm_ad" value="{{ $utm_task->utm_ad }}">
            </div>
        </div>
               

    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </div>
</form>
        </div>
        <hr>
        <div class="col-12">
            
            
            <header class="preview-header">
  <label>Device preview</label> <input type="text" class="textfield-url" />
</header>

<main class="preview-main">
  <div class="preview-content">
    <iframe id="preview-iframe"></iframe>
    <div class="loading">Loading<div>...<span>&nbsp;</span></div></div>
  </div>
</main>

<footer class="preview-footer">
  <button class="left" onclick="app.click(this,event,1)"><i class="material-icons">watch</i></button>
  <button class="left" onclick="app.click(this,event,2)"><i class="material-icons">phone_iphone</i></button>
  <button class="center" onclick="app.click(this,event,3)"><i class="material-icons">tablet_mac</i></button>
  <button class="right" onclick="app.click(this,event,4)"><i class="material-icons">laptop_mac</i></button>
  <button class="right" onclick="app.click(this,event,5)"><i class="material-icons">tv</i></button>
</footer>
        </div>
    </div>
</div>
            <div class="tab-pane" id="kt_portlet_logs" role="tabpanel">
                <h4 style="margin: 15px 0;">Activity Logs</h4>
                <!--Begin::Timeline 3 -->
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">

                        @foreach($activity as $act)
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">{{ $act->created_at->format('H:i') }}</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text  kt-padding-top-5">
                                {!! $act->description !!}<br>
                                at <span class="kt-font-info">{{ $act->created_at->format('H:i:s d:m:Y') }}</span>, By <span class="kt-font-success">{{ $act->created_by }}</span>
                            </div>
                        </div>
                        @endforeach


<!--                         <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">12:45</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-success"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                AEOL Meeting With
                            </div>
                            <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                <a href="#"><img src="assets/media/users/100_4.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_13.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_11.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_14.jpg" title=""></a>
                            </div>
                        </div> -->


                    </div>
                </div>
                <!--End::Timeline 3 -->
            </div>

        </div>
    </div>
</div>
    </div>
</div>
<!--end::Portlet-->

</div>


@endsection
@section('header_css')
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <style type="text/css">
        .textfield-url {
  display: none;
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  min-width: 240px;
  text-align: center;
}

.preview-main {
  background: #555;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow-x: hidden;
    min-height: 500px;
}
.preview-main .preview-content {
  position: relative;
  width: 100%;
  height: 100%;
  transition: 1s;
  display: flex;
  flex-direction: column;
  flex: 1 1 auto;
  overflow-x: hidden;
  max-width: 3000px;
}
.preview-main .preview-content.device-1 {
  max-width: 160px;
}
.preview-main .preview-content.device-1 ::-webkit-scrollbar, .preview-main .preview-content.device-2 ::-webkit-scrollbar, .preview-main .preview-content.device-3 ::-webkit-scrollbar {
  display: none;
}
.preview-main .preview-content > iframe {
  position: relative;
  display: block;
  border: 0;
  width: 100%;
  min-height: 100%;
  flex: 1 1 auto;
  overflow: hidden;
  transition: opacity 3s;
  opacity: 0;
}
.preview-main .preview-content > iframe.ready {
  opacity: 1;
}
.preview-main .preview-content.device-2 {
  max-width: 350px;
}
.preview-main .preview-content.device-1 ::-webkit-scrollbar, .preview-main .preview-content.device-2 ::-webkit-scrollbar, .preview-main .preview-content.device-3 ::-webkit-scrollbar {
  display: none;
}
.preview-main .preview-content > iframe {
  position: relative;
  display: block;
  border: 0;
  width: 100%;
  min-height: 100%;
  flex: 1 1 auto;
  overflow: hidden;
  transition: opacity 3s;
  opacity: 0;
}
.preview-main .preview-content > iframe.ready {
  opacity: 1;
}
.preview-main .preview-content.device-3 {
  max-width: 770px;
}
.preview-main .preview-content.device-1 ::-webkit-scrollbar, .preview-main .preview-content.device-2 ::-webkit-scrollbar, .preview-main .preview-content.device-3 ::-webkit-scrollbar {
  display: none;
}
.preview-main .preview-content > iframe {
  position: relative;
  display: block;
  border: 0;
  width: 100%;
  min-height: 100%;
  flex: 1 1 auto;
  overflow: hidden;
  transition: opacity 3s;
  opacity: 0;
}
.preview-main .preview-content > iframe.ready {
  opacity: 1;
}
.preview-main .preview-content.device-4 {
  max-width: 1200px;
}
.preview-main .preview-content.device-1 ::-webkit-scrollbar, .preview-main .preview-content.device-2 ::-webkit-scrollbar, .preview-main .preview-content.device-3 ::-webkit-scrollbar {
  display: none;
}
.preview-main .preview-content > iframe {
  position: relative;
  display: block;
  border: 0;
  width: 100%;
  min-height: 100%;
  flex: 1 1 auto;
  overflow: hidden;
  transition: opacity 3s;
  opacity: 0;
}
.preview-main .preview-content > iframe.ready {
  opacity: 1;
}
.preview-main .preview-content.device-5 {
  max-width: 3000px;
}
.preview-main .preview-content.device-1 ::-webkit-scrollbar, .preview-main .preview-content.device-2 ::-webkit-scrollbar, .preview-main .preview-content.device-3 ::-webkit-scrollbar {
  display: none;
}
.preview-main .preview-content > iframe {
  position: relative;
  display: block;
  border: 0;
  width: 100%;
  min-height: 100%;
  flex: 1 1 auto;
  overflow: hidden;
  transition: opacity 3s;
  opacity: 0;
}
.preview-main .preview-content > iframe.ready {
  opacity: 1;
}

.preview-header, .preview-footer {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  background: #001c33;
  min-height: 2em;
  flex: 0;
  padding:15px 0;
}

.preview-header {
  text-transform: capitalize;
}
.preview-header > label {
  display: block;
  z-index: 1;
}
.preview-header > .md {
  width: 0;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  transition: 2s;
}
.preview-header > .md.show {
  width: 100%;
  opacity: 0;
}
.preview-header > .md.show--1 {
  background: rgba(255, 0, 0, 0.5);
}
.preview-header > .md.show--2 {
  background: rgba(0, 128, 0, 0.5);
}
.preview-header > .md.show--3 {
  background: rgba(30, 144, 255, 0.5);
}
.preview-header > .md.show--4 {
  background: rgba(255, 165, 0, 0.5);
}
.preview-header > .md.show--5 {
  background: rgba(255, 20, 147, 0.5);
}

.preview-footer {
  align-items: stretch;
}

.loading {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  text-align: center;
  color: dodgerblue;
  transition: 2s;
  padding: 0.5em;
  font-size: 14vmin;
}
.loading > div {
  display: inline-block;
  position: relative;
}
.loading > div > span {
  position: absolute;
  top: 0;
  right: 0;
  width: 0;
  background: #555;
  -webkit-animation: typing 0.5s steps(3) alternate infinite;
          animation: typing 0.5s steps(3) alternate infinite;
}
.loading.done {
  pointer-events: none;
  transform: scale(1.3);
  color: white;
  opacity: 0;
}
.loading.done > div {
  display: none;
}

button {
  -webkit-user-select: none;
  -moz-user-select: none;
   -ms-user-select: none;
       user-select: none;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  text-transform: uppercase;
  overflow: hidden;
  position: relative;
  transition: 0.5s;
  flex: 1;
  border: 0;
  background: transparent;
  max-width: 8em;
  color: inherit;
  cursor: pointer;
  outline: none;
  opacity: 0.5;
}
button:hover {
  opacity: 1;
}

.md-circle-effect {
  border-radius: 50%;
  position: absolute;
  background: rgba(255, 255, 255, 0.2);
}

.effect-1 {
  background: rgba(255, 0, 0, 0.5);
}

.effect-2 {
  background: rgba(0, 128, 0, 0.5);
}

.effect-3 {
  background: rgba(30, 144, 255, 0.5);
}

.effect-4 {
  background: rgba(255, 165, 0, 0.5);
}

.effect-5 {
  background: rgba(255, 20, 147, 0.5);
}

.animate-md {
  -webkit-animation: animate-material-design 1s ease-in forwards;
          animation: animate-material-design 1s ease-in forwards;
}

@-webkit-keyframes animate-material-design {
  0% {
    transform: scale(0);
    opacity: 1;
  }
  100% {
    transform: scale(1);
    opacity: 0;
  }
}

@keyframes animate-material-design {
  0% {
    transform: scale(0);
    opacity: 1;
  }
  100% {
    transform: scale(1);
    opacity: 0;
  }
}
@-webkit-keyframes typing {
  from {
    width: 100%;
  }
  to {
    width: 0;
  }
}
@keyframes typing {
  from {
    width: 100%;
  }
  to {
    width: 0;
  }
}
    </style>
@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script type="text/javascript">
    $(function() {
        $('.new-correction-block').hide();
        $('.assigner-block').hide();
        $('.process-transfer-block').hide();
        $('.internal-reiview-block').hide();
        @if($utm_task->status == 'internal_review')
        $('.creative-upload-block').show();
        @elseif($utm_task->status == 'external_review')
        $('.creative-upload-block').show();
        @elseif($utm_task->status == 'completed')
        $('.creative-upload-block').show();
        @else
        $('.creative-upload-block').hide();
        @endif;
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'new_needed') {
                $('.new-correction-block').show();
            }else {
                $('.new-correction-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'assigned') {
                $('.assigner-block').show(); 
            } else {
                $('.assigner-block').hide(); 
            } 
        });

        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'process_transfer') {
                $('.process-transfer-block').show(); 
            } else {
                $('.process-transfer-block').hide(); 
            } 
        });

        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'internal_review') {
                $('.creative-upload-block').show(); 
            } else {
                $('.creative-upload-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'external_review') {
                $('.creative-upload-block').show(); 
                $('.internal-reiview-block').show(); 
            } else {
                $('.internal-reiview-block').hide();
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'completed') {
                $('.creative-upload-block').show(); 
            }
        });

        var creative_image_height = $('.creative-row').height();
        $('.creative-action-block').height(creative_image_height);
        @if(!empty($creative_updated))
            swal.fire({
                        title: 'Deleted!',
                        text: "The Creative Image has been deleted Successfuly!",
                        type: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'OK!'
                    }).then(function(result) {
                        if (result.value) {
                            location.reload();
                        }
                    });

        @endif

        $('.deleteCreativeImg').click(function(e){
            var id = $(this).data("id");
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax(
                    {
                        url: "{{ url('/task/creative_image/delete/') }}/"+id,
                        type: 'delete', // replaced from put
                        dataType: "JSON",
                        data: {
                            "id": id // method and token not needed in data
                        },
                        success: function (response)
                        {
                            swal.fire({
                                title: 'Deleted!',
                                text: "The Creative Image has been deleted Successfuly!",
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'OK!'
                            }).then(function(result) {
                                if (result.value) {
                                    location.reload();
                                }
                            });


                            // swal.fire("Deleted!", "The Creative Image has been deleted Successfuly!", "error");
                            
                        },
                        error: function(xhr) {
                             console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        // $(".deleteCreativeImg").click(function(){

        //     var id = $(this).data("id");
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax(
        //     {
        //         url: "{{ url('/task/creative_image/delete/') }}/"+id,
        //         type: 'delete', // replaced from put
        //         dataType: "JSON",
        //         data: {
        //             "id": id // method and token not needed in data
        //         },
        //         success: function (response)
        //         {
        //             swal.fire("Deleted!", "The Creative Image has been deleted Successfuly!", "error");
        //             location.reload();
        //         },
        //         error: function(xhr) {
        //          console.log(xhr.responseText); // this line will save you tons of hours while debugging
        //         // do something here because of error
        //        }
        //     });
        // });




    });


        // $(document).on('change', '#select_task_status', function () {
        //     if ($(this).val() == 'assigned') {
        //         $('.assigner-block').show();
        //     }
        //     else {
        //         $('.assigner-block').hide();
        //     }
        // });
    </script>
    <script type="text/javascript">
        let app = (() => {

  // Insert your own url here
  // Probably only codepen urls due to cross origin iframe restriction
  const url = '{{ $utm_task->output }}';
  // codepen.io/kunukn/debug/WwepOL

  const $mainContent = document.getElementsByClassName('preview-content')[0],
  $header = document.getElementsByClassName('preview-header')[0],
  $headerLabel = $header.querySelector('label'),
  $loading = document.getElementsByClassName('loading')[0],
  $textfieldUrl = document.getElementsByClassName('textfield-url')[0],
  $iframe = document.getElementById('preview-iframe'),
  devices = ['device-1', 'device-2', 'device-3', 'device-4', 'device-5'],
  screens = ['watch', 'phone', 'tablet', 'laptop', 'widescreen'];

  $textfieldUrl.value = url;

  $iframe.addEventListener('load', function () {
    $loading.innerHTML = 'Ready';
    setTimeout(_ => {
      $loading.classList.add('done');
      $iframe.classList.add('ready');
    }, 100);

  });
  setTimeout(_ => $iframe.src = url, 500); // just to display loading screen a little longer

  function createButtonMaterialDesignEffect(element, event, type) {
    let md = document.createElement('div'),
    size = 500,
    center;
    const buttonHeight = 40;

    if (!element.offsetTop) {
      // offsetTop could not be used
      center = {
        x: event.pageX - element.offsetLeft - size / 2,
        y: buttonHeight / 2 - size / 2 };

    } else {
      center = {
        x: event.pageX - element.offsetLeft - size / 2,
        y: event.pageY - element.offsetTop - size / 2 };

    }

    md.style.width = `${size}px`;
    md.style.height = `${size}px`;
    md.style.left = `${center.x}px`;
    md.style.top = `${center.y}px`;
    md.classList.add('md-circle-effect');
    md.classList.add(`effect-${type}`);
    md.classList.add('animate-md');
    return md;
  }

  function createHeaderMaterialDesignEffect(element, event, type) {
    let md = document.createElement('div');
    md.classList.add('md');
    md.classList.add(`show--${type}`);
    return md;
  }

  function changeDevice(type) {
    // Clean css class
    devices.forEach(device => $mainContent.classList.remove(device));
    // Apply responsive change
    $mainContent.classList.add(`device-${type}`);
  }

  function click(element, event, type) {
    let mdButton = createButtonMaterialDesignEffect(element, event, type);
    element.appendChild(mdButton);
    setTimeout(_ => {
      // cleanup DOM
      if (element && mdButton) element.removeChild(mdButton);
    }, 5000);

    $headerLabel.textContent = screens[+type - 1];

    let mdHeader = createHeaderMaterialDesignEffect(element, event, type);
    $header.appendChild(mdHeader);
    setTimeout(_ => {
      mdHeader.classList.add('show'); // apply effect
    }, 100);
    setTimeout(() => {
      // cleanup DOM
      if ($header && mdHeader) $header.removeChild(mdHeader);
    }, 5000);

    changeDevice(type);
  }

  return {
    click };

})();
    </script>
@endsection