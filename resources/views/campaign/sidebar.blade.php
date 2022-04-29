<div class="kt-portlet__head">
    <!-- <div class="project_logo">
        <img src="{{ asset('assets/images/Allaince Log_512x512.png') }}">
    </div> -->
    <div class="kt-portlet__head-toolbar">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $active_data[1] }}" data-toggle="tab" href="#metrix" role="tab"> <i class="fa fa-eye" aria-hidden="true"></i>Overal Metrics</a>
            </li>
            
                <li class="nav-item dropdown {{ $active_data[2] }}">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                            <i class="la la-cog"></i>
                            Ad Campaign
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                @php $camp_inc = ''; $ad_camp = App\AdCampaigns::where('campaign_id', $campaigns->id)->get(); @endphp
                @if(!empty($ad_camp))
                @foreach($ad_camp as $camp)
                @php $camp_inc++; @endphp
                            <a class="dropdown-item" href="{{ route('ad_camp_details',$camp->id) }}">{{  $camp->name }}</a>
                @endforeach
                @endif
                    </div>
                </li>
<!--              <li class="nav-item">
                <a class="nav-link {{ $active_data[3] }}" data-toggle="tab" href="#tab_description" role="tab"> <i class="fa fa-global" aria-hidden="true"></i>Description</a>
            </li> -->
    <!--                                 <li class="nav-item">
                <a class="nav-link {{ $active_data[3] }}" data-toggle="tab" href="#tab_milestones" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Milestones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $active_data[4] }}" data-toggle="tab" href="#tab_tasks" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Tasks</a>
            </li> -->
    <!--                                 <li class="nav-item">
                <a class="nav-link {{ $active_data[5] }}" data-toggle="tab" href="#tab_leads" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Leads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $active_data[6] }}" data-toggle="tab" href="#tab_comments" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $active_data[7] }}" data-toggle="tab" href="#tab_expenses" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Expenses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $active_data[8] }}" data-toggle="tab" href="#tab_documents" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $active_data[9] }}" data-toggle="tab" href="#tab_analytics" role="tab"> <i class="fa fa-edit" aria-hidden="true"></i>Analytics</a>
            </li> -->
<!--             <li class="nav-item">
                <a class="nav-link {{ $active_data[10] }}" data-toggle="tab" href="#tab_logs" role="tab"> <i class="fab fa-gitter" aria-hidden="true"></i>Logs </a>
            </li> -->
        </ul>
    </div>

                        <div class="kt-portlet__head-actions pt-2">
                            <button  type="button" class="btn btn-primary btn-elevate btn-icon-sm" data-toggle="modal" data-target="#downlaod_mediaPan">
                                <i class="la la-download"></i>
                                Export Excel
                            </button>
                            <button  type="button" class="btn btn-danger btn-elevate btn-icon-sm" data-toggle="modal" data-target="#mediaPan">
                                <i class="la la-share"></i>
                                Share Media Plan
                            </button>
                            <button  type="button" class="btn btn-info btn-elevate btn-icon-sm" data-toggle="modal" data-target="#update_actuals">
                                <i class="la la-edit"></i>
                                Update Actuals
                            </button>
                            <button  type="button" class="btn btn-primary btn-elevate btn-icon-sm" data-toggle="modal" data-target="#weekly_media_plan">
                                <i class="la la-edit"></i>
                                Weekly Media Plan
                            </button>
                        </div>
                        <div class="modal fade" id="mediaPan">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                        <form action="{{ route('download_media_plan', $campaigns->id) }}" method="post">
                                            @csrf
                                    <div class="modal-header" style="display: block;">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="modal-title">Share Media Plan</h4>
                                    </div>
                                    <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <label>Mail To:</label>
                                                    <select class="form-control" multiple id="select_mail_list" required style="width: 100%;" name="mail_to[]">
                                                        <option value="">---</option>
                                @foreach($settings->where('cat', 'Emails')->where('name', 'mail') as $setting)
                                <option  value="{{ $setting->value }}">{{ $setting->value }}</option>
                                @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label>Mail Content:</label>
                                                    <textarea id="kt-tinymce-4" name="mail_content" class="form-control" rows="5"></textarea>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Close</button>
                                        <button class="btn btn-primary"><i class="la la-share"></i> Share</button>
                                    </div>
                                        </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <div class="modal fade" id="update_actuals">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('update_actuals', $campaigns->id) }}" method="post">
                                        @csrf
                                        <div class="modal-header" style="display: block;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title">Update Actuals for <span class="text-info">{{ $campaigns->name }} - {{ $campaigns->month }}</span></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4 mb-3"><label>Budget</label><input type="number" name="actuals[budget]" class="form-control" required></div>
                                                <div class="col-2 mb-3"><label>Leads</label><input type="number" name="actuals[leads]" class="form-control" required></div>
                                                <div class="col-2 mb-3"><label>Valid Leads</label><input type="number" name="actuals[valid_leads]" class="form-control" required></div>
                                                {{-- <div class="col-2 mb-3"><label>Valid Leads Per</label><input type="number" name="actuals[valid_leads_per]" class="form-control" required></div> --}}
                                                <div class="col-2 mb-3"><label>Walk-in</label><input type="number" name="actuals[walk_in]" class="form-control" required></div>
                                                <div class="col-2 mb-3"><label>Sales</label><input type="number" name="actuals[sales]" class="form-control" required></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Close</button>
                                            <button class="btn btn-primary"><i class="la la-save"></i> Update Actuals</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <div class="modal fade" id="weekly_media_plan">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('update_actuals', $campaigns->id) }}" method="post">
                                        @csrf
                                        <div class="modal-header" style="display: block;">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title">Weekly Media Plan <span class="text-info">{{ $campaigns->name }} - {{ $campaigns->month }}</span></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                    <label>From Date</label>
                                                    <input type="date" name="plan[from_date]" class="form-control" required>
                                                </div>
                                                <div class="col-3 mb-3">
                                                    <label>To Date</label>
                                                    <input type="date" name="plan[from_date]" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2 mb-3">
                                                    <label>Leads %</label>
                                                    <input type="number" name="plan[leads_per]" class="form-control" required>
                                                </div>
                                                <div class="col-2 mb-3">
                                                    <label>Leads</label>
                                                    <input type="number" name="plan[leads]" class="form-control" readonly>
                                                </div>
                                                <div class="col-2 mb-3">
                                                    <label>Valid Leads %</label>
                                                    <input type="number" name="plan[valid_leads_per]" class="form-control" required>
                                                </div>
                                                <div class="col-2 mb-3">
                                                    <label>Valid Leads</label>
                                                    <input type="number" name="plan[valid_leads]" class="form-control" required>
                                                </div>
                                                <div class="col-2 mb-3">
                                                    <label>Budget</label>
                                                    <input type="number" name="plan[budget]" class="form-control" required>
                                                </div>
                                                <div class="col-1 mb-3">
                                                    <label>CPL</label>
                                                    <input type="number" name="plan[cpl]" class="form-control" readonly>
                                                </div>
                                                <div class="col-1 mb-3">
                                                    <label>CPVL</label>
                                                    <input type="number" name="plan[cpvl]" class="form-control" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="la la-close"></i> Close</button>
                                            <button class="btn btn-primary"><i class="la la-save"></i> Update Actuals</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
</div>