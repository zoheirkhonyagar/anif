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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/reg' , function (){
    return view('main.auth.register');
});
Route::get('/' , 'StoreController@index');
Route::get('/search' , 'StoreController@search')->name('search');

Route::get('/admin' , function (){
    return view('admin.dashboard.index');
});

Route::get('/v2' , 'StoreController@index');
Route::get('/' , function (){
    return view('landing.index');
});

Route::group(['namespace' => 'Auth'],function (){

    // Authentication Routes...
    $this->get('login', 'LoginController@showLoginForm')->name('login');
    $this->post('login', 'LoginController@login')->name('login-post');
    $this->post('logout', 'LoginController@logout')->name('logout');
    $this->get('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    // $this->post('register', 'RegisterController@register')->name('form-regiter');

    // Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});
Route::get('/{store}', 'StoreController@show')->name('store.show');
Route::post('/{store}/join', 'CustomerController@joinToCrm')->name('customer.joinToCrm');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/' , function () {
        return view('admin.dashboard.index');
    });

});

Route::post('sendVerifyCode' , 'UserController@sendVerifyCode')->name('sendVerifyCode');
Route::post('checkVerifyCode' , 'UserController@checkVerifyCode')->name('checkVerifyCode');
Route::post('register', 'UserController@register')->name('form-register');

Route::post('getCityRegions' , 'StoreController@getCityRegions')->name('getCityRegions');