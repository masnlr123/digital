<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    protected $fillable = [
    	'account_team',
		'initiated_by',
		'transaction_type',
		'transaction_mode',
		'platform',
		'project',
		'date',
		'currency',
		'amount',
		'card_no',
		'card_holder',
		'transaction_verification',
		'document'
		];
}
