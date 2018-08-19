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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('roles', 'Admin\RolesController@index');
Route::get('roles/{role}/edit', 'Admin\RolesController@edit');
Route::put('roles/{role}', 'Admin\RolesController@update');
Route::post('roles', 'Admin\RolesController@store');
Route::delete('roles/{role}','Admin\RolesController@destroy');