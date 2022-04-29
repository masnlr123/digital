@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
            Lead Name &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $lead->first_name }}</strong></h3>
            </div>
            <div class="kt-subheader__toolbar">{!! $back_url !!} <a href="{{ route('audit_index') }}" class="btn btn-warning btn-bold"><i class="fa fa-undo"></i> Back to All Audits</a>
                <a target="_blank" href="{{ $lead->lead_url }}" class="btn btn-brand btn-bold"><i class="flaticon2-paper-plane"></i> View in LeadSquared</a>
            </div>
        </div>
    </div>
    <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">@if($message = Session::get('success'))
                <div class="alert alert-success fade show" role="alert">
                    <div class="alert-icon"><i class="la la-check"></i>
                    </div>
                    <div class="alert-text">{{ $message }}</div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>@endif</div>
            <div class="col-md-4">
            @include('leads.inc.sidebar')
            </div>
            <div class="col-md-8">
                <div class="kt-portlet kt-portlet--tabs">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#lead_audit" role="tab"> <i class="flaticon2-chat" aria-hidden="true"></i>Lead Audit</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_details" role="tab"> <i class="flaticon2-line-chart" aria-hidden="true"></i>Activity History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab"> <i class="flaticon2-paper-plane" aria-hidden="true"></i>Lead Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab"> <i class="flaticon2-file" aria-hidden="true"></i>Notes</a>
                                </li>@if($current_lead->audit_count > 0)
                                <li class="nav-item" style="right: 8px;position: absolute;top: 8px;">
                                    <button data-toggle="modal" data-target="#model_new_followup_call" class="btn btn-sm btn-upper btn-info btn-bold"><i class="la la-plus"></i>New Follow up Call Audit</button>
                                </li>@endif</ul>
                        </div>
                    </div>
                    @include('leads.inc.followup_call')
                    <div class="kt-portlet__body">
                        <div class="tab-content">
                            @include('leads.tab.audits')
                            @include('leads.tab.activity')
                            @include('leads.tab.lead_details')
                            @include('leads.tab.notes')
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
</div>@endsection @section('header_css')
<style type="text/css">
    .select2.select2-container{
            width:100% !important;
        }
</style>
<script src="{{ asset('assets/js/angular.min.js') }}"></script>
@endsection @section('footer_js')
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
<script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
<!-- <script src="{{ asset('assets/js/pages/crud/forms/widgets/nouislider.js') }}"></script> -->
<script type="text/javascript">
    $(document).ready(function(){
                var count_inc = parseInt("1");
                @if($current_lead->audit_count > 0)
                var total_count = '';
                @else
                var total_count = parseInt("0");
                @endif
                function count_checktat($id){  
                    $($id).click(function(){
                        if($($id).is(':checked')){
                            total_count = total_count + count_inc;
                            $('#dis_check_count').text(total_count);
                            $('#total_yes').val(total_count);
                            $('#dis_check_count_new').text(total_count);
                            $('#total_yes_new').val(total_count);
                        }
                        else{
                            total_count = total_count - count_inc;
                            $('#dis_check_count').text(total_count);
                            $('#total_yes').val(total_count);
                            $('#dis_check_count_new').text(total_count);
                            $('#total_yes_new').val(total_count);
                        }
                    });
                }
                count_checktat('#count_check_1');
                count_checktat('#count_check_2');
                count_checktat('#count_check_3');
                count_checktat('#count_check_4');
                count_checktat('#count_check_5');
                count_checktat('#count_check_6');
                count_checktat('#count_check_7');
                count_checktat('#count_check_8');
                count_checktat('#count_check_9');
                count_checktat('#new_count_check_1');
                count_checktat('#new_count_check_2');
                count_checktat('#new_count_check_3');
                count_checktat('#new_count_check_4');
                count_checktat('#new_count_check_5');
                count_checktat('#new_count_check_6');
                count_checktat('#new_count_check_7');
                count_checktat('#new_count_check_8');
                count_checktat('#new_count_check_9');
                if(total_count == 0){
                    $('#dis_check_count').text('0');
                    $('#total_yes').val(total_count);
                    $('#dis_check_count_new').text('0');
                    $('#total_yes_new').val(total_count);
                }
@foreach($current_lead->audit as $audit)
                $('#select2_select{{ $audit->id }}').select2({
                    placeholder: "Select a Feedback"
                });
                @endforeach
    
            });
    
    
    jQuery(document).ready(function() {
        audit_scrore_range(0, 6, '#fresh_slider_a1');
        audit_scrore_range(0, 6, '#fresh_slider_a2');
        audit_scrore_range(0, 6, '#fresh_slider_a3');
        audit_scrore_range(0, 7, '#fresh_slider_a4');
        audit_scrore_range(0, 5, '#fresh_slider_b1');
        audit_scrore_range(0, 5, '#fresh_slider_b2');
        audit_scrore_range(0, 2, '#fresh_slider_b3');
        audit_scrore_range(0, 2, '#fresh_slider_b4');
        audit_scrore_range(0, 4, '#fresh_slider_b5');
        audit_scrore_range(0, 2, '#fresh_slider_b6');
        audit_scrore_range(0, 10, '#fresh_slider_c1');
        audit_scrore_range(0, 5, '#fresh_slider_c2');
        audit_scrore_range(0, 5, '#fresh_slider_c3');
        audit_scrore_range(0, 10, '#fresh_slider_d1');
        audit_scrore_range(0, 10, '#fresh_slider_d2');
        audit_scrore_range(0, 15, '#fresh_slider_d3');

        audit_scrore_range(0, 5, '#followup_slider_a1');
        audit_scrore_range(0, 3, '#followup_slider_a2');
        audit_scrore_range(0, 2, '#followup_slider_a3');
        audit_scrore_range(0, 5, '#followup_slider_a4');
        audit_scrore_range(0, 15, '#followup_slider_b1');
        audit_scrore_range(0, 20, '#followup_slider_b2');
        audit_scrore_range(0, 5, '#followup_slider_c1');
        audit_scrore_range(0, 2, '#followup_slider_c2');
        audit_scrore_range(0, 3, '#followup_slider_c3');
        audit_scrore_range(0, 15, '#followup_slider_d1');
        audit_scrore_range(0, 10, '#followup_slider_d2');
        audit_scrore_range(0, 10, '#followup_slider_d3');
    
        @if($current_lead->audit_count > 0)
    
        $('#audit_final_total_score').ionRangeSlider({
            type: "double",
            min: 0,
            max: 100,
            from: 0,
            to: 100,
            to: '{{ $current_lead->total_avg() }}',
            postfix: "%",
            from_fixed: true,
            to_fixed: true
        });
    
        @foreach($current_lead->audit as $audit)
        $('#audit_total_score{{ $audit->id }}').ionRangeSlider({
            type: "double",
            min: 0,
            max: 100,
            from: 0,
            to: '{{ $audit->total_score }}',
            postfix: "%",
            from_fixed: true,
            to_fixed: true
        });
        @php
        $score_board = json_decode($audit->score);
        @endphp
        @if($audit->type =='fresh')

        view_range(0, 6, {{ $score_board->{1} }}, '#audit_score_view_a1{{ $audit->id }}');
        view_range(0, 6,  {{ $score_board->{2} }}, '#audit_score_view_a2{{ $audit->id }}');
        view_range(0, 6,  {{ $score_board->{3} }}, '#audit_score_view_a3{{ $audit->id }}');
        view_range(0, 7,  {{ $score_board->{4} }}, '#audit_score_view_a4{{ $audit->id }}');
        view_range(0, 5,  {{ $score_board->{5} }}, '#audit_score_view_b1{{ $audit->id }}');
        view_range(0, 5,  {{ $score_board->{6} }}, '#audit_score_view_b2{{ $audit->id }}');
        view_range(0, 2,  {{ $score_board->{7} }}, '#audit_score_view_b3{{ $audit->id }}');
        view_range(0, 2,  {{ $score_board->{8} }}, '#audit_score_view_b4{{ $audit->id }}');
        view_range(0, 4,  {{ $score_board->{9} }}, '#audit_score_view_b5{{ $audit->id }}');
        view_range(0, 2,  {{ $score_board->{10} }}, '#audit_score_view_b6{{ $audit->id }}');
        view_range(0, 10,  {{ $score_board->{11} }}, '#audit_score_view_c1{{ $audit->id }}');
        view_range(0, 5,  {{ $score_board->{12} }}, '#audit_score_view_c2{{ $audit->id }}');
        view_range(0, 5,  {{ $score_board->{13} }}, '#audit_score_view_c3{{ $audit->id }}');
        view_range(0, 10,  {{ $score_board->{14} }}, '#audit_score_view_d1{{ $audit->id }}');
        view_range(0, 10,  {{ $score_board->{15} }}, '#audit_score_view_d2{{ $audit->id }}');
        view_range(0, 15,  {{ $score_board->{16} }}, '#audit_score_view_d3{{ $audit->id }}');

        edit_range(0, 6, {{ $score_board->{1} }}, '#audit_score_edit_a1{{ $audit->id }}');
        edit_range(0, 6,  {{ $score_board->{2} }}, '#audit_score_edit_a2{{ $audit->id }}');
        edit_range(0, 6,  {{ $score_board->{3} }}, '#audit_score_edit_a3{{ $audit->id }}');
        edit_range(0, 7,  {{ $score_board->{4} }}, '#audit_score_edit_a4{{ $audit->id }}');
        edit_range(0, 5,  {{ $score_board->{5} }}, '#audit_score_edit_b1{{ $audit->id }}');
        edit_range(0, 5,  {{ $score_board->{6} }}, '#audit_score_edit_b2{{ $audit->id }}');
        edit_range(0, 2,  {{ $score_board->{7} }}, '#audit_score_edit_b3{{ $audit->id }}');
        edit_range(0, 2,  {{ $score_board->{8} }}, '#audit_score_edit_b4{{ $audit->id }}');
        edit_range(0, 4,  {{ $score_board->{9} }}, '#audit_score_edit_b5{{ $audit->id }}');
        edit_range(0, 2,  {{ $score_board->{10} }}, '#audit_score_edit_b6{{ $audit->id }}');
        edit_range(0, 10,  {{ $score_board->{11} }}, '#audit_score_edit_c1{{ $audit->id }}');
        edit_range(0, 5,  {{ $score_board->{12} }}, '#audit_score_edit_c2{{ $audit->id }}');
        edit_range(0, 5,  {{ $score_board->{13} }}, '#audit_score_edit_c3{{ $audit->id }}');
        edit_range(0, 10,  {{ $score_board->{14} }}, '#audit_score_edit_d1{{ $audit->id }}');
        edit_range(0, 10,  {{ $score_board->{15} }}, '#audit_score_edit_d2{{ $audit->id }}');
        edit_range(0, 15,  {{ $score_board->{16} }}, '#audit_score_edit_d3{{ $audit->id }}');

        @else
        view_range(0, 5,  {{ $score_board->{1} }}, '#audit_score_view_a1{{ $audit->id }}');
        view_range(0, 3,  {{ $score_board->{2} }}, '#audit_score_view_a2{{ $audit->id }}');
        view_range(0, 2,  {{ $score_board->{3} }}, '#audit_score_view_a3{{ $audit->id }}');
        view_range(0, 5,  {{ $score_board->{4} }}, '#audit_score_view_a4{{ $audit->id }}');
        view_range(0, 15,  {{ $score_board->{5} }}, '#audit_score_view_b1{{ $audit->id }}');
        view_range(0, 20,  {{ $score_board->{6} }}, '#audit_score_view_b2{{ $audit->id }}');

        view_range(0, 5,  {{ $score_board->{7} }}, '#audit_score_view_c1{{ $audit->id }}');
        view_range(0, 2,  {{ $score_board->{8} }}, '#audit_score_view_c2{{ $audit->id }}');
        view_range(0, 3,  {{ $score_board->{9} }}, '#audit_score_view_c3{{ $audit->id }}');
        view_range(0, 15,  {{ $score_board->{10} }}, '#audit_score_view_d1{{ $audit->id }}');
        view_range(0, 10,  {{ $score_board->{11} }}, '#audit_score_view_d2{{ $audit->id }}');
        view_range(0, 10,  {{ $score_board->{12} }}, '#audit_score_view_d3{{ $audit->id }}');

        edit_range(0, 5,  {{ $score_board->{1} }}, '#audit_score_edit_a1{{ $audit->id }}');
        edit_range(0, 3,  {{ $score_board->{2} }}, '#audit_score_edit_a2{{ $audit->id }}');
        edit_range(0, 2,  {{ $score_board->{3} }}, '#audit_score_edit_a3{{ $audit->id }}');
        edit_range(0, 5,  {{ $score_board->{4} }}, '#audit_score_edit_a4{{ $audit->id }}');
        edit_range(0, 15,  {{ $score_board->{5} }}, '#audit_score_edit_b1{{ $audit->id }}');
        edit_range(0, 20,  {{ $score_board->{6} }}, '#audit_score_edit_b2{{ $audit->id }}');

        edit_range(0, 5,  {{ $score_board->{7} }}, '#audit_score_edit_c1{{ $audit->id }}');
        edit_range(0, 2,  {{ $score_board->{8} }}, '#audit_score_edit_c2{{ $audit->id }}');
        edit_range(0, 3,  {{ $score_board->{9} }}, '#audit_score_edit_c3{{ $audit->id }}');
        edit_range(0, 15,  {{ $score_board->{10} }}, '#audit_score_edit_d1{{ $audit->id }}');
        edit_range(0, 10,  {{ $score_board->{11} }}, '#audit_score_edit_d2{{ $audit->id }}');
        edit_range(0, 10,  {{ $score_board->{12} }}, '#audit_score_edit_d3{{ $audit->id }}');

    
        @endif
        @endforeach
        @endif
    
    });
    function audit_scrore_range(start, end, selecter){
        $(selecter).ionRangeSlider({
            min: start,
            max: end
        });
    }
    function view_range(start, end, from, selecter){
        $(selecter).ionRangeSlider({
            type: "double",
            min: start,
            max: end,
            from: 0,
            to: from,
            postfix: "",
            from_fixed: true,
            to_fixed: true
        });
    }
    function edit_range(start, end, from, selecter){
        $(selecter).ionRangeSlider({
            min: start,
            max: end,
            from: from
        });
    }
</script>@endsection