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
    $this->post('login', 'LoginController@login');
    $this->post('logout', 'LoginController@logout')->name('logout');
    $this->get('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});
Route::get('/{store}', 'StoreController@show')->name('store.show');

// Route::get('/insert', function () {

//    \App\StoreCategory::create([
//        'id' => 1,
//        'name' => 'رستوان',
//    ]);
//
//    \App\Store::create([
//        'name' => 'فست فود چیلی',
//        'username' => 'chilly',
//        'password' => bcrypt('4321'),
//        'telephone_number' =>'0543342516',
//        'address' =>'زاهدان ',
//        'rank' =>4.9,
//        'working_hours' => '11-16 , 19-23',
//        's_category_id' =>1,
//        'delivery_time' =>20,
//        'latitude' =>29.4772336,
//        'longitude' =>60.8489391,
//    ]);
//    \App\User::create([
//        'phone_number' => '09217265472  ',
//        'email' => 'edr9@gmail.com',
//        'password' => bcrypt('1234'),
//        'first_name' =>'احسان',
//        'last_name' =>'رنجبری',
//        'anif_code' =>9,
//        'user_name' => 'eDr9',
//    ]);

//
//        \App\ProductCategory::create([
//        'id' => 7,
//        'name' => 'همبرگر',
//        'store_id' => 6,
//    ]);
//
//    \App\ProductCategory::create([
//        'id' => 8,
//        'name' => 'ساندویچ',
//        'store_id' => 6,
//    ]);

//    \App\ProductCategory::create([
//        'id' => 9,
//        'name' => 'سالاد',
//        'store_id' => 6,
//    ]);
//
//    \App\ProductCategory::create([
//        'id' => 10,
//        'name' => 'تنوری',
//        'store_id' => 6,
//    ]);
//
//    \App\Product::create([
//        'store_id' => 6,
//        'name' => 'هات برگر',
//        'price' => 9000,
//        'category_id' => 6,
//        'off' => 10
//
//    ]);
////
//    return \App\Product::create([
//        'store_id' => 6,
//        'name' => 'رویال برگر',
//        'price' => 10000,
//        'category_id' => 6,
//        'off' => 45
//
//    ]);


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/' , function () {
        return view('admin.dashboard.index');
    });

});

Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    $this->get('login', 'LoginController@showLoginForm')->name('login');
    $this->post('login', 'LoginController@login');
    $this->post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});
