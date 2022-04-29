@extends('layouts.app') @section('content')
@php
use App\User;
@endphp

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Edit User </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
<!--begin::Portlet-->
<form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('update_user', $user->id) }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                User Details
                <span class="camp_name"></span>
            </h3>
            <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: right;" href="{{ url('users/') }}"><i class="fa fa-undo"></i> Back to Users</a>
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
            <div class="col-md-3">
                <label>Name</label>
                <input type="text" placeholder="Name" maxlength="255" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            <div class="col-md-3">
                <label>Password</label>
                <input type="password" placeholder="Password" maxlength="255" class="form-control" name="password" id="password">
            </div>
            <div class="col-md-3">
                <label>Email</label>
                <input type="text" placeholder="Email" maxlength="255" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div class="col-md-3">
                <label>Contact Number</label>
                <input type="text" placeholder="Contact Number" maxlength="255" pattern="[0-9]+" class="form-control" name="contact" id="contact" value="{{ $user->contact }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Address</label>
                <input type="text" placeholder="Address" maxlength="255" class="form-control" name="address" id="address" value="{{ $user->address }}">
            </div>
            @if($logged_user->role_id == '1' || $logged_user->role_id =='2')
            <div class="col-md-3">
                <label>Role</label>
                <select style="width: 100%" class="form-control kt-select2" id="user_role" required=""  name="role_id">
                    <option value="">** </option>

                    <option {{ $user->role_id == '1'? 'selected': '' }} value="1">Super Admin</option>
                    <option {{ $user->role_id == '2'? 'selected': '' }} value="2">Admin</option>
                    <option {{ $user->role_id == '3'? 'selected': '' }} value="3">Approval Team</option>
                    <option {{ $user->role_id == '4'? 'selected': '' }} value="4">Creative Team</option>
                    <option {{ $user->role_id == '5'? 'selected': '' }} value="5">Paid Team</option>
                    <option {{ $user->role_id == '6'? 'selected': '' }} value="6">LMS Team</option>
                    <option {{ $user->role_id == '7'? 'selected': '' }} value="7">SEO Team</option>
                    <option {{ $user->role_id == '8'? 'selected': '' }} value="8">Web Team</option>
                    <option {{ $user->role_id == '9'? 'selected': '' }} value="9">Gobrand360</option>
                    <option {{ $user->role_id == '10'? 'selected': '' }} value="10">Astra Communications</option>
                    <option {{ $user->role_id == '11'? 'selected': '' }} value="11">Lead Audit Team</option>
                    <option {{ $user->role_id == '12'? 'selected': '' }} value="12" value="12">Content Team</option>
                    <option {{ $user->role_id == '15'? 'selected': '' }} value="15" value="15">Agency</option>
                    <option {{ $user->role_id == '16'? 'selected': '' }} value="16" value="16">Business Intelligence Team</option>
                    <option {{ $user->role_id == '17'? 'selected': '' }} value="17">Only Media Plan</option>
                </select>
            </div>
            @endif
            <div class="col-md-3">
                <label>Status</label>
                <select style="width: 100%" class="form-control kt-select2" id="user_status" required=""  name="status">
                    <option value="">** </option>
                    <option @if($user->status == '1') selected @endif value="1">Active</option>
                    <option @if($user->status == '0') selected @endif value="0">Inactive</option>
                </select>
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

@section('footer_js')

    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
     <script type="text/javascript">
        $(document).ready(function(){
            $('.dst_manager_block').hide();
            $('.cp_manager_block').hide();
            $('#user_role').on('change', function(){
                var user_role = $(this).val();
                if(user_role == '4'){
                    $('.dst_manager_block').show();
                }
                else{
                    $('.dst_manager_block').hide();
                }
                if(user_role == '6'){
                    $('.cp_manager_block').show();
                }
                else{
                    $('.cp_manager_block').hide();
                }
            });

        });
    </script>
@endsection