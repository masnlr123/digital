<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Ad Campaign - {{ $ad_camp->name }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-primary"><i class="la la-plus"></i> Add New</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(77px, 38px, 0px);">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#NewAdCamp">New Ad Campaign</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#NewMilestone">Add Milestone</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#NewTask">Add Task</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#NewSubTask">Add Sub Task</a>
                                </div>
                            </div>
                            <a href="{{ route('campaign_details', $ad_camp->campaign_id) }}?show=ad_camp" class="btn btn-danger btn-elevate btn-icon-sm" style="background-color: #9c27b0;border-color: #9c27b0;">
                                <i class="la la-undo"></i>
                                All Ad Campaign
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <style type="text/css">
                .ad_camp_wrapper .dataTable thead,
                .ad_camp_wrapper .dataTable tbody{
                    width: 100% !important;
                }
                .ad_camp_wrapper .dataTables_wrapper{
                    padding: 5px !important;
    box-shadow: 0px 0px 4px #ccc;
    border-radius: 0px;
}
            </style>
            <div class="kt-container pl-0">
                <div class="row">
                    <div class="col-4 ad_camp_wrapper">
                        <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-8">
                        <div class="kt-portlet" style="margin-bottom: 2px;">
                            <form class="kt-form" method="post" action="{{ route('milestone_store') }}">
                                @csrf
                                <input type="hidden" name="project" value="{{ $ad_camp->project }}">
                                <input type="hidden" name="campaign" value="{{ $ad_camp->campaign }}">
                                <input type="hidden" name="campaign_id" value="{{ $ad_camp->campaign_id }}">
                                <input type="hidden" name="ad_campaign_id" value="{{ $ad_camp->id }}">
                                <input type="hidden" name="channel" value="{{ $ad_camp->channel }}">
                                <input type="hidden" name="medium" value="{{ $ad_camp->medium }}">
                                <input type="hidden" name="source" value="{{ $ad_camp->source }}">
                                
                                <div class="row" style="background: #ddffb5;padding-bottom: 10px;margin-left: -12px;margin-right: -15px;">
                                    <div class="col-5 mt-3">
                                        <div class="input-group">
                                            <select class="form-control" name="activity" required style="background: #03a9f4;border-color: #2786fb;color: #ffff;">
                                                <option value="">Select Pre-defined Milestone</option>
                                                @php $all_activity = App\Setting::where('name', 'milestone')->get(); @endphp
                                                @foreach($all_activity as $activity)
                                                <option value="{{ $activity->value }}">{{ $activity->value }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#new_milestone_activity"><i class="flaticon-add" style="font-weight: bold; color: #fff;padding-right: 2px;border-radius: 0;"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 mt-3">
                                        <div class="kt-form__actions text-left">
                                            <button class="btn btn-primary"><i class="la la-plus"></i>Create Milestone</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                <hr style="margin:0px -15px 0px !important;">
            <div class="row">
            <!--begin::Accordion-->
            <div class="mt-2 milestones-list accordion accordion-light  accordion-svg-icon" id="accordionExample7">
            
            @foreach($milestones as $milestone)
            <div class="card">
                <div class="card-header" id="heading{{ $milestone->id }}">
                    <div class="card-title collapse show" data-toggle="collapse" data-target="#collapse{{ $milestone->id }}" aria-expanded="true" aria-controls="collapse{{ $milestone->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
                                <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                            </g>
                        </svg>
                        <span class="milestone-title">
                            <span style="float: left;margin-top: 5px;">{{ $milestone->activity }}</span>
                        <a href="{{ route('delete_milestone', $milestone->id) }}" target="_blank" class="kt-badge kt-badge--inline kt-badge--pill milestone_delete"><i class="flaticon-delete"></i> Delete Milestone</a></span>
                    </div>
                </div>
                <div id="collapse{{ $milestone->id }}" class="collapse show" aria-labelledby="heading{{ $milestone->id }}" data-parent="#accordionExample7">
                    @php $tasks = App\Models\Task::where('ad_camp_id', $ad_camp->id)->where('section_id', $milestone->id)->get(); @endphp
                    
                    @foreach($tasks as $task)
                    <h5 class="milestone-task-title">
                        <div class="milestone-task-list row">
                            <div class="space col-5 title">{{ $task->name }}</div>
                            <div class="space col-2"><span class="kt-badge kt-badge--inline kt-badge--pill task-department-list">{{ $task->department }}</span></div>
                            <div class="space col-2"><span class="kt-badge kt-badge--primary  kt-badge--inline kt-badge--pill">{{ $task->status }}</span></div>
                            <div class="col-2 p-0 text-right" style="padding: 4px 0px !important;">
                                <a href="{{ route('clone_task', $task->id) }}" class="btn btn-sm btn-icon btn-icon-sm btn-brand"><i class="la la-clone"></i></a>
                                <a href="{{ route('view_task', $task->id) }}" target="_blank" class="btn btn-sm btn-icon btn-icon-sm btn-brand"><i class="la la-eye"></i></a>
                                <!-- <a href="#" class="btn btn-sm btn-icon btn-icon-sm btn-brand"><i class="la la-user-plus"></i></a> -->
                                <a href="{{ route('delete_task', $task->id) }}" class="btn btn-sm btn-icon btn-icon-sm btn-danger"><i class="flaticon-delete"></i></a>
                            </div>
                        </div>
                    </h5>
                    @endforeach
                    @if(count($tasks) == 0)
                    <div class="card-body">
                        <div class="alert alert-warning fade show mt-2" role="alert">
                            <div class="alert-icon"><i class="la la-close"></i></div>
                            <div class="alert-text">No Task Found in this activity.</div>
                        </div>
                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#NewTask">
                            <i class="la la-plus"></i>
                            New Task
                        </a>

<div class="modal fade" id="NewTask">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{ route('store_new_task') }}">
                @csrf
                <input type="hidden" name="project_id" value="{{ $campaigns->project }}">
                <input type="hidden" name="campaign_id" value="{{ $campaigns->id }}">
                <input type="hidden" name="ad_camp_id" value="{{ $ad_camp->id }}">
                <input type="hidden" name="section_id" value="{{ $milestone->id }}">
<div class="kt-portlet">
    <div class="modal-header">
        <h5 class="modal-title">New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
    </div> 
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Task Name</label>
                <input type="text" placeholder="Max 40 Letters" maxlength="40" class="form-control" name="name" id="about_camp" value="">
            </div>
            <div class="col-md-3">
                <label>Department</label>
                <select class="form-control" name="department" id="department">
                    <option value="">Choose one Department</option>
<!--                     <option value="Paid">Paid</option>
                    <option value="Organic">Organic</option> -->
                    @php
                    $get_settings = App\Setting::where('name', 'task_department')->get();
                    @endphp
                    @foreach($get_settings as $setting)
                    @php $get_department_name = json_decode($setting->value); @endphp
                    <option value="{{ $get_department_name->name }}">{{ $get_department_name->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>ETA</label>
                <input type="datetime-local" name="eta" class="form-control">
            </div>
            <div class="col-md-6 mt-3">
                <label>To Assign</label>
                <select class="form-control" name="responsible">
                    <option value=""></option>
                    @foreach(App\User::whereIn('role_id', ['1', '2', '3', '4', '5', '6', '7', '8'])->get() as $assignee)
                        <option value="{{ $assignee->name }}">{{ $assignee->name }}</option>
                        @endforeach

                </select>
            </div>
            <div class="col-md-3 mt-3">
                <label>Priorities</label>
                <select class="form-control" name="priority">
                    <option value=""></option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <div class="col-md-3 mt-3 creative_block">
                <label>Task For*</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_task_for" name="team">
                    <option value="">** Select a Option</option>
                    <option value="inhouse">InHouse</option>
                    <option value="agency">Agency</option>
                </select>
            </div>
            <div class="col-md-12 mt-3 creative_block">
                <label>Creatives</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" name="creative_type[]" multiple="multiple">
                    <option value="">** Select a Creative Type</option>

                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <label>Task Brief</label>
                <textarea rows="16" placeholder="Enter your Description" class="form-control tiny_editor_popup" name="brief" id="kt-ckeditor-5"></textarea>
            </div>
            <div class="col-md-12 mt-3 creative_block">
                <label>Samples (Optional)</label>
                <input type="file" class="form-control" name="samples_creatives[]" multiple>
            </div>
        </div>                      
    </div>
    <div class="modal-foot">
        <div class="col-md-12 mt-3">
            <div class="kt-form__actions">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="#" class="btn btn-secondary close" data-dismiss="modal" aria-label="Close">Cancel</a>
            </div>
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
</div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

            @if(count($milestones) == 0)
            <div class="col-12">
                
            <div class="alert alert-warning fade show mt-2" role="alert" style="width: 100%;">
                <div class="alert-icon"><i class="la la-close"></i></div>
                <div class="alert-text">No Milestone found.</div>
            </div>
            </div>
            @endif
            </div>
            <!--end::Accordion-->
            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('footer_js')

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.get_medium_list_row').each(function(){
            $(this).click(function(){
                // alert($(this).attr('aria-expanded'));
                let is_this_expanded = $(this).attr('aria-expanded');
                if(is_this_expanded == true || is_this_expanded == 'undefined'){
                    $(this).find('.flaticon2-right-arrow').css({
                        'transform': 'rotate(90deg)',
                        'display': 'inline-block'
                    })
                }
            });
        });
        
    });
// $.fn.dataTable.ext.errMode = function(obj,param,err){
//                 var tableId = obj.sTableId;
//                 console.log('Handling DataTable issue of Table '+tableId);
//         };
//         $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
//     console.log(message);
// };
var table = $('#kt_table_1').DataTable({
       ordering: false,
       processing: true,
       serverSide: true,
       pageLength: 50,
       // ajax: {
       //         url: "https://digital.allianceprojects.in/ad_campaigns/ad_camp_datatables",
       //         type: "GET",
       //         dataSrc: ""
       //     },
       ajax: '{{ route('ad_camp_datatables', $campaigns->id) }}',
       columns: [
                { data: 'name', name: 'name' },
                { data: 'project', name: 'project' },
                { data: 'action', searchable: false, orderable: false }

             ],
        // language : {
        //     processing: '<img src="{{asset('assets/images/loader.jpg')}}">'
        // },
        // drawCallback : function( settings ) {
        //         $('.select').niceSelect();
        // }
    });

    $(document).ready(function(){
        $('.creative_block').hide();
        $('#department').change(function(){
            if($(this).val() == 'Creative'){
                $('.creative_block').show();
            }
            else{
                $('.creative_block').hide();
            }
        });
        
        $('#select_task_creatives').select2({
            placeholder: 'Select Creatives',
        });
        $('#assignee_list').select2({
            placeholder: 'Choose one assignee',
        });
        $('#select_task_theme').select2({
            placeholder: 'Select Creatives',
        });

        function create_ad_camp(camp){
            $(camp).click(function(){
                let camp_source = $(this).data('source');
                let camp_channel = $(this).data('channel');
                let camp_assign = $(this).data('assign');
                $('#new_ad_camp_source').val(camp_source);
                $('#new_ad_camp_channel').val(camp_channel);
                $('#new_ad_camp_assign').val(camp_assign);
                $('#new_ad_camp_source').css('background', '#e2ff70');
                $('#new_ad_camp_channel').css('background', '#e2ff70');
                $('#new_ad_camp_assign').css('background', '#e2ff70');
            });
        }
        @php $inc = 1; @endphp
        @foreach(json_decode($campaigns->channels) as $channel => $camp)
        create_ad_camp('#new_ad_camp_{{ $inc }}');
        @php $inc++; @endphp
        @endforeach
    });


</script>
@endsection