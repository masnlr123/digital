<div class="row">
                                    <div class="kt-widget1 col-md-12" style="padding: 20px 10px;">
                                                @if(null !== $campaigns->channels)
                                                <h5 class="mt-4">Channel/Medium Assignee:</h5>
                                                <table class="table table-bordered table-striped table-success">
                                                    <thead>
                                                        <tr>
                                                            <th>Objective
                                                            <th>Medium</th>
                                                            <th>Source</th>
                                                            <th>User</th>
                                                            <th>Budget</th>
                                                            <th>Leads</th>
                                                            <th>Valid</th>
                                                            <!-- <th>Valid Leads Count</th> -->
                                                            <th>Walk-In</th>
                                                            <th>Sales</th>
                                                            <th>Rev</th>
                                                            <th>CPL</th>
                                                            <th>CPW</th>
                                                            <th>CPS</th>
                                                            <th>SOR</th>
                                                            <th>VLTW</th>
                                                            <th>WTS</th>
                                                            <th>VLTS</th>
                                                            <th>Daily Spend</th>
                                                            <th>Daily Leads</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $inc = 1; @endphp
                                                        @foreach(json_decode($campaigns->channels) as $channel => $camp) 
                                                        @php $get_user = App\User::find($camp->user); 
                                                        $get_user = json_decode($get_user);
                                                        @endphp
                                                        <tr>
            <td>@if(isset($camp->budget)){{ $camp->budget }}@endif</td>
            <td>@if($camp->leads){{ $camp->leads }}@endif</td>
            <td>@if($camp->valid_leads){{ $camp->valid_leads }}@endif</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>@if($camp->vltw){{ $camp->vltw }}@endif</td>
            <td>@if($camp->wts){{ $camp->wts }}@endif</td>
            <td></td>
            <td></td>
            <td></td>
                                                            <td><button style="padding: 2px;width: auto;height: auto;"class="btn btn-brand btn-elevate btn-icon btn-icon-sm" data-toggle="modal" data-target="#NewAdCamp" id="new_ad_camp_{{ $inc }}" data-source="{{ $camp->source->source }}" data-channel="{{ $camp->medium }}" data-assign="{{ $get_user->name }}"><i class="la la-plus" ></i></button></td>
                                                        </tr>
                                                        @php $inc++; @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @endif
<!--                                                 <h5 class="mt-4">Additional Details:</h5>
                                                <table class="table table-bordered table-striped table-danger">
                                                    <tbody>
                                                        <tr>
                                                            <td>Target Audience</td>
                                                            <td>{{ $campaigns->target_audience }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Budget Cost</td>
                                                            <td>{{ $campaigns->budget_cost }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expected Leads Count</td>
                                                            <td>{{ $campaigns->expected_leads_count }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Valid Leads %</td>
                                                            <td>{{ $campaigns->valid_leads }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expected Site visit count</td>
                                                            <td>{{ $campaigns->expected_site_visit_count }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sales Count</td>
                                                            <td>{{ $campaigns->sales_count }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expected SOR</td>
                                                            <td>{{ $campaigns->expected_sor }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Expected Closeate</td>
                                                            <td>{{ $campaigns->expected_close_date }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table> -->
                                    </div>
                                </div>