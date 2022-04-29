@extends('layouts.app') @section('content')
@php
use App\User;
@endphp

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Edit Profile - {{ $user->name }} </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('update_profile', $user->id) }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Profile Details
                <span class="camp_name"></span>
            </h3>
            <a style="margin-left:10px;" class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: right;" href="{{ url('/') }}"><i class="fa fa-undo"></i> Back to Dashboard</a>
        </div>
    </div>
    
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
                                @if($message = Session::get('danger'))
                                <div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-check"></i></div>
                                    <div class="alert-text">{{ $message }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
    <div class="kt-portlet__body task_create_portlet">
        <div class="form-group row">
            <div class="col-md-6">
                @if(!empty($user->photo))
                <img src="{{ url($user->photo) }}" width="300" height="300" class="img-thumbnail" />
                @endif
            	<table class="table table-bordered table-dark mt-5">
            		<tbody>
            			<tr>
            				<td>Name</td>
            				<td>{{ $user->name }}</td>
            			</tr>
            			<tr>
            				<td>Email</td>
            				<td>{{ $user->email }}</td>
            			</tr>
            			<tr>
            				<td>Contact Number</td>
            				<td>{{ $user->contact }}</td>
            			</tr>
            			<tr>
            				<td>Address</td>
            				<td>{{ $user->address }}</td>
            			</tr>
            		</tbody>
            	</table>
                
            </div>
            <div class="col-md-6">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" placeholder="Name" maxlength="255" class="form-control" name="name" id="name" value="{{ $user->name }}" readonly>
            </div>
            <div class="col-md-6">
                <label>Gsuite Password</label>
                <input type="password" placeholder="Name" maxlength="255" class="form-control" name="gsuite_password" id="name" value="{{ $user->gsuite_password }}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label>Password</label>
                <input type="password" placeholder="Password" maxlength="255" class="form-control" name="password" id="password">
            </div>
            <div class="col-md-6">
                <label>Confirm Password</label>
                <input type="password" placeholder="Password" maxlength="255" class="form-control" name="confirm_password" id="password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Email</label>
                <input type="text" placeholder="Email" maxlength="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required class="form-control" name="email" id="email" value="{{ $user->email }}" readonly>
            </div>
            <div class="col-md-6">
                <label>Contact Number</label>
                <input type="text" placeholder="Contact Number" maxlength="255" pattern="[0-9]+" required class="form-control" name="contact" id="contact" value="{{ $user->contact }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Address</label>
                <input type="text" placeholder="Address" maxlength="255" class="form-control" name="address" id="address" value="{{ $user->address }}">
            </div>
            <div class="col-md-6">
                <label>Profile Photo</label>
                <input type="file" class="form-control" name="photo" id="photo">
            </div>
        </div>
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

@section('header_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />
@endsection
@section('footer_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.my-image').croppie();
        });
    </script>
@endsection