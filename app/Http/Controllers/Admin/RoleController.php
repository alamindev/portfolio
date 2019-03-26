<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Model\Admin\Permission;
use DB;

class RoleController extends Controller
{
    public $user_permission;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->user_permission =  get_permission_value('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can(!empty($this->user_permission[2]))) {
            return view('backend.auth.roles.roles');
        } else {
            return redirect()->back();
        }
    }
    /*
       * for get and show when login from developer account
       *
       */
    public function getRoleByFilter()
    {
        $role_all = [] ;
        $data  = Role::latest()->get();
        foreach ($data as $value) {
            if (auth()->user()->hasRole('developer')) {
                $role_all[] = $value;
            } else {
                if ($value['name'] !== 'developer') {
                    $role_all[] = $value;
                }
            }
        }
        return $role_all;
    }
    public function getRoleData()
    {
        $data  = $this->getRoleByFilter();
        return DataTables::of($data)
                        ->setRowClass(function ($role) {
                            return $role->id % 2 == 0 ? 'alert-success' : 'alert-info';
                        })
                        ->setRowId(function ($role) {
                            return $role->id;
                        })
                        // ->setRowAttr(['align'=>'center'])
                        ->addColumn('manage', '
                     <?php 
                        $permission = get_permission_value("roles"); 
                        if(auth()->user()->can("$permission[3]")){
                    ?>
                        <a href="<?php echo route("roles.show",$id);?>" class="btn btn-outline-purple waves-effect waves-info"><i
                            class="fas fa-eye"></i></a>
                      <?php
                            }
                            if(auth()->user()->can("$permission[4]")){
                        ?> 
                    <a href="<?php echo route("roles.edit",$id);?>" class="btn btn-outline-success waves-effect waves-light"><i
                        class="fas fa-edit"></i></a>
                         <?php
            }
            if(auth()->user()->can("$permission[1]")){
         ?>
    <button id="delete"  type="button" class="btn btn-outline-danger waves-effect waves-light"
    data-remote="<?php echo route("roles.destroy",$id);?>"><i
       class="fas fa-trash"></i></button>
         <?php
            }
        ?>
')
                        ->rawColumns(['manage'])
                        ->editColumn('created_at', function (Role $role) {
                            return $role->created_at;
                        })
                        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can(!empty($this->user_permission[0]))) {
            $permissions = Permission::all();
            $view_tables = DB::table('view_tables')->get();
            $tables = DB::select('SHOW TABLES');
            return view('backend.auth.roles.add-role', compact('permissions', 'view_tables', 'tables'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can(!empty($this->user_permission[0]))) {
            $this->validateWith([
                'display_name' => 'required|max:255',
                'name' => 'required|max:100|alpha_dash|unique:roles',
                'description' => 'sometimes|max:255'
              ]);
        
            $role = new Role();
            $role->display_name = $request->display_name;
            $role->name = $request->name;
            $role->description = $request->description;
            $role->save();
        
            if ($request->permission) {
                $role->syncPermissions($request->permission);
            }
            toast('Successfully created the new '. $role->display_name . ' role in the database!', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('roles.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can(!empty($this->user_permission[3]))) {
            $show = Role::where('id', $id)->first();
            if ($show) {
                $show = Role::where('id', $id)->with('permissions', 'users')->first();
                return view('backend.auth.roles.view-role')->withShow($show);
            } else {
                return redirect()->route('roles.index');
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can(!empty($this->user_permission[4]))) {
            $role = Role::where('id', $id)->first();
            if ($role) {
                $edit = Role::where('id', $id)->with('permissions')->first();
                $permissions = Permission::all();
                $view_tables = DB::table('view_tables')->get();
                $tables = DB::select('SHOW TABLES');
                return view('backend.auth.roles.edit-role', compact('view_tables', 'tables'))->withEdit($edit)->withPermissions($permissions);
            } else {
                return redirect()->route('roles.index');
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can(!empty($this->user_permission[4]))) {
            $this->validateWith([
                'display_name' => 'required|max:255',
                'description' => 'sometimes|max:255'
              ]);
        
            $role = Role::findOrFail($id);
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->save();
        
            if ($request->permission) {
                $role->syncPermissions($request->permission);
            }
            toast('Successfully update the '. $role->display_name . ' role in the database.', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('roles.show', $id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Role::where('id', $id)->first();
        if ($destroy) {
            $destroy->delete();
            return redirect()->route('roles.index');
        }
    }
    /**
    * store database table name which you can permission give
    * @param init $id
    * @return Illuminate\Http\Request  $request
    */
    public function showPermission(Request $request)
    {
        $request->validate([
        'per_table' => 'required',
        ], [
          'per_table.required' => 'Please Select A Table :)-',
        ]);
        if (DB::table('view_tables')->where('t_name', '=', $request->per_table)->exists()) {
            toast('You Have already created permission on this table!', 'error', 'top-right')->autoClose(5000);
            return back();
        } else {
            $per = DB::table('view_tables')->insert([
                't_name' => $request->per_table
            ]);
            toast('Table Name Inserted Successfully Complated!', 'success', 'top-right')->autoClose(5000);
            if ($request->edit_role != '') {
                return redirect()->route('roles.edit', $request->edit_role);
            } else {
                return redirect()->route('roles.create');
            }
        }
    }
}
