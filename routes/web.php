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
Route::get('/contracts', 'ContractController@index')->name('contracts')->middleware('auth');
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::get('/contract/add', 'ContractController@add')->name('contract.add')->middleware('auth');
Route::get('/contract/{contractId}/edit', 'ContractController@edit')->name('contract.edit')->middleware('auth');
Route::get('/contract/{contractId}/delete', 'ContractController@delete')->name('contract.delete')->middleware('auth');
Route::get('/user/{userId}/edit', 'UserController@edit')->name('user.edit')->middleware('auth');
Route::get('user/add', 'UserController@add')->name('user.add')->middleware('auth');
Route::get('/user/{userId}/delete', 'UserController@delete')->name('user.delete')->middleware('auth');
Route::get('/contract/{contractId}/clients', 'ClientController@index')->name('client.list')->middleware('auth');
Route::get('/contract/{contractId}/client/add', 'ClientController@add')->name('client.add')->middleware('auth');
Route::get('/client/{clientId}/edit', 'ClientController@edit')->name('client.edit')->middleware('auth');
Route::get('/client/{clientId}/delete', 'ClientController@delete')->name('client.delete')->middleware('auth');
Route::get('/client/{clientId}/dependent/add','ClientController@addDependent')->name('client.dependent.add')->middleware('auth');
Route::get('/client/{clientId}','ClientController@show')->name('client.show')->middleware('auth');


Route::post('/contract/add', 'ContractController@store')->name('contract.store');
Route::post('/user/store', 'UserController@store')->name('user.store');
Route::post('/client/store', 'ClientController@store')->name('client.store');
