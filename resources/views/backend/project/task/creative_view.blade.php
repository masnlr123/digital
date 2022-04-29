@extends('layouts.app') @section('content')
<!-- begin:: Subheader -->
<div ng-app="myApp">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
                    <!-- <a class="btn btn-brand btn-elevate btn-pill btn-elevate-air btn-sm" style="float: left;" href="{{ url('task/web') }}"><i class="fa fa-undo"></i> Back to Web Task</a> -->
            <h3 class="kt-subheader__title">
                   {{ $task->department }} Task &nbsp; : &nbsp;<strong style="color: #FF9800;">{{ $task->name }}</strong></h3>
        </div>
        <div class="kt-subheader__toolbar">
            @if(!empty($task->campaign))
            <a href="{{ route('campaign_details', $task->campaign) }}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> Campaign Page</a>
            @endif
            <a href="{{ route('campaign_index') }}" class="btn btn-warning btn-elevate btn-icon-sm"><i class="fa fa-undo"></i>Project Campagins</a>
            <a href="{{ route('all_ad_camp_index') }}" class="btn btn-warning btn-elevate btn-icon-sm"><i class="fa fa-undo"></i>Ad Campagins</a>
            <a href="{{ route('task_list_index', $task->department) }}" class="btn btn-success btn-elevate btn-icon-sm"><i class="fa fa-undo"></i> All Task</a>
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
        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_details" role="tab">
                                    <i class="fa fa-eye" aria-hidden="true"></i>Task Details
                                </a>
                            </li>
                            @if($current_user->name == $task->created_by || $current_user->name == "Mahimai Alexander")
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_portlet_edit" role="tab">
                                    <i class="fa fa-edit" aria-hidden="true"></i>Edit Details
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#creative_tab" role="tab">
                                    <i class="flaticon2-image-file" aria-hidden="true"></i>Creatives
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#status_logs" role="tab">
                                    <i class="flaticon2-correct" aria-hidden="true"></i>Status Logs
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
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_portlet_details" role="tabpanel">
                            <div class="row">
                                <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                                    <table class="table table-bordered table-striped table-large">
                                        <tbody>
                                            <tr>
                                                <td>Task Name</td>
                                                <td colspan="3">{{ $task->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Creatives</td>
                                                <td colspan="3">
                                                    @foreach(explode(',',$task->creatives) as $creative)
                                                    <span class="kt-badge kt-badge--primary kt-badge--inline">{{ $creative }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @if($task->from == 'task')
                                            <tr>
                                                <td>Project</td>
                                                <td>{{ $task->project->name }}</td>
                                                <td><strong>Task For</strong></td>
                                                <td>{{ $task->team }}</td>
                                            </tr>
                                            <tr>
                                                <td>Campaign</td>
                                                <td>{{ $task->campaign->name }}</td>
                                                <td><strong>Department</strong></td>
                                                <td>{{ $task->department }}</td>
                                            </tr>
                                            @if(!empty($task->ad_camp_id))
                                            <tr>
                                                <td>Ad Campaign</td>
                                                <td>{{ $task->ad_campaign->name }}</td>
                                                <td><strong>MileStone</strong></td>
                                                <td>{{ $task->milestone->activity }}</td>
                                            </tr>
                                            @endif
                                            @endif
                                            <tr>
                                                <td>Task For</td>
                                                <td>{{ $task->team }}</td>
                                                <td><strong>ETA</strong></td>
                                                <td>{{ $task->eta }}</td>
                                            </tr>
                                            @if(!empty($task->tag))
                                            <tr>
                                                <td>Creative Theme</td>
                                                <td colspan="3">
                                                    @foreach(explode(',',$task->tag) as $creative)
                                                    <span class="kt-badge kt-badge--primary kt-badge--inline">{{ $creative }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Priority</td>
                                                <td>{{ $task->priority }}</td>
                                                <td><strong>Assignee</strong></td>
                                                <td>{{ $task->responsible }}</td>
                                            </tr>
                                            <tr>
                                                <td>Task Status</td>
                                                <td>{{ $task->status }}</td>
                                                <td><strong>Task created By</strong></td>
                                                <td>{{ $task->created_by }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if(!empty($task->brief))
                                <hr>
                                <div class="col-md-12">
                                    <div class="mb-2"><strong>Task Brief</strong></div>
                                    <div style="line-height: 1.5;">{!! $task->brief !!}</div>
                                </div>
                                @endif
                                @if(count($samples) > 0)
                                <hr>
                                <div class="kt-widget1 col-md-12" style="padding:20px 10px;">
                                    <div class="kt-widget1__info">
                                        <div class="mb-2"><strong>Sample Creatives</strong></div>
                                    </div>
                                    <div id="demo{{$task->id}}" class="carousel slide creative-carousel" data-ride="carousel" style="height: auto;">

                                      <!-- Indicators -->
                                      <ul class="carousel-indicators">
                                        <?php $i = 0; foreach($samples as $samples_creatives): ?>
                                        <li data-target="#demo{{$task->id}}" data-slide-to="<?php echo $i; ?>" <?php if($i == 0){ echo 'class="active"'; } ?>></li>
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
                                    <a class="carousel-control-prev" href="#demo{{$task->id}}" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#demo{{$task->id}}" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>

                                </div>
                            </div>
                            @endif


                        </div>
                    </div>
                    <div class="tab-pane" id="kt_portlet_logs" role="tabpanel">
                        
             <h5 class="text-warning" style="margin: 15px 0;">Activity Logs</h5><hr>
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
                <form class="kt-form" method="post" action="{{ route('update_task_details', $task->id) }}">
                    @csrf
                    <input type="hidden" name="department" value="Creative">
                    {{ method_field('PUT') }}
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Task Name</label>
                        <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="{{ $task->name }}">
                    </div>
                    <div class="col-md-3">                
                        <label>ETA From Task Creator</label>
                        <div class="input-group date">
                            <input type="datetime-local" class="form-control" name="eta" value="{{ $task->eta }}" required="" />
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">                
                        <label>Priority From Task Creator</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_priority" required="" name="priority">
                            <option value="">** </option>
                            <option @if($task->priority == 'high') selected @endif  value="high">High</option>
                            <option @if($task->priority == 'medium') selected @endif  value="medium">Medium</option>
                            <option @if($task->priority == 'low') selected @endif  value="low">Low</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Task Category</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_cat" required="" name="tag[]" multiple="multiple">
                            <option value="">** Select a Option</option>
                            <?php $filter_cat = explode(',', $task->tag) ?>
                            @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_category') as $setting)

                            <option @if(in_array($setting->value, $filter_cat)) selected @endif value="{{ $setting->value }}">{{ $setting->value }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Task For</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_for" required="" name="team">
                            <option value="">** Select a Option</option>
                            <option @if($task->team == 'inhouse') selected @endif value="inhouse">InHouse -  Alliance Digital Labs</option>
                            <option @if($task->team == 'agency') selected @endif value="agency">Agency</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Assignee</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_for" name="responsible">
                            <option value="">** Select a Option</option>
                            @php
                    $get_department = App\Setting::where('name', 'task_department')->where('value', 'like', '%"name":"'.$task->department.'"%')->first();
                    $get_user = json_decode($get_department->value);
                    $get_user = json_decode($get_user->users);
                    @endphp
                    @foreach($get_user as $user)
                    @php $department_user = App\User::find($user); @endphp
                    <option value="{{ $department_user->name }}" @if($task->responsible == $department_user->name) selected @endif>{{ $department_user->name }}</option>
                    @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Creatives</label>
                        <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" required="" name="creative_type[]" multiple="multiple">
                            <option value="">** Select a Creative Type</option>
                            <?php $creative_type = explode(',', $task->creatives) ?>
                            @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                            <option  @if(in_array($setting->value, $creative_type)) selected @endif value="{{ $setting->value }}">{{ $setting->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">

                <label>Task Brief</label>
                <textarea id="kt-tinymce-4" name="brief" class="tox-target">
                    {!! $task->brief !!}
                </textarea>

                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="creative_tab" role="tabpanel">

        @if(!$creatives->isEmpty())
            
             <h5 class="text-warning" style="margin: 15px 0;">
                Creative Details
            </h5>
            <hr>
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
                @if($task->status != 'completed')
                <div class="col-md-2 creative-action-block" style="padding: 0px !important;">
                    <span style="overflow: visible; position: relative; width: 110px;">

                        @if($creative->approval == 'Yes')<a href="{{ url($creative->location) }}" download title="Download Creative" class="btn btn-sm btn-brand btn-icon btn-icon-sm"><i class="flaticon2-download"></i></a>@endif
                        <button type="button" class="btn btn-sm btn-info btn-icon btn-icon-sm" data-toggle="modal" data-target="#kt_modal_{{ $creative->id }}"><i class="flaticon2-paper"></i></button>

                        <div class="modal fade" id="kt_modal_{{ $creative->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">

                                    <form class="kt-form" method="post" action="{{ route('creatives_update', $creative->id) }}" enctype="multipart/form-data">
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
                                            @php
                                            $old_creatives = App\CreativeImages::where('creative_id', $task->id)->where('order_id', $creative->order_id)->where('status', '0')->get();
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

        <div class="kt-form__actions">
            <!-- <a href="{{ url('/') }}" class="btn btn-success">Add more Creatives</a> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#kt_modal_additional">Add more Creatives</button>
        </div>
        <div class="modal fade" id="kt_modal_additional" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('store_creative', $task->id) }}">
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
            @else


            
             <h5 class="text-warning" style="margin: 15px 0;">
                No Creative
            </h5>
            <hr>
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

                <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('store_creative', $task->id) }}">
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
        <div class="tab-pane" id="status_logs" role="tabpanel">

             <h5 class="text-warning" style="margin: 15px 0;">
                    Status Logs
                </h5>
                <hr>
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
</div>
</div>


</div>
<div class="col-md-4">
    <!--begin::Portlet-->
    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('creative_status_update', $task->id) }}">
        @csrf
        {{ method_field('PUT') }}
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Task Status 
                        @if($task->status == 'new')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--brand kt-badge--inline">New</span>
                        @elseif($task->status == 'new_needed')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--warning kt-badge--inline">New - Correction Needed - {{ $task->new_needed_count }}</span>
                        @elseif($task->status == 'new_updated')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--warning kt-badge--inline">New - Correction Updated - {{ $task->new_update_count }}</span>
                        @elseif($task->status == 'assigned')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--primary kt-badge--inline">Assigned</span>
                        @elseif($task->status == 'processed')
                        <span style="font-size: 14px;background:#FF9800;" class="kt-badge kt-badge--success kt-badge--inline">On Progress</span>
                        @elseif($task->status == 'process_transfer')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--info kt-badge--inline">Progress Transfer</span>
                        @elseif($task->status == 'internal_review')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--warning kt-badge--inline">Internal Review</span>
                        @elseif($task->status == 'review')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--primary kt-badge--inline">Review</span>
                        @elseif($task->status == 'external_review')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--primary kt-badge--inline">External Review</span>
                        @elseif($task->status == 'completed')
                        <span style="font-size: 14px;" class="kt-badge kt-badge--danger kt-badge--inline">Completed</span>
                        @else
                        <span style="font-size: 14px;" class="kt-badge kt-badge--danger kt-badge--inline"><?php echo ucfirst($task->status); ?></span>
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
                        @if($task->status == 'assigned')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="processed">On Progress</option>
                            <option value="review">Review</option>
                        </select>
                        @elseif($task->status == 'processed')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="review">Review</option>
                        </select>
                        @elseif($task->status == 'review')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="review">Review</option>
                        </select>
                        @endif
                        @elseif($current_user->role_id == '5' || $current_user->role_id == '7' || $current_user->role_id == '8')
                        @if($task->status == 'new')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="new_updated">New - Correction Updated</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @endif
                        @else
                        @if($task->status == 'new' || $task->status == 'new_updated' || $task->status == 'new_needed')
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
                        @elseif($task->status == 'assigned')
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
                        @elseif($task->status == 'processed')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @elseif($task->status == 'process_transfer')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <!-- <option value="completed">Completed</option> -->
                        </select>
                        @elseif($task->status == 'internal_review')
                        <select style="width: 100%" class="form-control kt-select2" id="select_task_status" required="" name="task_cat" ng-model="TaskStatus">
                            <option value=""> --- </option>
                            <option value="process_transfer">Progress Transfer</option>
                            <option value="internal_review">Internal Review</option>
                            <option value="external_review">External Review</option>
                            <option value="on_hold">On Hold</option>
                            <option value="discard">Discard</option>
                            <option value="completed">Completed</option>
                        </select>
                        @elseif($task->status == 'external_review')
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
                        <select style="width: 100%" class="form-control kt-select2" name="assigned_to">
                            <option value=""> --- </option>
                            @foreach($creative_users as $creative_user)
                            <option value="{{ $creative_user->name }}">{{ ucfirst($creative_user->name) }}</option>
                            @endforeach
                            @foreach($agency_users as $agency_user)
                            <option value="{{ $agency_user->name }}">{{ ucfirst($agency_user->name) }}</option>
                            @endforeach
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

                                <?php $creative_type = explode(',', $task->creative_type) ?>
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

                                <?php $creative_type = explode(',', $task->creative_type) ?>
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