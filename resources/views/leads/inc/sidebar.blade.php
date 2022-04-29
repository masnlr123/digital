
                <div class="kt-portlet kt-portlet--solid-brand">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label"> <span class="kt-portlet__head-icon"><i class="flaticon-stopwatch"></i></span>
                            <h3 class="kt-portlet__head-title">Lead Details</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a class="btn btn-outline-light btn-sm btn-circle btn-icon mr-2" href="#" data-toggle="kt-popover" data-content="Edit Basic information of the Lead" data-original-title="Edit"> <i class="flaticon-edit"></i>
                            </a>
                            <a class="btn btn-outline-light btn-sm btn-circle btn-icon" href="#" data-toggle="kt-popover" data-content="Share this lead information to social media" data-original-title="Share Lead"> <i class="fa fa-share-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__content">
                            <h2><i class="flaticon2-user "></i> {{ $lead->first_name }}</h2>
                            <p><strong><em>{{ $lead->lead_stage }}</em></strong>
                            </p>
                            <p><i class="fa fa-building mr-1"></i>
                            </p>
                            <p><i class="flaticon2-black-back-closed-envelope-shape mr-1"></i> {{ $lead->email }}</p>
                            <p><i class="fa fa-phone-alt mr-1"></i> {{ $lead->contact_number }}</p>
                            <!-- <p><i class="fa fa-map-marker-alt mr-1"></i> {{ $lead->first_name }}</p> -->
                            <!--             <p><i class="fa fa-user"></i> {{ $lead->contact_number }}</p>
            <p><i class="fa fa-user"></i> {{ $lead->email }}</p> -->
                        </div>
                    </div>
                </div>
                <div class="kt-portlet kt-portlet--tabs">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right nav-tabs-bold" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#lead_properties" role="tab"> <i class="flaticon2-paper-plane" aria-hidden="true"></i>Lead Properties</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="padding: 2px;">
                        <div class="tab-content">
                            <div class="tab-pane active" id="lead_properties" role="tabpanel">
                                <div class="row">
                                    <div class="kt-widget1 col-md-12" style="padding:2px 10px;">
                                        <!-- <h5>Lead Properties</h5> -->
                                        <table class="table table-bordered table-striped table-large">
                                            <tbody>@if($lead->lead_stage)
                                                <tr>
                                                    <td>Lead Stage</td>
                                                    <td>{{ $lead->lead_stage }}</td>
                                                </tr>@endif @if($lead->lead_source)
                                                <tr>
                                                    <td>Source</td>
                                                    <td>{{ $lead->lead_source }}</td>
                                                </tr>@endif @if($lead->lead_sub_source)
                                                <tr>
                                                    <td>Sub Source</td>
                                                    <td>{{ $lead->lead_sub_source }}</td>
                                                </tr>@endif @if($lead->lead_origin)
                                                <tr>
                                                    <td>Lead Origin</td>
                                                    <td>{{ $lead->lead_origin }}</td>
                                                </tr>@endif @if($lead->notes)
                                                <tr>
                                                    <td>Notes</td>
                                                    <td>{{ $lead->notes }}</td>
                                                </tr>@endif
                                                <tr>
                                                    <td>Lead Age</td>
                                                    <td>{{ $lead->lead_age }} Days</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>