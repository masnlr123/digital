<div class="modal fade" id="edit_this_camp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit This Project Campaign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 10px 30px;">
                    <form class="kt-form" method="post" action="{{ route('campaign_update', $campaigns->id) }}">
                        @csrf {{ method_field('PUT') }}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Status</label>
                                <select style="width: 100%;" class="form-control kt-select2" id="select_status" required="" name="status">
                                    <option value=""> --- </option>
                                    <option @if($campaigns->status == 'live') selected @endif value="live">Live</option>
                                    <option @if($campaigns->status == 'pause') selected @endif value="pause">Pause</option>
                                    <option @if($campaigns->status == 'not_started') selected @endif value="not_started">Not Started</option>
                                </select>
                            </div>
                        </div>

                        @php $setting = new App\Setting; $users = new App\User; @endphp

                        @php 
                            foreach(config('dtms.source') as $source){
                                $get_medium[] = $source['medium'];
                            }
                            $get_medium = array_unique($get_medium);
                        @endphp
                        <div class="form-group">
                            <label>Assign more users</label>
                        </div>
                        <div id="kt_repeater_4">
                            <div class="form-group row mt-4">
                                <div data-repeater-list="asaignee_list" class="col-lg-12">
                                    @if(null !== $campaigns->channels) @foreach(json_decode($campaigns->channels) as $channel => $camp)
                                    <div data-repeater-item class="row kt-margin-b-10">
                                        <div class="col-lg-4">
                                            <select style="width: 100%;" class="form-control kt-select2 choose_medium" id="category" name="camp_channel">
                                                <option value=""> --- Channel/Medium ---</option>
                                                <option value="Search Ads" >Search Ads</option>

                                        @foreach($get_medium as $medium)
                                        <option value="{{ $medium }}" {{ $camp->medium == $medium? 'selected': '' }}>{{ $medium }}</option>
                                        @endforeach

                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select style="width: 100%;" class="form-control kt-select2 choose_source" id="subcategory" required="" name="camp_source">
                                                <option value=""> --- Choose Source ---</option>
                                                @foreach(config('dtms.source') as $source)
                                                @if(!is_object($camp->source))
                                                <option value="{{ $source['source'] }}" {{ $camp->source == $medium? 'selected': '' }}>{{ $source['source'] }}</option>
                                                @else
                                                <option value="{{ $source['source'] }}" {{ $camp->source->source == $medium? 'selected': '' }}>{{ $source['source'] }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        
                                        </div>
                                        <div class="col-lg-3">
                                            <select style="width: 100%;" class="form-control kt-select2" id="choose_channel_person" name="camp_user">
                                                <option value=""> --- Choose Asignee ---</option>
                                                @foreach($users->whereIn('role_id', ['1', '2', '4', '5', '6', '7'])->get() as $camp_user)
                                                <option value="{{ $camp_user->id }}" {{ $camp->user == $camp_user->id? 'selected': '' }}>{{ $camp_user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                                <i class="la la-remove"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach @else

                                    <div data-repeater-item class="row kt-margin-b-10 repeat_block">
                                        <div class="col-lg-4">
                                            <select style="width: 100%;" class="form-control kt-select2 choose_medium" id="category" required="" name="camp_channel">
                                                <option value=""> --- Channel/Medium ---</option>
                                        @foreach($get_medium as $medium)
                                        <option value="{{ $medium }}">{{ $medium }}</option>
                                        @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <select style="width: 100%;" class="form-control kt-select2 choose_source" id="subcategory" required="" name="camp_source">
                                                <option value=""> --- Choose Source ---</option>
                                                @foreach(config('dtms.source') as $source)
                                                <option value="{{ $source['source'] }}">{{ $source['source'] }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select style="width: 100%;" class="form-control kt-select2" required="" name="camp_user">
                                                <option value=""> --- Choose Asignee ---</option>
                                                @foreach($users->whereIn('role_id', ['1', '2', '4', '5', '6', '7'])->get() as $camp_user)
                                                <option value="{{ $camp_user->id }}">{{ $camp_user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon">
                                                <i class="la la-remove"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div data-repeater-create="" class="btn btn btn-primary">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>Add</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea placeholder="Enter your Description" class="form-control tiny_editor_popup" name="description" id="description">{{ $campaigns->description }}</textarea>
                            </div>
                        </div>
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-size: 16px;">
                                Other Details (Optional)
                            </h3>
                            <hr style="border-top: 2px dashed #c1c1c1 !important; padding-top: 10px;" />
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Target Audience</label>
                                <input type="text" placeholder="" maxlength="255" class="form-control" name="target_audience" id="target_audience" value="{{ $campaigns->target_audience }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Budget Cost</label>
                                <input type="number" placeholder="" maxlength="255" class="form-control" name="budget_cost" id="budget_cost" value="{{ $campaigns->budget_cost }}" />
                            </div>
                            <div class="col-md-6">
                                <label>Expected Leads Count</label>
                                <input type="number" placeholder="" maxlength="255" class="form-control" name="expected_leads_count" id="expected_leads_count" value="{{ $campaigns->expected_leads_count }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Valid Leads %</label>
                                <input type="number" placeholder="" maxlength="255" class="form-control" name="valid_leads" id="valid_leads" value="{{ $campaigns->valid_leads }}" />
                            </div>
                            <div class="col-md-6">
                                <label>Expected Site Visit Count</label>
                                <input type="number" placeholder="" maxlength="255" class="form-control" name="expected_site_visit_count" id="expected_site_visit_count" value="{{ $campaigns->expected_site_visit_count }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Expected Sales</label>
                                <input type="number" placeholder="" maxlength="255" class="form-control" name="sales_count" id="sales_count" value="{{ $campaigns->sales_count }}" />
                            </div>
                            <div class="col-md-6">
                                <label>Expected SOR</label>
                                <input type="number" placeholder="" maxlength="255" class="form-control" name="expected_sor" id="expected_sor" value="{{ $campaigns->expected_sor }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Expected Close Date</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="expected_close_date" readonly placeholder="Select date & time" id="kt_datepicker_2" value="{{ $campaigns->expected_close_date }}" />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                                <a href="{{ url('/') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>