<div class="modal fade" id="NewMilestone" tabindex="1">
    <div class="modal-dialog">
        <div class="modal-content">
<div class="kt-portlet">
        <form class="kt-form" method="post" action="{{ route('milestone_store') }}">
            @csrf
            <input type="hidden" name="project" value="{{ $ad_camp->project }}">
            <input type="hidden" name="campaign" value="{{ $ad_camp->campaign }}">
            <input type="hidden" name="campaign_id" value="{{ $ad_camp->campaign_id }}">
            <input type="hidden" name="ad_campaign_id" value="{{ $ad_camp->id }}">
            <input type="hidden" name="channel" value="{{ $ad_camp->channel }}">
            <input type="hidden" name="medium" value="{{ $ad_camp->medium }}">
            <input type="hidden" name="source" value="{{ $ad_camp->source }}">
    <div class="modal-header">
        <h5 class="modal-title">New Milestone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
    </div> 
    <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="input-group">
                        <select class="form-control" name="activity" required>
                            <option value="">Select Pre-defined Milestone</option>
                            @php $all_activity = App\Setting::where('name', 'milestone')->get(); @endphp
                            @foreach($all_activity as $activity)
                            <option value="{{ $activity->value }}">{{ $activity->value }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#new_milestone_activity"><i class="la la-plus" style="font-weight: bold; color: #fff;"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <select class="form-control" name="assigned_to">
                        <option value="">Assignee...</option>
                        @foreach(App\User::whereIn('role_id', ['1', '2', '3', '4', '5', '6', '7', '8'])->get() as $assignee)
                        <option value="{{ $assignee->name }}">{{ $assignee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>                 
    </div>
    <div class="modal-foot">
        <div class="col-md-12 mt-3">
            <div class="kt-form__actions text-right">
                <input type="submit" class="btn btn-primary" value="Create Milestone">
            </div>
        </div>
    </div>
        </form>   
</div>
        </div>
    </div>
</div>


<!-- setting_store -->
<div class="modal fade" id="new_milestone_activity" tabindex="12" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <form class="kt-form" method="post" enctype="multipart/form-data" action="{{ route('setting_store') }}">
                @csrf
                <input type="hidden" name="setting_cat" value="Activity">
                <input type="hidden" name="setting_name" value="milestone">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Milestone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 10px 30px;">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Milestone Name</label>
                            <input type="text" placeholder="" required="" maxlength="255" class="form-control" name="setting_value" id="url" value="" />
                            <p class="mt-4">Don't Create Duplicate Milestones - Please check the pre-defined milestone before creatiing a new one</p>
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