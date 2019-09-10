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



//product
Route::resources(['product' => 'API\ProductController']);
Route::get('findProduct','API\ProductController@searchProduct');
Route::post('delete/sp', [
    'as'    =>'api.delete.product',
    'uses'  =>  'API\ProductController@deleteProduct'
]);
Route::post('update/sp', [
    'as'    =>'api.update.product',
    'uses'  =>  'API\ProductController@updateProduct'
]);


// order
Route::resources(['order' => 'API\OrderController']);
Route::get('findOrder','API\OrderController@searchOrder');
Route::post('delete/od', [
    'as' => 'api.delete.order',
    'uses'=>'API\OrderController@deleteOrder'
]);
Route::post('update/od', [
    'as' => 'api.update.order',
    'uses'=>'API\OrderController@updateOrder'
]);




//user
Route::resources(['user' => 'API\UserController']);
Route::post('delete/us', [
    'as' => 'api.delete.user',
    'uses'=>'API\UserController@deleteUser'
]);
Route::post('update/us', [
    'as' => 'api.update.user',
    'uses'=>'API\UserController@updateUser'
]);
Route::get('findUser','API\UserController@searchUser');


Route::get('profile','API\UserController@profile');
Route::post('update/pf', [
    'as' => 'api.update.profile',
    'uses'=>'API\UserController@updateProfile'
]);

