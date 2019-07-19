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


Route::group(['prefix'=>'v1', 'namespace'=> 'Api'],function (){

    Route::get('categories','MainController@categories');
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::get('settings','MainController@settings');
    Route::get('bloodTypes','MainController@bloodTypes');

    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('resetPassword','AuthController@resetPassword');
    Route::post('newpassword','AuthController@newpassword');


    Route::group(['middleware'=>'auth:api'],function (){

        //Route::get('posts','MainController@posts');
        Route::get('post','MainController@post');
        Route::get('listposts','MainController@listposts');
        Route::get('favpost','MainController@favpost');
        Route::get('togglefavourite','MainController@togglefavourite');
        Route::post('profile','AuthController@profile');
        Route::post('contacts','MainController@contacts');
        Route::post('notificationsettings','AuthController@notificationsettings');
        Route::get('listorders','MainController@listorders');
        Route::get('orderdetails','MainController@orderdetails');
        Route::post('ordercreate','MainController@ordercreate');

        Route::post('registertoken','AuthController@registertoken');
        Route::post('removetoken','AuthController@removetoken');
        Route::get('count','MainController@count');
        Route::post('findnotification','MainController@findnotification');





    });

});