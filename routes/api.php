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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'v1', 'namespace'=> 'Api\v1'], function () {

    $this->get('getOfferStores', 'StoreController@getOfferStores');
    $this->post('getStores', 'StoreController@getStores');
    $this->get('getBestStores', 'StoreController@getBestStores');
    $this->post('getStore', 'StoreController@show');
    $this->post('getStoreCategory', 'StoreController@showAllCategory');
    $this->post('getProductsOfCategory', 'ProductCategoryController@showAllProduct');
    $this->post('login', 'UserController@login');
    $this->post('register', 'UserController@register');
    $this->post('sendVerifyCode', 'UserController@sendVerifyCode');
    $this->post('getCities', 'CityController@getAllCities');
    $this->post('addWSRequest', 'WSRequestController@insertTo');
    $this->post('getRegions', 'RegionController@getAll');
    $this->post('storeSearch', 'StoreController@search');
    $this->post('getComments', 'CommentController@getComment');
    $this->post('calcPercentagePoints', 'StorePointController@calcPercentagePoints');
    $this->post('getVersion', 'VersionController@get');


    Route::middleware('auth:api')->group(function ()
    {
        Route::post('exitCRM', 'CustomerController@exitCustomer');
        Route::post('joinToCRM', 'CustomerController@storeCustomer');
        Route::post('getCustomer', 'CustomerController@getCustomer');
        Route::post('getUserPointToStore', 'StorePointController@getUserPoint');
        Route::post('savePointComment', 'StorePointController@storePointAndCommentToStore');
        Route::post('saveComment', 'StorePointController@updatePointAndComment');

        Route::post('user', function ()
        {
            return auth()->user();
        });


    });

});
