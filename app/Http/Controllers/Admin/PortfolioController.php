<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
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
        return view('backend.portfolio.portfolio');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getView()
    {
        return Portfolio::orderBy('created_at', 'DESC')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return back to the user
     */
    public function create()
    {
        return redirect()->route('portfolios.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateWith([
            'portfolio_name' => 'required|max:100|unique:portfolios',
        ]);
        $Portfolio = new Portfolio();
        $Portfolio->portfolio_name = $request->portfolio_name;
        $Portfolio->save();
        return response()->json(['message' => 'Portfolio Added Successfully!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateWith([
            'portfolio_name' => 'required|max:100|unique:Portfolios',
        ]);

        $Portfolio = Portfolio::find($id);
        $Portfolio->portfolio_name = $request->portfolio_name;
        $Portfolio->save();
        return response()->json(['message' => 'Portfolio Update Successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Portfolio::find($id);
        if ($destroy) {
            $destroy->delete();
            return response()->json(['deleted' => 'Portfolio deleted successfully']);
        }
    }
}
