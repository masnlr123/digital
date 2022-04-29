<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
	protected $table = 'campaigns';
    protected $fillable = [
    	'name',
		'project',
		'channel',
		'channels',
		'about_camp',
		'channel',
		'type',
		'person',
		'status',
		'source',
		'creative_count',
		'target_audience',
		'budget_cost',
		'base_price',
		'start_date',
		'end_date',
		'metrix',
		'month',
		'actuals',
		'actual_cost',
		'valid_leads',
		'actual_leads_count',
		'invalid_leads_count',
		'expected_site_visit_count',
		'sales_count',
		'expected_sor',
		'actual_sor',
		'assigned_to',
		'expected_close_date',
		'created_by',
		'created_time',
		'description',
		'created_at',
		'updated_at',
		'deleted_at'     
    ];

    public function creative_task() {     
		return $this->belongsTo('CreativeTask::class');
	}
    public function ad_campaigns() {     
        return $this->hasMany('App\AdCampaigns', 'campaign_id', 'id');
	}
	public function ind_money($money){

            $decimal = (string)($money - floor($money));
            $money = floor($money);
            $length = strlen($money);
            $m = '';
            $money = strrev($money);
            for($i=0;$i<$length;$i++){
                if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                    $m .=',';
                }
                $m .=$money[$i];
            }
            $result = strrev($m);
            $decimal = preg_replace("/0\./i", ".", $decimal);
            $decimal = substr($decimal, 0, 3);
            if( $decimal != '0'){
            $result = $result.$decimal;
            }
            return $result;
        }
	public function getPercentageChange($oldNumber, $newNumber){
            $decreaseValue = $oldNumber - $newNumber;
            
            if( $oldNumber==0 || $oldNumber==null){
            $oldNumber=1;
            }
            else{
            $oldNumber=$oldNumber;
            }
    		return ($decreaseValue /$oldNumber) * 100;
        }
    public function convertCurrency($number)
		{
		    // Convert Price to Crores or Lakhs or Thousands
		    $length = strlen($number);
		    $currency = '';

		    if($length == 4 || $length == 5)
		    {
		        // Thousand
		        $number = $number / 1000;
		        $number = round($number,2);
		        $ext = "K";
		        $currency = $number." ".$ext;
		    }
		    elseif($length == 6 || $length == 7)
		    {
		        // Lakhs
		        $number = $number / 100000;
		        $number = round($number,2);
		        $ext = "L";
		        $currency = $number." ".$ext;

		    }
		    elseif($length == 8 || $length == 9)
		    {
		        // Crores
		        $number = $number / 10000000;
		        $number = round($number,2);
		        $ext = "Cr";
		        $currency = $number.' '.$ext;
		    }

		    return $currency;
		}
}
