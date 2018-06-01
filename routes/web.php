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

//Route::get('/plop/{name?}', function ($name = false) {
  //return view('plop', ['name' => $name]);
//});

//Route::get('/read', 'WallController@read')->name('wall');

//Route::post('/write', 'WallController@write');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/group', 'GroupController@index')->name('group');

Route::post('/group/add', 'GroupController@add');

Route::get('/profile', 'UserController@index')->name('profile');

Route::get('/vault', 'UserController@vault')->name('vault');
