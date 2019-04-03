<?php
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// route for front end
Auth::routes();
Route::get('/home/text', 'HomeController@GetHomeText')->name('home.text');

Route::get('home/{vue?}/', 'HomeController@index')->where('vue', '([A-z\d-\/_.]+)?')->name('home');

// route for dashboard  adminpanel
Route::redirect('/admin', '/admin/dashboard');
Route::redirect('/', '/home');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login.post');
    Route::get('/logout', 'Admin\Auth\LoginController@AdminLogout')->name('admin.logout');
    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    /*
        route for users admins
    */
    Route::get('/admins', 'Admin\AdminController@index')->name('admins.index');
    Route::get('/admins/create', 'Admin\AdminController@create')->name('admins.create');
    Route::POST('/admins/store', 'Admin\AdminController@store')->name('admins.store');
    Route::get('/admins/getdata', 'Admin\AdminController@getData')->name('getdata');
    Route::get('/admins/show/{id}', 'Admin\AdminController@show')->name('admins.show');
    Route::get('/admins/{id}/edit', 'Admin\AdminController@edit')->name('admins.edit');
    Route::DELETE('/admins/delete/{id}', 'Admin\AdminController@destroy')->name('admins.destroy');
    Route::post('/admins/update/{id}', 'Admin\AdminController@update')->name('admins.update');
    Route::post('/upload', 'Admin\AdminController@uploadAvater')->name('avater');
    Route::get('/getimg/{id}', 'Admin\AdminController@getImg')->name('getimage');

    // route for role
    Route::get('/roles', 'Admin\RoleController@index')->name('roles.index');
    Route::get('/roles/create', 'Admin\RoleController@create')->name('roles.create');
    Route::POST('/roles/store', 'Admin\RoleController@store')->name('roles.store');
    Route::get('/roles/getroledata', 'Admin\RoleController@getRoleData')->name('getRoleData');
    Route::get('/roles/show/{id}', 'Admin\RoleController@show')->name('roles.show');
    Route::get('/roles/{id}/edit', 'Admin\RoleController@edit')->name('roles.edit');
    Route::POST('/roles/{id}/update', 'Admin\RoleController@update')->name('roles.update');
    Route::get('/roles/delete/{id}', 'Admin\RoleController@destroy')->name('roles.destroy');
    Route::post('/roles/permission/store', 'Admin\RoleController@showPermission')->name('database_user_store');
    // route for permission
    Route::get('/permissions', 'Admin\PermissionController@index')->name('permissions.index');
    Route::get('/permissions/create', 'Admin\PermissionController@create')->name('permissions.create');
    Route::POST('/permissions/store', 'Admin\PermissionController@store')->name('permissions.store');
    Route::get('/permissions/getPermissionData', 'Admin\PermissionController@getPermissionData')->name('getPermissionData');
    Route::get('/permissions/show/{id}', 'Admin\PermissionController@show')->name('permissions.show');
    Route::get('/permissions/{id}/edit', 'Admin\PermissionController@edit')->name('permissions.edit');
    Route::post('/permissions/{id}/edit/update', 'Admin\PermissionController@update')->name('permissions.update');
    Route::DELETE('/permissions/delete/{id}', 'Admin\PermissionController@destroy')->name('permissions.destroy');
    //route for generals
    Route::resource('generals', 'Admin\GeneralController');
    Route::get('generals/animate-text', 'Admin\GeneralController@show');


    /*
      routes for porfolio
    */
    Route::get('/sub-portfolios', 'Admin\SubPortfolioController@index')->name('sub_portfolios.index');
    Route::get('/sub-portfolios/create', 'Admin\SubPortfolioController@create')->name('sub_portfolios.create');
    Route::POST('/sub-portfolios/store', 'Admin\SubPortfolioController@store')->name('sub_portfolios.store');
    Route::get('/sub-portfolios/getdata', 'Admin\SubPortfolioController@getPortfolioData')->name('getPortfolioData');
    Route::get('/sub-portfolios/show/{id}', 'Admin\SubPortfolioController@show')->name('sub_portfolios.show');
    Route::get('/sub-portfolios/{id}/edit', 'Admin\SubPortfolioController@edit')->name('sub_portfolios.edit');
    Route::DELETE('/sub-portfolios/delete/{id}', 'Admin\SubPortfolioController@destroy')->name('sub_portfolios.destroy');
    Route::post('/sub-portfolios/update/{id}', 'Admin\SubPortfolioController@update')->name('sub_portfolios.update');
    Route::get('portfolios/all', 'Admin\PortfolioController@getView')->name('portfolio');
    Route::resource('portfolios', 'Admin\PortfolioController');
    Route::get('/social-icon/getdata', 'Admin\SocialIconController@getSocialData')->name('getSocialData');
    Route::resource('social-icon', 'Admin\SocialIconController');
    Route::get('/user-contact/getdata', 'Admin\UserContactController@getContactData')->name('getContactData');
    Route::post('user-contact/store-data', 'Admin\UserContactController@store');
    Route::resource('user-contact', 'Admin\UserContactController');
});
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
