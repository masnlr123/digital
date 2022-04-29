@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add Expense </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" enctype="multipart/form-data"  action="{{ route('store_exp') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Expense Details
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="form-group row same-row-content">
            <div class="col-md-3">
                <label>Ad Account / Team</label>
                <input type="text" title="Expense Name" placeholder="" required="" maxlength="255" class="form-control" name="account_team" id="account_team" value="">
            </div>
            <div class="col-md-3">
                <label>Initiated by</label>
                <select style="width: 100%" class="form-control" id="initiated_by" required="" name="initiated_by">
                    <option value="">** Select who is Initiated</option>
                    <option value="Alex">Alex</option>
                    <option value="Sudhakar">Sudhakar</option>
                    <option value="Grorav">Grorav</option>
                    <option value="Idris">Idris</option>
                    <option value="Kumaran">Kumaran</option>
                    <option value="RajaSekar">RajaSekar</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Transaction Type</label>
                <select style="width: 100%" class="form-control" id="transaction_type" required="" name="transaction_type">
                    <option value="">** Select Transaction Type</option>
                    <option value="Credit-Card">Credit-Card</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Transaction Mode</label>
                <select style="width: 100%" class="form-control" id="transaction_mode" required="" name="transaction_mode">
                    <option value="">** Select Transaction Type</option>
                    <option value="Manual">Manual</option>
                    <option value="Automatic">Automatic</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Platform</label>
                <input type="text" title="Enter platform" placeholder="" required="" maxlength="255" class="form-control" name="platform" id="platform" value="">
            </div>

            <div class="col-md-3">
                <label>Project</label>
                <select style="width: 100%" class="form-control" id="project" required="" name="project">
                    <option value="">** Select a Project</option>
                    <option value="0">Non Project Task</option>
                    @foreach($projects as $pro)
                    <option value="{{ $pro->name }}">{{ $pro->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Date</label>
                <input type="text" title="date" placeholder="Enter Date" required="" maxlength="255" class="form-control" name="date" id="kt_datepicker_6" value="" readonly>
            </div>
            <div class="col-md-3">
                <label>Currency</label>
                <select style="width: 100%" class="form-control" id="currency" required="" name="currency">
                    <option value="">** Select Currency Type</option>
                    <option value="INR">INR</option>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Amount</label>
                <input type="text" placeholder="Enter Amount" required="" maxlength="255" class="form-control" name="amount" id="amount" value="">
            </div>
            <div class="col-md-3">
                <label>Card No</label>
                <input type="text" placeholder="Enter Card No" required="" class="form-control" name="card_no" id="card_no" value="">
            </div>
            <div class="col-md-3">
                <label>Card Holder</label>
                <input type="text" placeholder="Enter Card Holder" required="" maxlength="255" class="form-control" name="card_holder" id="card_holder" value="">
            </div>
            <div class="col-md-3">
                <label>Document</label>
                <input type="file" required="" class="form-control" name="document" id="document">
            </div>
            <div class="col-md-3">
                <label>Transaction_Verification</label>
                <select style="width: 100%" class="form-control" id="transaction_verification" required="" name="transaction_verification">
                    <option value="">** Select Transaction_Verification</option>
                    <option value="Verified">Verified</option>
                    <option value="Non Verified">Non Verified</option>
                </select>
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

<!--end::Form-->
</div>
</div>
</div>
<!--end::Portlet-->
@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endsection