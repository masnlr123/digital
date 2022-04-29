<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeadAudit;
use App\Activity;
use Illuminate\Support\Facades\Mail;
use Auth;
use DataTables;
use DB;
use Redirect;
use App\User;
use App\Projects;
use App\Campaigns;
use Validator;
use App\Imports\LeadAuditImport;
use Maatwebsite\Excel\Facades\Excel;

class LeadAuditController extends Controller
{

    //*** JSON Request
    public function datatables()
    {
         $datas = LeadAudit::orderBy('id','desc')->get();
         return DataTables::of($datas)
                            // ->addColumn('status', function(LeadAudit $data) {
                            //     $class = $data->status == 1 ? 'drop-success' : 'drop-danger';
                            //     $s = $data->status == 1 ? 'selected' : '';
                            //     $ns = $data->status == 0 ? 'selected' : '';
                            //     return '<div class="action-list"><select class="process select droplinks '.$class.'"><option data-val="1" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 1]).'" '.$s.'>Activated</option><option data-val="0" value="'. route('admin-brand-status',['id1' => $data->id, 'id2' => 0]).'" '.$ns.'>Deactivated</option>/select></div>';
                            // })
                            ->addColumn('action', function(LeadAudit $data) {
                                return '<div class="action-list d-inline-flex"><a data-href="' . route('edit_creative_task',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>
                                <form class="d-inline" action="' . route('delete_creative',$data->id) . '" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button title="Delete details" 
                                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                                href="' . route('delete_creative',$data->id) . '">
                                <i class="flaticon2-trash"></i>
                                </button>
                                </form>';
                            })
                            ->rawColumns(['action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    
    public function index(){
    	$audits = LeadAudit::paginate(500)->sortByDesc("id");
        $current_user = Auth::user();
        return view('task.lead_audits.index', compact(array('audits', 'current_user')));
    }
    public function import(Request $request){
    	$validator = Validator::make($request->all(),[
    		'leads_csv' => 'required|mimes:csv,txt'
    	]);
    	$dataTime = date('Ymd_His');
    	$leads = $request->file('leads_csv');
  //   	$leads_file_new_name = $dataTime.'_'.$leads->getClientOriginalName();

		// $year = date("Y");
		// $month = date("m");
		// $save_directory = "storage/creatives/$year/$month";
		// if(!is_dir($save_directory)){
		//     mkdir($save_directory, 755, true);
		// }
		// $leads->move($save_directory, $leads_file_new_name);
    	// if($validator->passes()){
    	// 	return Redirect::back()->with('file_upload_success', 'File added successfuly');
    	// }
    	// else{
    	// 	return Redirect::back()->with(['file_upload_error' => $validator->errors()->all()]);
    	// }
    	Excel::import(new LeadAuditImport, $leads);
    	return Redirect::back()->with('leads_added','The Lead Audits List Uploaded Successful !');
    	
    }
    public function edit(){
    	
    }
    public function update(){
    	
    }
    public function delete(){
    	
    }
}
