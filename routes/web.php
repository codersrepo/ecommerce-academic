<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['domain' => config('app.domain_url'), 'middleware' => ['front.lang', 'subdomain'], 'namespace' => "Front", 'as' => 'sub_front.'], function () {
    require base_path('routes/frontend.php');
});

Route::group(['middleware' => ['front.lang'], 'namespace' => "Front", 'as' => 'front.'], function () {
    require base_path('routes/frontend.php');
});


    // return view('user.index');

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function(){
    // admin loginnn
    Route::get('login','AdminLoginController@loginForm')->name('admin.login');
    Route::post('login','AdminLoginController@login')->name('admin.login');
    Route::group(['middleware' => ['admin','lang','bindings']],function(){
        Route::get('/lang/{lang}', "SwitchLanguageController")->name('switch-lang');
        Route::get('/',function(){
           return view('admin.dashboard');
        });
        Route::get('logout','AdminLoginController@logout')->name('admin.logout');
        Route::resource('/slider','SliderController');
        Route::resource('/category','CategoryController');
        Route::post('updateCategoryStatus','CategoryController@togglestatus')->name('updateCategoryStatus');

        Route::resource('/blog','BlogController');

        Route::resource('/facilities', 'FacilityController')->except('show');
        Route::put('facilities/{facility}/toggle-status', 'FacilityController@toggleStatus')->name('facilities.toggle-status');

        Route::post('updateBlogStatus','BlogController@togglestatus')->name('updateStatus');

        Route::resource('/product','ProductController');
        Route::post('updateProductStatus','ProductController@togglestatus')->name('updateProductStatus');

        // Route::get('/{lang}','LanguageSwitchController')->name('switch-lang');
    });
});

Auth::routes();

Route::get('/home','HomeController@index')->name('home');


Route::resource('crude','CrudeController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
