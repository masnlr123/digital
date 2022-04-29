<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\Role;
use App\Models\Auth\Permissions;
use App\Http\Controllers\Controller;
use DataTables;
use Redirect;
use Illuminate\Http\Request;
use App\User;
use App\Activity;
use App\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Validator;
use Response;

/**
 * Class RoleController.
 */
class RoleController extends Controller
{


    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */


    public function datatables()
    {

        $datas = Role::orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->addColumn('action', function(Role $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_role',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                if(in_array(Auth::user()->role_id, array('1', '2'))):
                $action .= '<form class="d-inline" action="' . route('delete_role',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_role',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                endif;
                return $action;
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        $roles = Role::all();

        // return view('auth.role.index', compact(array(
        //     'roles', 
        //     'creative_users', 
        //     'settings', 
        //     'users', 
        //     'user', 
        //     'all_creative_task',
        // )));
        return view('auth.role.index');
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create($request)
    {
        return view('auth.role.create');
    }
    public function edit($id)
    {
        $permissions = Permissions::all();
        $role = Role::find($id);
        return view('auth.role.edit', compact(array(
            'role',
            'permissions'
        )));
    }

    public function store(Request $request){
        $role = new Role([
            'name' => $request->get('name'),
            'guard_name' => $request->get('guard_name')
        ]);
        $role->save();
        return Redirect::back()->with('success', 'User Role has been created successfully!');
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->get('name');
        foreach($request->get('permissions') as $permission){
            $role->givePermissionTo($permission);
        }
        $role->save();
        return view('auth.role.index')->with('success', 'User Role has been updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::where('id', $id)->first();
        if ($role != null) {
            $role->delete();
        }
        return redirect('/role')->with('success', 'Role deleted!');
    }

}
