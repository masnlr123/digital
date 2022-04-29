<div class="row">
    <div class="kt-widget1 col-md-12" style="padding: 0px;">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#camp_optimization" role="tab"> <i class="fa fa-wrench" aria-hidden="true"></i>Paid </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_task" role="tab"> <i class="flaticon2-chart" aria-hidden="true"></i>Organic </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#creative_task" role="tab"> <i class="fa fa-eye" aria-hidden="true"></i>Creatives </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#web_task" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>LP </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#content_task" role="tab"> <i class="fab fa-gitter" aria-hidden="true"></i>Content </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#lms_task" role="tab"> <i class="fab fa-gitter" aria-hidden="true"></i>LMS </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#utm_builder" role="tab"> <i class="fab fa-gitter" aria-hidden="true"></i>UTM Builder </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="camp_optimization" role="tabpanel">
                        <h5 class="tabpanel-heading">Paid Task <button type="button" class="btn btn-success" data-toggle="modal" data-target="#paid_create_task">New Task</button></h5>

                        <div class="modal fade" id="paid_create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_paids', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add New</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Name</label>
                                                    <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>Activity Type</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="activity">
                                                        <option value="">** Select a Activity Type</option>
                                                        <option value="Optimization">Optimization</option>
                                                        <option value="Set-up">Set-up</option>
                                                        <option value="Reporting">Reporting</option>
                                                        <option value="Media Plan">Media Plan</option>
                                                        <option value="Research">Research</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ETA From Task Owner</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Priority From Task Owner</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="priority">
                                                        <option value="">** </option>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Brief</label>
                                                    <textarea placeholder="" class="form-control tiny_editor" name="brief" id="task_brief"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php 
                            $i ='1'; 
                            $opts = App\TaskPaid::where('campaign', $campaigns->id)->get(); ?> @foreach($opts as $task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section"> {!! ucfirst($task->name) !!}</span>
                                        <span class="btn btn-success btn-camp-status"><a style="color: #fff;" href="{{ route('edit_paid', $task->id) }}">{{ $task->status }} </a></span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $task->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td>{{ $task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Activity TYpe</td>
                                                    <td>{{ $task->activity }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Owner ETA</td>
                                                    <td>{{ $task->task_owner_eta }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Priority</td>
                                                    <td>{{ $task->priority }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Brief</td>
                                                    <td>{{ $task->brief }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Status</td>
                                                    <td>{{ $task->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="seo_task" role="tabpanel">
                        <h5 class="tabpanel-heading">Organic Task List<button type="button" class="btn btn-success" data-toggle="modal" data-target="#seo_create_task">New Task</button></h5>

                        <div class="modal fade" id="seo_create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_seo', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Organic Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Name</label>
                                                    <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>Activity Type</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="activity">
                                                        <option value="">** Select a Activity Type</option>
                                                        <option value="Backlink Building">Backlink Building</option>
                                                        <option value="Image Submission">Image Submission</option>
                                                        <option value="Classsified Submission">Classsified Submission</option>
                                                        <option value="PPT/PDF Submission">PPT/PDF Submission</option>
                                                        <option value="FB marketplace Posting">FB marketplace Posting</option>
                                                        <option value="FB Group Sharing">FB Group Sharing</option>
                                                        <option value="Property Portals">Property Portals</option>
                                                        <option value="Infographics">Infographics</option>
                                                        <option value="Minisites">Minisites</option>
                                                        <option value="PBN Content Submission">PBN Content Submission</option>
                                                        <option value="GBL ORM">GBL ORM</option>
                                                        <option value="FB Ad Commenting">FB Ad Commenting</option>
                                                        <option value="Keyword Ranking">Keyword Ranking</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ETA From Task Owner</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Priority From Task Owner</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="priority">
                                                        <option value="">** </option>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Brief</label>
                                                    <textarea placeholder="" class="form-control tiny_editor" name="brief" id="task_brief"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php 
                            $i ='1';
                            $seo_tasks = App\TaskSEO::where('campaign', $campaigns->id)->get(); ?> @foreach($seo_tasks as $task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section"> {!! ucfirst($task->name) !!}</span>
                                        <span class="btn btn-success btn-camp-status">{{ $task->status }}</span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $task->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td>{{ $task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Activity TYpe</td>
                                                    <td>{{ $task->activity }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Owner ETA</td>
                                                    <td>{{ $task->task_owner_eta }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Priority</td>
                                                    <td>{{ $task->priority }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Brief</td>
                                                    <td>{{ $task->brief }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Status</td>
                                                    <td>{{ $task->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="creative_task" role="tabpanel">
                        <h5 class="tabpanel-heading">Creative Task List<button type="button" class="btn btn-success" data-toggle="modal" data-target="#kt_modal_additional">New Task</button></h5>

                        <div class="modal fade" id="kt_modal_additional" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_creatives', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Creatives Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>Task Category</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="select_task_cat" required="" name="task_cat[]" multiple="multiple">
                                                        <option value="">** Select a Option</option>
                                                        @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_category') as $setting)
                                                        <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Task For</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="select_task_for" required="" name="task_for">
                                                        <option value="">** Select a Option</option>
                                                        <option value="inhouse">InHouse - Alliance Digital Labs</option>
                                                        <option value="agency">Agency</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Creative Sizes</label>
                                                    <input type="text" title="Creative Size" placeholder="" maxlength="255" class="form-control" name="creative_size" id="creative_size" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Creative Type</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="select_creative_type" required="" name="creative_type[]" multiple="multiple">
                                                        <option value="">** Select a Creative Type</option>

                                                        @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                                                        <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Brief</label>
                                                    <textarea title="Task Brief" placeholder="" class="form-control tiny_editor" name="task_brief" id="task_brief"></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Hero Message</label>
                                                    <textarea title="Hero Message" placeholder="" class="form-control tiny_editor" name="hero_message" id="hero_message" value=""></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label>ETA From Task Creator</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="eta_from_creator" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Priority From Task Creator</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="select_priority" required="" name="creator_priority">
                                                        <option value="">** </option>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Upload Creative Samples</label>
                                                    <input type="file" class="form-control" name="samples_creatives[]" multiple />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php $i ='1'; ?>
                            @foreach($creative_tasks as $task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section">
                                            @php $tasks_list = explode(',' , $task->creative_type); $types = ''; $ti = 0; $len = count($tasks_list); foreach ($tasks_list as $tsk) { $types .= ' '; $types .= $tsk; if($ti == $len - 1){
                                            $types .= ''; }else{ $types .= ' | '; } $ti++; } @endphp {!! ucfirst($types) !!}
                                        </span>
                                        <span class="btn btn-success btn-camp-status">{{ $task->status }}</span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td width="40%">Creatives</td>
                                                    <td>{{ $task->creative_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>project</td>
                                                    <td>{{ $task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Category</td>
                                                    <td>{{ $task->task_cat }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task For</td>
                                                    <td>{{ $task->task_for }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign Type</td>
                                                    <td>{{ $task->campaign_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Channel</td>
                                                    <td>{{ $task->channel }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Creative Size</td>
                                                    <td>{{ $task->creative_size }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Brief</td>
                                                    <td>{{ $task->task_brief }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hero Message</td>
                                                    <td>{{ $task->hero_message }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="web_task" role="tabpanel">
                        <h5 class="tabpanel-heading">LP task list<button type="button" class="btn btn-success" data-toggle="modal" data-target="#web_create_task">New Task</button></h5>

                        <div class="modal fade" id="web_create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_web', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add LP</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Name</label>
                                                    <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>Activity Type</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="activity">
                                                        <option value="">** Select a Activity Type</option>
                                                        <option value="Landing page">Landing page</option>
                                                        <option value="Website">Website</option>
                                                        <option value="SEO Optimization">SEO Optimization</option>
                                                        <option value="Custom Software Requirements">Custom Software Requirements</option>
                                                        <option value="Projects Update">Projects Update</option>
                                                        <option value="Leadsqaured Works">Leadsqaured Works</option>
                                                        <option value="Server Maintanace">Server Maintanace</option>
                                                        <option value="Server Based Requirements">Server Based Requirements</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ETA From Task Owner</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Priority From Task Owner</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="priority">
                                                        <option value="">** </option>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Brief</label>
                                                    <textarea placeholder="" class="form-control tiny_editor" name="brief" id="task_brief"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php $i ='1'; 
                            $seo_tasks = App\TaskWeb::where('campaign', $campaigns->id)->get(); ?> @foreach($seo_tasks as $task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section"> {!! ucfirst($task->name) !!}</span>
                                        <span class="btn btn-success btn-camp-status">{{ $task->status }}</span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $task->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td>{{ $task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Activity TYpe</td>
                                                    <td>{{ $task->activity }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Owner ETA</td>
                                                    <td>{{ $task->task_owner_eta }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Priority</td>
                                                    <td>{{ $task->priority }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Brief</td>
                                                    <td>{{ $task->brief }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Status</td>
                                                    <td>{{ $task->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="content_task" role="tabpanel">
                        <h5 class="tabpanel-heading">Content Requirements List<button type="button" class="btn btn-success" data-toggle="modal" data-target="#content_create_task">New task</button></h5>
                        <div class="modal fade" id="content_create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_content', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Content Requirements</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Name</label>
                                                    <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>Activity Type</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="activity">
                                                        <option value="">** Select a Activity Type</option>
                                                        <option value="Blog Post Content">Blog Post Content</option>
                                                        <option value="Creative Ad Content">Creative Ad Content</option>
                                                        <option value="Hero Message">Hero Message</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ETA From Task Owner</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Priority From Task Owner</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="priority">
                                                        <option value="">** </option>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Brief</label>
                                                    <textarea placeholder="" class="form-control tiny_editor" name="brief" id="task_brief"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php $i ='1'; 
                            $content_tasks = App\TaskContent::where('campaign', $campaigns->id)->get(); ?> @foreach($content_tasks as $task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section"> {!! ucfirst($task->name) !!}</span>
                                        <span class="btn btn-success btn-camp-status">{{ $task->status }}</span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $task->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td>{{ $task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Activity TYpe</td>
                                                    <td>{{ $task->activity }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Owner ETA</td>
                                                    <td>{{ $task->task_owner_eta }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Priority</td>
                                                    <td>{{ $task->priority }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Brief</td>
                                                    <td>{{ $task->brief }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Status</td>
                                                    <td>{{ $task->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="lms_task" role="tabpanel">
                        <h5 class="tabpanel-heading">LMS Team Task <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lms_create_task">New LMS Task</button></h5>
                        <div class="modal fade" id="lms_create_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_lms', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add LMS Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Name</label>
                                                    <input type="text" title="Task Name" placeholder="" required="" maxlength="255" class="form-control" name="name" id="task_name" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>Activity Type</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="activity">
                                                        <option value="">** Select a Activity Type</option>
                                                        <option value="Technical Issues Resolution in Leadsqaured- Calls/Leads assignments etc">Technical Issues Resolution in Leadsqaured- Calls/Leads assignments etc</option>

                                                        <option value="Technical Issues Resolution in Mcube Inbound /Outbound calls, User assignment etc">
                                                            Technical Issues Resolution in Mcube Inbound /Outbound calls, User assignment etc
                                                        </option>

                                                        <option value="Lead Import">Lead Import</option>

                                                        <option value="Lead reassignments basis Sales Team request">Lead reassignments basis Sales Team request</option>

                                                        <option value="New Automation creation for Sources/Projects/Users basis requirements">New Automation creation for Sources/Projects/Users basis requirements</option>

                                                        <option value="Automation changes/corrections basis Sales Team requirements">Automation changes/corrections basis Sales Team requirements</option>

                                                        <option value="New Lead Progression Development in all projects">New Lead Progression Development in all projects</option>

                                                        <option value="New Virtual Number creation/ adding in Mcube panel">New Virtual Number creation/ adding in Mcube panel</option>

                                                        <option value="Source mapping in Mcube & Leadsqaured new Virtual Number">Source mapping in Mcube & Leadsqaured new Virtual Number</option>

                                                        <option value="Monthly Invoices tracking for Leadsquared & Mcube">Monthly Invoices tracking for Leadsquared & Mcube</option>

                                                        <option value="Vendor payments followup">Vendor payments followup</option>

                                                        <option value="Lead database sanctity check -Project Name updation/User assignment">Lead database sanctity check -Project Name updation/User assignment</option>

                                                        <option value="User deactivation/Creation in both LSQ & Mcube">User deactivation/Creation in both LSQ & Mcube</option>

                                                        <option value="To check User Licenses /Email credit balances ">To check User Licenses /Email credit balances </option>

                                                        <option value="New account creation followup with vendor basis Sales Team request">New account creation followup with vendor basis Sales Team request</option>

                                                        <option value="Correction of Lead Sources in the existing Lead database across all projects">
                                                            Correction of Lead Sources in the existing Lead database across all projects
                                                        </option>

                                                        <option value="Booking Form integration">Booking Form integration</option>

                                                        <option value="Mcube Inbound/Outbound Numbers activation/deactivation & maintaining the List">
                                                            Mcube Inbound/Outbound Numbers activation/deactivation & maintaining the List
                                                        </option>

                                                        <option value="Landing Pages automation">Landing Pages automation</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>ETA From Task Owner</label>
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" name="task_owner_eta" readonly placeholder="Select date & time" id="kt_datetimepicker_2" required="" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Priority From Task Owner</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="" required="" name="priority">
                                                        <option value="">** </option>
                                                        <option value="high">High</option>
                                                        <option value="medium">Medium</option>
                                                        <option value="low">Low</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>Task Brief</label>
                                                    <textarea placeholder="" class="form-control tiny_editor" name="brief" id="task_brief"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php $i ='1'; 
                            $seo_tasks = App\TaskLMS::where('campaign', $campaigns->id)->get(); ?> @foreach($seo_tasks as $task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section"> {!! ucfirst($task->name) !!}</span>
                                        <span class="btn btn-success btn-camp-status">{{ $task->status }}</span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $task->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td>{{ $task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Activity TYpe</td>
                                                    <td>{{ $task->activity }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Owner ETA</td>
                                                    <td>{{ $task->task_owner_eta }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Priority</td>
                                                    <td>{{ $task->priority }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Brief</td>
                                                    <td>{{ $task->brief }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Task Status</td>
                                                    <td>{{ $task->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane" id="utm_builder" role="tabpanel">
                        <h5 class="tabpanel-heading">UTM Parameters <button type="button" class="btn btn-success" data-toggle="modal" data-target="#utm_build_form">New URL</button></h5>

                        <div class="modal fade" id="utm_build_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form class="kt-form" enctype="multipart/form-data" method="post" action="{{ route('camp_store_utm', $campaigns->id) }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add LMS Task</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 10px 30px;">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label>LP/Website URL</label>
                                                    <input type="text" placeholder="" required="" maxlength="255" class="form-control" name="url" id="url" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label>UTM Source</label>
                                                    <select style="width: 100%;" class="form-control kt-select2" id="select_creative_type" required="" name="utm_source">
                                                        <option value="">** Select a UTM Source</option>
                                                        <option value="Organic Search">Organic Search</option>
                                                        <option value="Referral Sites">Referral Sites</option>
                                                        <option value="Direct Traffic">Direct Traffic</option>
                                                        <option value="Social Media">Social Media</option>
                                                        <option value="Pay per Click Ads">Pay per Click Ads</option>
                                                        <option value="Direct Walk-in">Direct Walk-in</option>
                                                        <option value="Own Source">Own Source</option>
                                                        <option value="Realtor">Realtor</option>
                                                        <option value="Referral">Referral</option>
                                                        <option value="Website">Website</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Online portals">Online portals</option>
                                                        <option value="Property Fair">Property Fair</option>
                                                        <option value="Print Ad">Print Ad</option>
                                                        <option value="Website / Google Ad words">Website / Google Ad words</option>
                                                        <option value="Magicbrick">Magicbrick</option>
                                                        <option value="os lead">os lead</option>
                                                        <option value="Prop Fair">Prop Fair</option>
                                                        <option value="emailcampaign27">emailcampaign27</option>
                                                        <option value="colombia_native">colombia_native</option>
                                                        <option value="Webchat">Webchat</option>
                                                        <option value="My Property Boutique">My Property Boutique</option>
                                                        <option value="Mailerfurnished">Mailerfurnished</option>
                                                        <option value="99 Acres">99 Acres</option>
                                                        <option value="Adgebra">Adgebra</option>
                                                        <option value="Taboola">Taboola</option>
                                                        <option value="Outbrain">Outbrain</option>
                                                        <option value="Internet Times">Internet Times</option>
                                                        <option value="Roof and Floor">Roof and Floor</option>
                                                        <option value="Semi Furnished EDM">Semi Furnished EDM</option>
                                                        <option value="Existing Client">Existing Client</option>
                                                        <option value="Fair Pro">Fair Pro</option>
                                                        <option value="Postal Activity">Postal Activity</option>
                                                        <option value="website/Referral">website/Referral</option>
                                                        <option value="Email">Email</option>
                                                        <option value="Yahoo">Yahoo</option>
                                                        <option value="Rediff Camapign">Rediff Camapign</option>
                                                        <option value="googlenativeads">googlenativeads</option>
                                                        <option value="Realty Compass">Realty Compass</option>
                                                        <option value="India Property">India Property</option>
                                                        <option value="Housing.com">Housing.com</option>
                                                        <option value="Chennai properties">Chennai properties</option>
                                                        <option value="mdn">mdn</option>
                                                        <option value="Common Floor">Common Floor</option>
                                                        <option value="Olx">Olx</option>
                                                        <option value="Webboomba">Webboomba</option>
                                                        <option value="Hindu slug">Hindu slug</option>
                                                        <option value="Outbrain,Outbrain">Outbrain,Outbrain</option>
                                                        <option value="mdn,taboola">mdn,taboola</option>
                                                        <option value="Quikr">Quikr</option>
                                                        <option value="Quora">Quora</option>
                                                        <option value="way2online">way2online</option>
                                                        <option value="Propertywala">Propertywala</option>
                                                        <option value="Adwords">Adwords</option>
                                                        <option value="Facebook Sudhakar">Facebook Sudhakar</option>
                                                        <option value="Multiplex">Multiplex</option>
                                                        <option value="Makaan">Makaan</option>
                                                        <option value="Market Research Team">Market Research Team</option>
                                                        <option value="Internet_Times">Internet_Times</option>
                                                        <option value="AdCanopus">AdCanopus</option>
                                                        <option value="videocon">videocon</option>
                                                        <option value="Daily Hunt">Daily Hunt</option>
                                                        <option value="Adwords_Txt">Adwords_Txt</option>
                                                        <option value="Dailyhunt">Dailyhunt</option>
                                                        <option value="Clickindia Property Portal">Clickindia Property Portal</option>
                                                        <option value="Adwords_Dsp">Adwords_Dsp</option>
                                                        <option value="Google">Google</option>
                                                        <option value="GAds_Alliance">GAds_Alliance</option>
                                                        <option value="Sulekha">Sulekha</option>
                                                        <option value="Click India">Click India</option>
                                                        <option value="SEO TEAM">SEO TEAM</option>
                                                        <option value="Click_India">Click_India</option>
                                                        <option value="Adword_Text">Adword_Text</option>
                                                        <option value="G-Ads-Alliance">G-Ads-Alliance</option>
                                                        <option value="CP">CP</option>
                                                        <option value="CP_Praveen_Paul">CP_Praveen_Paul</option>
                                                        <option value="Times CPL">Times CPL</option>
                                                        <option value="Adwords_Text_OTP">Adwords_Text_OTP</option>
                                                        <option value="Facebook_OTP">Facebook_OTP</option>
                                                        <option value="Facebook_OTP_location">Facebook_OTP_location</option>
                                                        <option value="Quora Commenting">Quora Commenting</option>
                                                        <option value="Website_Organic">Website_Organic</option>
                                                        <option value="ROTN">ROTN</option>
                                                        <option value="gbl">gbl</option>
                                                        <option value="Whats app Campaign 2020">Whats app Campaign 2020</option>
                                                        <option value="NRI Team">NRI Team</option>
                                                        <option value="Business Partner">Business Partner</option>
                                                        <option value="LP Alliance">LP Alliance</option>
                                                        <option value="Existing Booked Customer Referral">Existing Booked Customer Referral</option>
                                                        <option value="Direct Sales Team">Direct Sales Team</option>
                                                        <option value="Business Partners">Business Partners</option>
                                                        <option value="OS Booked Customer">OS Booked Customer</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>UTM Medium</label>
                                                    <input type="text" placeholder="Enter UTM Medium" class="form-control" name="utm_medium" id="utm_medium" value="" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>UTM Term</label>
                                                    <input type="text" placeholder="Enter UTM Term" class="form-control" name="utm_term" id="utm_term" value="" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>UTM Content</label>
                                                    <input type="text" placeholder="Enter UTM Content" class="form-control" name="utm_content" id="utm_content" value="" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>UTM Ad Position</label>
                                                    <input type="text" placeholder="Enter UTM Ad Position" class="form-control" name="utm_adposition" id="utm_adposition" value="{adposition}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>UTM Device</label>
                                                    <input type="text" placeholder="Enter UTM Device" class="form-control" name="utm_device" id="utm_device" value="{device}" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label>UTM Network</label>
                                                    <input type="text" placeholder="Enter UTM Network" class="form-control" name="utm_network" id="utm_network" value="" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>UTM Placement</label>
                                                    <input type="text" placeholder="Enter UTM Placement" class="form-control" name="utm_placement" id="utm_placement" value="{placement}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>UTM Target</label>
                                                    <input type="text" placeholder="Enter UTM Target" class="form-control" name="utm_target" id="utm_target" value="{targetid}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label>UTM Ad</label>
                                                    <input type="text" placeholder="Enter UTM Ad" class="form-control" name="utm_ad" id="utm_ad" value="{adgroupid}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" value="Save" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-toggle-arrow" id="campaign_info">
                            <?php $i ='1'; 
                            $utms = App\UTM::where('campaign', $campaigns->id)->get(); ?> @foreach($utms as $utm_task)
                            <div class="card">
                                <div class="card-header" id="campaign_heading<?php echo $i; ?>">
                                    <div
                                        class="card-title"
                                        data-toggle="collapse"
                                        data-target="#campaign_collapse<?php echo $i; ?>"
                                        aria-expanded="<?php echo ($i == '1')?'true':'false'; ?>"
                                        aria-controls="campaign_collapse<?php echo $i; ?>"
                                    >
                                        <span class="task-heading-section"> {!! ucfirst($utm_task->utm_source) !!} - {!! ucfirst($utm_task->project) !!}</span>
                                        <span class="btn btn-success btn-camp-status">Created By: {{ $utm_task->created_by }}</span>
                                    </div>
                                </div>
                                <div id="campaign_collapse<?php echo $i; ?>" class="collapse <?php echo ($i == '1')?'show':''; ?>" aria-labelledby="campaign_heading<?php echo $i; ?>" data-parent="#campaign_info">
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Source</td>
                                                    <td>{{ $utm_task->utm_source }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Project</td>
                                                    <td>{{ $utm_task->project }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Campaign</td>
                                                    <td>{{ $utm_task->campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Medium</td>
                                                    <td>{{ $utm_task->utm_medium }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Campaign</td>
                                                    <td>{{ $utm_task->utm_campaign }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Term</td>
                                                    <td>{{ $utm_task->utm_term }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Content</td>
                                                    <td>{{ $utm_task->utm_content }}</td>
                                                </tr>
                                                <tr>
                                                    <td>utm_aUTM Adposition</td>
                                                    <td>{{ $utm_task->utm_adposition }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Device</td>
                                                    <td>{{ $utm_task->utm_device }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Network</td>
                                                    <td>{{ $utm_task->utm_network }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Placement</td>
                                                    <td>{{ $utm_task->utm_placement }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Target</td>
                                                    <td>{{ $utm_task->utm_target }}</td>
                                                </tr>
                                                <tr>
                                                    <td>UTM Ad</td>
                                                    <td>{{ $utm_task->utm_ad }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Full UTM URL</td>
                                                    <td><textarea class="form-control tiny_editor" rows="15" readonly>{{ $utm_task->output }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <td>Created By</td>
                                                    <td>{{ $utm_task->created_by }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>