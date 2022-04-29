<?php

namespace App\Exports;

use App\LeadAudit;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportLeadAudit implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function query()
    {
        return LeadAudit::query()->select(
        'lead_number',
        'project',
        'lead_name',
        'created_on',
        'lead_id',
        'lead_stage',
        'lead_source',
        'contact_number',
        'email',
        'url',
        'lead_owner',
        'lat_feedback',
        'lat_action',
        'detailed_remark',
        'lat_executive',
        'block_1',
        'block_2',
        'block_3',
        'block_4',
        'total_score',
        'red_alert',
        'type',
        'created_by',
        'created_at');
    }
    public function headings(): array
    {
        return [
            'Lead Number',
            'Project',
            'Lead First Name',
            'Lead Created On',
            'Lead Auto ID',
            'Lead Stage',
            'Lead Source',
            'Contact Number',
            'Email Address',
            'Lead URL',
            'Lead Owner',
            'LAT Feedback',
            'LAT Action',
            'Detailed Remark',
            'LAT Executive',
            'Soft Skills Score',
            'Product Knowledge Score',
            'LMS Update Score',
            'Zero Tolerance',
            'Total Score',
            'Red Alert',
            'Lead Audit Type',
            'Lead Audit Created By',
            'Lead Audit Created At'
        ];
    }

}
