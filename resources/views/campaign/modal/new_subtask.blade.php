
<div class="modal fade" id="NewSubTask">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <form method="post" action="#">
            <!-- <form method="post" action="{{ route('store_ad_campaign') }}"> -->
                @csrf
                <input type="hidden" name="project" value="{{ $campaigns->project }}">
                <input type="hidden" name="campaign_id" value="{{ $campaigns->id }}">
                <input type="hidden" name="campaign" value="{{ $campaigns->name }}">
<div class="kt-portlet">
    <div class="modal-header">
        <h5 class="modal-title">New Sub Task | Project: {{ $campaigns->project }} | Campaign: {{ $campaigns->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
    </div> 
    <div class="modal-body">
        <div class="form-group row">
            <div class="col-md-12">
                <label>Campaign Name</label>
                <input type="text" placeholder="Max 40 Letters" maxlength="40" class="form-control" name="name" id="about_camp" value="">
            </div>
            <div class="col-md-6 mt-3">
                <label>Channel</label>
                <select class="form-control" name="channel">
                    <option value=""></option>
                    @foreach(json_decode($campaigns->channels) as $channel => $camp)
                    <option value="{{ $camp->medium }}">{{ $camp->medium }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>Source</label>
                <select class="form-control" name="source">
                    <option value=""></option>
                    @foreach(json_decode($campaigns->channels) as $channel => $camp)
                    @if(!is_object($camp->source))
                    <option value="{{ $camp->source }}">{{ $camp->source }}</option>
                    @else
                    <option value="{{ $camp->source->source }}">{{ $camp->source->source }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>To Assign</label>
                <select class="form-control" name="assigned_to">
                    <option value=""></option>
                    @foreach(json_decode($campaigns->channels) as $channel => $camp)
                    @php $get_user = App\User::find($camp->user); $get_user = json_decode($get_user); @endphp
                    <option value="{{ $get_user->name }}">{{ $get_user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>Ad Campaign Type</label>
                <select class="form-control" name="type">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-md-12 mt-3">
                <label>Description</label>
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