@extends('layouts.app')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                All Task List </h3>
        </div>
    </div>
</div>
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if($current_department == 'all') active @endif" href="{{ route('carbon_index', 'all') }}">
                            <i class="flaticon2-list-1" aria-hidden="true"></i>All Task
                        </a>
                    </li>
                    @foreach(App\Setting::where('name', 'task_department')->get() as $result)
                    @php 
                    $department = json_decode($result->value);
                    if(\Request::is($department->url)) { 
                        $active_class = 'active';
                    }
                    else{
                        $active_class = '';
                    }
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link @if($department->url == $current_department) active @endif" href="{{ route('carbon_index', $department->url) }}">
                            <i class="{{ $department->icon }}" aria-hidden="true"></i>{{ $department->name }}
                        </a>
                    </li>
                    @endforeach
                    
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="kt_portlet_base_demo_3_3_tab_content" role="tabpanel">
                  
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
    @if($message = Session::get('warning'))
    <div class="alert alert-warning fade show" role="alert">
        <div class="alert-icon"><i class="la la-close"></i></div>
        <div class="alert-text">{{ $message }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
    @endif
    <div class="pt-2 pb-3 creative_index kt-portlet__body kt-portlet__body--fit">

        <div class="row">
            <div class="col-9">

                @if(!empty($user->timer))
                <div class="task_panel_wrapper">
                    @php 
                    $get_user_task = App\Models\Task::find($user->live_task_id);
                    $get_timer = App\Models\Timer::find($get_user_task->timer_id);
                    @endphp
                    <span class="task_status_lable">
                        <span><i class="fas fa-pause"></i></span>
                        <span>Working Task</span>
                    </span>
                    <!-- <span class="triangle-right"></span> -->
                    <span>{{ $get_user_task->name }}</span>
                    <span class="task_action">
                        <span class="btn btn-sm btn-brand btn_task_action display_task_timer" style="margin-right: 0px;"></span>
                        <a href="{{ route('stop_timer',$get_timer->id) }}" class="btn btn-sm btn-warning btn_task_action">Stop Timer</a>
                    </span>
                </div>
                @endif
                
            </div>
            <div class="col-3 text-right">
                <a href="{{ route('task_list_index', $current_department) }}" class="btn btn-brand btn-sm btn-elevate btn-icon-sm"><i class="flaticon2-list-1"></i>List View</a>
                <a href="#" id="open_new_task" class="btn btn-new btn-success btn-sm btn-elevate btn-icon-sm" data-toggle="modal" data-target="#NewTask"><i class="flaticon-plus"></i>New Task</a>
            </div>
        </div>
        <div id="kanban4" class="mt-3"></div>


        <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <!-- <th>#</th> -->
                    <th>Project</th>
                    <th>Campain</th>
                    <th>Task</th>
                    <th>Department</th>
                    <th>Creator</th>
                    <th>Responsible</th>
                    <th>ETA</th>
                    <th>Status</th>
                    <th>Timer</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        <!-- <div class="kanban-toolbar">
            <div class="row">
                <div class="col-lg-4">
                    <div class="kanban-toolbar__title">
                        Add New Board
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <input id="kanban-add-board" class="form-control" type="text" placeholder="Board Name" /><br />
                            <select id="kanban-add-board-color" class="form-control">
                                <option value="">Select a Board Color</option>
                                <option value="brand">Brand</option>
                                <option value="brand-light">Brand Light</option>
                                <option value="primary">Primary</option>
                                <option value="primary-light">Primary Light</option>
                                <option value="success">Success</option>
                                <option value="success-light">Success Light</option>
                                <option value="info">Info</option>
                                <option value="info-light">Info Light</option>
                                <option value="warning">Warning</option>
                                <option value="warning-light">Warning Light</option>
                                <option value="danger">Danger</option>
                                <option value="danger-light">Danger Light</option>
                            </select>
                            <br />
                            <button class="btn btn-success" id="addBoard">Add board</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="kanban-toolbar__title">
                        Add New Task
                    </div>
                    <div class="form-group">
                        <input id="kanban-add-task" class="form-control" type="text" placeholder="Task Name" /><br />
                        <select id="kanban-select-task" class="form-control">
                            <option value="">Select a Board</option>
                            <option value="_board1">Board 1</option>
                            <option value="_board2">Board 2</option>
                            <option value="_board3">Board 3</option>
                        </select>
                        <br />
                        <select id="kanban-add-task-color" class="form-control">
                            <option value="">Select a Task Color</option>
                            <option value="brand">Brand</option>
                            <option value="primary">Primary</option>
                            <option value="success">Success</option>
                            <option value="info">Info</option>
                            <option value="warning">Warning</option>
                            <option value="danger">Danger</option>
                        </select>
                        <br />
                        <button class="btn btn-primary" id="addTask">Add Task</button>
                    </div>
                </div>
            </div>
        </div> -->







    </div>
                </div>
                
            </div>
        </div>
    </div>
    </div>

    <!-- end:: Content -->
    </div>


<div class="modal fade task_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title task_title" style="width: 100%;" id="taskTitle"></h5><div id="titleStatus"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 class="sub_title">Description</h5>
        <div class="task_discription"></div>
        <h5 class="sub_title">Sub Task</h5>
        <div class="sub_task">
            <div id="kt_repeater_2">
                <div class="form-group  row">
                    <div data-repeater-list="" class="col-12">
                        <div data-repeater-item class="kt-margin-b-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-danger" placeholder="Enter telephone">
                                <div class="input-group-append">
                                    <a href="javascript:;" class="btn btn-danger btn-icon">
                                        <i class="la la-close"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div data-repeater-create="" class="btn btn btn-warning">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Add</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="sub_title">Comments</h5>
        <div class="comments"></div>
        <h5 class="sub_title">Activity</h5>
        <div class="activity_list"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@include('backend.project.task.modal.new_task')
@endsection




@section('header_css')
<link href="{{ asset('assets/plugins/custom/kanban/kanban.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/angular.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer_js')
<script src="{{ asset('assets/plugins/custom/kanban/kanban.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    

jQuery(document).ready(function() {

        var table = $('#kt_table_1').DataTable({
               ordering: false,
               processing: true,
               serverSide: true,
               pageLength: 50,
               ajax: '{{ route('task_datatable', $current_route) }}',
               columns: [
                        // { data: 'id', name: 'id' },
                        { data: 'project', name: 'project' },
                        { data: 'campaign', name: 'campaign' },
                        { data: 'name', name: 'name' },
                        { data: 'department', name: 'department' },
                        // { data: 'types', orderable: false },
                        { data: 'created_by', name: 'created_by' },
                        { data: 'responsible', name: 'responsible' },
                        { data: 'eta', name: 'eta' },
                        { data: 'status', name: 'status' },
                        // { data: 'status', searchable: false, orderable: false},
                        { data: 'timer', name: 'timer' },
                        { data: 'action', searchable: false, orderable: false }

                     ],
            });

        // kanban 4
        var kanban4 = new jKanban({
            element : '#kanban4',
            gutter  : '0',
            // click : function(el){
            //     alert(el.innerHTML);
            // },
            boards  :[
                {
                    'id' : 'new',
                    'title'  : 'To do - {{ $todo_tasks->count() }}',
                    'class' : 'brand',
                    'item'  : [
                        @foreach($todo_tasks as $task)
                        {
                            'id' : '{{ $task->id }}',
                            'title':'<span class="kanban-tags"><span style="margin-top: 3px;background: #8E24AA;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->department }}</span>@if($task->responsible)<span style="margin-top: 3px;background: #4caf50;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->responsible }}</span>@endif<span style="margin-top: 3px;background:#2196f3;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->status }}</span></span>{{ $task->name }}',
                            'content': 'This is test content',
                            click: function(el){
                                window.open('{{ route('view_task',$task->id) }}', '_blank');
                            }
                        },
                        @endforeach
                    ]
                },
                {
                    'id' : 'wip',
                    'title'  : 'Work in Progress - {{ $wip_tasks->count() }}',
                    'class' : 'warning',
                    'item'  : [
                        @foreach($wip_tasks as $task)
                        {
                            'id' : '{{ $task->id }}',
                            'title':'<span class="kanban-tags"><span style="margin-top: 3px;background: #8E24AA;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->department }}</span>@if($task->responsible)<span style="margin-top: 3px;background: #4caf50;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->responsible }}</span>@endif<span style="margin-top: 3px;background:#2196f3;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->status }}</span></span>{{ $task->name }}',
                            click: function(el){
                                window.open('{{ route('view_task',$task->id) }}', '_blank');
                            }
                        },
                        @endforeach
                    ]
                },
                {
                    'id' : 'review',
                    'title'  : 'Review - {{ $review_tasks->count() }}',
                    'class' : 'danger',
                    'item'  : [
                        @foreach($review_tasks as $task)
                        {
                            'id' : '{{ $task->id }}',
                            'title':'<span class="kanban-tags"><span style="margin-top: 3px;background: #8E24AA;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->department }}</span>@if($task->responsible)<span style="margin-top: 3px;background: #4caf50;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->responsible }}</span>@endif<span style="margin-top: 3px;background:#2196f3;" class="kanban-status-tag kt-badge kt-badge--primary kt-badge--inline">{{ $task->status }}</span></span>{{ $task->name }}',
                            click: function(el){
                                window.open('{{ route('view_task',$task->id) }}', '_blank');
                            }
                        },
                        @endforeach
                    ]
                },
                {
                    'id' : 'completed',
                    'title'  : 'Completed',
                    'class' : 'success',
                    'item'  : [
                        @foreach($completed_tasks as $task)
                        {
                            'id' : '{{ $task->id }}',
                            'title':'{{ $task->name }}',
                            click: function(el){
                                window.open('{{ route('view_task',$task->id) }}', '_blank');
                            }
                        },
                        @endforeach
                    ]
                }
            ],
            dropEl: function(el, target, source, sibling){
                var status = el.parentNode.parentNode.dataset.id;
                var task_id = el.dataset.eid;
                $.get("{{ route('carbon_status_update') }}", {task_id: task_id, status: status}, function(result){
                if(result){
                    swal.fire({
                        title: 'Updated!',
                        text: "Task Status Updated Successfuly!",
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
              });
            },
        });

               
    
        $('#kt_repeater_2').repeater({
            initEmpty: false,
           
            defaultValues: {
                'text-input': 'foo'
            },
             
            show: function() {
                $(this).slideDown();                               
            },

            hide: function(deleteElement) {                 
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }                                
            },
            // ready: function (setIndexes) {
            //     $dragAndDrop.on('drop', setIndexes);
            // }, 
        });
        $('.creative_block').hide();

        $('#department').change(function(){
            if($(this).val() == 'Creative'){
                $('.creative_block').show();
            }
            else{
                $('.creative_block').hide();
            }
            if($(this).val() == 'Non-Campaign'){
                $('.campaign_task').hide();
            }
            else{
                $('.campaign_task').show();
            }
        });
        $('.select_campaign').select2({
            placeholder: 'Select one campaign',
        });
        $('#select_activity').select2({
            placeholder: 'Select one  activity',
        });
        $(document.body).on("change","#camp_id",function(){
            if($('#camp_id').val() == 'Non-Campaign'){
                $('.campaign_task').hide();
            }
            else{
                $('.campaign_task').show();
            }
        });

        $('#open_new_task').click(function(){
            if($('#department').val() == 'Creative'){
                $('.creative_block').show();
                $('#open_new_task').attr("disabled", "disabled");
            }
            else{
                $('.creative_block').hide();
            }

            if($('#department').val() == 'Non-Campaign'){
                $('.campaign_task').hide();
                $('#camp_id').hide();
            }
            else{
                $('.campaign_task').show();
                $('#camp_id').show();
            }
            // $('#open_new_task').prop('disabled', true);
        });

        $('#projects').change(function(){
            var get_project = $('#projects').val();
            $('#campaign').empty();
            $('#ad_campaign').empty();
            $('#milestone').empty();
            $.get("{{ route('task_get_campaign') }}", {project: get_project}, function(results){
                 $("#campaign").append(results);
            });
        });
        $('#campaign').change(function(){
            var get_campaign = $('#campaign').val();
            $('#ad_campaign').empty();
            $('#milestone').empty();
            $.get("{{ route('task_get_ad_campaign') }}", {campaign: get_campaign}, function(results){
                 $("#ad_campaign").append(results);
            });
        });
        $('#ad_campaign').change(function(){
            var get_ad_campaign = $('#ad_campaign').val();
            $('#milestone').empty();
            $.get("{{ route('task_get_milestone') }}", {campaign: get_ad_campaign}, function(results){
                 $("#milestone").append(results);
            });
        });
});

            // $.ajax({
            //     url: {{ route('task_get_campaign') }},
            //     type:'POST',
            //     data:{project: get_project},
            //     success:function(results)
            //     {
            //         $("#campaign").append(results);
            //     }
            // });
        
        jQuery(function($){
            $('#main_cat').change(function(){
                    var $mainCat=$('#main_cat').val();

                    // call ajax
                    console.log(frontend_ajax_object.ajaxurl);
                     $("#sub_cat").empty();
                     $("#get_this_post").empty();
                      $("#post-content-wrapper").html("");
                        $.ajax({
                            url:frontend_ajax_object.ajaxurl,
                            type:'POST',
                             data:'action=get_sub_category&main_catid=' + $mainCat,
                             success:function(results)
                             {
                                //  alert(results);
                                    $("#sub_cat").removeAttr("style");
                                    $("#sub_cat").append(results);
                             }
                        });
                     }
             );

             $('#sub_cat').change(function(){
                    var $sub_catid=$('#sub_cat').val();

                    // call ajax
                     $("#get_this_post").empty();
                     $("#post-content-wrapper").html("");
                        $.ajax({
                            url:frontend_ajax_object.ajaxurl,
                            type:'POST',
                             data:'action=get_sub_category_posts&sub_catid='+ $sub_catid,
                             success:function(results)
                             {
                               //  alert(results);
                                // $("#sub_cat").removeAttr("style");
                                  $("#get_this_post").append(results);
                             }
                        });
                     }
             );

             $('#get_this_post').change(function(){
                    var $get_this_post=$('#get_this_post').val();

                    // call ajax
                     $("#post-content-wrapper").html("");
                        $.ajax({
                            url:frontend_ajax_object.ajaxurl,
                            type:'POST',
                             data:'action=get_page_data&this_post_id='+ $get_this_post,
                             success:function(results)
                             {
                               //  alert(results);
                                $("#post-content-wrapper").html(results);
                             }
                        });
                     }
             );
});

        // var addBoard = document.getElementById('addBoard');
        // addBoard.addEventListener('click',function(){
        //     var boardTitle = $('#kanban-add-board').val();
        //     var boardId = '_' + $.trim(boardTitle);
        //     var boardColor = $('#kanban-add-board-color').val();
        //     var option = '<option value="'+boardId+'">'+boardTitle+'</option>';
        //     kanban4.addBoards(
        //         [{
        //             'id' : boardId,
        //             'title'  : boardTitle,
        //             'class': boardColor
        //         }]
        //     );              
        //     $('#kanban-select-task').append(option);
        //     $('#kanban-select-board').append(option);
        // });

        // var addTask = document.getElementById('addTask');
        // addTask.addEventListener('click',function(){
        //     var target = $('#kanban-select-task').val();
        //     var title = $('#kanban-add-task').val();
        //     var taskColor = $('#kanban-add-task-color').val();
        //     kanban4.addElement(
        //         target,
        //         {
        //             'title': title,
        //             'class': taskColor
        //         }
        //     );
        // });

        // var removeBoard2 = document.getElementById('removeBoard2');
        // removeBoard2.addEventListener('click',function(){
        //     var target = $('#kanban-select-board').val();
        //     kanban4.removeBoard(target);
        //     $('#kanban-select-task option[value="'+target+'"]').remove();
        //     $('#kanban-select-board option[value="'+target+'"]').remove();
        // });



      @if(!empty($user->timer))
$(document).ready(function () {
        var taskStartedTime = new Date('{{ $get_timer->start }}');
        $('.display_task_timer').countdown({
            since: taskStartedTime,
            layout: '<span class="order_countdown">{hnn}{sep}{mnn}{sep}{snn}</span>',
            format: 'HMS'
        });
    });
@endif
</script>

@endsection

    