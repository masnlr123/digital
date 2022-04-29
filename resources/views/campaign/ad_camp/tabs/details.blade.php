<div class="row">
                                    <div class="kt-widget1 col-md-12" style="padding: 20px 10px;">
                                                <h5>Basic Details:</h5>
                                                <table class="table table-bordered table-striped table-warning">
                                                    <tbody>
                                                        <tr>
                                                            <td width="40%">Name</td>
                                                            <td colspan="3"><strong>{{ $campaigns->name }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>project</td>
                                                            <td>{{ $campaigns->project }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>{{ $campaigns->status }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <h5>Description</h5>
                                                <td>{!! $campaigns->description !!}</td>
                                                <hr>

                                                @if(null !== $campaigns->channels)
                                                <h5 class="mt-4">Channel/Medium Assignee:</h5>
                                                <table class="table table-bordered table-striped table-success">
                                                    <thead>
                                                        <tr>
                                                            <th>Channel/Medium</th>
                                                            <th>Source</th>
                                                            <th>Assignee</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach(json_decode($campaigns->channels) as $channel => $camp) @php $get_user = App\User::find($camp->camp_user); $get_user = json_decode($get_user); @endphp
                                                        <tr>
                                                            <td width="40%">{{ $camp->camp_channel }}</td>
                                                            <td width="40%">{{ $camp->camp_source }}</td>
                                                            <td colspan="3">{{ $get_user->name }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @endif
                                                <h5 class="mt-4">Additional Details:</h5>
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
                                                </table>
                                                <h5 class="text-center mt-4">Edit Details:</h5>
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
                                                                            <option value="Search Ads" {{ $camp->camp_channel == 'Search Ads'? 'selected': '' }}>Search Ads</option>
                                                                            <option value="Social Ads" {{ $camp->camp_channel == 'Social Ads'? 'selected': '' }}>Social Ads</option>
                                                                            <option value="Native Ads" {{ $camp->camp_channel == 'Native Ads'? 'selected': '' }}>Native Ads</option>
                                                                            <option value="Aggregators Ads" {{ $camp->camp_channel == 'Aggregators Ads'? 'selected': '' }}>Aggregators Ads</option>
                                                                            <option value="Support & IM" {{ $camp->camp_channel == 'Support & IM'? 'selected': '' }}>Support & IM</option>
                                                                            <option value="Organic Search" {{ $camp->camp_channel == 'Organic Search'? 'selected': '' }}>Organic Search</option>
                                                                            <option value="GBL" {{ $camp->camp_channel == 'GBL'? 'selected': '' }}>GBL</option>
                                                                            <option value="Organic Social" {{ $camp->camp_channel == 'Organic Social'? 'selected': '' }}>Organic Social</option>
                                                                            <option value="Listing Aggregators" {{ $camp->camp_channel == 'Listing Aggregators'? 'selected': '' }}>Listing Aggregators</option>
                                                                            <option value="Direct Traffic" {{ $camp->camp_channel == 'Direct Traffic'? 'selected': '' }}>Direct Traffic</option>
                                                                            <option value="Internal Sites" {{ $camp->camp_channel == 'Internal Sites'? 'selected': '' }}>Internal Sites</option>
                                                                            <option value="Q&A" {{ $camp->camp_channel == 'Q&A'? 'selected': '' }}>Q&A</option>
                                                                            <option value="Social Media Marketplace" {{ $camp->camp_channel == 'Social Media Marketplace'? 'selected': '' }}>Social Media Marketplace</option>
                                                                            <option value="Corporate Website" {{ $camp->camp_channel == 'Corporate Website'? 'selected': '' }}>Corporate Website</option>
                                                                            <option value="Hyper Target Marketing" {{ $camp->camp_channel == 'Hyper Target Marketing'? 'selected': '' }}>Hyper Target Marketing</option>
                                                                            <option value="Geo Fencing" {{ $camp->camp_channel == 'Geo Fencing'? 'selected': '' }}>Geo Fencing</option>
                                                                            <option value="OTT Platform" {{ $camp->camp_channel == 'OTT Platform'? 'selected': '' }}>OTT Platform</option>
                                                                            <option value="Email Marketing" {{ $camp->camp_channel == 'Email Marketing'? 'selected': '' }}>Email Marketing</option>
                                                                            <option value="Video Marketing" {{ $camp->camp_channel == 'Video Marketing'? 'selected': '' }}>Video Marketing</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <select style="width: 100%;" class="form-control kt-select2 choose_source" id="subcategory" required="" name="camp_source">
                                                                            <option value=""> --- Choose Source ---</option>
                                                                            <optgroup label="Search Ads">
                                                                                <option value="Adwords Text" {{ $camp->camp_source == 'Adwords Text'? 'selected': '' }}>Adwords Text</option>
                                                                                <option value="Adwords Dsp" {{ $camp->camp_source == 'Adwords Dsp'? 'selected': '' }}>Adwords Dsp</option>
                                                                                <option value="Adwords Dsp" {{ $camp->camp_source == 'Adwords Discovery'? 'selected': '' }}>Adwords Discovery</option>
                                                                            </optgroup>
                                                                            <optgroup label="Social Ads">
                                                                                <option value="Facebook Ads" {{ $camp->camp_source == 'Facebook Ads'? 'selected': '' }}>Facebook Ads</option>
                                                                                <option value="Linkedin Ads" {{ $camp->camp_source == 'Linkedin Ads'? 'selected': '' }}>Linkedin Ads</option>
                                                                                <option value="Twitter Ads" {{ $camp->camp_source == 'Twitter Ads'? 'selected': '' }}>Twitter Ads</option>
                                                                            </optgroup>
                                                                            <optgroup label="Native Ads">
                                                                                <option value="Taboola" {{ $camp->camp_source == 'Taboola'? 'selected': '' }}>Taboola</option>
                                                                                <option value="Colombia" {{ $camp->camp_source == 'Colombia'? 'selected': '' }}>Colombia</option>
                                                                                <option value="Adgebra" {{ $camp->camp_source == 'Adgebra'? 'selected': '' }}>Adgebra</option>
                                                                                <option value="Mounting Digital" {{ $camp->camp_source == 'Mounting Digital'? 'selected': '' }}>Mounting Digital</option>
                                                                                <option value="Outbrain" {{ $camp->camp_source == 'Outbrain'? 'selected': '' }}>Outbrain</option>
                                                                                <option value="Daily Hunt" {{ $camp->camp_source == 'Daily Hunt'? 'selected': '' }}>Daily Hunt</option>
                                                                            </optgroup>
                                                                            <optgroup label="Aggregators Ads">
                                                                                <option value="99 Acres" {{ $camp->camp_source == '99 Acres'? 'selected': '' }}>99 Acres</option>
                                                                                <option value="Magic bricks" {{ $camp->camp_source == 'Magic bricks'? 'selected': '' }}>Magic bricks</option>
                                                                                <option value="Housing" {{ $camp->camp_source == 'Housing'? 'selected': '' }}>Housing</option>
                                                                                <option value="India Property" {{ $camp->camp_source == 'India Property'? 'selected': '' }}>India Property</option>
                                                                                <option value="Chennai Properties" {{ $camp->camp_source == 'Chennai Properties'? 'selected': '' }}>Chennai Properties</option>
                                                                                <option value="Common Floor" {{ $camp->camp_source == 'Common Floor'? 'selected': '' }}>Common Floor</option>
                                                                                <option value="Roof and Floor" {{ $camp->camp_source == 'Roof and Floor'? 'selected': '' }}>Roof and Floor</option>
                                                                                <option value="zricks" {{ $camp->camp_source == 'zricks'? 'selected': '' }}>zricks</option>
                                                                                <option value="Sulekha" {{ $camp->camp_source == 'Sulekha'? 'selected': '' }}>Sulekha</option>
                                                                                <option value="NoBroker" {{ $camp->camp_source == 'NoBroker'? 'selected': '' }}>NoBroker</option>
                                                                            </optgroup>
                                                                            <optgroup label="Support & IM">
                                                                                <option value="Whatsapp" {{ $camp->camp_source == 'NoBroker'? 'selected': '' }}>Whatsapp</option>
                                                                                <option value="Hola SMS" {{ $camp->camp_source == 'Hola SMS'? 'selected': '' }}>Hola SMS</option>
                                                                                <option value="Web Chat" {{ $camp->camp_source == 'Web Chat'? 'selected': '' }}>Web Chat</option>
                                                                            </optgroup>
                                                                            <optgroup label="Organic Search">
                                                                                <option value="SEO" {{ $camp->camp_source == 'SEO'? 'selected': '' }}>SEO</option>
                                                                            </optgroup>
                                                                            <optgroup label="GBL">
                                                                                <option value="GBL" {{ $camp->camp_source == 'SEO'? 'selected': '' }}>SEO</option>
                                                                            </optgroup>
                                                                            <optgroup label="Social Organic">
                                                                                <option value="Social Organic" {{ $camp->camp_source == 'Social Organic'? 'selected': '' }}>Social Organic</option>
                                                                            </optgroup>
                                                                            <optgroup label="Corporate Website">
                                                                                <option value="LP Alliance Website" {{ $camp->camp_source == 'LP Alliance Website'? 'selected': '' }}>LP Alliance Website</option>
                                                                                <option value="LP Urbanrise Website" {{ $camp->camp_source == 'LP Urbanrise Website'? 'selected': '' }}>LP Urbanrise Website</option>
                                                                            </optgroup>
                                                                            <optgroup label="Geo Fencing">
                                                                                <option value="Geo Fencing" {{ $camp->camp_source == 'Geo Fencing'? 'selected': '' }}>Geo Fencing</option>
                                                                            </optgroup>
                                                                            <optgroup label="Listing Aggregators">
                                                                                <option value="ClickIndia-Listing" {{ $camp->camp_source == 'ClickIndia-Listing'? 'selected': '' }}>ClickIndia-Listing</option>
                                                                                <option value="Makaan-Listing" {{ $camp->camp_source == 'Makaan-Listing'? 'selected': '' }}>Makaan-Listing</option>
                                                                                <option value="Propertywala-Listing" {{ $camp->camp_source == 'Propertywala-Listing'? 'selected': '' }}>Propertywala-Listing</option>
                                                                                <option value="MyPropertyBoutique-Listing" {{ $camp->camp_source == 'MyPropertyBoutique-Listing'? 'selected': '' }}>MyPropertyBoutique-Listing</option>
                                                                                <option value="Quickr-Listing" {{ $camp->camp_source == 'Quickr-Listing'? 'selected': '' }}>Quickr-Listing</option>
                                                                            </optgroup>
                                                                            <optgroup label="Direct Traffic">
                                                                                <option value="Direct Traffic" {{ $camp->camp_source == 'Direct Traffic'? 'selected': '' }}>Direct Traffic</option>
                                                                            </optgroup>
                                                                            <optgroup label="Email Marketing">
                                                                                <option value="Email Internal" {{ $camp->camp_source == 'Email Internal'? 'selected': '' }}>Email Internal</option>
                                                                            </optgroup>
                                                                            <optgroup label="Social Media Marketplace">
                                                                                <option value="FB Marketplace" {{ $camp->camp_source == 'FB Marketplace'? 'selected': '' }}>FB Marketplace</option>
                                                                            </optgroup>
                                                                            <optgroup label="Organic Social">
                                                                                <option value="Facebook Page" {{ $camp->camp_source == 'Facebook Page'? 'selected': '' }}>Facebook Page</option>
                                                                                <option value="Instagram Page" {{ $camp->camp_source == 'Instagram Page'? 'selected': '' }}>Instagram Page</option>
                                                                                <option value="Linkedin Page" {{ $camp->camp_source == 'Linkedin Page'? 'selected': '' }}>Linkedin Page</option>
                                                                            </optgroup>
                                                                            <optgroup label="Q&A">
                                                                                <option value="Quora" {{ $camp->camp_source == 'Quora'? 'selected': '' }}>Quora</option>
                                                                            </optgroup>
                                                                            <optgroup label="Internal Sites">
                                                                                <option value="Jasmine Springs Website" {{ $camp->camp_source == 'Jasmine Springs Website'? 'selected': '' }}>Jasmine Springs Website</option>
                                                                                <option value="Jubilee Residences Website" {{ $camp->camp_source == 'Jubilee Residences Website'? 'selected': '' }}>Jubilee Residences Website</option>
                                                                                <option value="Humming Gardens Website" {{ $camp->camp_source == 'Humming Gardens Website'? 'selected': '' }}>Humming Gardens Website</option>
                                                                                <option value="Galleria Residences Website" {{ $camp->camp_source == 'Galleria Residences Website'? 'selected': '' }}>Galleria Residences Website</option>
                                                                                <option value="Urbanrise Eternity Website" {{ $camp->camp_source == 'Urbanrise Eternity Website'? 'selected': '' }}>Urbanrise Eternity Website</option>
                                                                                <option value="Villa Belvedere Website" {{ $camp->camp_source == 'Villa Belvedere Website'? 'selected': '' }}>Villa Belvedere Website</option>
                                                                                <option value="Codename Chennaias Best Website" {{ $camp->camp_source == 'Codename Chennaias Best Website'? 'selected': '' }}>Codename Chennaias Best Website</option>
                                                                            </optgroup>
                                                                            <optgroup label="Video Marketing">
                                                                                <option value="Youtube" {{ $camp->camp_source == 'Youtube'? 'selected': '' }}>Youtube</option>
                                                                            </optgroup>
                                                                            <optgroup label="OTT Platform">
                                                                                <option value="Hotstar Ads" {{ $camp->camp_source == 'Hotstar Ads'? 'selected': '' }}>Hotstar Ads</option>
                                                                                <option value="Zee5 Ads" {{ $camp->camp_source == 'Zee5 Ads'? 'selected': '' }}>Zee5 Ads</option>
                                                                            </optgroup>
                                                                            <optgroup label="Hyper Target Marketing">
                                                                                <option value="Hyper Target Marketing" {{ $camp->camp_source == 'Hyper Target Marketing'? 'selected': '' }}>Hyper Target Marketing</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <select style="width: 100%;" class="form-control kt-select2" id="choose_channel_person" name="camp_user">
                                                                            <option value=""> --- Choose Asignee ---</option>
                                                                            @foreach($users->whereIn('role_id', ['1', '2', '4', '5', '6', '7'])->get() as $camp_user)
                                                                            <option value="{{ $camp_user->id }}" {{ $camp->camp_user == $camp_user->id? 'selected': '' }}>{{ $camp_user->name }}</option>
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
                                                                            <option value="Search Ads">Search Ads</option>
                                                                            <option value="Social Ads">Social Ads</option>
                                                                            <option value="Native Ads">Native Ads</option>
                                                                            <option value="Aggregators Ads">Aggregators Ads</option>
                                                                            <option value="Support & IM">Support & IM</option>
                                                                            <option value="Organic Search">Organic Search</option>
                                                                            <option value="GBL">GBL</option>
                                                                            <option value="Organic Social">Organic Social</option>
                                                                            <option value="Listing Aggregators">Listing Aggregators</option>
                                                                            <option value="Direct Traffic">Direct Traffic</option>
                                                                            <option value="Internal Sites">Internal Sites</option>
                                                                            <option value="Q&A">Q&A</option>
                                                                            <option value="Social Media Marketplace">Social Media Marketplace</option>
                                                                            <option value="Corporate Website">Corporate Website</option>
                                                                            <option value="Hyper Target Marketing">Hyper Target Marketing</option>
                                                                            <option value="Geo Fencing">Geo Fencing</option>
                                                                            <option value="OTT Platform">OTT Platform</option>
                                                                            <option value="Email Marketing">Email Marketing</option>
                                                                            <option value="Video Marketing">Video Marketing</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <select style="width: 100%;" class="form-control kt-select2 choose_source" id="subcategory" required="" name="camp_source">
                                                                            <option value=""> --- Choose Source ---</option>
                                                                            <optgroup label="Search Ads">
                                                                                <option value="Adwords Text">Adwords Text</option>
                                                                                <option value="Adwords Dsp">Adwords Dsp</option>
                                                                                <option value="Adwords Dsp">Adwords Discovery</option>
                                                                            </optgroup>
                                                                            <optgroup label="Social Ads">
                                                                                <option value="Facebook Ads">Facebook Ads</option>
                                                                                <option value="Linkedin Ads">Linkedin Ads</option>
                                                                                <option value="Twitter Ads">Twitter Ads</option>
                                                                            </optgroup>
                                                                            <optgroup label="Native Ads">
                                                                                <option value="Taboola">Taboola</option>
                                                                                <option value="Colombia">Colombia</option>
                                                                                <option value="Adgebra">Adgebra</option>
                                                                                <option value="Mounting Digital">Mounting Digital</option>
                                                                                <option value="Outbrain">Outbrain</option>
                                                                                <option value="Daily Hunt">Daily Hunt</option>
                                                                                <!--<option value="Native Ads">Native Ads</option>-->
                                                                            </optgroup>
                                                                            <optgroup label="Aggregators Ads">
                                                                                <option value="99 Acres">99 Acres</option>
                                                                                <option value="Magic bricks">Magic bricks</option>
                                                                                <option value="Housing">Housing</option>
                                                                                <option value="India Property">India Property</option>
                                                                                <option value="Chennai Properties">Chennai Properties</option>
                                                                                <option value="Common Floor">Common Floor</option>
                                                                                <option value="Roof and Floor">Roof and Floor</option>
                                                                                <option value="zricks">zricks</option>
                                                                                <!--<option value="Olx">Olx</option>-->
                                                                                <option value="Sulekha">Sulekha</option>
                                                                                <option value="NoBroker">NoBroker</option>
                                                                            </optgroup>
                                                                            <optgroup label="Support & IM">
                                                                                <option value="Whatsapp">Whatsapp</option>
                                                                                <option value="Hola SMS">Hola SMS</option>
                                                                                <option value="Web Chat">Web Chat</option>
                                                                            </optgroup>
                                                                            <optgroup label="Organic Search">
                                                                                <option value="SEO">SEO</option>
                                                                            </optgroup>
                                                                            <optgroup label="GBL">
                                                                                <option value="GBL">GBL</option>
                                                                            </optgroup>
                                                                            <optgroup label="Social Organic">
                                                                                <option value="Social Organic">Social Organic</option>
                                                                            </optgroup>

                                                                            <optgroup label="Corporate Website">
                                                                                <option value="LP Alliance Website">LP Alliance Website</option>
                                                                                <option value="LP Urbanrise Website">LP Urbanrise Website</option>
                                                                            </optgroup>
                                                                            <optgroup label="Geo Fencing">
                                                                                <option value="Geo Fencing">Geo Fencing</option>
                                                                            </optgroup>
                                                                            <optgroup label="Listing Aggregators">
                                                                                <option value="ClickIndia-Listing">ClickIndia-Listing</option>
                                                                                <option value="Makaan-Listing">Makaan-Listing</option>
                                                                                <option value="Propertywala-Listing">Propertywala-Listing</option>
                                                                                <option value="MyPropertyBoutique-Listing">MyPropertyBoutique-Listing</option>
                                                                                <option value="Quickr-Listing">Quickr-Listing</option>
                                                                            </optgroup>
                                                                            <optgroup label="Direct Traffic">
                                                                                <option value="Direct Traffic">Direct Traffic</option>
                                                                            </optgroup>
                                                                            <optgroup label="Email Marketing">
                                                                                <option value="Email Internal">Email Internal</option>
                                                                            </optgroup>
                                                                            <optgroup label="Social Media Marketplace">
                                                                                <option value="FB Marketplace">FB Marketplace</option>
                                                                            </optgroup>
                                                                            <optgroup label="Organic Social">
                                                                                <option value="Facebook Page">Facebook Page</option>
                                                                                <option value="Instagram Page">Instagram Page</option>
                                                                                <option value="Linkedin Page">Linkedin Page</option>
                                                                            </optgroup>
                                                                            <optgroup label="Q&A">
                                                                                <option value="Quora">Quora</option>
                                                                            </optgroup>
                                                                            <optgroup label="Internal Sites">
                                                                                <option value="Jasmine Springs Website">Jasmine Springs Website</option>
                                                                                <option value="Jubilee Residences Website">Jubilee Residences Website</option>
                                                                                <option value="Humming Gardens Website">Humming Gardens Website</option>
                                                                                <option value="Galleria Residences Website">Galleria Residences Website</option>
                                                                                <option value="Urbanrise Eternity Website">Urbanrise Eternity Website</option>
                                                                                <option value="Villa Belvedere Website">Villa Belvedere Website</option>
                                                                                <option value="Codename Chennaias Best Website">Codename Chennaias Best Website</option>
                                                                            </optgroup>
                                                                            <optgroup label="Video Marketing">
                                                                                <option value="Youtube">Youtube</option>
                                                                            </optgroup>
                                                                            <optgroup label="OTT Platform">
                                                                                <option value="Hotstar Ads">Hotstar Ads</option>
                                                                                <option value="Zee5 Ads">Zee5 Ads</option>
                                                                            </optgroup>
                                                                            <optgroup label="Hyper Target Marketing">
                                                                                <option value="Hyper Target Marketing">Hyper Target Marketing</option>
                                                                            </optgroup>
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
                                                            <textarea id="kt-tinymce-4" placeholder="Enter your Description" class="form-control" name="description">{{ $campaigns->description }}</textarea>
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