<div class="kt-subheader kt-grid__item" id="kt_subheader">
        <div class="kt-container kt-container--fluid">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Media Plan &nbsp; : &nbsp;<strong style="color: #ff9800;">{{ $campaigns->name }} - {{ $campaigns->month }}</strong></h3>
            </div>
            <div class="kt-subheader__toolbar">
                <!-- <a href="#" data-toggle="modal" data-target="#edit_this_camp" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-edit"></i>Edit Project Campaign</a> -->
                <a href="{{ route('media_plan_list') }}" class="btn btn-warning btn-elevate btn-icon-sm"><i class="fa fa-undo"></i>Media Plan</a>
                <!-- <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">Launch Demo Modal</button> -->
                <a href="#" class="btn btn-success btn-elevate btn-icon-sm" data-toggle="modal" data-target="#NewAdCamp"><i class="la la-plus"></i>New Ad Campaign</a>
            </div>
        </div>
    </div>