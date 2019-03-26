<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Model\Admin\General;
use App\Http\Controllers\Controller;
use Image;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!General::count()) {
                if (auth()->user()->can('create-generals')) {
                    return view('backend.generals.add-generals');
                } else {
                    return redirect(route('dashboard'));
                }
            } else {
                if (auth()->user()->can('update-generals')) {
                    $edit = General::first();
                    return view('backend.generals.edit-generals', compact('edit'));
                } else {
                    return redirect(route('dashboard'));
                }
            }
        } catch (Exception $x) {
            return 'there are some problem';
        }
    }


    /**
         *   for show animated text
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */

    public function show()
    {
        return General::select('slide_text')->get();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('create-generals')) {
            $this->validate($request, [
                'logo' => 'required|mimes:png',
                'fav_icon' => 'required|mimes:png,jpg,jpeg',
                'photo' => 'required|mimes:png,jpg,jpeg',
                'main_text' => 'required',
                'animate_text' => 'required'
            ]);
            $logo = Upload_Image($request, 'logo', 'uploads/generals/');
            $fav_icon = Upload_Image($request, 'fav_icon', 'uploads/generals/');
            $photo = Upload_Image($request, 'photo', 'uploads/generals/');

            $general = new General();
            $general->logo = $logo;
            $general->fav_icon = $fav_icon;
            $general->photo = $photo;
            $general->main_text = $request->main_text;
            $general->slide_text = implode(", ", $request->animate_text);
            $general->copy_right = $request->copy_right;
            $general->save();
            toast('Successfully created General Setting', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('generals.index');
        } else {
            return redirect(route('generals.index'));
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MapOption  $mapOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('update-generals')) {
            $this->validate($request, [
                'logo' => 'mimes:png',
                'fav_icon' => 'mimes:jpg,png',
                'photo' => 'mimes:jpg,png,jpeg',
                'main_text' => 'required',
                'animate_text' => 'required'
            ]);
            $general = General::where('id', $id)->first();

            $logo = Update_Upload_Image($request, 'logo', $general, 'uploads/generals/');
            $fav_icon = Update_Upload_Image($request, 'fav_icon', $general, 'uploads/generals/');
            ;
            $photo = Update_Upload_Image($request, 'photo', $general, 'uploads/generals/');
            ;

            $general = General::find($id);
            $general->logo = $logo;
            $general->fav_icon = $fav_icon;
            $general->photo = $photo;
            $general->main_text = $request->main_text;
            $general->slide_text = implode(", ", $request->animate_text);
            $general->copy_right = $request->copy_right;
            $general->save();
            toast('Updated Successfully', 'success', 'top-right')->autoClose(5000);
            
            return redirect()->route('generals.index');
        } else {
            return redirect(route('generals.index'));
        }
    }
}
