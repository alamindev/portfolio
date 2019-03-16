<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubPortfolioController extends Controller
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
        // if (auth()->user()->can(!empty($this->user_permission[2]))) {
        return view('backend.portfolios.portfolios');
        // } else {
        return redirect()->back();
        // }
    }
    public function getPortfolioByFilter()
    {
        $portfolio_all = [];
        $data  = Portfolio::latest()->get();
        foreach ($data as $value) {
            if (auth()->user()->hasRole('developer')) {
                $portfolio_all[] = $value;
            } else {
                if ($value['user_name'] !== 'developer') {
                    $portfolio_all[] = $value;
                }
            }
        }
        return $portfolio_all;
    }
    public function getPortfolioData()
    {
        $data  = $this->getPortfolioByFilter();
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
        // if (auth()->user()->can(!empty($this->user_permission[0]))) {
        return view('backend.portfolios.add-portfolio');
        // } else {
        //     return redirect()->back();
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'port_name' => 'required',
            'port_link' => 'required',
            'port_photo' => 'required',
        ]);
        $photo = Upload_Image($request, 'port_photo', 'uploads/portfolio/');
        $portfolio = new Portfolio();
        $portfolio->port_name = $request->port_name;
        $portfolio->port_link = $request->port_link;
        $portfolio->port_details = $request->port_details;
        $portfolio->port_photo = $photo;
        $portfolio->save();
        toast('Successfully created  Portfolio', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('portfolios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
