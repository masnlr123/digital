
        <form action="{{ url('download-report') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-sm-2">
                    <select class="form-control" id="clientCustomerId" name="clientCustomerId" required>
                        <option value="">Choose one Account</option>
                        <option value="584-012-3898">Eternity</option>
                        <option value="200-057-9858">Siruseri</option>
                        <option value="193-263-3184">Padur</option>
                        <option value="139-367-7531">Jubilee Residences</option>
                        <option value="927-598-0580">Humming Gardens</option>
                        <option value="249-340-6137">AGR Account - Agency</option>
                        <option value="829-584-8078">Alliance- Orchid Springss</option>
                        <option value="584-012-3898">Eternity</option>
                        <option value="139-043-4719">Galleria Residences</option>
                        <option value="927-598-0580">Humming Gardens</option>
                        <option value="775-701-7141">Hyderabad - Ameenpur</option>
                        <option value="489-090-8172">Jasmine Springs</option>
                        <option value="139-367-7531">Jubilee Residences</option>
                        <option value="193-263-3184">Padur</option>
                        <option value="200-057-9858">Siruseri</option>
                        <option value="856-834-3141">T-Sai</option>
                        <option value="602-632-8546">Urbanrise Projects</option>
                        <option value="331-738-4609">Villa Belvedere</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-control" id="reportType" name="reportType" required>
                        <option selected>LANDING_PAGE_REPORT</option>
                        <option>CAMPAIGN_PERFORMANCE_REPORT</option>
                        <option>ADGROUP_PERFORMANCE_REPORT</option>
                        <option>AD_PERFORMANCE_REPORT</option>
                        <option>ACCOUNT_PERFORMANCE_REPORT</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" id="reportRange" name="reportRange" required>
                        <option>TODAY</option>
                        <option selected>YESTERDAY</option>
                        <option>LAST_7_DAYS</option>
                        <option>LAST_WEEK</option>
                        <option>LAST_BUSINESS_WEEK</option>
                        <option>THIS_MONTH</option>
                        <option>LAST_MONTH</option>
                        <option>ALL_TIME</option>
                        <!--<option>CUSTOM_DATE</option>-->
                        <option>LAST_14_DAYS</option>
                        <option>LAST_30_DAYS</option>
                        <option>THIS_WEEK_SUN_TODAY</option>
                        <option>THIS_WEEK_MON_TODAY</option>
                        <option>LAST_WEEK_SUN_SAT</option>
                    </select>
                </div>
                <label for="entriesPerPage" class="col-sm-1 col-form-label">Per page</label>
                <div class="col-sm-1">
                    <select class="form-control" id="entriesPerPage" name="entriesPerPage" required>
                        <option selected>20</option>
                        <option>50</option>
                        <option>100</option>
                        <option>200</option>
                    </select>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

