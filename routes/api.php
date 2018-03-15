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

Route::group(['prefix'=>'/V1','middleware'=>'api','namespace'=>'Http\Controller\Api\V1'],function(){
    Route::get('/',function(){
        return response('Olá Mundo');
    });
    Route::post('/alarm/point', 'AlarmController@point')->name('api.ping.alarm');
    Route::post('/auth','AuthController@login')->name('api.auth');
    Route::post('/alarm', 'AlarmController@start')->name('api.start.alarm');
    Route::post('/help/interact','HelpController@start')->name('api.help.interact');
    Route::post('/help','HelpController@start')->name('api.start.help');
});
