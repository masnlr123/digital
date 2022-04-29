@extends('layouts.app') @section('content')
@php
use App\User;
@endphp

<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
            Edit Role </h3>
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('update_permissions', $role->id) }}">
                @csrf
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Role Details
                                <span class="camp_name"></span>
                            </h3>
                            <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: right;" href="{{ url('permissions/') }}"><i class="fa fa-undo"></i> Back to Roles</a>
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
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <input type="text" placeholder="Name" maxlength="255" class="form-control" name="name" id="name" value="{{ $role->name }}">
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