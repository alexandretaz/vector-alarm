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
Route::get('/user/add', 'UserController@add')->name('user.add')->middleware('auth');
Route::get('/user/{userId}/delete', 'UserController@delete')->name('user.delete')->middleware('auth');
Route::get('/contract/{contractId}/clients', 'ClientController@index')->name('client.list')->middleware('auth');
Route::get('/contract/{contractId}/clients/search', 'ClientController@search')->name('client.search')->middleware('auth');
Route::get('/contract/{contractId}/client/add', 'ClientController@add')->name('client.add')->middleware('auth');
Route::get('/client/{clientId}/edit', 'ClientController@edit')->name('client.edit')->middleware('auth');
Route::get('/client/{clientId}/delete', 'ClientController@delete')->name('client.delete')->middleware('auth');
Route::get('/client/{clientId}/dependent/add','ClientController@addDependent')->name('client.dependent.add')->middleware('auth');
Route::get('/client/{clientId}','ClientController@show')->name('client.show')->middleware('auth');
Route::get('/client/{clientId}/car/add','CarController@add')->name('car.add')->middleware('auth');
Route::get('/client/{clientId}/car/{carPosition}/edit','CarController@edit')->name('car.edit')->middleware('auth');
Route::get('/client/{clientId}/car/{carPosition}/delete','CarController@delete')->name('car.delete')->middleware('auth');
Route::get('/client/{clientId}/contato_autorizado/add','AuthContactController@add')->name('contato_autorizado.add')->middleware('auth');
Route::get('/client/{clientId}/contato_autorizado/{position}/edit','AuthContactController@edit')->name('contato_autorizado.edit')->middleware('auth');
Route::get('/client/{clientId}/contato_autorizado/{position}/delete','AuthContactController@delete')->name('contato_autorizado.delete')->middleware('auth');
Route::get('/client/{clientId}/contato_prioridade/add','PriorityContactController@add')->name('contato_prioridade.add')->middleware('auth');
Route::get('/client/{clientId}/contato_prioridade/{position}/edit','PriorityContactController@edit')->name('contato_prioridade.edit')->middleware('auth');
Route::get('/client/{clientId}/contato_prioridade/{position}/delete','PriorityContactController@delete')->name('contato_prioridade.delete')->middleware('auth');
Route::get('/chamados/{status?}','CallInController@list')->name('call.list')->middleware('auth');
Route::get('/chamado/show/{type}/{id}','CallInController@show')->name('call.show')->middleware('auth');
Route::post('/chamado/add', 'CallInController@add')->name('call.add')->middleware('auth');
Route::get('/chamado/add/client/{id}','CallInController@add')->name('call.add.client')->middleware('auth');



Route::post('/contract/add', 'ContractController@store')->name('contract.store')->middleware('auth');
Route::post('/chamado/add','CallInController@add')->name('call.post.add')->middleware('auth');
Route::post('/chamado/create','CallInController@store')->name('call.store')->middleware('auth');
Route::post('/chamado/add/search-client', 'CallInController@searchClient')->name('chamado.search.client')->middleware('auth');
Route::post('/chamado/interact', 'CallInController@storeInteraction')->name('chamado.store.interact')->middleware('auth');
Route::post('/chamado/close', 'CallInController@close')->name('chamado.close')->middleware('auth');
Route::post('/user/store', 'UserController@store')->name('user.store')->middleware('auth');
Route::post('/client/store', 'ClientController@store')->name('client.store')->middleware('auth');
Route::post('/client/car/store', 'CarController@store')->name('car.store')->middleware('auth');
Route::post('/client/contato_autorizado/store', 'AuthContactController@store')->name('contato_autorizado.store')->middleware('auth');
Route::post('/client/contato_prioridade/store', 'PriorityContactController@store')->name('contato_prioridade.store')->middleware('auth');
