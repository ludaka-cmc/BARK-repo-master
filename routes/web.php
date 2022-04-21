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

Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');
Route::post('logout', 'UserController@logout');
Route::get('admin/logout', 'UserController@logout');
Route::post('admin/logout', 'UserController@logout');

Route::post('sign-up', 'UserController@signUp');

Route::get('/{path?}', function () {
    return view('app')->with('user', Auth::user());
});
