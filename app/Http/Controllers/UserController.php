<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\RegisterRequest;

use App\Lead;
use App\Activity;
use App\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendLead;
use Auth;
use DB;
use DataTables;
use Redirect;
use Validator;
use Response;

class UserController extends Controller
{
    //

    public function datatables()
    {
         $datas = User::orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->addColumn('role', function(User $data) {
                switch ($data->role_id) {
                    case '1':
                    $role_name = 'Super Admin';
                    break;
                    case '2':
                    $role_name = 'Admin';
                    break;
                    case '3':
                    $role_name = 'Approval Team';
                    break;
                    case '4':
                    $role_name = 'Creative Team';
                    break;
                    case '5':
                    $role_name = 'Paid Team';
                    break;
                    case '6':
                    $role_name = 'LMS Team';
                    break;
                    case '7':
                    $role_name = 'SEO Team';
                    break;
                    case '8':
                    $role_name = 'Web Team';
                    break;
                    case '9':
                    $role_name = 'Gobrand360';
                    break;
                    case '10':
                    $role_name = 'Astra Communications';
                    break;
                    case '11':
                    $role_name = 'Lead Audit Team';
                    break;
                    case '12':
                    $role_name = 'Content Team';
                    break;
                    case '15':
                    $role_name = 'Agency';
                    break;
                    case '16':
                    $role_name = 'Business Intelligence Team';
                    break;
                    case '17':
                    $role_name = 'View Only Media Plan';
                    break;
                }
                return $role_name;
            })
            ->addColumn('status', function(User $data) {
                switch ($data->status) {
                    case '1':
                    $status_name = 'Active';
                    break;
                    case '0':
                    $status_name = 'Inactive';
                    break;
                    case NULL:
                    $status_name = 'Not Defined';
                    break;
                }
                return $status_name;
            })
            ->addColumn('action', function(User $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_user',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                $action .= '<form class="d-inline" action="' . route('delete_user',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_user',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                return $action;
            })
            ->rawColumns(['status', 'role', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }


    public function index(Request $request){
        // $users = '';
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }

        if($user->role_id == '1' || $user->role_id == '2'){
            $users = User::all();
        }
        else{
            abort('404');
        }
        


        return view('user.index', compact(array(
            'users'
        )));
    }
    public function all(){

        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        return view('user.index', compact(array(
            'users', 
            'user',
        )));
    }

    public function index_json()
    {

        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/login');
        }
        $users = User::all();

        $res_arrays = 
        array (
          'meta' => 
          array (
            'page' => 1,
            'pages' => 1,
            'perpage' => -1,
            'total' => $users->count(),
            'sort' => 'asc',
            'field' => 'id',
          ),
          'data' => $users,
        );
        return Response::json($res_arrays, 200, array(), JSON_PRETTY_PRINT);
    }

    public function new_user(){
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        return view('user.new', compact(array(
            'user'
        )));
    }
    public function edit($id){
        $user = User::find($id);
        if(Auth::check()){
            $logged_user = Auth::user();
        }else{
            return redirect('/');
        }
        $dst_managers = User::where('role_id', '3')->get();
        $cp_managers = User::where('role_id', '5')->get();
        return view('user.edit', compact(array(
            'logged_user', 
            'user',
            'dst_managers',
            'cp_managers',
        )));
    }
    public function profile($id){
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        return view('user.profile', compact(array(
            'user'
        )));
    }
    public function activity($id){
        if(Auth::check()){
            $user = Auth::user();
        }else{
            return redirect('/');
        }
        $activity = Activity::where('created_by', $user->name)->get();
        return view('user.activity', compact(array(
            'user',
            'activity'
        )));
    }
    public function store(Request $request){

        $validator_email = Validator::make($request->all(), [
            'email' => 'unique:users,email',
        ]);
        if ($validator_email->fails()) {
            return Redirect::back()->with('danger', 'Email already exists!.')->withInput();
        }
        $validator_contact = Validator::make($request->all(), [
            'contact' => 'unique:users,contact',
        ]);
        if ($validator_contact->fails()) {
            return Redirect::back()->with('danger', 'Contact Number already exists!.')->withInput();
        }
        
        $new_user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'contact' => $request->contact,
            'status' => $request->status,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);
        $new_user->save();
        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'general',
            'model' => 'User',
            'description' => 'The User - ( '.$new_user->name.' ) Has been Created successfuly',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return redirect('/users')->with('success', 'New User has beed created successfully!');
    }

    public function update(Request $request, $id){
        $address_proof_location = '';
        $update_user = User::find($id);

        $update_user->name = $request->name;
        $update_user->email = $request->email;
        $update_user->contact = $request->contact;
        $update_user->address = $request->address;
        $update_user->role_id = $request->role_id;
        $update_user->status = $request->status;
        $update_user->password = Hash::make($request->password);
        $update_user->save();
        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'general',
            'model' => 'User',
            'description' => 'The User - ( '.$update_user->name.' ) Has been Updated successfuly',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return redirect('/users')->with('success', 'The User has beed Updated successfully!');
    }

    public function update_profile(Request $request, $id){
        $update_user = User::find($id);

        $update_user->name = $request->name;
        $update_user->email = $request->email;
        $update_user->contact = $request->contact;
        $update_user->address = $request->address;
        $update_user->status = $request->status;
        $update_user->gsuite_password = $request->gsuite_password;
        if(isset($request->password)){
            $update_user->password = Hash::make($request->password);
        }
        if(isset($request->photo)){
            $image = $request->file('photo');
            $directory = "storage/profiles";
            if(!is_dir($directory)){
                mkdir($directory, 755, true);
            }
            $new_name = $image->getClientOriginalName();
            // $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move($directory, $new_name);
            $location = $directory.'/'.$new_name;
            $update_user->photo = $location;
        }
        $update_user->save();
        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'general',
            'model' => 'User',
            'description' => 'The User - ( '.$update_user->name.' ) Has been Updated successfuly',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        return Redirect::back()->with('success', 'The Profile Information has beed Updated successfully!');
    }

    public function register(Request $request){

        $validator_email = Validator::make($request->all(), [
            'email' => 'unique:users,email',
        ]);
        if ($validator_email->fails()) {
            return redirect('/login?type=register')->with('danger', 'Email already exists!.')->withInput();
        }
        $validator_contact = Validator::make($request->all(), [
            'contact' => 'unique:users,contact',
        ]);
        if ($validator_contact->fails()) {
            return redirect('/login?type=register')->with('danger', 'Contact Number already exists!.')->withInput();
        }
        $reg_req = RegisterRequest::where('request_id', $request->request_id)->first();

        if($reg_req){
            $register_role_id = $reg_req->role_id;
            if($reg_req->dst_manager_id){
                $register_dst_manager_id = $reg_req->dst_manager_id;
            }
            else{
                $register_dst_manager_id = '';
            }
            if($reg_req->cp_manager_id){
                $register_cp_manager_id = $reg_req->cp_manager_id;
            }
            else{
                $register_cp_manager_id = '';
            }
            $reg_req->status ='closed';
            $reg_req->save();
            
        }
        else{
            return redirect('/login?type=register')->with('danger', 'Your Register Request ID not matched!. Please enter the correct One!.')->withInput();
        }

        $address_proof_location = '';
        $address_proof_dir = 'storage/users/address_proof';
        if(!is_dir($address_proof_dir)){
            mkdir($address_proof_dir, 755, true);
        }
        $address_proof_file = $request->file('address_proof');
        if($address_proof_file){
            $address_proof_newname = $address_proof_file->getClientOriginalName();
            $address_proof_file->move($address_proof_dir, $address_proof_newname);
            $address_proof_location = $address_proof_dir.'/'.$address_proof_newname;
        }
        $new_user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $register_role_id,
            'dst_manager_id' => $register_dst_manager_id,
            'cp_manager_id' => $register_cp_manager_id,
            'contact' => $request->contact,
            'address' => $request->address,
            'address_proof' => $address_proof_location,
            'date_of_join' => $request->date_of_join,
            'status' => 0,
            'password' => Hash::make($request->password),
            'created_time' => date('Y-m-d H:i:s')
        ]);
        $new_user->save();
        $activity_log = new Activity([
            'name' => 'general',
            'model' => 'User',
            'description' => 'The User - ( '.$new_user->name.' ) Has been Created successfuly',
            'created_by' => 'Registration Form',
        ]);
        $activity_log->save();
        return redirect('/login?type=login')->with('success', 'Your Account has beed Created successfully!');
    }

    // public function profile($id){
    //     if(Auth::check()){
    //         $user = Auth::user();
    //     }else{
    //         return redirect('/');
    //     }
    // 	$settings = Setting::all();
    // 	$activity = Activity::all();

    //     return view('user.profile', compact(array(
    //     	'ctivity', 
    //     	'user', 
    //     	'settings'
    //     )));
        
    // }

    public function delete($id)
    {
        $delete_user = User::find($id);
        $user = Auth::user();
        $activity_log = new Activity([
            'name' => 'general',
            'model' => 'User',
            'description' => 'The User - ( '.$delete_user->name.' ) Has been Deleted successfuly',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
        $delete_user->delete();
        return redirect('/users')->with('success', 'The User has been deleted successfuly.');
    }
}
