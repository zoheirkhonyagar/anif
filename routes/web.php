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

use Illuminate\Support\Facades\DB;

Route::get('stores', 'StoreController@index');
Route::get('/insert', function () {

//    \App\StoreCategory::create([
//        'id' => 1,
//        'name' => 'رستوان',
//    ]);
//
//    \App\Store::create([
//        'name' => 'رستوران ولیعصر',
//        'username' => 'valiasr',
//        'password' => bcrypt('4321'),
//        'telephone_number' =>'0543342516',
//        'address' =>'زاهدان ',
//        'rank' =>4.1,
//        'working_hours' => '11-16 , 19-23',
//        's_category_id' =>1,
//        'delivery_time' =>20,
//        'latitude' =>29.4772336,
//        'longitude' =>60.8489391,
//    ]);
//
//        \App\ProductCategory::create([
//        'id' => 2,
//        'name' => 'پیش غذا',
//        'store_id' => 2,
//    ]);
//
//    \App\Product::create([
//        'store_id' => 2,
//        'name' => 'سالاد',
//        'price' => 3000,
//        'category_id' => 2,
//        'off' => 21
//
//    ]);
//
//    return \App\Product::create([
//        'store_id' => 2,
//        'name' => 'سالاد سزار',
//        'price' => 5000,
//        'category_id' => 2,
//        'off' => 35
//
//    ]);



//    return view('welcome');
});
