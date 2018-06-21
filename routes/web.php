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

Route::get('/vault', 'VaultController@index')->name('vault');
Route::get('/account/{id}/edit', 'AccountController@edit')->name('account.edit');
Route::post('/account/add', 'AccountController@add')->name('account.add');
Route::post('/account/{id}/update', 'AccountController@update')->name('account.update');
Route::post('/account/{id}/delete', 'AccountController@delete')->name('account.delete');
Route::post('/account/share', 'AccountController@share')->name('account.share');

Route::get('/group', 'GroupController@index')->name('groups');
Route::get('/group/{id}/show', 'GroupController@show')->name('group.show');
Route::post('/group/add', 'GroupController@add')->name('group.add');
Route::post('/group/{id}/update', 'GroupController@update')->name('group.update');
Route::post('/group/{id}/delete', 'GroupController@delete')->name('group.delete');
Route::post('/group/share', 'GroupController@share')->name('group.share');
Route::post('/group/manage', 'GroupController@manage')->name('group.manage');

Route::post('/user/search', 'UserController@search')->name('user.search');
Route::get('/profile', 'UserController@profile')->name('profile');
