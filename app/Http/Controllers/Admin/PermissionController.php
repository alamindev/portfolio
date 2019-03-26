<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use DB;

class PermissionController extends Controller
{
    public $user_permission;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->user_permission =  get_permission_value('permissions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can(!empty($this->user_permission[2]))  && auth()->user()->hasRole('developer')) {
            return view('backend.auth.permissions.permissions');
        } else {
            return redirect()->back();
        }
    }
    /*
    * for get and show when login from developer account
    *
    */
    public function getPermissionByFilter()
    {
        $permission_all = [] ;
        $data  = Permission::latest()->get();
        foreach ($data as $value) {
            $explode_value =  explode('-', $value['name']);
            if (auth()->user()->hasRole('developer')) {
                $permission_all[] = $value;
            } else {
                if ($explode_value[1] !== 'permissions') {
                    $permission_all[] = $value;
                }
            }
        }
        return $permission_all;
    }
    /*
    * coding for data table value
    */
    public function getPermissionData()
    {
        $data  = $this->getPermissionByFilter();
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->setRowClass(function ($permission) {
                            return $permission->id % 2 == 0 ? 'alert-success' : 'alert-info';
                        })
                        ->setRowId(function ($permission) {
                            return $permission->id;
                        })
                        // ->setRowAttr(['align'=>'center'])
                        ->addColumn('manage', '
            <?php 
                $permission = get_permission_value("permissions"); 
                if(auth()->user()->can("$permission[3]")){
            ?>
        <a href="<?php echo route("permissions.show",$id);?>" class="btn btn-outline-purple waves-effect waves-info"><i class="fas fa-eye"></i></a>
        <?php
            }
            if(auth()->user()->can("$permission[4]")){
        ?> 
        <a href="<?php echo route("permissions.edit",$id);?>" class="btn btn-outline-success waves-effect waves-light"><i class="fas fa-edit"></i></a>
        <?php
            }
            if(auth()->user()->can("$permission[1]")){
         ?>

        <button id="delete"  type="button" class="btn btn-outline-danger waves-effect waves-light"
        data-remote="<?php echo route("permissions.destroy",$id);?>"><i
        class="fas fa-trash"></i></button>
        <?php
            }
        ?>
')
                        ->rawColumns(['manage'])
                        ->editColumn('created_at', function (permission $permission) {
                            return $permission->created_at;
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
        if (auth()->user()->can(!empty($this->user_permission[0]))  && auth()->user()->hasRole('developer')) {
            $tables = DB::select('SHOW TABLES');
            return view('backend.auth.permissions.add-permission', compact('tables'));
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
        if (auth()->user()->can(!empty($this->user_permission[0]))  && auth()->user()->hasRole('developer')) {
            $permissions = Permission::get();

            foreach ($permissions as $permission) {
                if ($permission->name == $request->name) {
                    toast('You Have already created permission on this Name!', 'error', 'top-right')->autoClose(5000);
                    return back();
                }
            }
    
            if ($request->permission_type == 'basic') {
                $this->validateWith([
                    'display_name' => 'required|max:255',
                    'name' => 'required|max:255|alphadash|unique:permissions,name',
                    'description' => 'sometimes|max:255',
                    'per_table' => 'required'
                ]);
    
                $permission = new Permission();
                $permission->name = $request->name;
                $permission->display_name = $request->display_name;
                $permission->description = $request->description;
                $permission->per_table = $request->per_table;
                $permission->save();
    
                toast(
                    'Successfully created the new ' . $permission->display_name . ' permission in the database!',
                    'success',
                    'top-right'
                )->autoClose(5000);
                return redirect()->route('permissions.index');
            } elseif ($request->permission_type == 'crud') {
                if (Permission::where('per_table', '=', $request->per_table)->exists()) {
                    toast('You Have already created permission on this table!', 'error', 'top-right')->autoClose(5000);
    
                    return back();
                } else {
                    $this->validateWith([
                        'table_name' => 'required|min:3|max:100|alpha',
                        'per_table' => 'required'
                    ]);
    
                    $crud = explode(',', $request->crud_selected);
                    if (count($crud) > 0) {
                        foreach ($crud as $x) {
                            $slug = strtolower($x) . '-' . strtolower($request->table_name);
                            $display_name = ucwords($x . " " . $request->table_name);
                            $description = "Allows a user to " . strtoupper($x) . ' a ' . ucwords($request->table_name);
    
                            $permission = new Permission();
                            $permission->name = $slug;
                            $permission->display_name = $display_name;
                            $permission->description = $description;
                            $permission->per_table = $request->per_table;
                            $permission->save();
                        }
                        toast(
                            'Successfully created the new ' . $permission->display_name . ' permission in the database!',
                            'success',
                            'top-right'
                        )->autoClose(5000);
                        return redirect()->route('permissions.index');
                    }
                }
            } else {
                return redirect()->route('permissions.create')->withInput();
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified information
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can(!empty($this->user_permission[3]))  && auth()->user()->hasRole('developer')) {
            $show = Permission::find($id);
            return view('backend.auth.permissions.view-permission', compact('show'));
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
        if (auth()->user()->can(!empty($this->user_permission[4])) && auth()->user()->hasRole('developer')) {
            $edit = Permission::find($id);
            $tables = DB::select('SHOW TABLES');
            return view('backend.auth.permissions.edit-permission', compact('edit', 'tables'));
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
        if (auth()->user()->can(!empty($this->user_permission[1])) && auth()->user()->hasRole('developer')) {
            $this->validateWith([
                'display_name' => 'required|max:255',
                'description' => 'sometimes|max:255'
            ]);
            $permission = Permission::findOrFail($id);
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            $permission->save();
    
            toast(
                'Successfully Updated the new ' . $permission->display_name . ' permission in the database!',
                'success',
                'top-right'
            )->autoClose(5000);
            return redirect()->route('permissions.show', $id);
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
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
        }
    }
}
