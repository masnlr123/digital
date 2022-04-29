@extends('layouts.app') @section('content')
@php
use App\User;
@endphp
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   Add New User </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
        @if($message = Session::get('danger'))
                                <div class="alert alert-danger fade show" role="alert">
                                    <div class="alert-icon"><i class="la la-times"></i></div>
                                    <div class="alert-text">{{ $message }}</div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="la la-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                @if(isset($validator))
                                {{ $validator->errors()->first('email') }}
                                {{ $validator->errors()->first('contact') }}
                                @endif
<form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('store_new_user') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                User Details
                <span class="camp_name"></span>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body task_create_portlet">
        <div class="form-group row">
            <div class="col-md-3">
                <label>Name *</label>
                <input type="text" placeholder="Name" maxlength="255" class="form-control" name="name" id="name" required>
            </div>
            <div class="col-md-3">
                <label>Password *</label>
                <input type="password" placeholder="Password" maxlength="255" class="form-control" name="password" id="password" required>
            </div>
            <div class="col-md-3">
                <label>Email *</label>
                <input type="text" placeholder="Email" maxlength="255" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" id="email" required>
            </div>
            <div class="col-md-3">
                <label>Contact Number *</label>
                <input type="text" placeholder="Contact Number" pattern="[0-9]+" minlength="10" maxlength="10" class="form-control" name="contact" id="contact" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Address</label>
                <input type="text" placeholder="Address" class="form-control" name="address" id="address">
            </div>
            @if($user->role_id == '1' || $user->role_id =='2')
            <div class="col-md-3">
                <label>Role *</label>
                <select style="width: 100%" class="form-control kt-select2" id="user_role" required name="role_id">
                    <option value="">** </option>
                    <option value="1">Super Admin</option>
                    <option value="2">Admin</option>
                    <option value="3">Approval Team</option>
                    <option value="4">Creative Team</option>
                    <option value="5">Paid Team</option>
                    <option value="6">LMS Team</option>
                    <option value="7">SEO Team</option>
                    <option value="8">Web Team</option>
                    <option value="9">Gobrand360</option>
                    <option value="10">Astra Communications</option>
                    <option value="11">Lead Audit Team</option>
                    <option value="12">Content Team</option>
                    <option value="15">Agency</option>
                    <option value="16">Business Intelligence Team</option>
                    <option value="17">Only Media Plan</option>
                </select>
            </div>
            @endif
            <div class="col-md-3">
                <label>Status *</label>
                <select style="width: 100%" class="form-control kt-select2" id="user_status" required name="status">
                    <option value="">** </option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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