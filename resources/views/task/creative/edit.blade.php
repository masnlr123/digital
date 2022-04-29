@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader" style="margin:0;">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main" style="width: 100%;">
                @if(!$creatives->isEmpty())
                <div class="col-md-6">
                    <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('task/creative') }}"><i class="fa fa-undo"></i> Back to Creatives</a>
                 </div>
                 <div class="col-md-6">
                    <h3 class="kt-subheader__title">
                     <span style="background-color: #5a3994;
                     color: #fff;
                     padding: 4px 14px;
                     font-size: 14px;
                     letter-spacing: .5px;
                     border-radius: 30px;">{{ url('task/creative/view') }}/{{ $creative_task->id }}</span>
                 </h3>
             </div>
             @else
             <div class="col-md-12">
                <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('task/creative') }}"><i class="fa fa-undo"></i> Back to Creatives</a>


                 <div class="kt-subheader__breadcrumbs" style="right: 0;
                 position: absolute;">
                 <a href="{{ url('') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                 <span class="kt-subheader__breadcrumbs-separator"></span>
                 <a href="{{ url('task/creatives') }}" class="kt-subheader__breadcrumbs-link">
                 Creatives </a>
                 <span class="kt-subheader__breadcrumbs-separator"></span>
                 <a href="" class="kt-subheader__breadcrumbs-link">
                    {{ $creative_task->task_name }}</a>
                </div></h3>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
        <div class="col-md-6">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_details" role="tab">
                                    <i class="fa fa-eye" aria-hidden="true"></i>Task Details
                                </a>
                            </li>
                            @if($current_user->name == $creative_task->created_by)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                                    <i class="fa fa-edit" aria-hidden="true"></i>Edit Details
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_logs" role="tab">
                                    <i class="fab fa-gitter" aria-hidden="true"></i>Activity Logs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_portlet_details" role="tabpanel">

                            <div class="row">


                                <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                                    <table class="table table-bordered table-striped table-large">
                                        <tbody>
                                            <tr><td>Creatives</td>
                                                <td>{{ $creative_task->creative_type }}</td>
                                            </tr>
                                            <tr><td width="40%">Project</td>
                                                <td>{{ $creative_task->project }}</td>
                                            </tr>
                                            <tr><td>Task Category</td>
                                                <td>{{ $creative_task->task_cat }}</td>
                                            </tr>
                                            <tr><td>Task For</td>
                                                <td>{{ $creative_task->task_for }}</td>
                                            </tr>
                                            <tr>
                                                <td>Campaign</td>
                                                <td>{{ $creative_task->campaign }}</td>
                                            </tr>
                                            <tr><td>Campaign Type</td>
                                                <td>{{ $creative_task->campaign_type }}</td>
                                            </tr>
                                            <tr><td>Channel</td>
                                                <td>{{ $creative_task->channel }}</td>
                                            </tr>
                                            <tr><td>Creative Size</td>
                                                <td>{{ $creative_task->creative_size }}</td>
                                            </tr>
                                            <tr><td>Hero Message</td>
                                                <td>{{ $creative_task->hero_message }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>

                                            <div class="col-md-12">
                                                <div class="mb-2"><strong>Task Brief</strong></div>
                                                <div>{!! $creative_task->task_brief !!}</div>
                                            </div>
                                            <hr>



                                @if($samples)
                                <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                                    <div class="kt-widget1__info">
                                        <div class="mb-2"><strong>Sample Creatives</strong></div>
                                    </div>
                                    <div id="demo{{$creative_task->id}}" class="carousel slide creative-carousel" data-ride="carousel" style="height: auto;">

                                      <!-- Indicators -->
                                      <ul class="carousel-indicators">
                                        <?php $i = 0; foreach($samples as $samples_creatives): ?>
                                        <li data-target="#demo{{$creative_task->id}}" data-slide-to="<?php echo $i; ?>" <?php if($i == 0){ echo 'class="active"'; } ?>></li>
                                        <?php $i++; endforeach; ?>
                                    </ul>

                                    <!-- The slideshow -->
                                    <div class="carousel-inner"> 
                                        <?php $i = 0; foreach($samples as $samples_creatives): 
                                        $doc_type = \File::extension($samples_creatives->location);
                                        ?>
                                        <div class="carousel-item <?php if($i == 0){ echo 'active'; } ?>">
                                            <div class="creative_show_block" style="max-width: 400px;text-align: center;margin: 0 auto;">
                                                @if($doc_type == 'png' ||$doc_type == 'jpg' ||$doc_type == 'jpeg' ||$doc_type == 'gif')
                                                <img style="max-width: 400px; width:100%;text-align: center;margin: 0 auto; height: auto !important;" src="{{ url($samples_creatives->location) }}" alt="Craetives">
                                                @else
                                                <span class="alert alert-warning mt-5">Creatives Not found!</span>
                                                @endif
                                            </div>
                                            <div class="carousel-caption d-none d-md-block">
                                                @if($doc_type == 'png' ||$doc_type == 'jpg' ||$doc_type == 'jpeg' ||$doc_type == 'gif')
                                                <?php
                                                $creative_name = str_replace('_', ' ', $samples_creatives->name);
                                                $creative_name = str_replace('-', ' ', $creative_name);
                                                $creative_name = str_replace('.jpg', ' ', $creative_name);
                                                $creative_name = str_replace('.png', ' ', $creative_name);
                                                $creative_name = str_replace('.gif', ' ', $creative_name);
                                                $creative_name = ucfirst($creative_name);
                                                ?>
                                                <h3>{{ $creative_name }}</h3>
                                                <p>{{ $samples_creatives->comment }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <?php $i++; endforeach; ?>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" href="#demo{{$creative_task->id}}" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo{{$creative_task->id}}" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>

                                </div>
                            </div>
                            @endif


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


<!--                         <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">12:45</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-success"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                AEOL Meeting With
                            </div>
                            <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                <a href="#"><img src="assets/media/users/100_4.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_13.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_11.jpg" title=""></a>
                                <a href="#"><img src="assets/media/users/100_14.jpg" title=""></a>
                            </div>
                        </div> -->


                    </div>
                </div>
                <!--End::Timeline 3 -->
            </div>
            <div class="tab-pane" id="kt_portlet_edit" role="tabpanel">
                <h5 class="text-warning" style="margin: 15px 0;">Edit Details</h5>
                <hr>

                <form class="kt-form" method="post" action="{{ route('update_basic_creative_task', $creative_task->id) }}">
                    @csrf
                    {{ method_field('PUT') }}
                <!-- <div class="form-group row">
                    <div class="col-md-12">
                        <label>Task Name</label>
                        <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="task_name" id="task_name" value="{{ $creative_task->task_name }}">
                    </div>
                </div> -->

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Task Category</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_cat" required="" name="task_cat[]" multiple="multiple">
                            <option value="">** Select a Option</option>
                            <?php $filter_cat = explode(',', $creative_task->task_cat) ?>
                            @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_category') as $setting)

                            <option @if(in_array($setting->value, $filter_cat)) selected @endif value="{{ $setting->value }}">{{ $setting->value }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Task For</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_for" required="" name="task_for">
                            <option value="">** Select a Option</option>
                            <option @if($creative_task->task_for == 'inhouse') selected @endif value="inhouse">InHouse -  Alliance Digital Labs</option>
                            <option @if($creative_task->task_for == 'agency') selected @endif value="agency">Agency</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Creatives</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" required="" name="creative_type[]" multiple="multiple">
                            <option value="">** Select a Creative Type</option>

                            <?php $creative_type = explode(',', $creative_task->creative_type) ?>
                            @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                            <option  @if(in_array($setting->value, $creative_type)) selected @endif value="{{ $setting->value }}">{{ $setting->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">

                <label>Task Brief</label>
                <textarea id="kt-tinymce-4" name="task_brief" class="tox-target">
                    {!! $creative_task->task_brief !!}
                </textarea>

                    </div>
                    <div class="col-md-12">
                        <label>Hero Message</label>
                        <input type="text" title="Hero Message" placeholder="" maxlength="255" class="form-control" name="hero_message" id="hero_message" value="{{ $creative_task->hero_message }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>Creative Sizes</label>
                        <input type="text" title="Creative Size" placeholder="" maxlength="255" class="form-control" name="creative_size" id="creative_size" value="{{ $creative_task->creative_size }}">
                    </div>
                    <div class="col-md-4">                
                        <label>ETA From Task Creator</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="eta_from_creator" readonly placeholder="Select date & time" id="kt_datetimepicker_2"  value="{{ $creative_task->creator_eta }}" required="" />
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">                
                        <label>Priority From Task Creator</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_priority" required="" name="creator_priority">
                            <option value="">** </option>
                            <option @if($creative_task->priority == 'high') selected @endif  value="high">High</option>
                            <option @if($creative_task->priority == 'medium') selected @endif  value="medium">Medium</option>
                            <option @if($creative_task->priority == 'low') selected @endif  value="low">Low</option>
                        </select>
                    </div>
                </div>

<!-- 
                <h5 class="text-warning" style="margin: 15px 0;">Sub Task</h5>
                <hr> -->
<!--                 <div id="kt_repeater_4">
                    <div class="form-group  row mt-4">
                        <div data-repeater-list="asaignee_list" class="col-lg-12">
                            <div data-repeater-item class="row kt-margin-b-10">
                                <div class="col-lg-5">
                        <select style="width: 100%" class="form-control kt-select2" id="choose_channel" required="" name="camp_channel">
                            <option value=""> --- Choose Channel/Medium ---</option>
                            @foreach($setting->getValue('channel-medium') as $channel)
                            <option value="{{ $channel->value }}">{{ $channel->value }}</option>
                            @endforeach
                        </select>
                                </div>
                                <div class="col-lg-6">
                        <select style="width: 100%" class="form-control kt-select2" id="choose_channel_person" required="" name="camp_user">
                            <option value=""> --- Choose Asignee ---</option>
                        </select>
                                </div>
                                <div class="col-lg-1">
                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
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
                </div> -->
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>
</div>
</div>
<div class="col-md-6">
    
    <div class="kt-portlet creative-upload-block">
        @if(!$creatives->isEmpty())
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Creative Details
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            @foreach($creatives as $creative)
            <div class="form-group row creative-row" @if($creative->approval == 'Yes') style="background:#55ff6a;box-shadow: none;"@endif>
                <div class="col-md-2 col-creative-image">
                    <div class="creative">
                        <img src="{{ url($creative->location) }}" height="52" alt="Creatives" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="comments">
                        <p><strong>{{ $creative->name }}</strong></p>
                        @if($creative->comment)<p><strong style="color: #fd27eb;">Approval Comment:</strong> {{ $creative->comment }}</p>@endif
                        @if($creative->approval == 'Yes')<span class="kt-badge kt-badge--inline kt-badge--brand">Approved</span>@endif
                    </div>
                </div>
                @if($creative_task->status != 'completed')
                <div class="col-md-2 creative-action-block" style="padding: 0px !important;">
                    <span style="overflow: visible; position: relative; width: 110px;">

                        @if($creative->approval == 'Yes')<a href="{{ url($creative->location) }}" download title="Download Creative" class="btn btn-sm btn-brand btn-icon btn-icon-sm"><i class="flaticon2-download"></i></a>@endif
                        <button type="button" class="btn btn-sm btn-info btn-icon btn-icon-sm" data-toggle="modal" data-target="#kt_modal_{{ $creative->id }}"><i class="flaticon2-paper"></i></button>

                        <div class="modal fade" id="kt_modal_{{ $creative->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">

                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('update_creative_image_task', $creative->id) }}">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Creative</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="creatives_edit_images">
                                                        <img src="{{ url($creative->location) }}" alt="Creatives" style="max-height: 320px; max-width: 100%;" />
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <textarea name="reapproval_notes" class="form-control" placeholder="Write something about updates" style="height: 100px; margin-bottom: 20px;"></textarea>
                                                    <input type="file" name="creative_update" class="form-control">
                                                    <div class="current_creative_status">
                                                        <p><strong>Creative Comment</strong>: {{ $creative->comment }}</p>
                                                        <p><strong>Re-Approval Notes:</strong>: {{ $creative->reapproval_notes }}</p>
                                                    </div>
                                                </div>
                                            </div>
<!--                                             <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{ url($creative->location) }}" alt="Creatives" style="max-height: 162px;" />
                                                </div>
                                                <div class="col-md-9">
                                                    <textarea name="reapproval_notes" class="form-control" placeholder="Write something about updates" style="height: 100px; margin-bottom: 20px;"></textarea>
                                                    <input type="file" name="creative_update" class="form-control">
                                                </div>
                                            </div> -->
                                            @php
                                            $old_creatives = App\CreativeImages::where('creative_id', $creative_task->id)->where('order_id', $creative->order_id)->where('status', '0')->get();
                                            @endphp
                                            @foreach($old_creatives as $old_creative)
                                            <div class="row mt-4">
                                                <div class="col-md-3">
                                                    <img src="{{ url($old_creative->location) }}" alt="Old Creative" class="img-thumbnail img-fluid" />
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="current_creative_status_2">
                                                        <p><strong>Creative Comment:</strong> {{ $old_creative->comment }}</p>
                                                        <p><strong>Re-Approval Notes:</strong> {{ $old_creative->reapproval_notes }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Update Creative">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button title="Delete" class="deleteCreativeImg btn btn-sm btn-danger btn-icon btn-icon-sm" data-id="{{ $creative->id }}"><i class="flaticon2-trash"></i></button>
                    </span>
                </div>
                @endif
            </div>
            @endforeach
<!--         <div class="form-group row">
            <div class="col-md-12">
                <label>Upload Creatives</label>
                <div class="input-group">
                    <input required type="file" class="form-control" name="creatives[]" placeholder="address" multiple>
                </div>
            </div>
        </div> -->
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <!-- <a href="{{ url('/') }}" class="btn btn-success">Add more Creatives</a> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kt_modal_additional">Add more Creatives</button>
        </div>
        <div class="modal fade" id="kt_modal_additional" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('store_creative_image', $creative_task->id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Creatives</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Upload Creatives</label>
                                        <div class="input-group">
                                            <input required type="file" class="form-control" name="creatives[]" placeholder="address" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Upload Creative">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                No Creative
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="alert alert-warning" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">There No creative uploaded to this Task</div>
        </div>
    </div>
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kt_modal_additional">Upload Creatives</button>
            <!-- <a href="{{ url('/') }}" class="btn btn-success">Upload Creatives</a> -->
        </div>
    </div>

    <div class="modal fade" id="kt_modal_additional" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('store_creative_image', $creative_task->id) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Creatives</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Upload Creatives</label>
                                    <div class="input-group">
                                        <input required type="file" class="form-control" name="creatives[]" placeholder="address" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Upload Creative">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
    <!--begin::Portlet-->
    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('update_creative_task', $creative_task->id) }}">
        @csrf
        {{ method_field('PUT') }}
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Task Status 
                        @if($creative_task->status == 'new')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--brand kt-badge--inline">New</span>
                        @elseif($creative_task->status == 'new_needed')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--warning kt-badge--inline">New - Correction Needed - {{ $creative_task->new_needed_count }}</span>
                        @elseif($creative_task->status == 'new_updated')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--warning kt-badge--inline">New - Correction Updated - {{ $creative_task->new_update_count }}</span>
                        @elseif($creative_task->status == 'assigned')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--primary kt-badge--inline">Assigned</span>
                        @elseif($creative_task->status == 'processed')
                        <span style="font-size: 14px;background:#FF9800;" class="kt-badge kt-badge--success kt-badge--inline">On Progress</span>
                        @elseif($creative_task->status == 'process_transfer')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--info kt-badge--inline">Progress Transfer</span>
                        @elseif($creative_task->status == 'internal_review')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--warning kt-badge--inline">Internal Review</span>
                        @elseif($creative_task->status == 'review')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--primary kt-badge--inline">Review</span>
                        @elseif($creative_task->status == 'external_review')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--primary kt-badge--inline">External Review</span>
                        @elseif($creative_task->status == 'completed')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--danger kt-badge--inline">Completed</span>
                        @else
                        <span style="font-size: 14px;" class="kt-badge kt-badge--danger kt-badge--inline"><?php echo ucfirst($creative_task->status); ?></span>
                        @endif
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Change Status</label>
                        @if($current_user->role_id == '1' || $current_user->role_id == '2')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="new">New</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <option value="new_needed">New - Correction Needed</option>
                            <option value="new_updated">New - Correction Updated</option>
                            <option value="assigned">Assigned</option>
                            <option value="processed">On Progress</option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="review">Review</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="completed">Completed</option>
                        </select>
                        @elseif($current_user->role_id == '6')
                        @if($creative_task->status == 'assigned')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="processed">On Progress</option>
                            <option value="review">Review</option>
                        </select>
                        @elseif($creative_task->status == 'processed')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="review">Review</option>
                        </select>
                        @elseif($creative_task->status == 'review')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="review">Review</option>
                        </select>
                        @endif
                        @elseif($current_user->role_id == '5' || $current_user->role_id == '7' || $current_user->role_id == '8')
                        @if($creative_task->status == 'new')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="new_updated">New - Correction Updated</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @endif
                        @else
                        @if($creative_task->status == 'new' || $creative_task->status == 'new_updated' || $creative_task->status == 'new_needed')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="new_needed">New - Correction Needed</option>
                            <option value="assigned">Assigned</option>
                            <option value="processed">On Progress</option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                        </select>
                        @elseif($creative_task->status == 'assigned')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="processed">On Progress</option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @elseif($creative_task->status == 'processed')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @elseif($creative_task->status == 'process_transfer')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @elseif($creative_task->status == 'internal_review')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <option value="completed">Completed</option>
                        </select>
                        @elseif($creative_task->status == 'external_review')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="completed">Completed</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                        </select>
                        @endif
                        @endif
                    </div>

                    <div class="col-md-12 mt-4">
                        <textarea class="form-control" name="notes" placeholder="Designer Notes"></textarea>
                    </div>
                </div>
                <div class="form-group row new-correction-block">
                    <div class="col-md-12">                
                        <label>What actulay Need?</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="new_correction_need" placeholder="Correction Need" />
                        </div>
                    </div>
                </div> 
                <div class="form-group row assigner-block">
                    <div class="col-md-6">
                        <label>Assigned_to</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_assigned_to" name="assigned_to">
                            <option value=""> --- </option>
                            @if($creative_task->task_for == 'inhouse')
                            @foreach($creative_users as $creative_user)
                            <option value="{{ $creative_user->name }}">{{ ucfirst($creative_user->name) }}</option>
                            @endforeach
                            @elseif($creative_task->task_for == 'agency')
                            @foreach($agency_users as $agency_user)
                            <option value="{{ $agency_user->name }}">{{ ucfirst($agency_user->name) }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6">                
                        <label>ETA From Task Assigner</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="eta_from_assigner" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="form-group row process-transfer-block">
                    <div class="col-md-12">
                        <label>Transfer to</label>
                        <select style="width: 100%" class="form-control kt-select2" id="process_transfer_to" name="process_transfer_to">
                            <option value=""> --- </option>
                            @foreach($creative_users as $creative_user)
                            <option value="{{ $creative_user->name }}">{{ ucfirst($creative_user->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
                <div class="form-group row internal-reiview-block">
                    <div class="col-md-12">
                        <label>Mail to</label>
                        <div class="input-group">
                            <select style="width: 100%" class="form-control kt-select2" id="mail_to" name="mail_to" multiple="multiple">
                                <option value="">** Select a User</option>

                                <?php $creative_type = explode(',', $creative_task->creative_type) ?>
                                @foreach($settings->where('cat', 'Emails')->where('name', 'mail') as $setting)
                                <option  @if(in_array($setting->value, $creative_type)) selected @endif value="{{ $setting->value }}">{{ $setting->value }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Mail CC</label>
                        <div class="input-group">
                            <select style="width: 100%" class="form-control kt-select2" id="mail_cc" name="mail_cc" multiple="multiple">
                                <option value="">** Select a User</option>

                                <?php $creative_type = explode(',', $creative_task->creative_type) ?>
                                @foreach($settings->where('cat', 'Emails')->where('name', 'mail') as $setting)
                                <option  @if(in_array($setting->value, $creative_type)) selected @endif value="{{ $setting->value }}">{{ $setting->value }}</option>
                                @endforeach
                            </select>
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


<div class="kt-portlet creative-upload-block">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Status Log History
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="kt-list-timeline">
            <div class="status-history kt-list-timeline__items">
                @foreach($status_history as $history)
                @if($history->status == 'new_needed')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">New - Correction Needed</span>
                        @if($history->designer_comment)
                        | <span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span>
                        @endif
                        <p class="">{!! $history->note !!} </p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>

                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'assigned')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Assigned</span>
                        @if($history->designer_comment)
                        | <span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span>
                        @endif
                        <p class="">{!! $history->note !!}. @if($history->eta) And this creative task needs to complete by {{ $history->eta }} @endif</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>

                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'processed')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">On Progress</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>

                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'process_transfer')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Progress Transfer</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">New Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>

                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'review')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Review</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">Task Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>
                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'internal_review')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Internal Review</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">Task Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>
                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'external_review')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">External Review</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">Task Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>
                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'completed')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Creative task Completed</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">Task Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>
                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'discard')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Task Discard</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">Task Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>
                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @elseif($history->status == 'on_hold')
                <div class="kt-list-timeline__item">
                    <span class="kt-list-timeline__badge kt-list-timeline__badge--danger"></span>
                    <span class="kt-list-timeline__text"><strong>Status: </strong>
                        <span class="kt-badge kt-badge--success kt-badge--inline">Task on Hold</span>
                        @if($history->designer_comment)
                        <p class=""><span class=""><strong>Designer Note:</strong> {{ $history->designer_comment }}</span></p>
                        @endif
                        <p class="">{!! $history->note !!}.</p>
                        <p class="">Task Assignee : {{ $history->assignee }}.</p>
                        <p class="status_histoty_updated_by">Updated By: <strong>{{ $history->updated_by }}</strong></p>
                    </span>
                    <span class="kt-list-timeline__time">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>


<!--end::Form-->
</div>

        @php 
        foreach($samples as $samples_creatives): 
        $other_doc_type = \File::extension($samples_creatives->location);
        @endphp
        @if($doc_type == 'png' ||$doc_type == 'jpg' ||$doc_type == 'jpeg' ||$doc_type == 'gif')

                @elseif($other_doc_type == 'pdf')
<div class="col-md-12 col-xs-12">
    <div class="kt-portlet creative-upload-block">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Task Brief Documents
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <iframe src="{{ url($samples_creatives->location) }}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
        </div>
    </div>
</div>
                
                @else
                <div class="col-md-12 col-xs-12">
    <div class="kt-portlet creative-upload-block">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Task Brief Documents
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
                <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{ url($samples_creatives->location) }}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
        </div>
    </div>
</div>
                @endif
        @php
        endforeach;
        @endphp

</div>
</div>
<!--end::Portlet-->

</div>


@endsection
@section('footer_js')
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
<script src="{{ asset('assets/js/pages/components/extended/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('.new-correction-block').hide();
        $('.assigner-block').hide();
        $('.process-transfer-block').hide();
        $('.internal-reiview-block').hide();


        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'new_needed') {
                $('.new-correction-block').show();
            }else {
                $('.new-correction-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'assigned') {
                $('.assigner-block').show(); 
            } else {
                $('.assigner-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'process_transfer') {
                $('.process-transfer-block').show(); 
            } else {
                $('.process-transfer-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'internal_review') {
                //$('.creative-upload-block').show(); 
            } else {
                //$('.creative-upload-block').hide(); 
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'external_review' || $('#select_task_status').val() == 'review') {
                //$('.creative-upload-block').show(); 
                $('.internal-reiview-block').show(); 
            } else {
                $('.internal-reiview-block').hide();
            } 
        });
        $('#select_task_status').change(function(){
            if($('#select_task_status').val() == 'completed') {
                //$('.creative-upload-block').show(); 
            }
        });
        var creative_image_height = $('.creative-row').height();
        $('.creative-action-block').height(creative_image_height);
        @if(!empty($creative_updated))
        swal.fire({
            title: 'Deleted!',
            text: "The Creative Image has been deleted Successfuly!",
            type: 'error',
            showCancelButton: false,
            confirmButtonText: 'OK!'
        }).then(function(result){
            if (result.value) {
                location.reload();
            }
        });

        @endif

        $('.deleteCreativeImg').click(function(e){
            var id = $(this).data("id");
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.value) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax(
                    {
                        url: "{{ url('/task/creative_image/delete/') }}/"+id,
                        type: 'delete', // replaced from put
                        dataType: "JSON",
                        data: {
                            "id": id // method and token not needed in data
                        },
                        success: function (response)
                        {
                            swal.fire({
                                title: 'Deleted!',
                                text: "The Creative Image has been deleted Successfuly!",
                                type: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'OK!'
                            }).then(function(result) {
                                if (result.value) {
                                    location.reload();
                                }
                            });


                            // swal.fire("Deleted!", "The Creative Image has been deleted Successfuly!", "error");
                            
                        },
                        error: function(xhr) {
                           console.log(xhr.responseText);
                       }
                   });
                }
            });
        });

        // $(".deleteCreativeImg").click(function(){

        //     var id = $(this).data("id");
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax(
        //     {
        //         url: "{{ url('/task/creative_image/delete/') }}/"+id,
        //         type: 'delete', // replaced from put
        //         dataType: "JSON",
        //         data: {
        //             "id": id // method and token not needed in data
        //         },
        //         success: function (response)
        //         {
        //             swal.fire("Deleted!", "The Creative Image has been deleted Successfuly!", "error");
        //             location.reload();
        //         },
        //         error: function(xhr) {
        //          console.log(xhr.responseText); // this line will save you tons of hours while debugging
        //         // do something here because of error
        //        }
        //     });
        // });




    });


        // $(document).on('change', '#select_task_status', function () {
        //     if ($(this).val() == 'assigned') {
        //         $('.assigner-block').show();
        //     }
        //     else {
        //         $('.assigner-block').hide();
        //     }
        // });
    </script>
    @endsection