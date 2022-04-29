@extends('layouts.default')
@section('content')
    @include('contents.download-report-form')
    <div class="container-fluid mt-2">
        <table class="table" id="datatable">
            <thead>
            <tr>
                <th scope="col">#</th>
                @foreach ($selectedFields as $field)
                    <th scope="col">{{ $field }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                
                @php
                @endphp
            @forelse ($reportResults as $index => $row)
            
                <tr @if($row['@attributes']['mobileSpeedScore'] == 0) class="bg-danger" style="color:#fff;" @endif>
                    <th scope="row">{{ $index + 1 }}</th>
                    @foreach($row['@attributes'] as $row_index => $cellValue)
                        @if($row_index == 'cost')
                        <td class="badge badge-success" style="margin-top: 9px;padding: 7px 20px;font-size: 14px;border-radius: 30px;"><i class="fa fa-inr"></i> {{ round($cellValue/1000000) }}</td>
                        @elseif($row_index == 'costConv')
                        <td class="badge badge-info" style="margin-top: 9px;padding: 7px 20px;font-size: 14px;border-radius: 30px;"><i class="fa fa-inr"></i> {{ round($cellValue/1000000) }}</td>
                        
                        @else
                        <td> {{ $cellValue }}</td>
                    @endif
                        
                    @endforeach
                </tr>
            @empty
                <tr class="text-center"><td colspan="{{ count($selectedFields) + 1 }}">
                        <strong>No data for this query.</strong></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{ $reportResults->links() }}
@stop

