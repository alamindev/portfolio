<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Model\Admin\General;
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
        $animate_text_all = explode(',',$animate_text->slide_text);
        $general = General::select('logo','main_text','photo')->first(); 
        $collect = Collect($general);
        $collections = $collect->merge(['animate_text' => $animate_text_all]);
        return response()->json($collections); 
    }
    
}
