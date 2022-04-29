<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityTypes;
use App\Projects;
use App\Activity;
use Auth;
use DB;
use DataTables;
use Redirect;
use App\User;
use Validator;

class ActivityTypesController extends Controller
{
     //*** JSON Request
    public function datatables()
    {
         $datas = ActivityTypes::orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->addColumn('action', function(ActivityTypes $data) {
                $action = '<div class="action-list d-inline-flex">';
                if($data->document){
                $action .= '<a href="' . $data->document . '" class="btn btn-sm btn-success btn-icon btn-icon-sm kt-mr-5" target="_blank"> <i class="fas fa-download"></i></a>';
                    
                }                
                $action .= '<a href="' . route('edit_activity_types',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-eye"></i></a>';
                $action .= '<form class="d-inline" action="' . route('delete_activity_types',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_activity_types',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                return $action;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        $current_user = Auth::user();
        $activity_types = ActivityTypes::all();
        return view('admin.activity_types.index', compact(array('activity_types', 'current_user')));
    }
    public function create()
    {
        //
        $projects = Projects::all();
        return view('admin.activity_types.create', compact(array('projects')));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $store_exp = new ActivityTypes($request->all());
        $store_exp->save();

        $doc_location = '';

        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $doc_dir = "storage/exp/samples/$year/$month";
        // $doc_dir = 'storage/exp';
        if(!is_dir($doc_dir)){
            mkdir($doc_dir, 755, true);
        }
        $doc_file = $request->file('document');
        if($doc_file){
            $doc_newname = $doc_file->getClientOriginalName();
            $doc_file->move($doc_dir, $doc_newname);
            $doc_location = $doc_dir.'/'.$doc_newname;
        }
        $store_exp->document = $doc_location;
        $store_exp->save();

        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'ActivityTypes',
            'model_id' => $store_exp->id,
            'description' => 'The ActivityTypes Has been created!',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return redirect('/activity_types')->with('success', 'Creative task saved!');
    }

    public function edit($id)
    {
        $activity_types = ActivityTypes::find($id);
        $activity = Activity::where('model', 'ActivityTypes')->where('model_id', $activity_types->id)->get();
        return view('admin.activity_types.edit', compact(array('activity_types','activity')));    
    }

    public function update(Request $request, $id)
    {   
        $user = Auth::user();
        $c_task = ActivityTypes::find($id);


        $doc_location = '';
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $doc_dir = "storage/exp/$year/$month";
        // $doc_dir = 'storage/exp';
        if(!is_dir($doc_dir)){
            mkdir($doc_dir, 755, true);
        }
        $doc_file = $request->file('document');
        if($doc_file){
            $doc_newname = $doc_file->getClientOriginalName();
            $doc_file->move($doc_dir, $doc_newname);
            $doc_location = $doc_dir.'/'.$doc_newname;
        }
        $c_task->document = $doc_location;
		$c_task->account_team = $request->get('account_team');
		$c_task->initiated_by = $request->get('initiated_by');
		$c_task->transaction_type = $request->get('transaction_type');
		$c_task->transaction_mode = $request->get('transaction_mode');
		$c_task->platform = $request->get('platform');
		$c_task->project = $request->get('project');
		$c_task->date = $request->get('date');
		$c_task->currency = $request->get('currency');
		$c_task->amount = $request->get('amount');
		$c_task->card_no = $request->get('card_no');
		$c_task->card_holder = $request->get('card_holder');
		$c_task->transaction_verification = $request->get('transaction_verification');
		// $c_task->document = $request->get('document');
		// $c_task = $request->document;
        // $c_task = $request->all();
        $c_task->save();


        $activity_log = new Activity([
            'name' => 'Create',
            'model' => 'ActivityTypes',
            'model_id' => $c_task->id,
            'description' => 'The ActivityTypes details updated by'.$user->name,
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return Redirect::back()->with('creative_added','Updated Successfully!');
    }

    public function destroy($id)
    {
        $cre_task = ActivityTypes::find($id);
        $cre_task->delete();
        return redirect('/activity_types')->with('success', 'Task deleted!');
    }
}
