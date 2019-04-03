<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables; 
use App\Model\Admin\UserContact;
class UserContactController extends Controller
{
    public $user_permission;
    public function __construct()
    {
        $this->middleware('auth:admin')->except('create','store');
        $this->user_permission =  get_permission_value('socials');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if (auth()->user()->can('index-user_contacts')) {
            return view('backend.user-contact.user-contact');
        } else {
            return redirect()->back();
        }
    }
    public function getuserContactByFilter()
    {
        $userContact_all = [];
        $data  = UserContact::where('deleted_at',null)->latest()->get();
        foreach ($data as $value) {
            if (auth()->user()->hasRole('developer')) {
                $userContact_all[] = $value;
            } else {
                if ($value['user_name'] !== 'developer') {
                    $userContact_all[] = $value;
                }
            }
        }
        return $userContact_all;
    }
    public function getContactData()
    {
        $data  = $this->getuserContactByFilter();
        return DataTables::of($data)
            ->setRowClass(function ($data) {
                return $data->id % 2 == 0 ? 'alert-success' : 'alert-info';
            })
            ->setRowId(function ($data) {
                return $data->id;
            })
            // ->setRowAttr(['align'=>'center'])
            ->addColumn('manage', '
                <?php 
                    $permission = get_permission_value("user_contacts"); 
                    if(auth()->user()->can("$permission[2]")){
                        ?>
                        <a href="<?php echo route("user-contact.show",$id);?>" class="btn btn-outline-purple waves-effect waves-info"><i
                                class="fas fa-eye"></i></a>
                        <?php
                            } 
                            if(auth()->user()->can("$permission[0]")){
                        ?>
                        <button id="delete" type="button" class="btn btn-outline-danger waves-effect waves-light"
                            data-remote="<?php echo route("user-contact.destroy",$id);?>">
                            <i= class="fas fa-trash"></i>
                        </button>
                        <?php
                        }
                        ?>
')
->rawColumns(['manage']) 
->editColumn('created_at', function (UserContact $UserContact) {
    return $UserContact->created_at;
})
->toJson();
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {   
            $this->validate($request, [
                'name' => 'required', 
                'email' => 'required|email', 
                'subject' => 'required', 
                'details' => 'required', 
            ]); 
            $userContact = new UserContact(); 
            $userContact->name = $request->name; 
            $userContact->email = $request->email; 
            $userContact->subject = $request->subject; 
            $userContact->details = $request->details; 
            $userContact->save(); 
            return response()->json(['message'=>'Success: Message Send Success Fully.']); 
    }

    /**
    * Display the specified resource.
    *
    * @param \App\Mode\Admin\Social $portfolio
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        if (auth()->user()->can('read-user_contacts')) {
            $show = UserContact::where('deleted_at', null)->where('id',$id)->first();
            return view('backend.user-contact.view-user-contact', compact('show'));
        } else {
            return redirect(route('user-contact.index'));
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Mode\Admin\Social $powerPlant
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    { 
            return redirect(route('user-contact.index')); 
    }


    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Mode\Admin\Social $portfolio
    * @return \Illuminate\Http\Response and id
    */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('update-socials')) {
            $this->validate($request, [
                'icon' => 'required',
                'link' => 'required|url', 
                'background' => 'required',
                'color' => 'required',
                'hover_color' => 'required',
                'hover_background' => 'required',
                'font_size' => 'required|integer',
            ]); 
            $social = Social::find($id);
            $social->icon = senitizeIconData($request->icon);
            $social->link = $request->link;
            $social->background = $request->background;
            $social->color = $request->color;
            $social->hover_color = $request->hover_color;
            $social->hover_background = $request->hover_background;
            $social->font_size = $request->font_size;
            $social->save();
            toast('Successfully Updated Social Icon', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('user-contact.index');
        } else {
            return redirect(route('user-contact.index'));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param \App\social $social
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $social = Social::where('deleted_at',null)->find($id);
        if ($social) {
            $social->delete();
        }
    }
}
