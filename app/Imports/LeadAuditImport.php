<?php

namespace App\Imports;

use App\LeadAudit;
use Maatwebsite\Excel\Concerns\ToModel;

class LeadAuditImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new LeadAudit([
            'project' => $row[0],
            'created_on' => $row[1],
            'lead_number' => $row[2],
            'lead_stage' => $row[3],
            'lead_source' => $row[4],
            'contact_number' => $row[5],
            'email' => $row[6],
            'url' => $row[7],   
            'lead_owner' => $row[8],
        ]);
    }
}
