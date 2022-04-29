@extends('layouts.app')

@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                        <!-- begin:: Subheader -->
                        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                            <div class="kt-container  kt-container--fluid ">
                                <div class="kt-subheader__main">
                                    <h3 class="kt-subheader__title">
                                        All Media</h3>
                                </div>
                            </div>
                        </div>
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-line-chart"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            All Media List
                                            <small>List of Recent Media List</small>
                                        </h3>
                                    </div>
                                </div>
                                    <!-- <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="{{ route('web_create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    Upload New
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="kt-portlet__body">
                                        <div class="kt-section">
                                            <div class="kt-section__content">
                                                <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="kt-portlet kt-portlet--height-fluid">
                                                        <div class="dropzone dropzone-default dropzone-brand" id="kt_dropzone_2">
                                                            <div class="dropzone-msg dz-message needsclick">
                                                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                                                <span class="dropzone-msg-desc">Upload up to 10 files</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                @foreach($files as $file)
                                                    <a href="#" class="kt-media">
                                                        <img src="https://urbanrislp.b-cdn.net/{{ $file->ObjectName }}" alt="image">
                                                    </a>
                                                @endforeach
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <!-- end:: Content -->
                    </div>
@endsection
@section('header_css')
        <link href="{{ asset('assets/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')
        <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
        </script>
@endsection