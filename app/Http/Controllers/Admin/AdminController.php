<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin;
use App\Model\Admin\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Image;
use App\Model\Admin\Role;

class AdminController extends Controller
{
    public $user_permission;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->user_permission =  get_permission_value('admins');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can(!empty($this->user_permission[2]))) {
            return view('backend.auth.admins.admins');
        } else {
            return redirect()->back();
        }
    }
    public function getAdminByFilter()
    {
        $admin_all = [] ;
        $data  = Admin::with('roles')->latest()->get();
        foreach ($data as $value) {
            if (auth()->user()->hasRole('developer')) {
                $admin_all[] = $value;
            } else {
                if ($value['user_name'] !== 'developer') {
                    $admin_all[] = $value;
                }
            }
        }
        return $admin_all;
    }
    public function getData()
    {
        $data  = $this->getAdminByFilter();
        return DataTables::of($data)
                        ->setRowClass(function ($user) {
                            return $user->id % 2 == 0 ? 'alert-success' : 'alert-info';
                        })
                        ->setRowId(function ($user) {
                            return $user->id;
                        })
                        // ->setRowAttr(['align'=>'center'])
                        ->addColumn('manage', '
                <?php 
                    $permission = get_permission_value("admins"); 
                    if(auth()->user()->can("$permission[3]")){
                ?>
                    <a href="<?php echo route("admins.show",$id);?>" class="btn btn-outline-purple waves-effect waves-info"><i
                        class="fas fa-eye"></i></a>
                <?php
                    }
                    if(auth()->user()->can("$permission[4]")){
                ?> 
                     <a href="<?php echo route("admins.edit",$id);?>" class="btn btn-outline-success waves-effect waves-light"><i class="fas fa-edit"></i></a>
                <?php
                    }
                    if(auth()->user()->can("$permission[1]")){
                 ?>
                    <button id="delete"  type="button" class="btn btn-outline-danger waves-effect waves-light" data-remote="<?php echo route("admins.destroy",$id);?>"><i= class="fas fa-trash"></i></button>
                <?php
                }
                ?>
')
                        ->rawColumns(['manage'])
                        ->addColumn('roles', function ($user) {
                            return $user->roles->count() ?
                            implode(', ', $user->roles->pluck('name')->toArray()) :
                            '';
                        })
                        ->editColumn('created_at', function (Admin $admin) {
                            return $admin->created_at;
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
            $roles = Role::get();
            return view('backend.auth.admins.add-admin', compact('roles'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can(!empty($this->user_permission[0]))) {
            $this->validateWith([
                'user_name' => 'required|unique:admins|max:255',
                'email' => 'required|email|unique:admins',
                'password' => 'required|string|min:6|confirmed',
                'roles' => 'required',
            ]);
            $admin = new Admin();
            $admin->user_name = $request->user_name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->save();
            if ($request->roles) {
                $admin->syncRoles($request->roles);
            }
            toast(
                'User Created Successfully Completed!',
                'success',
                'top-right'
            )->autoClose(5000);
            return redirect()->route('admins.index');
        } else {
            return redirect()->back();
        }
    }
 

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can(!empty($this->user_permission[3]))) {
            $show = Admin::with('roles')->find($id);
            return view('backend.auth.admins.view-admin', compact('show'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->can(!empty($this->user_permission[4]))) {
            $edit = Admin::find($id);
            $roles = Role::get();
            return view('backend.auth.admins.edit-admin', compact('edit', 'roles'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can(!empty($this->user_permission[4]))) {
            $this->validateWith([
                'user_name' => 'required|unique:admins,user_name,' . $id,
                'roles' => 'required',
                'email' => 'required|email|unique:admins,email,' . $id,
            ]);
            $admin = Admin::findOrFail($id);
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->user_name = $request->user_name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            if ($request->new_password == 'manual') {
                $admin->password = Hash::make($request->password);
            }
            $admin->save();
    
            $admin->syncRoles($request->roles);
            toast('User updated Success!', 'success', 'top-right');
            return redirect()->route('admins.index');
        } else {
            return redirect()->back();
        }
    }

    public function uploadAvater(Request $request)
    {
        $admin = Admin::where('id', $request->user_id)->first();
        if ($admin->id == $request->user_id) {
            $file = $request->photo;
            $count = strlen($file);
            if ($count <= 5000) {
                return ['errors' => 'Please Select An Image and must Jpeg,jpg,png'];
            } else {
                $explode_file = explode(',', $file);
                $decode = base64_decode($explode_file[1]);
                if (str_contains($explode_file[0], 'jpeg')) {
                    $extension = 'jpg';
                } else {
                    $extension = 'png';
                }
                if ($admin->photo === 'photo') {
                    $fileName = 'avater' . str_random() . '.' . $extension;
                    $images = Image::make($decode);
                    $fileName = 'avater_' . str_random() . '.' . $extension;
                    $images->save('uploads/avaters/' . $fileName);
                    $admin->update(['photo'=> $fileName]);
                } else {
                    $fileName = 'avater' . str_random() . '.' . $extension;
                    $images = Image::make($decode);
                    $fileName = 'avater_' . str_random() . '.' . $extension;
                    $file_path = $admin->photo;
                    $storage_path = 'uploads/avaters/' . $file_path;
                    if (\File::exists($storage_path)) {
                        unlink($storage_path);
                    }
                    $admin->update(['photo'=> $fileName]);
                    $images->save('uploads/avaters/' . $fileName);
                }
                return ['success' => 'Avater Updated Successfull!'];
            }
        }
    }
    public function getImg($id)
    {
        return Admin::where('id', $id)->select('id', 'photo')->first();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $file_path = $admin->photo;
            if ($file_path != 'photo') {
                $storage_path = 'uploads/avaters/' . $file_path;
                if (\File::exists($storage_path)) {
                    unlink($storage_path);
                }
            }
            $admin->delete();
        }
    }
}
