<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Portfolio;
use App\Model\Admin\SubPortfolio;

class ShowPortfolioController extends Controller
{
    /**
     * start coding for get category
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory()
    {
        return Portfolio::select('id', 'portfolio_name')->get();
    }
    /**
    * start coding for get all portfoilo
    *
    * @return \Illuminate\Http\Response
    */
    public function allPortfolio()
    {
        $subport = SubPortfolio::select('id', 'sub_port_photo', 'sub_port_name')->get();
        return response()->json($subport);
    }
    /**
     * start coding for get item by id
     *
     * @return \Illuminate\Http\Response
     */
    public function PorfolioById($id)
    {
        $port = Portfolio::with("subPortfolios")->where('id', $id)->select('id')->first();
        return response()->json($port);
    }
    /**
     * start coding for get sub portfolio by id
     *
     * @return \Illuminate\Http\Response
     */
    public function SubPorfoliById($id)
    {
        $subport = SubPortfolio::with('portfolios')->where('id', $id)->first();
        return response()->json($subport);
    }
}
