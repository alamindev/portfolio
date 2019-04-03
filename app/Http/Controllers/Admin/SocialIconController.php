<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables; 
use App\Model\Admin\Social;

class SocialIconController extends Controller
{
    public $user_permission;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->user_permission =  get_permission_value('socials');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can(!empty($this->user_permission[2]))) {
            return view('backend.socials.socials');
        } else {
            return redirect()->back();
        }
    }
    public function getSocialByFilter()
    {
        $social_all = [];
        $data  = Social::latest()->get();
        foreach ($data as $value) {
            if (auth()->user()->hasRole('developer')) {
                $social_all[] = $value;
            } else {
                if ($value['user_name'] !== 'developer') {
                    $social_all[] = $value;
                }
            }
        }
        return $social_all;
    }

    public function getSocialData()
    {
        $data  = $this->getSocialByFilter();
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
                    $permission = get_permission_value("socials"); 
                    if(auth()->user()->can("$permission[3]")){
                        ?>
                        <a href="<?php echo route("social-icon.show",$id);?>" class="btn btn-outline-purple waves-effect waves-info"><i
                                class="fas fa-eye"></i></a>
                        <?php
                            }
                            if(auth()->user()->can("$permission[4]")){
                        ?>
                            <a href="<?php echo route("social-icon.edit",$id);?>" class="btn btn-outline-success waves-effect waves-light"><i
                                    class="fas fa-edit"></i></a>
                            <?php
                            }
                            if(auth()->user()->can("$permission[1]")){
                        ?>
                        <button id="delete" type="button" class="btn btn-outline-danger waves-effect waves-light"
                            data-remote="<?php echo route("social-icon.destroy",$id);?>">
                            <i= class="fas fa-trash"></i>
                        </button>
                        <?php
                        }
                        ?>
')
->rawColumns(['manage'])
->editColumn('created_at', function (Social $Social) {
    return $Social->created_at;
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
            return view('backend.socials.add-socials');
        } else {
            return redirect(route('social-icon.index'));
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
        if (auth()->user()->can('create-socials')) { 
            $this->validate($request, [
                'icon' => 'required',
                'link' => 'required|url', 
                'background' => 'required',
                'color' => 'required',
                'hover_color' => 'required',
                'hover_background' => 'required',
                'font_size' => 'required|integer',
            ]); 
            $social = new Social();
            $social->icon = senitizeIconData($request->icon);
            $social->link = $request->link;
            $social->background = $request->background;
            $social->color = $request->color;
            $social->hover_color = $request->hover_color;
            $social->hover_background = $request->hover_background;
            $social->font_size = $request->font_size;
            $social->save();
            toast('Successfully created Social', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('social-icon.index');
        } else {
            return redirect(route('social-icon.index'));
        }
    }

    /**
    * Display the specified resource.
    *
    * @param \App\Mode\Admin\Social $portfolio
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        if (auth()->user()->can('read-socials')) {
            $show = Social::where('id',$id)->first();
            return view('backend.socials.view-social', compact('show'));
        } else {
            return redirect(route('social-icon.index'));
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
        if (auth()->user()->can('update-socials')) {
            $edit = Social::where('id', $id)->first();
            return view('backend.socials.edit-socials', compact('edit'));
        } else {
            return redirect(route('social-icon.index'));
        }
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
            return redirect()->route('social-icon.index');
        } else {
            return redirect(route('social-icon.index'));
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
        $social = Social::find($id);
        if ($social) {
            $social->delete();
        }
    }
}
