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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


Route::group(['middleware'=>['auth','auto-check-permission'],'prefix'=>'admin'],function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('governorate', 'GovernorateController');
    Route::resource('governorate.city', 'GovernorateCityController');
    Route::resource('category', 'CategoryController');
    Route::post('client/change-status/{id}', 'ClientController@changeStatus')->name('client.change-status');
    Route::resource('client', 'ClientController');
    Route::resource('post', 'PostController');
    Route::resource('contact', 'ContactController');
    Route::resource('order', 'OrderController');
    Route::resource('setting', 'settingController');
    Route::resource('role', 'RoleController');

    //user reset password
    Route::get('user/change-password','UserController@changePassword')->name('user.change-password');
    Route::post('user/change-password','UserController@changePasswordSave');
    Route::resource('user', 'UserController');
   // Route::get('/logout',function (){

//         auth()->logout();
//         return redirect('/');

   // });



});



