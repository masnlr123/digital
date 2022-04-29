<?php

namespace App\Exports;

use App\Campaign;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use \Carbon\Carbon;

class ExportMediaPlan implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $media_plan_id;

    public function __construct($media_plan_id)
    {
        $this->media_plan_id = $media_plan_id;
    }

    public function query()
    {
        return Attendance::query()->select(
            'start_date',
            'user_id',
            'start_time',
            'start_ip',
            'end_date',
            'end_time',
            'end_ip',
            'total_duration',
            'login_screen',
            'logout_screen',
            'login_device',
            'logout_device'
        );
    }
    public function map($attendance): array
    {
        return [
            Carbon::Parse($attendance->start_date)->format('d-m-Y'),
            $attendance->user->name,
            $attendance->start_time,
            $attendance->start_ip,
            Carbon::Parse($attendance->end_date)->format('d-m-Y'),
            $attendance->end_time,
            $attendance->end_ip,
            $attendance->total_duration,
            $attendance->login_screen,
            $attendance->logout_screen,
            $attendance->login_device,
            $attendance->logout_device
        ];
    }
    public function headings(): array
    {
        return [
            'Date',
            'User',
            'Start Time',
            'Start IP',
            'Ended Date',
            'End Time',
            'End IP',
            'Total Duration',
            'Login Screen',
            'Logout Screen',
            'Login Device',
            'Logout Device'
        ];
    }

}
