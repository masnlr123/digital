<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Media Plans</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="#!/create" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Media Plans
                            </a>
                            <a href="#!/index" class="btn btn-warning btn-elevate btn-icon-sm">
                                <i class="flaticon-reply"></i>
                                All Media Plans
                            </a>
                        </div>
                        <div class="kt-portlet__head-actions">
                            <a href="#!/create" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Media Plans
                            </a>
                        </div>
                    </div>

                </div>
        </div>
    </div>
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                @if($message = Session::get('campaign_updated'))
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
            </div>
        </div>
        
<div class="row">
    <div class="col-md-12 campp-task-add">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tabs">

                @php
                if(app('request')->input('show') == 'ad_camp'){
                    $active_data=[
                        '1' => "active",
                        '2' => "",
                        '3' => "",
                        '4' => "",
                        '5' => "",
                        '6' => "",
                        '7' => "",
                        '8' => "",
                        '9' => "",
                        '10' => ""
                    ];
                }
                else{
                    $active_data=[
                        '1' => "active",
                        '2' => "",
                        '3' => "",
                        '4' => "",
                        '5' => "",
                        '6' => "",
                        '7' => "",
                        '8' => "",
                        '9' => "",
                        '10' => ""
                    ];

                }
                
                @endphp
            @include('campaign.sidebar', $active_data)
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="metrix" role="tabpanel">
                        @include('campaign.metrix')
                    </div>
                    <div class="tab-pane {{ app('request')->input('show') == 'ad_camp'? 'active':'' }}" id="ad_campaigns" role="tabpanel">
                        @include('campaign.tabs.ad_camp')
                    </div>
                    <div class="tab-pane" id="tab_logs" role="tabpanel">
                        @include('campaign.tabs.logs')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    <!--end::Portlet-->
</div>
</div>

@include('campaign.modal.edit')
@include('campaign.modal.new')