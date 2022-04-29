<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreativeTask extends Model
{
    //
    protected $table = 'task_creative';

    protected $fillable = [
  'task_name',
  'task_brief',
  'task_cat',
  'task_type',
  'task_for',
  'project',
  'campaign',
  'ad_camp_id',
  'campaign_id',
  'creative_type',
  'creative_brief',
  'creative_size',
  'hero_message',
  'priority',
  'status',
  'notes',
  'created_by',
  'created_by_email',
  'created_time',
  'creator_eta',
  'assignee',
  'assigned_date',
  'completed_time',
  'completed_by',
  'approval_person',
  'actual_duration',
  'created_at',
  'updated_at',
  'deleted_at'     
    ];
}
