@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader" style="margin:0;">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main" style="width: 100%;">
           
            <div class="col-md-6">
                <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('/') }}"><i class="fa fa-undo"></i> Back to Home</a>
                <h3 class="kt-subheader__title" style="padding: 10px 0;">
                   Settings</h3>
            </div>
            <div class="col-md-6">
            </div>
           
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                                @if($message = Session::get('setting_created'))
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
<div class="row">

    <div class="col-md-12">

                                @if($message = Session::get('creative_added'))
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
    </div>
    <div class="col-md-8">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_portlet_general" role="tab">
                            <i class="fa fa-eye" aria-hidden="true"></i>General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_details" role="tab">
                            <i class="fa fa-eye" aria-hidden="true"></i>Options
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab">
                            <i class="fab fa-gitter" aria-hidden="true"></i>Activity Logs
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <div class="kt-portlet__body setting-body">
        <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_general" role="tabpanel">

            </div>
            <div class="tab-pane" id="kt_portlet_details" role="tabpanel">

	        	<div class="row">

  <ul class="nav nav-tabs" id="myTab" role="tablist">

  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-controls="general">General</a>
  </li>
@foreach($setting_cat as $cat)
<?php $cat_id = str_replace(' ', '_', $cat['cat']); ?>   
<li class="nav-item">
  <a class="nav-link" data-toggle="tab" href="#{{ $cat_id }}" role="tab" aria-controls="{{ $cat_id }}">{{ $cat['cat'] }}</a>
</li>
@endforeach
</ul>

<div class="tab-content" style="
    width: 81%;
    margin-top: 10px;">

  <div class="tab-pane active" id="general" role="tabpanel"></div>
@foreach($setting_cat as $cat)   
<?php $cat_id = str_replace(' ', '_', $cat['cat']); ?> 
  <div class="tab-pane" id="{{ $cat_id }}" role="tabpanel">
    <h4 style="border-bottom: 2px solid #21b8fe;
    padding-bottom: 10px;">{{ $cat['cat'] }}</h4>

        <?php $new_setting = $setting->where('cat', $cat['cat'])->groupBy('name')->toArray(); ?>

        <!--begin::Accordion-->
        <div class="accordion accordion-light  accordion-toggle-arrow" id="accordionExample2">
        <?php $setting_name_i = 1; ?>
        @foreach($new_setting as $new_s)
            <div class="card">
                <div class="card-header" id="heading{{ $new_s['0']['name'] }}">
                    <div class="card-title" data-toggle="collapse" data-target="#collapse{{ $new_s['0']['name'] }}" aria-expanded="true" aria-controls="collapse{{ $new_s['0']['name'] }}">
                        {{ $new_s['0']['name'] }}
                    </div>
                </div>
                <div id="collapse{{ $new_s['0']['name'] }}" class="collapse <?php if($setting_name_i == 1) { echo 'show'; } ?>" aria-labelledby="heading{{ $new_s['0']['name'] }}" data-parent="#accordionExample2">
                    <div class="card-body">
                        <ul>
                            
                        @foreach($new_s as $new_v)
            <li class="setting-list">{{ $new_v['value'] }} 
                <!-- <a href="{{ route('delete_setting', $new_v['id']) }}" class="btn btn-small btn-icon"><i class="la la-remove"></i></a> -->
                <form class="d-inline setting-delete" action="{{ route('delete_setting', $new_v['id']) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm">
                <i class="flaticon2-trash"></i>
                </button>
                </form>

            </li>
            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <?php $setting_name_i++ ?>
        @endforeach

        </div>

        <!--end::Accordion-->

  </div>
@endforeach
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

        </div>
    </div>
</div>
    </div>
    <div class="col-md-4">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#add_settings" role="tab">
                            <i class="fa fa-plus" aria-hidden="true"></i>New
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#add_custom_fields" role="tab">
                            <i class="fa fa-gears" aria-hidden="true"></i>Add Custom Fields
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="la la-cog"></i>
                            Settings
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" data-toggle="tab" href="#source_setting">Sources</a>
                            <a class="dropdown-item" data-toggle="tab" href="#module_setting">Modules</a>
                            <a class="dropdown-item" data-toggle="tab" href="#menu_setting">Menus</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-toggle="tab" href="#user_setting">Users</a>
                            <a class="dropdown-item" data-toggle="tab" href="#permission_setting">Permisions</a>
                            <a class="dropdown-item" data-toggle="tab" href="#user_role_setting">User Roles</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="add_settings" role="tabpanel">

                <div class="row">
                    <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('setting_store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12 mt-2">
                                <label>Setting Category</label>
                                <select style="width: 100%" class="form-control kt-select2" id="select_task_cat" required="" name="setting_cat">
                                    <option value="">** Select a Option</option>
                                    @foreach($setting_cat as $cat)
                                    <option value="{{ $cat['cat'] }}">{{ $cat['cat'] }}</option>
                                    @endforeach
                                    <option value="new_cat">New Setting Category</option>
                                </select>
                                <input type="text" name="setting_cat_new" placeholder="Enter New Category Name" class="setting_cat form-control mt-4" />
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Setting Name</label>
                                <select style="width: 100%" class="form-control kt-select2" id="select_setting_name" required="" name="setting_name">
                                    <option value="">** Select a Option</option>
                                    @foreach($setting_name as $name)
                                    <option value="{{ $name['name'] }}">{{ $name['name'] }}</option>
                                    @endforeach
                                    <option value="new_name">New Setting Name</option>
                                </select>
                                <input type="text" name="setting_name_new" placeholder="Enter New Setting Name" class="setting_name form-control mt-4" />
                            </div>
                            <div class="col-md-12 mt-3">
                                <input type="text" name="setting_value" placeholder="Setting Value" class="form-control" />
                            </div>
                            <div class="col-md-12 mt-2 setting_type_block">
                                <label>Setting Type</label>
                                <select style="width: 100%" class="form-control kt-select2" id="select_setting_type" name="setting_type">
                                    <option value="">** Select a Option</option>
                                    <option value="img">Image</option>
                                    <option value="video">Video</option>
                                    <option value="select">Select</option>
                                    <option value="input">input</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2 select_type_block">
                                <label>Setting Type</label>
                                <select style="width: 100%" class="form-control kt-select2" id="setting_select_type" name="select_type">
                                    <option value="">** Select a Option</option>
                                    <option value="single">Single Value Select</option>
                                    <option value="mulit">Multi Value Select</option>
                                </select>
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
            <div class="tab-pane" id="add_custom_fields" role="tabpanel">
                <h4 style="margin: 15px 0;">Custom Fields -  Under Construction</h4>
            </div>
            <div class="tab-pane" id="source_setting" role="tabpanel">
                <h4 style="margin: 15px 0;">Manage Source</h4>
                <form method="POST" action="{{ route('setting_store_source') }}" id="add_source">
                    @csrf
                    <input type="text" class="form-control mt-3" name="name" placeholder="Source Name" required />
                    <input type="text" class="form-control mt-3" name="description" placeholder="Description" />
                    <input type="submit" class="btn btn-primary mt-3" placeholder="Source Name" value="Add Source" />
                </form>
            </div>

        </div>
    </div>
</div>

</div>
</div>
<!--end::Portlet-->

</div>


@endsection
@section('footer_js')
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script type="text/javascript">
    $(function() {

    });
    $('.setting_cat').hide(); 
    $('.setting_name').hide(); 
    $('.select_type_block').hide(); 
    $('.setting_type_block').hide(); 
    $('#select_task_cat').change(function(){
        if($('#select_task_cat').val() == 'new_cat') {
            $('.setting_cat').show();
        }else {
            $('.setting_cat').hide(); 
        } 
    });
    $('#select_setting_name').change(function(){
        if($('#select_setting_name').val() == 'new_name') {
            $('.setting_name').show();
    $('.setting_type_block').show(); 
        }else {
            $('.setting_name').hide(); 
    $('.setting_type_block').hide(); 
        } 
    });
    $('#select_setting_type').change(function(){
        if($('#select_setting_type').val() == 'select') {
            $('.select_type_block').show();
        }else {
            $('.select_type_block').hide(); 
        } 
    });

    // function add_setting($form_id, $action_url){
    //     $form_action_url = '<?php echo route('setting_store_source'); ?>';
    //     // alert($form_action_url); 
    //     $($form_id).submit(function(){
    //         $.ajax({
    //             url: $form_action_url,
    //             // type: 'POST', // replaced from put
    //             method: 'POST',
    //             dataType: "JSON",
    //             data: $($form_id).serialize(),
    //             success: function (response)
    //             {
    //                 swal.fire({
    //                     title: 'Success!',
    //                     text: "The Setting added Successfuly!",
    //                     type: 'success',
    //                     showCancelButton: false,
    //                     confirmButtonText: 'OK!'
    //                 }).then(function(result) {
    //                     if (result.value) {
    //                         window.location = "<?php echo route('setting_index'); ?>";
    //                     }
    //                 });
                    
    //             },
    //             error: function(xhr) {
    //                  console.log(xhr.responseText);
    //             }
    //         });
    //     });
    // }
    // add_setting('add_source', '/setting/store/source/');
    </script>


@endsection