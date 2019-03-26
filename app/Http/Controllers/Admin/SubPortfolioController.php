<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Portfolio;
use App\Model\Admin\SubPortfolio;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Support\Str;

class SubPortfolioController extends Controller
{
    public $user_permission;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->user_permission =  get_permission_value('subportfolios');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can(!empty($this->user_permission[2]))) {
            return view('backend.sub-portfolios.sub-portfolios');
        } else {
            return redirect()->back();
        }
    }
    public function getPortfolioByFilter()
    {
        $portfolio_all = [];
        $data  = SubPortfolio::with('portfolios')->latest()->get();
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
                    $permission = get_permission_value("subportfolios"); 
                    if(auth()->user()->can("$permission[3]")){
                        ?>
                        <a href="<?php echo route("sub_portfolios.show",$id);?>" class="btn btn-outline-purple waves-effect waves-info"><i
                                class="fas fa-eye"></i></a>
                        <?php
                            }
                            if(auth()->user()->can("$permission[4]")){
                        ?>
                            <a href="<?php echo route("sub_portfolios.edit",$id);?>" class="btn btn-outline-success waves-effect waves-light"><i
                                    class="fas fa-edit"></i></a>
                            <?php
                            }
                            if(auth()->user()->can("$permission[1]")){
                        ?>
                        <button id="delete" type="button" class="btn btn-outline-danger waves-effect waves-light"
                            data-remote="<?php echo route("sub_portfolios.destroy",$id);?>">
                            <i= class="fas fa-trash"></i>
                        </button>
                        <?php
                        }
                        ?>
')
->rawColumns(['manage'])
->addColumn('Portfolio Main', function ($data) {
    return $data->portfolios->portfolio_name;
})
->addColumn('Portfolio Link', function ($data) {
    return Str::limit($data->sub_port_link, 25);
})
->editColumn('created_at', function (SubPortfolio $SubPortfolio) {
    return $SubPortfolio->created_at;
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
            $portfolios = Portfolio::select('id', 'portfolio_name')->latest()->get();
            return view('backend.sub-portfolios.add-sub-portfolio', compact('portfolios'));
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
        $this->validate($request, [
            'portfolio' => 'required',
            'port_name' => 'required',
            'port_link' => 'required',
            'port_photo' => 'required',
        ]);

        $photo = Upload_Image($request, 'port_photo', 'uploads/portfolio/');
        $portfolio = new SubPortfolio();
        $portfolio->portfolio_id = $request->portfolio;
        $portfolio->sub_port_name = $request->port_name;
        $portfolio->sub_port_link = $request->port_link;
        $portfolio->sub_port_details = $request->port_details;
        $portfolio->sub_port_photo = $photo;
        $portfolio->save();
        toast('Successfully created Portfolio', 'success', 'top-right')->autoClose(5000);
        return redirect()->route('sub_portfolios.index');
    }

    /**
    * Display the specified resource.
    *
    * @param \App\Mode\Admin\SubPortfolio $portfolio
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        if (auth()->user()->can('read-subportfolios')) {
            $show = SubPortfolio::where('id', $id)->first();
            return view('backend.sub-portfolios.sub-view-portfolio', compact('show'));
        } else {
            return redirect(route('sub_portfolios.index'));
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param \App\Mode\Admin\SubPortfolio $powerPlant
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        if (auth()->user()->can('update-subportfolios')) {
            $categories = Portfolio::orderBy('created_at', 'DESC')->get();
            $edit = SubPortfolio::where('id', $id)->first();
            return view('backend.sub-portfolios.edit-sub-portfolio', compact('categories', 'edit'));
        } else {
            return redirect(route('sub_portfolios.index'));
        }
    }


    /**
    * Update the specified resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @param \App\Mode\Admin\SubPortfolio $portfolio
    * @return \Illuminate\Http\Response and id
    */
    public function update(Request $request, $id)
    {
        if (auth()->user()->can('update-subportfolios')) {
            $this->validate($request, [
                'portfolio' => 'required',
                'port_name' => 'required',
                'port_link' => 'required',
            ]);

            $subport = SubPortfolio::where('id', $id)->first();

            $photo = Update_Upload_Image($request, 'sub_port_photo', $subport, 'uploads/portfolio/');
            $portfolio = SubPortfolio::find($id);
            $portfolio->portfolio_id = $request->portfolio;
            $portfolio->sub_port_name = $request->port_name;
            $portfolio->sub_port_link = $request->port_link;
            $portfolio->sub_port_details = $request->port_details;
            $portfolio->sub_port_photo = $photo;
            $portfolio->save();
            toast('Successfully Updated Portfolio', 'success', 'top-right')->autoClose(5000);
            return redirect()->route('sub_portfolios.index');
        } else {
            return redirect(route('sub_portfolios.index'));
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param \App\Portfolio $portfolio
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $portfolio = SubPortfolio::find($id);
        if ($portfolio) {
            $file_path = $portfolio->sub_port_photo;
            $storage_path = 'uploads/portfolio/' . $file_path;
            if (\File::exists($storage_path)) {
                unlink($storage_path);
            }
            $portfolio->delete();
        }
    }
}
