<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 /*
    for portfolio api
 */
Route::get('/category ', 'Api\ShowPortfolioController@getCategory')->name('getcategory');
Route::get('/all-portfolio ', 'Api\ShowPortfolioController@allPortfolio')->name('all.portfolio');
Route::get('/portfolio/{id}', 'Api\ShowPortfolioController@PorfolioById')->name('all.portfoliobyid');
Route::get('/sub-portfolio/{id}', 'Api\ShowPortfolioController@SubPorfoliById')->name('all.SubPorfoliById');

/*
for get header logo and footer text
*/
Route::get('/header-footer', 'HomeController@getHeaderFooter')->name('headerfooter');
Route::get('/footer', 'HomeController@getfooter')->name('footer');
