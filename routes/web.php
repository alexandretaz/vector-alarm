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
Route::get('/contracts', 'ContractController@index')->name('contracts');
Route::get('/users', 'UserController@index')->name('users');
Route::get('/contract/add', 'ContractController@add')->name('contract.add');

Route::post('/contract/add', 'ContractController@store')->name('contract.store');
