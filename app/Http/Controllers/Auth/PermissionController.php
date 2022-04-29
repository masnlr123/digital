<?php

namespace App\Http\Controllers\Auth;

use Spatie\Permission\Models\Permission;
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
class PermissionController extends Controller
{


    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */


    public function datatables()
    {

        $datas = Permissions::orderBy('id','desc')->get();
         return DataTables::of($datas)
            ->addColumn('action', function(Permissions $data) {
                $action = '<div class="action-list d-inline-flex">';
                $action .= '<a href="' . route('edit_permissions',$data->id) . '" class="btn btn-sm btn-info btn-icon btn-icon-sm kt-mr-5"> <i class="fas fa-edit"></i></a>';
                $action .= '<form class="d-inline" action="' . route('delete_permissions',$data->id) . '" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <button title="Delete details" 
                class="btn btn-sm btn-danger btn-icon btn-icon-sm" 
                href="' . route('delete_permissions',$data->id) . '">
                <i class="flaticon2-trash"></i>
                </button>
                </form>';
                return $action;
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        $roles = Role::all();

        // return view('auth.permissions.index', compact(array(
        //     'roles', 
        //     'creative_users', 
        //     'settings', 
        //     'users', 
        //     'user', 
        //     'all_creative_task',
        // )));
        return view('auth.permissions.index');
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create($request)
    {
        return view('auth.permissions.create');
    }
    public function edit($id)
    {
        $permissions = Permissions::all();
        $role = Permissions::find($id);
        return view('auth.permissions.edit', compact(array(
            'role',
            'permissions'
        )));
    }

    public function store(Request $request){
        $permission = new Permissions([
            'name' => $request->get('name'),
            'guard_name' => $request->get('guard_name')
        ]);
        $permission->save();
        // Permission::create([$request->get('name'), $request->get('guard_name')]);
        // $permission = Permission::create(['name' => $request->get('name')]);
        return redirect('/permissions')->with('success', 'User Permissions has been created successfully!');
    }

    public function update(Request $request, $id)
    {
        $role = Permissions::find($id);
        $role->name = $request->get('name');
        $role->save();
        return redirect('/permissions')->with('success', 'User Permissions has been updated successfully!');
    }

    public function destroy($id)
    {

    }

}
