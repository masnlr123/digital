<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">      
function quick_update(currentEle, name, type){
    $(currentEle).dblclick(function (e) {
        e.stopPropagation();
        var currentEle = $(this);
        var value = $(this).html();
        updateVal(currentEle, name, value, type);
    });
};
function updateVal(currentEle, name, value, type){
    if(type == 'text'){
        $(currentEle).html('<input class="form-control thVal" type="text" name="' + name + '" value="' + value + '" />');
    }
    else if(type == 'textarea'){
        $(currentEle).html('<textarea style="width:100%;" class="form-control thVal" name="' + name + '">' + value + '</textarea>');
    }
    $(".thVal").focus();
    // $(".thVal").trigger('focus');
    $(".thVal").keypress(function(event){
        if(event.keyCode == 13){
            var task_id = '{{ $task->id }}';
            var field_name = name;
            var field_value = $(".thVal").val();
            $.get("{{ route('task_quick_update') }}", {id: task_id, name: field_name, value: field_value});
            $(currentEle).html($(".thVal").val().trim());
        }
    });
    // $(document).click(function(){
    //     $(currentEle).html($(".thVal").val().trim());
    // });
}
jQuery(document).ready(function() {
        $('#kt_repeater_2').repeater({
            initEmpty: true,
           
            defaultValues: {
                'sub_task_id': ''
            },
            show: function() {
              //   $.post( "hidettps://www.galleriaresidences.in/cdn/js/leads.php", {track_id: page.track_id, user_name: current_user_name, project: page.project }, function (data) {
              //    console.log("Result:" + JSON.stringify(data));
              // });
                var task_id = '';
                var task_id = '10' + task_id;
                $(this).children('input[name*="sub_task_id"]').val(task_id);
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
        quick_update('.task_discription', 'brief', 'textarea');
        quick_update('.task_title', 'name', 'text');
});
</script>
@if(!empty($task->brief))
<h5 class="sub_title">Description</h5>
    <div class="task_discription mb-4">{!! $task->brief !!}</div>
@endif
        <h5 class="sub_title">Sub Task</h5>
        <div class="sub_task">
            <div id="kt_repeater_2">
                <div class="form-group  row" style="    margin-bottom: -2px;">
                    <div data-repeater-list="sub_task" class="col-12">
                        <div data-repeater-item class="kt-margin-b-10">
                            <input type="hidden" name="sub_task_id">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--success">
                                            <input type="checkbox" name="sub_task_completed">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-danger" placeholder="Enter telephone">
                                <div class="input-group-append">
                                    <select class="btn input-group-text" name="status" data-toggle="kt-popover" data-placement="top" data-title="Task Status" data-content="Click to view Task Status" style="height: auto;min-height: auto;padding: 7px 9px;">
                                        <option value="">Status</option>
                                        <option value="new">New</option>
                                        <option value="wip">WIP</option>
                                        <option value="review">Under Review</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <a href="javascript:;" class="btn input-group-text btn-icon">
                                        <i class="la la-plus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn input-group-text btn-icon">
                                        <i class="la la-user-plus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn input-group-text btn-icon">
                                        <i class="la la-clone"></i>
                                    </a>
                                    <a href="javascript:;" data-repeater-delete class="btn input-group-text btn-icon">
                                        <i class="la la-close"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col text-right">
                        <div data-repeater-create="" class="btn btn-sm btn-success" style="background: #44e402;border: none;cursor: pointer;">
                            <span>
                                <i class="la la-plus"></i>
                                <span>Add Sub Task</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5 class="sub_title">Comments</h5>
        <div class="comments"></div>
        <h5 class="sub_title">Activity</h5>
        <div class="activity_list">
            @foreach($activity as $act)
                        <div class="kt-timeline-v2__item"><span class="kt-timeline-v2__item-time">{{ $act->created_at->format('H:i') }}</span><div class="kt-timeline-v2__item-cricle"><i class="fa fa-genderless kt-font-danger"></i></div><div class="kt-timeline-v2__item-text  kt-padding-top-5">{!! $act->description !!}<br>at <span class="kt-font-info">{{ $act->created_at->format('H:i:s d:m:Y') }}</span>, By <span class="kt-font-success">{{ $act->created_by }}</span></div></div>
                        @endforeach
        </div>