<?php

Route::group(['prefix' => 'admin','middleware'=>'AdminLoginMiddleware'], function () {
    Route::get('/home',[
        'as' => 'admin',
        'uses' => 'HomeController@getIndex'
        ]);
    Route::get('/out',[
            'as' => 'out',
            'uses' => 'HomeController@getLogout'
            ]);
    // Route::get('/index', 'HomeController@index')->name('index');
});
//pages

Route::get('/',[
    'as' => 'show_index',
    'uses' => 'PagesController@getIndex']);
Route::get('/contact',[
    'as' => 'show_contact',
    'uses' => 'PagesController@getContact']);
Route::get('/introduce',[
    'as' => 'show_introduce',
    'uses' => 'PagesController@getAbout']);
Route::get('/product',[
    'as' => 'show_product',
    'uses' => 'PagesController@getProduct']);
Route::get('/detail/{id}/{slug}.html',[
    'as' => 'show_detail',
    'uses' => 'PagesController@getDetail']);
Route::get('/typeproduct/{id}/{slug}.html',[
    'as' => 'show_typeproduct',
    'uses' => 'PagesController@getTypeProduct']);

Route::get('/pages-200',[
        'as' => 'thanks',
        'uses' => 'PagesController@getThanks']);

Route::get('/signup',[
        'as' => 'show_signup',
        'uses' => 'PagesController@getRegister']);
Route::post('/signup','PagesController@postRegister');
Route::get('/log',[
        'as' => 'show_login',
        'uses' => 'PagesController@getLogin']);
Route::post('/log','PagesController@postLogin');

Route::get('/search',[
        'as' => 'show_search',
        'uses' => 'PagesController@getSearch']);
Route::get('/logout',[
        'as' => 'show_logout',
        'uses' => 'PagesController@getLogout']);
    //cart
Route::get('/pay',[
    'as' => 'show_pay',
    'uses' => 'CartController@getCheckOut']);

Route::post('/pay','CartController@postCheckOut');

Route::get('/order/{id}',[
        'as' => 'show_order',
        'uses' => 'CartController@getCart']);

Route::get('/delete/{id}',[
        'as' => 'show_delete',
        'uses' => 'CartController@getDeleteItem']);

Route::get('/deleteAll',[
        'as' => 'show_deleteAll',
        'uses' => 'CartController@getDeleteAll']);

Route::post('/dat-hang-update',[
            'as' => 'updateCart',
            'uses' => 'CartController@getUpdateCart']);





Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}',[
        'as' => 'user.change-language',
        'uses' => 'LangController@changeLanguage']);
});

Route::get('facebook/callback/{social}',[
    'as' => 'facebook_callback',
    'uses' => 'HandleController@handleFacebook']);

Route::get('facebook/login/{social}',[
    'as' => 'facebook_login',
    'uses' => 'HandleController@loginFacebook']);


Auth::routes();
