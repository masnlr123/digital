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
    else if(type == 'datetime'){
        $(currentEle).html('<input type="datetime-local" style="width:100%;" class="form-control thVal" name="' + name + '" value="' + value + '" />');
    }
    else if(type == 'time'){
        $(currentEle).html('<input type="time" style="width:100%;" class="form-control thVal" name="' + name + '" value="' + value + '" />');
    }
    else if(type == 'select_user'){
        var sub_task_user = '<select name="assignee" class="form-control thVal" style="width:140px;background: #fff;" id="assignee_'+ value.id +'">';
        sub_task_user += '<option value="">No Assignee</option>';
        
        @foreach(App\User::whereIn('role_id', ['1', '2', '3', '4', '5', '6', '7', '8'])->get() as $assignee)
                        var current_user = {{ $assignee->id }};
                        var task_user = value.assignee;
                        var user_selected = '';
                        if(current_user == task_user){
                            user_selected = 'selected';
                        }
                        sub_task_user += '<option value="{{ $assignee->id }}" '+user_selected+'>{{ $assignee->name }}</option>';
                        @endforeach

        sub_task_user += '</select>';
        $(currentEle).html(sub_task_user);
    }
    else if(type == 'status'){
        var sub_task_status = '<select name="assignee" class="form-control thVal" style="width:140px;background: #fff;" id="assignee_'+ value.id +'">';
        sub_task_status += '<option value="">Choose status</option>';
        sub_task_status += '<option value="WIP">WIP</option>';
        sub_task_status += '<option value="review">Review</option>';
        sub_task_status += '<option value="completed">Completed</option>';
        sub_task_status += '</select>';
        $(currentEle).html(sub_task_status);
    }
    $(".thVal").focus();
    // $(".thVal").trigger('focus');
    $(".thVal").keypress(function(event){
        if(event.keyCode == 13){
            var task_id = '{{ $sub_task->id }}';
            var field_name = name;
            var field_value = $(".thVal").val();
            $.get("{{ route('sub_task_quick_update') }}", {id: task_id, name: field_name, value: field_value});
            $(currentEle).html($(".thVal").val().trim());
        }
    });
    $(".thVal").bind("change paste", function(){
        var task_id = '{{ $sub_task->id }}';
        var field_name = name;
        var field_value = $(".thVal").val();
        $.get("{{ route('sub_task_quick_update') }}", {id: task_id, name: field_name, value: field_value});
        $(currentEle).html($(".thVal").val().trim());
    });
    // $(document).click(function(){
    //     $(currentEle).html($(".thVal").val().trim());
    // });
}
jQuery(document).ready(function() {
        quick_update('.task_discription', 'brief', 'textarea');
        quick_update('.task_deliverable', 'deliverable', 'textarea');
        quick_update('.task_title', 'name', 'text');
        quick_update('.task_assignee', 'assignee', 'select_user');
        quick_update('.task_due_date', 'due_date', 'datetime');
        quick_update('.task_activity', 'activity', 'text');
        quick_update('.task_duration', 'duration', 'text');
        quick_update('.task_status', 'status', 'status');
});
</script>
<div class="row">
@if(!empty($sub_task->due_date))
    <div class="col-6">
        <div class="kt-portlet kt-iconbox" style="box-shadow: 0px 0px 2px #ccc;padding: 10px;margin-bottom: 15px;">
            <div class="kt-portlet__body" style="padding: 0px !important;">
                <div class="kt-iconbox__body" style="padding: 2px;">
                    <div class="kt-iconbox__icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 280.027 280.027" style="enable-background:new 0 0 280.027 280.027;" xml:space="preserve">
<g>
    <path style="fill:#3E4E5C;" d="M140.014,69.884c57.834,0,105.01,48.313,105.01,105.78c0,57.476-47.176,104.363-105.01,104.363
        c-57.843,0-105.01-47.447-105.01-104.923C35.002,117.62,82.17,69.884,140.014,69.884z"/>
    <path style="fill:#EBEBEB;" d="M140.014,94.693c44.192,0,80.21,36.902,80.21,80.805c0,43.912-36.019,79.703-80.21,79.703
        c-44.183,0-80.21-36.246-80.21-80.14C59.802,131.158,95.83,94.693,140.014,94.693z"/>
    <path style="fill:#324D5B;" d="M105.053,34.96c0-19.296,15.673-34.96,34.986-34.96c19.322,0,34.986,15.664,34.986,34.968
        c0,16.312-11.227,29.893-26.349,33.752v10.037h-17.283V68.712C116.289,64.853,105.053,51.271,105.053,34.96z M131.411,59.795
        V43.649h17.274v16.145c10.317-3.57,17.764-13.231,17.764-24.712c0-14.5-11.831-26.253-26.419-26.253
        c-14.579,0-26.401,11.761-26.401,26.253C113.638,46.555,121.093,56.215,131.411,59.795z"/>
    <path style="fill:#E2574C;" d="M233.035,73.306l8.418,8.375c4.638,4.62,4.638,12.129,0,16.749l-2.8,2.8
        c-4.638,4.62-12.181,4.62-16.819,0l-8.41-8.383c-4.647-4.629-4.647-12.12,0-16.749l2.792-2.792
        C220.854,68.685,228.389,68.685,233.035,73.306z"/>
    <path style="fill:#51BBA8;" d="M46.886,73.306l-8.34,8.375c-4.603,4.62-4.603,12.129,0,16.749l2.774,2.8
        c4.603,4.62,12.076,4.62,16.679,0l8.331-8.383c4.603-4.629,4.603-12.12,0-16.749l-2.765-2.792
        C58.953,68.685,51.498,68.685,46.886,73.306z"/>
    <path style="fill:#E2574C;" d="M183.768,166.266h-35.003v-43.754c0-4.83-3.912-8.751-8.751-8.751s-8.751,3.92-8.751,8.751v52.505
        c0,4.839,3.912,8.751,8.751,8.751h43.754c4.839,0,8.751-3.912,8.751-8.751S188.606,166.266,183.768,166.266z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg> </div>
                        <div class="kt-iconbox__desc">
                            <h3 class="kt-iconbox__title">
                                <a class="kt-link" href="#">Due Date</a>
                            </h3>
                            <div class="kt-iconbox__content">
                                <div class="task_due_date">{{ $sub_task->due_date }}</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-6">
        <div class="kt-portlet kt-iconbox bg-warning" style="box-shadow: 0px 0px 2px #ccc;padding: 10px;margin-bottom: 15px;">
            <div class="kt-portlet__body"  style="padding: 0px !important;">
                <div class="kt-iconbox__body" style="padding: 2px;">
                    <div class="kt-iconbox__icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 280.027 280.027" style="enable-background:new 0 0 280.027 280.027;" xml:space="preserve">
<g>
    <path style="fill:#3E4E5C;" d="M140.014,69.884c57.834,0,105.01,48.313,105.01,105.78c0,57.476-47.176,104.363-105.01,104.363
        c-57.843,0-105.01-47.447-105.01-104.923C35.002,117.62,82.17,69.884,140.014,69.884z"/>
    <path style="fill:#EBEBEB;" d="M140.014,94.693c44.192,0,80.21,36.902,80.21,80.805c0,43.912-36.019,79.703-80.21,79.703
        c-44.183,0-80.21-36.246-80.21-80.14C59.802,131.158,95.83,94.693,140.014,94.693z"/>
    <path style="fill:#324D5B;" d="M105.053,34.96c0-19.296,15.673-34.96,34.986-34.96c19.322,0,34.986,15.664,34.986,34.968
        c0,16.312-11.227,29.893-26.349,33.752v10.037h-17.283V68.712C116.289,64.853,105.053,51.271,105.053,34.96z M131.411,59.795
        V43.649h17.274v16.145c10.317-3.57,17.764-13.231,17.764-24.712c0-14.5-11.831-26.253-26.419-26.253
        c-14.579,0-26.401,11.761-26.401,26.253C113.638,46.555,121.093,56.215,131.411,59.795z"/>
    <path style="fill:#E2574C;" d="M233.035,73.306l8.418,8.375c4.638,4.62,4.638,12.129,0,16.749l-2.8,2.8
        c-4.638,4.62-12.181,4.62-16.819,0l-8.41-8.383c-4.647-4.629-4.647-12.12,0-16.749l2.792-2.792
        C220.854,68.685,228.389,68.685,233.035,73.306z"/>
    <path style="fill:#51BBA8;" d="M46.886,73.306l-8.34,8.375c-4.603,4.62-4.603,12.129,0,16.749l2.774,2.8
        c4.603,4.62,12.076,4.62,16.679,0l8.331-8.383c4.603-4.629,4.603-12.12,0-16.749l-2.765-2.792
        C58.953,68.685,51.498,68.685,46.886,73.306z"/>
    <path style="fill:#E2574C;" d="M183.768,166.266h-35.003v-43.754c0-4.83-3.912-8.751-8.751-8.751s-8.751,3.92-8.751,8.751v52.505
        c0,4.839,3.912,8.751,8.751,8.751h43.754c4.839,0,8.751-3.912,8.751-8.751S188.606,166.266,183.768,166.266z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg> </div>
                        <div class="kt-iconbox__desc">
                            <h3 class="kt-iconbox__title">
                                <a class="kt-link" href="#">Due Date</a>
                            </h3>
                            <div class="kt-iconbox__content">
                                <div class="task_due_date">No Due Date</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty($sub_task->due_date))
    <div class="col-6">
        <div class="kt-portlet kt-iconbox" style="box-shadow: 0px 0px 2px #ccc;padding: 10px;margin-bottom: 15px;">
            <div class="kt-portlet__body"  style="padding: 0px !important;">
                <div class="kt-iconbox__body" style="padding: 2px;">
                    <div class="kt-iconbox__icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#3366CC;}
</style>
<g>
    <path class="st0" d="M24.98,49.01c-7.89,0-15.77,0-23.66,0c-0.34,0-0.34,0-0.34-0.33c0-0.65,0.01-1.31,0-1.96
        c-0.01-1.22,0.27-2.38,0.78-3.48c0.88-1.89,2.16-3.47,3.69-4.86c3.07-2.79,6.69-4.54,10.68-5.57c1.33-0.34,2.69-0.59,4.04-0.8
        c1.38-0.21,2.78-0.3,4.18-0.3c1.07,0.01,2.14-0.01,3.2,0.07c4.32,0.3,8.47,1.29,12.32,3.33c2.33,1.24,4.43,2.79,6.17,4.79
        c1.23,1.41,2.22,2.96,2.73,4.79c0.17,0.61,0.24,1.23,0.25,1.87c0.01,0.73,0,1.45,0.01,2.18c0,0.21-0.06,0.28-0.27,0.28
        c-3.1-0.01-6.2,0-9.3,0C34.63,49.01,29.8,49.01,24.98,49.01z"/>
    <path class="st0" d="M11.66,14.31C11.72,6.89,17.59,0.98,25,0.98c7.44,0,13.33,5.95,13.32,13.33c-0.01,7.38-5.88,13.31-13.31,13.31
        C17.65,27.64,11.73,21.76,11.66,14.31z"/>
</g>
</svg>
 </div>
                        <div class="kt-iconbox__desc">
                            <h3 class="kt-iconbox__title">
                                <a class="kt-link" href="#">Assignee</a>
                            </h3>
                            <div class="kt-iconbox__content">
                                <div class="task_assignee">{{ $sub_task->user->name }}</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-6">
        <div class="kt-portlet kt-iconbox bg-warning" style="box-shadow: 0px 0px 2px #ccc;padding: 10px;margin-bottom: 15px;">
            <div class="kt-portlet__body"  style="padding: 0px !important;">
                <div class="kt-iconbox__body" style="padding: 2px;">
                    <div class="kt-iconbox__icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#3366CC;}
</style>
<g>
    <path class="st0" d="M24.98,49.01c-7.89,0-15.77,0-23.66,0c-0.34,0-0.34,0-0.34-0.33c0-0.65,0.01-1.31,0-1.96
        c-0.01-1.22,0.27-2.38,0.78-3.48c0.88-1.89,2.16-3.47,3.69-4.86c3.07-2.79,6.69-4.54,10.68-5.57c1.33-0.34,2.69-0.59,4.04-0.8
        c1.38-0.21,2.78-0.3,4.18-0.3c1.07,0.01,2.14-0.01,3.2,0.07c4.32,0.3,8.47,1.29,12.32,3.33c2.33,1.24,4.43,2.79,6.17,4.79
        c1.23,1.41,2.22,2.96,2.73,4.79c0.17,0.61,0.24,1.23,0.25,1.87c0.01,0.73,0,1.45,0.01,2.18c0,0.21-0.06,0.28-0.27,0.28
        c-3.1-0.01-6.2,0-9.3,0C34.63,49.01,29.8,49.01,24.98,49.01z"/>
    <path class="st0" d="M11.66,14.31C11.72,6.89,17.59,0.98,25,0.98c7.44,0,13.33,5.95,13.32,13.33c-0.01,7.38-5.88,13.31-13.31,13.31
        C17.65,27.64,11.73,21.76,11.66,14.31z"/>
</g>
</svg> </div>
                        <div class="kt-iconbox__desc">
                            <h3 class="kt-iconbox__title">
                                <a class="kt-link" href="#">Assignee</a>
                            </h3>
                            <div class="kt-iconbox__content">
                                <div class="task_assignee">No Assignee</div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endif


</div>

<table class="table table-stripped table-bordered">
    <tr>
        <td><strong>Activity</strong></td>
        <td class="task_activity task_content">{!! $sub_task->activity !!}</td>
        <td><strong>Department</strong></td>
        <td class="task_department task_content">{!! $sub_task->department !!}</td>
    </tr>
    <tr>
        <td><strong>Status</strong></td>
        <td class="task_status task_content">{!! $sub_task->status !!}</td>
        <td><strong>Duration</strong></td>
        <td class="task_duration task_content">{!! $sub_task->duration !!}</td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td class="task_discription task_content" colspan="3">{!! $sub_task->brief !!}</td>
    </tr>
    <tr>
        <td><strong>Deliverable</strong></td>
        <td class="task_deliverable task_content" colspan="3">{!! $sub_task->deliverable !!}</td>
    </tr>
</table>
    

