
<div class="modal fade" id="NewAdCamp">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form method="post" action="{{ route('store_ad_campaign') }}">
                @csrf
                <input type="hidden" name="project" value="{{ $campaigns->project }}">
                <input type="hidden" name="campaign_id" value="{{ $campaigns->id }}">
                <input type="hidden" name="campaign" value="{{ $campaigns->name }}">
<div class="kt-portlet">
    <div class="modal-header">
        <h5 class="modal-title">New Ad Campaign | Project: <span class="text-warning">{{ $campaigns->project }}</span> | Media Plan: <span class="text-primary">{{ $campaigns->name }}</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
    </div> 
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-2 col-form-label">Campaign Name</label>
            <div class="col-10">
                <input type="text" placeholder="Max 40 Letters" maxlength="40" class="form-control" name="name" id="about_camp" value="">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label">Medium</label>
            <div class="col-4">
                <select class="form-control" name="channel" id="new_ad_camp_channel">
                    <option value=""></option>
                    @foreach(collect(json_decode($campaigns->channels))->unique('medium') as $camp)
                    <option value="{{ $camp->medium }}">{{ $camp->medium }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-2 col-form-label">Source</label>
            <div class="col-4">
                <select class="form-control" name="source" id="new_ad_camp_source">
                    <option value=""></option>
                    @foreach(json_decode($campaigns->channels) as $camp)
                    @if(!is_object($camp->source))
                    <option value="{{ $camp->source }}">{{ $camp->source }}</option>
                    @else
                    <option value="{{ $camp->source->source }}">{{ $camp->source->source }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label">To Assign</label>
            <div class="col-4">
                <select class="form-control" name="assigned_to" id="new_ad_camp_assign">
                    <option value="">Choose one user</option>
                    @php $all_channels = json_decode($campaigns->channels);
                    //$all_channels = array_unique($all_channels);@endphp
                    @foreach(collect($all_channels)->unique('user') as $channel => $camp)
                    @php $get_user = App\User::find($camp->user); $get_user = json_decode($get_user); @endphp
                    <option value="{{ $get_user->name }}">{{ $get_user->name }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-2 col-form-label">Type</label>
            <div class="col-4">
                <select class="form-control" name="type">
                    <option value=""></option>
                    <option value="Paid">Paid</option>
                    <option value="Organic">Organic</option>
                    <option value="Branding">Branding</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label">Description</label>
            <div class="col-10">
                <textarea rows="5" placeholder="Enter your Description" class="form-control tiny_editor_popup" name="description" id="kt-ckeditor-5"></textarea>
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