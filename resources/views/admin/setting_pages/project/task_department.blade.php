<?php 
use App\CreativeImages;
?>
@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        <button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
                                        Task</h3>
                                    <span class="kt-subheader__separator kt-hidden"></span>
                                    <div class="kt-subheader__breadcrumbs">
                                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Task </a>
                                        <span class="kt-subheader__breadcrumbs-separator"></span>
                                        <a href="" class="kt-subheader__breadcrumbs-link">
                                            Departments</a>
                                    </div>
                                </div>
                                @include('admin.includes.actions')
                            </div>
                        </div>
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <!--Begin::App-->
                            <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
                                <!--Begin:: App Aside Mobile Toggle-->
                                <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                                    <i class="la la-close"></i>
                                </button>
                                <!--End:: App Aside Mobile Toggle-->
                                @include('admin.includes.aside')
                                <!--Begin:: App Content-->
                                <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                                    <div class="row">
                                        <div class="col-12">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
            <!-- begin:: Subheader -->
<!--             <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-container  kt-container--fluid ">
                    <div class="kt-subheader__main">
                        <h3 class="kt-subheader__title">
                            All Activities</h3>
                    </div>
                </div>
            </div> -->
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Task Departments
                            <small>List of Task Departments</small>
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <button type="button" data-toggle="modal" data-target="#createTaskDepartment" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    New Department
                                </button>

                            </div>
                        </div>
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
                <div class="camp_index kt-portlet__body kt-portlet__body--fit">
                    <!--begin: Datatable -->
                    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th title="Field #3">Department</th>
                                <th title="Field #1">Users</th>
                                <th title="Field #1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Setting::where('name', 'task_department')->get() as $result)
                            @php
                            $department = json_decode($result->value);
                            $get_all_users = json_decode($department->users);
                            @endphp
                            <tr>
                                <td class="" style="vertical-align: middle;">
                                    @if(!empty($department->icon))<i style="padding-left: 7px; font-size: 21px;" class="{{ $department->icon }}"></i>@endif
                                    {{ $department->name }}</td>
                                <td>
                                    <div class="kt-media-group">
                                        @foreach($get_all_users as $user)
                                        @php
                                        $get_user = App\User::find($user);
                                        @endphp
                                        @if(!empty($get_user->photo))
                                        <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="{{ $get_user->name }}">
                                            <img width="30" height="30" src="{{ url($get_user->photo) }}" alt="image">
                                        </a>
                                        @else
                                        <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="{{ $get_user->name }}">
                                            <img width="30" height="30" src="{{ url('assets/media/users/default.jpg') }}" alt="image">
                                        </a>
                                        @endif
                                        @endforeach
                                       
                                        <!-- <a href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="John Myer">
                                            <span>6+</span>
                                        </a> -->
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm">Edit</button>
                                    <a href="{{ route('del_setting', $result->id) }}" class="btn btn-warning btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
            <!-- end:: Content -->
        </div>
                                        </div>
                                    </div>
                                </div>

                                <!--End:: App Content-->
                            </div>

                            <!--End::App-->
                        </div>

                        <!-- end:: Content -->
                    </div>

<div class="modal fade" id="createTaskDepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!-- <div class="modal fade" id="createTaskDepartment" tabindex="-1" role="dialog"> -->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Task Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{ route('store_task_department') }}">
      <div class="modal-body">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Name" required>
            <input type="text" name="url" class=" mt-3 form-control" placeholder="URL (Optional)">
            <label class="mt-3">Icon</label>
            <select class="form-control kt-select2" id="get_all_flaticons" style="width: 100%" name="icon">
                <option value=""></option>
                @php 
                $get_flaticon = App\Setting::where('name', 'flaticon')->first();
                $all_flaticons = explode(',', $get_flaticon->value);
                //print_r($all_flaticons);
                @endphp

                @foreach($all_flaticons as $flaticon)
                <option value="{{ $flaticon }}"><i class="{{ $flaticon }}"></i> {{ $flaticon }}</option>
                @endforeach

            </select>
            <label class="mt-3">Assign Users</label>
            <select class="form-control kt-select2" id="get_all_users" style="width: 100%" name="users[]" multiple>
                <option value=""></option>
                @foreach(App\User::all() as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
        
@endsection
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')

        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#22b9ff",
                        "light": "#ffffff",
                        "dark": "#282a3c",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
            $(document).ready(function(){
                $('#get_all_users').select2({ placeholder: "Select Users" });
                $('#get_all_flaticons').select2({ placeholder: "Select one Icon for this Department" });
            });
        </script>

@endsection