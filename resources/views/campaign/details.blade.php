@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
    @include('campaign.sub_header')
    <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                @if($message = Session::get('success'))
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

                @php
                if(app('request')->input('show') == 'ad_camp'){
                    $active_data=[
                        '1' => "",
                        '2' => "active",
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
                <div class="kt-portlet kt-portlet--tabs">
                    @include('campaign.sidebar', $active_data)
                    
                    <div class="kt-portlet__body" style="padding: 2px !important;">
                        <div class="tab-content">
                            <div class="tab-pane {{ app('request')->input('show') == ''? 'active':'' }}"" id="metrix" role="tabpanel">
                                @include('campaign.metrix')
                            </div>
                            <div class="tab-pane {{ app('request')->input('show') == 'ad_camp'? 'active':'' }}" id="ad_campaigns" role="tabpanel">
                                @include('campaign.tabs.ad_camp')
                            </div>
                            <div class="tab-pane" id="tab_milestones" role="tabpanel">
                                @include('campaign.tabs.milestones')
                            </div>
                            <div class="tab-pane" id="tab_description" role="tabpanel">
                                @include('campaign.tabs.description')
                            </div>
                            <div class="tab-pane" id="tab_tasks" role="tabpanel">
                                @include('campaign.tabs.tasks')
                            </div>
                            <div class="tab-pane" id="tab_leads" role="tabpanel">
                                @include('campaign.tabs.leads')
                            </div>
                            <div class="tab-pane" id="tab_comments" role="tabpanel">
                                @include('campaign.tabs.comments')
                            </div>
                            <div class="tab-pane" id="tab_documents" role="tabpanel">
                                @include('campaign.tabs.documents')
                            </div>
                            <div class="tab-pane" id="tab_expenses" role="tabpanel">
                                @include('campaign.tabs.expenses')
                            </div>
                            <div class="tab-pane" id="tab_analytics" role="tabpanel">
                                @include('campaign.tabs.analytics')
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
<!-- </div> -->
@include('campaign.modal.edit')
@include('campaign.modal.new')
@endsection @section('footer_js')
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
<!-- <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script> -->
<script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    // echo_source_list_width

    tinymce.init({
        selector: '.tiny_editor_onload',
        menubar: false,
        toolbar: ['styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'], 
        plugins : 'advlist autolink link image lists charmap print preview code'
    });
    $(window).on("show.bs.modal", function(event){
        tinymce.remove('.tiny_editor_popup');
        tinymce.init({
        selector: '.tiny_editor_popup',
        menubar: false,
        toolbar: ['styleselect fontselect fontsizeselect',
            'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
            'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'], 
        plugins : 'advlist autolink link image lists charmap print preview code'
        });
    });
});
</script>
<!-- test Mahi -->
@endsection