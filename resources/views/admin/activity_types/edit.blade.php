@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Activity Type Details</h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-4">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_portlet_details" role="tab">
                                <i class="fa fa-eye" aria-hidden="true"></i>Activity Type Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                                <i class="fa fa-edit" aria-hidden="true"></i>Edit Activity Type Details
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="kt_portlet_details" role="tabpanel">

                            <div class="row">
                            <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Ad Account / Team</td>
                                            <td>{{ $activity_types->account_team }}</td>
                                        </tr>
                                        <tr>
                                            <td>Initiated by</td>
                                            <td>{{ $activity_types->initiated_by }}</td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Type</td>
                                            <td>{{ $activity_types->transaction_type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Mode</td>
                                            <td>{{ $activity_types->transaction_mode }}</td>
                                        </tr>
                                        <tr>
                                            <td>Platform</td>
                                            <td>{{ $activity_types->platform }}</td>
                                        </tr>
                                        <tr>
                                            <td>Project</td>
                                            <td>{{ $activity_types->project }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $activity_types->date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Currency</td>
                                            <td>{{ $activity_types->currency }}</td>
                                        </tr>
                                        <tr>
                                            <td>Amount</td>
                                            <td>{{ $activity_types->amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>Card No.</td>
                                            <td>{{ $activity_types->card_no }}</td>
                                        </tr>
                                        <tr>
                                            <td>Card Holder</td>
                                            <td>{{ $activity_types->card_holder }}</td>
                                        </tr>
                                        <tr>
                                            <td>Transaction_Verification</td>
                                            <td>{{ $activity_types->transaction_verification }}</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                                
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
                            </div>
                        </div>
                        <!--End::Timeline 3 -->
                    </div>
                    <div class="tab-pane" id="kt_portlet_edit" role="tabpanel">
                        <h4 style="margin: 15px 0;">Edit Details</h4>

                        <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('update_activity_types', $activity_types->id) }}">
                            @csrf
                            {{ method_field('PUT') }}


                                <div class="form-group row same-row-content">
                                    <div class="col-md-6">
                                        <label>Ad Account / Team</label>
                                        <input type="text" title="Activity Type Name" placeholder="" required="" maxlength="255" class="form-control" name="account_team" id="account_team" value="{{ $activity_types->account_team }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Initiated by</label>
                                        <select style="width: 100%" class="form-control" id="initiated_by" required="" name="initiated_by">
                                            <option value="">** Select who is Initiated</option>
                                            <option {{ $activity_types->initiated_by == "Alex"? "selected": " " }} value="Alex">Alex</option>
                                            <option {{ $activity_types->initiated_by == "Sudhakar"? "selected": " " }} value="Sudhakar">Sudhakar</option>
                                            <option {{ $activity_types->initiated_by == "Grorav"? "selected": " " }} value="Grorav">Grorav</option>
                                            <option {{ $activity_types->initiated_by == "Idris"? "selected": " " }} value="Idris">Idris</option>
                                            <option {{ $activity_types->initiated_by == "Kumaran"? "selected": " " }} value="Kumaran">Kumaran</option>
                                            <option {{ $activity_types->initiated_by == "RajaSekar"? "selected": " " }} value="RajaSekar">RajaSekar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Transaction Type</label>
                                        <select style="width: 100%" class="form-control" id="transaction_type" required="" name="transaction_type">
                                            <option value="">** Select Transaction Type</option>
                                            <option {{ $activity_types->transaction_type == "Credit-Card"? "selected": " " }} value="Credit-Card">Credit-Card</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Transaction Mode</label>
                                        <select style="width: 100%" class="form-control" id="transaction_mode" required="" name="transaction_mode">
                                            <option value="">** Select Transaction Type</option>
                                            <option {{ $activity_types->transaction_mode == "Manual"? "selected": " " }} value="Manual">Manual</option>
                                            <option {{ $activity_types->transaction_mode == "Automatic"? "selected": " " }} value="Automatic">Automatic</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Platform</label>
                                        <input type="text" title="Enter platform" placeholder="" required="" maxlength="255" class="form-control" name="platform" id="platform" value="{{ $activity_types->platform }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label>Project</label>
                                        <select style="width: 100%" class="form-control" id="project" required="" name="project">
                                            <option value="">** Select a Project</option>
                                            <option value="0">Non Project Task</option>
                                            @foreach($projects as $pro)
                                            <option {{ $activity_types->project == $pro->name? "selected": " " }}  value="{{ $pro->name }}">{{ $pro->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Date</label>
                                        <input type="text" title="date" placeholder="Enter Date" required="" maxlength="255" class="form-control" name="date" id="kt_datepicker_6" value="{{ $activity_types->date }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Currency</label>
                                        <select style="width: 100%" class="form-control" id="currency" required="" name="currency">
                                            <option value="">** Select Currency Type</option>
                                            <option {{ $activity_types->currency == "INR"? "selected": " " }} value="INR">INR</option>
                                            <option {{ $activity_types->currency == "USD"? "selected": " " }}  value="USD">USD</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Amount</label>
                                        <input type="text" placeholder="Enter Amount" required="" maxlength="255" class="form-control" name="amount" id="amount" value="{{ $activity_types->amount }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Card No</label>
                                        <input type="text" placeholder="Enter Card No" required="" class="form-control" name="card_no" id="card_no" value="{{ $activity_types->card_no }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Card Holder</label>
                                        <input type="text" placeholder="Enter Card Holder" required="" maxlength="255" class="form-control" name="card_holder" id="card_holder" value="{{ $activity_types->card_holder }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Transaction_Verification</label>
                                        <select style="width: 100%" class="form-control" id="transaction_verification" required="" name="transaction_verification">
                                            <option value="">** Select Transaction_Verification</option>
                                            <option {{ $activity_types->transaction_verification == "Verified"? "selected": " " }} value="Verified">Verified</option>
                                            <option {{ $activity_types->transaction_verification == "Non Verified"? "selected": " " }} value="Non Verified">Non Verified</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Document</label>
                                        <input type="file" required="" class="form-control" name="document" id="document">
                                    </div>
                                </div>

                                       

                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Exp Document
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                @php 
                $other_doc_type = \File::extension($activity_types->document);
                @endphp
                @if($other_doc_type == 'pdf')
                <iframe src="{{ url($activity_types->document) }}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                @else
                <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{ url($activity_types->document) }}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>


@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
@endsection