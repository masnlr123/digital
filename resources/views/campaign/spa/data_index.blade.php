<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    All Ad Campaigns</h3>
            </div>
        </div>
    </div>
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Ad Campaigns
                        <small>List of Recent Ad Campaigns</small>
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-wrapper">
                                            <div class="kt-portlet__head-actions">
                                                <a href="/spa/create" class="btn btn-brand btn-elevate btn-icon-sm">
                                                    <i class="la la-plus"></i>
                                                    New camp
                                                </a>
                                            </div>
                                        </div>
                                    </div>
            </div>
            <div class="camp_index kt-portlet__body kt-portlet__body--fit">
                <!--begin: Datatable -->
                <table datatable="ng" class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Date</th>
                            <th>Project</th>
                            <th>Project Campaign</th>
                            <th>Ad Campaign</th>
                            <th>Channel</th>
                            <th>Source</th>
                            <th>Assignee</th>
                            <th style="width: 82px;">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script type="text/javascript">

var table = $('#kt_table_1').DataTable({
       ordering: false,
       processing: true,
       serverSide: true,
       pageLength: 50,
       lengthMenu: [ [10, 25, 50, 100, 200, 500, 1000, -1], [10, 25, 50, 100, 200, 500, 1000, "All"] ],
       ajax: '{{ route('all_ad_camp_datatables') }}',
       columns: [
                // { data: 'id', name: 'id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'project', name: 'project' },
                { data: 'campaign', name: 'campaign' },
                { data: 'name', name: 'name' },
                { data: 'channel', name: 'channel' },
                { data: 'source', name: 'source' },
                { data: 'assigned_to', name: 'assigned_to' },
                { data: 'status', name: 'status' },
                // { data: 'status', searchable: false, orderable: false},
                { data: 'action', searchable: false, orderable: false }

             ],
             dom: "<'row'<'col-2'l><'col-5'B><'col-sm-12 col-md-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
             columnDefs: [
                    {
                        targets: 1,
                        className: 'noVis'
                    }
                ],
                buttons: [
                'copy', 'excel', 'csv', 'pdf', 'print',
                    {
                        extend: 'colvis',
                        columns: ':not(.noVis)',
                         text: 'Coloumns',
                         collectionLayout: 'fixed three-column'
                    }
                ],
        // language : {
        //     processing: '<img src="{{asset('assets/images/loader.jpg')}}">'
        // },
        // drawCallback : function( settings ) {
        //         $('.select').niceSelect();
        // }
    });

</script>