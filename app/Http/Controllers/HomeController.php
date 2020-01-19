<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Model\Admin\General;
use App\Model\Admin\Social; 
use Illuminate\Support\Facades\Cookie;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.app');
    }
    public function GetHomeText()
    {
        $animate_text = General::select('slide_text')->first();
        $animate_text_all = explode(',', $animate_text->slide_text);
        $general = General::select('logo', 'main_text', 'photo')->first();
        $collect = Collect($general);
        $collections = $collect->merge(['animate_text' => $animate_text_all]);
        
        return response()->json($collections);
    }
    public function getHeaderFooter()
    {
        return General::select('id', 'logo', 'copy_right', 'main_text')->first();
    }
    public function getfooter()
    { 
        $social_cookie = Cookie::get('social');
        if($social_cookie != null){
            $social =  Cookie::get('social');
        }else{
           $social = Social::select('icon','link','background','color','hover_color','hover_background','font_size')->get();
        } 
        return response($social)->cookie('social', $social, time() + (86400 * 30));
    }
}
