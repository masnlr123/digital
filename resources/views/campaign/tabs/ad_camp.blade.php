<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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
                            <a href="{{ route('campaign_create') }}" class="btn btn-brand btn-elevate btn-icon-sm" data-toggle="modal" data-target="#NewAdCamp">
                                <i class="la la-plus"></i>
                                New Ad Campaign
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="camp_index kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th width="25%">Name</th>
                            <th>Project</th>
                            <th>Channel</th>
                            <th>Source</th>
                            <th>Assignee</th>
                            <th width="82" style="width: 82px;">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>
</div>
@section('header_css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('footer_js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.table2excel.js') }}"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($){
      $(function() {
        $("#table2excel_export").click(function(){
            $("#table2excel").tableToCSV(); 
         });
      });


        $('#select_mail_list').select2();
        $('.get_medium_list_row').each(function(){
            $(this).click(function(){
                // alert($(this).attr('aria-expanded'));
                let is_this_expanded = $(this).attr('aria-expanded');
                if(is_this_expanded == true || is_this_expanded == 'undefined'){
                    $(this).find('.flaticon2-right-arrow').css({
                        'transform': 'rotate(90deg)',
                        'display': 'inline-block'
                    })
                }
            });
        });
        $('#mediaPan').on('hide.bs.modal', function () {
            // scope the selector to the modal so you remove any editor on the page underneath.
            tinymce.remove('#mediaPan textarea');
         });
        // $('#mediaPan').on('shown.bs.modal', function() {
        //     tinyMCE.editors=[];
        //     // $(document).off('focusin.modal');
        // });

        
    });
// $.fn.dataTable.ext.errMode = function(obj,param,err){
//                 var tableId = obj.sTableId;
//                 console.log('Handling DataTable issue of Table '+tableId);
//         };
//         $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
//     console.log(message);
// };
var table = $('#kt_table_1').DataTable({
       ordering: false,
       processing: true,
       serverSide: true,
       pageLength: 50,
       // ajax: {
       //         url: "https://digital.allianceprojects.in/ad_campaigns/ad_camp_datatables",
       //         type: "GET",
       //         dataSrc: ""
       //     },
       ajax: '{{ route('ad_camp_datatables', $campaigns->id) }}',
       columns: [
                { data: 'id', name: 'id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'name', name: 'name' },
                { data: 'project', name: 'project' },
                { data: 'channel', name: 'channel' },
                { data: 'source', name: 'source' },
                { data: 'assigned_to', name: 'assigned_to' },
                { data: 'status', name: 'status' },
                { data: 'action', searchable: false, orderable: false }

             ],
        // language : {
        //     processing: '<img src="{{asset('assets/images/loader.jpg')}}">'
        // },
        // drawCallback : function( settings ) {
        //         $('.select').niceSelect();
        // }
    });
    $(document).ready(function(){
        if($('#kt_table_1').find('thead').width() < $('#kt_table_1').width()){
            let tr_count = $('#kt_table_1').find('thead th').length;
            let find_width = $('#kt_table_1').width()/tr_count;
            // alert(tr_count);
            // alert(find_width);
            $('#kt_table_1').find('thead th').attr('width', find_width).attr('test', 'alex');
        }
        function create_ad_camp(camp){
            $(camp).click(function(){
                let camp_source = $(this).data('source');
                let camp_channel = $(this).data('channel');
                let camp_assign = $(this).data('assign');
                $('#new_ad_camp_source').val(camp_source);
                $('#new_ad_camp_channel').val(camp_channel);
                $('#new_ad_camp_assign').val(camp_assign);
                $('#new_ad_camp_source').css('background', '#e2ff70');
                $('#new_ad_camp_channel').css('background', '#e2ff70');
                $('#new_ad_camp_assign').css('background', '#e2ff70');
            });
        }
        @php $inc = 1; @endphp
        @foreach(json_decode($campaigns->channels) as $channel => $camp)
        create_ad_camp('#new_ad_camp_{{ $inc }}');
        @php $inc++; @endphp
        @endforeach




        google.charts.load('current', {'language': 'hi_IN', 'packages':['bar', 'corechart']});
              google.charts.setOnLoadCallback(drawStuff);
              google.charts.setOnLoadCallback(drawChart1);
              google.charts.setOnLoadCallback(drawChart2);
              google.charts.setOnLoadCallback(drawChart3);
              google.charts.setOnLoadCallback(drawChart4);
              google.charts.setOnLoadCallback(drawChartBudget);
              function Create2DArray(rows) {
                var arr = [];
  
                for (var i=0;i<rows;i++) {
                   arr[i] = [];
                }
  
                return arr;
              }
              function drawStuff(){
  
                  var data = new google.visualization.arrayToDataTable([
                    ['Source', 'Budget'],
            
            @foreach(json_decode($campaigns->channels) as $camp)
        @if($loop->last)
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{ $camp->budget }}]
        @else
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{ $camp->budget }}],
        @endif
            @endforeach
                    ]);
  
                  var options = {
                    title: 'All Project Budget',
                    legend: { position: 'none' },
                    chart: { title: 'All Project Budget',
                             subtitle: 'Media Plan Budget by Projects' },
                    bars: 'horizontal', // Required for Material Bar Charts.
                    hAxis: {format: 'currency'},
                    annotations: {
                      textStyle: {
                        fontName: 'Poppins',
                        fontSize: 16,
                        bold: true,
                        color: '#871b47',
                        auraColor: '#d799ae',
                        opacity: 0.8
                      }
                    },
                    bar: { groupWidth: "90%" }
                  };
                  var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                  chart.draw(data, google.charts.Bar.convertOptions(options));
              };
              function drawChart1(){

                  var data = new google.visualization.arrayToDataTable([
                    ['Media Plan', 'Sales'],
            @foreach(json_decode($campaigns->channels) as $camp)
        @if($loop->last)
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->sales }}]
        @else
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->sales }}],
        @endif
            @endforeach
                    ]);

                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      // titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                      // pieHole: 0.4,
                      // pieSliceText: 'value',
                      // sliceVisibilityThreshold :0,
                      // fontSize: 17,
                    title: 'Sales Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_1'));
                  chart.draw(data, options);
              }
              function drawChart2(){
                  var data = new google.visualization.arrayToDataTable([
                    ['Source', 'Walk-In'],
            @foreach(json_decode($campaigns->channels) as $camp)
        @if($loop->last)
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->walk_in }}]
        @else
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->walk_in }}],
        @endif
            @endforeach
                    ]);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Walk-In Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_2'));
                  chart.draw(data, options);
              }
              function drawChart3(){
                  var data = new google.visualization.arrayToDataTable([
                    ['Source', 'Leads'],
            @foreach(json_decode($campaigns->channels) as $camp)
        @if($loop->last)
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->leads }}]
        @else
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->leads }}],
        @endif
            @endforeach
                    ]);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Leads Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_3'));
                  chart.draw(data, options);
              }
              function drawChart4(){
                  var data = new google.visualization.arrayToDataTable([
                    ['Source', 'Valid Leads'],
            @foreach(json_decode($campaigns->channels) as $camp)
        @if($loop->last)
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->vleads }}]
        @else
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->vleads }}],
        @endif
            @endforeach
                    ]);
                  var options = {
                      legend: {
                          position: 'right',
                          textStyle: {color: '#646c9a', fontSize: 13, fontName:'Roboto', bold: false}
                      },
                      is3D: true,
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                    title: 'Valid Leads Target'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_4'));
                  chart.draw(data, options);
              }
              function drawChartBudget(){
                  var data = new google.visualization.arrayToDataTable([
                    ['Source', 'Budget'],
            @foreach(json_decode($campaigns->channels) as $camp)
        @if($loop->last)
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->budget }}]
        @else
        ['@if(!is_object($camp->source)){{ $camp->source }}@else{{ $camp->source->source }}@endif', {{$camp->budget }}],
        @endif
            @endforeach
                    ]);
                  var options = {
                      pieSliceText: 'value-and-percentage',
                      is3D: true,
                      slices: {  15: {offset: 0.2},
                                1: {offset: 0.3},
                                7: {offset: 0.4},
                                10: {offset: 0.5},
                      },
                      sliceVisibilityThreshold: 0,             
                      legend: 'labeled',
                      titleTextStyle:{color: '#646c9a', fontSize: 16, fontName:'Roboto', bold: false},
                      title: 'Budget Metrix'
                  };
                  var chart = new google.visualization.PieChart(document.getElementById('piechart_budget'));
                  chart.draw(data, options);
              }
        
    });

</script>
@endsection