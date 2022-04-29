@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                   New CRUD </h3>
        </div>
    </div>
</div>
<div ng-app="" class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
<div class="row">
    <div class="col-md-12">
        @if($message = Session::get('success'))
        <div class="alert alert-success fade show mb-4" role="alert">
            <div class="alert-icon"><i class="la la-check"></i></div>
            <div class="alert-text">{{ $message }}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>
        @endif
<!--begin::Portlet-->
<form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('crud_action') }}">
    @csrf
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label" style="width: 100%;">
            <h3 class="kt-portlet__head-title" style="width: 100%;">
                <span style="float: left; display: block !important;padding-top: 10px;">Landing Page Details</span>
                <span class="lp_dynamic_switch" style="float: right; display: flex;">
                    <span style="margin-top: 17px;margin-right: 10px;">Is Dynamic Landing Page?</span>
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                        <label class="col-form-label">
                            <input type="checkbox" checked="checked" name="lp_dynamic" ng-model="lp_dynamic" ng-value="1">
                            <span></span>
                        </label>
                    </span>
                </span>
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">

        <div id="kt_repeater_4">
            <div class="form-group  row mt-4">
                <div class="col-3 mb-4">
                    <label>Module Name</label>
                    <input type="text" name="module_name" class="form-control" placeholder="Enter Module Name">
                </div>
                <div class="col-3 mb-4">
                    <label>Module Plural Name</label>
                    <input type="text" name="module_plural_name" class="form-control" placeholder="Enter Module Name">
                </div>

                <div class="col-12">
                    <label>Database Columns</label>
                    <hr>
                </div>
                <div class="col-lg-3">
                    <label>Name</label>
                </div>
                <div class="col-lg-2">
                    <label>Type</label>
                </div>
                <div class="col-lg-2">
                    <label>Length/Values</label>
                </div>
                <div class="col-lg-2">
                    <label>Default</label>
                </div>
                <div class="col-lg-2">
                    <label>Defined</label>
                </div>
                <div class="col-lg-1">
                    <label>Remove</label>
                </div>
                <div data-repeater-list="col_list" class="col-lg-12">
                    <div data-repeater-item class="row kt-margin-b-10 repeat_block">
                        <div class="col-lg-3">
                            <input type="text" name="name" class="form-control" placeholder="Enter Column Name..." />
                        </div>
                        <div class="col-lg-2">
                            <select style="width: 100%" class="form-control column_type" name="type" id="field_0_2">
                                <option></option>
    <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
    <option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option>
    <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option>
    <option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option>
    <optgroup label="Numeric">
        <option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255">TINYINT</option><option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535">SMALLINT</option>
        <option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215">MEDIUMINT</option>
        <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
        <option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615">BIGINT</option><option disabled="disabled">-</option>
        <option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)">DECIMAL</option>
        <option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38">FLOAT</option>
        <option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308">DOUBLE</option>
        <option title="Synonym for DOUBLE (exception: in REAL_AS_FLOAT SQL mode it is a synonym for FLOAT)">REAL</option><option disabled="disabled">-</option>
        <option title="A bit-field type (M), storing M of bits per value (default is 1, maximum is 64)">BIT</option>
        <option title="A synonym for TINYINT(1), a value of zero is considered false, nonzero values are considered true">BOOLEAN</option><option title="An alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE">SERIAL</option>
    </optgroup>
    <optgroup label="Date and time">
        <option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59">DATETIME</option>
        <option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)">TIMESTAMP</option>
        <option title="A time, range is -838:59:59 to 838:59:59">TIME</option><option title="A year in four-digit (4, default) or two-digit (2) format, the allowable values are 70 (1970) to 69 (2069) or 1901 to 2155 and 0000">YEAR</option>
    </optgroup>
    <optgroup label="String">
        <option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored">CHAR</option>
        <option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option><option disabled="disabled">-</option>
        <option title="A TEXT column with a maximum length of 255 (2^8 - 1) characters, stored with a one-byte prefix indicating the length of the value in bytes">TINYTEXT</option>
        <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option>
        <option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes">MEDIUMTEXT</option>
        <option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes">LONGTEXT</option><option disabled="disabled">-</option>
        <option title="Similar to the CHAR type, but stores binary byte strings rather than non-binary character strings">BINARY</option>
        <option title="Similar to the VARCHAR type, but stores binary byte strings rather than non-binary character strings">VARBINARY</option><option disabled="disabled">-</option>
        <option title="A BLOB column with a maximum length of 255 (2^8 - 1) bytes, stored with a one-byte prefix indicating the length of the value">TINYBLOB</option>
        <option title="A BLOB column with a maximum length of 16,777,215 (2^24 - 1) bytes, stored with a three-byte prefix indicating the length of the value">MEDIUMBLOB</option>
        <option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value">BLOB</option>
        <option title="A BLOB column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) bytes, stored with a four-byte prefix indicating the length of the value">LONGBLOB</option><option disabled="disabled">-</option>
        <option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value">ENUM</option><option title="A single value chosen from a set of up to 64 members">SET</option>
    </optgroup>
    <optgroup label="Spatial">
        <option title="A type that can store a geometry of any type">GEOMETRY</option><option title="A point in 2-dimensional space">POINT</option><option title="A curve with linear interpolation between points">LINESTRING</option>
        <option title="A polygon">POLYGON</option><option title="A collection of points">MULTIPOINT</option><option title="A collection of curves with linear interpolation between points">MULTILINESTRING</option>
        <option title="A collection of polygons">MULTIPOLYGON</option><option title="A collection of geometry objects of any type">GEOMETRYCOLLECTION</option>
    </optgroup>
    <optgroup label="JSON"><option title="Stores and enables efficient access to data in JSON (JavaScript Object Notation) documents">JSON</option></optgroup>
</select>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="length" class="form-control" />
                        </div>
                        <div class="col-lg-2">
                            <select name="field_default_type[0]" id="field_0_4" class="form-control">
                                <option value="NONE">None</option>
                                <option value="USER_DEFINED">As defined:</option>
                                <option value="NULL">NULL</option>
                                <option value="CURRENT_TIMESTAMP">CURRENT_TIMESTAMP</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <input type="text" name="USER_DEFINED" size="12" value="" class="form-control" style="">
                        </div>
                        <div class="col-lg-1">
                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm">
                                <i class="la la-remove"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">   
                <div class="col">
                    <div data-repeater-create="" class="btn btn btn-primary">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Add</span>
                        </span>
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
<iframe ng-hide="dynamic_lp" id="show_current_lp" src="" style="display: none; height: 500px; border:7px solid #222; width: 100%;"></iframe>

<!--end::Form-->
</div>
</div>
</div>
<!--end::Portlet-->

@endsection
@section('header_css')
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
$(document).ready(function(){

    $('#select_lp_template').select2({
        placeholder: "Select LP Template"
    });
    $('#select_lp_template').change(function(){
        let current_lp = $(this).val();
        $('#show_current_lp').show();
        $('#show_current_lp').attr('src', current_lp);
    });
});
        
    </script>
@endsection