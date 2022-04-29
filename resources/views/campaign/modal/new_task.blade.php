
<div class="modal fade" id="NewTask">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="{{ route('store_new_task') }}">
                @csrf
                <input type="hidden" name="from" value="camp">
                <input type="hidden" name="project_id" value="{{ $campaigns->project }}">
                <input type="hidden" name="camp_id" value="{{ $campaigns->id }}">
                <input type="hidden" name="ad_camp_id" value="{{ $ad_camp->id }}">
                <!-- <input type="hidden" name="section_id" value="{{ $ad_camp->id }}"> -->
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
            <div class="col-md-6 create_task_col">
                <label>Activity</label>
                <input type="text" name="activity" class="form-control">
            </div>
            <div class="col-md-3 mt-3">
                <label>To Assign</label>
                <select class="form-control kt-select2" id="assignee_list" name="responsible">
                    <option value=""></option>
                    @foreach(App\User::whereIn('role_id', ['1', '2', '3', '4', '5', '6', '7', '8'])->get() as $assignee)
                        <option value="{{ $assignee->name }}">{{ $assignee->name }}</option>
                        @endforeach

                </select>
            </div>
            <div class="col-md-3 mt-3">
                <label>Select Milestone</label>
                <select class="form-control" name="section_id">
                    <option value=""></option>
                    @foreach($milestones as $milestone)
                        <option value="{{ $milestone->id }}">{{ $milestone->activity }}</option>
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
            <div class="col-md-6 mt-3 creative_block">
                <label>Creative Theme</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_task_theme" name="tag[]" multiple="multiple">
                    <option value="">** Select a Option</option>
                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_category') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mt-3 creative_block">
                <label>Creatives</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_task_creatives" name="creative_type[]" multiple="multiple">
                    <option value="">** Select a Creative Type</option>

                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <label>Task Brief</label>
                <textarea rows="5" placeholder="Enter your Description" class="form-control tiny_editor_popup" name="brief" id="kt-ckeditor-5"></textarea>
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
@section('footer_js')
<script type="text/javascript">
    $(document).ready(function(){
        // $('.creative_block').hide();
        // $('#department').change(function(){
        //     if($(this).val() == 'Creative'){
        //         $('.creative_block').show();
        //     }
        //     else{
        //         $('.creative_block').hide();
        //     }
        // });

    });
</script>
@endsection