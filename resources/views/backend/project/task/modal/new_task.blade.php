
<div class="modal fade" id="NewTask">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form ng-app="" method="post" enctype="multipart/form-data" action="{{ route('store_new_task') }}">
                <input type="hidden" name="from" value="task">
                @csrf
<div class="kt-portlet">
    <div class="modal-header">
        <h5 class="modal-title">New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
    </div> 
    <div class="modal-body" style="padding-top: 0 !important;">
        <div class="form-group row">
            <div class="col-md-6 create_task_col">
                <label>Task Name</label>
                <input type="text" placeholder="Max 72 Letters" maxlength="72" class="form-control" name="name" id="about_camp" value="">
            </div>
            <div class="col-md-3 create_task_col">
                <label>Department</label>
                <select class="form-control" name="department" id="department" ng-model="department">
                    <option value="">Choose one Department</option>
<!--                     <option value="Paid">Paid</option>
                    <option value="Organic">Organic</option> -->
                    @php
                    $get_settings = App\Setting::where('name', 'task_department')->get();
                    @endphp
                    @foreach($get_settings as $setting)
                    @php $get_department_name = json_decode($setting->value); @endphp
                    <option value="{{ $get_department_name->name }}" {{ $current_department == $get_department_name->url? 'selected': ''}}>{{ $get_department_name->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 create_task_col">
                <label>ETA</label>
                <input type="datetime-local" name="eta" class="form-control">
            </div>
            <div class="col-md-6 create_task_col">
                <label>Activity</label>
                <!-- <input type="text" name="activity" class="form-control"> -->
                <select style="width: 100%" class="form-control" id="select_activity2" name="activity">
                    <option value="">** Select a Option</option>
                    @foreach($settings->where('cat', 'Activity') as $setting)
                    <option ng-show="department =='{{ $setting->name }}'" value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 create_task_col">
                <label>To Assign</label>
                <select class="form-control" name="responsible">
                    <option value=""></option>
                    @foreach(App\User::whereIn('role_id', ['1', '2', '3', '4', '5', '6', '7', '8', '11', '16'])->get() as $assignee)
                        <option value="{{ $assignee->name }}">{{ $assignee->name }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-md-2 create_task_col">
                <label>Priorities</label>
                <select class="form-control" name="priority">
                    <option value=""></option>
                    <option value="high">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>
            <div class="col-md-2 create_task_col creative_block">
                <label>Task For*</label>
                <select style="width: 100%" class="form-control" name="team">
                    <option value="">** Select a Option</option>
                    <option value="inhouse">InHouse</option>
                    <option value="agency">Agency</option>
                </select>
            </div>
            <div class="col-md-12 create_task_col creative_block">
                <label>Creative Theme</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_task_cat" name="tag[]" multiple="multiple">
                    <option value="">** Select a Option</option>
                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_category') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-md-12 create_task_col creative_block">
                <label>Creatives</label>
                <select style="width: 100%" class="form-control kt-select2" id="select_creative_type" name="creative_type[]" multiple="multiple">
                    <option value="">** Select a Creative Type</option>

                    @foreach($settings->where('cat', 'Creative Task')->where('name', 'creative_type') as $setting)
                    <option value="{{ $setting->value }}">{{ $setting->value }}</option>
                    @endforeach
                    
                </select>
            </div>
            <div class="col-md-12 create_task_col">
                <label>Task Brief</label>
                <textarea rows="5" placeholder="Enter your Description" class="form-control tiny_editor_popup" name="brief" id="kt-ckeditor-5"></textarea>
            </div>
            <div class="col-md-12 create_task_col creative_block">
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