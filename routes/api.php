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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => ['api', 'cors']], function ($router) {

    Route::group(['prefix' => 'auth', 'namespace' => 'Api\User'], function ($router) {
        Route::post('login', [ 'as' => 'login', 'uses' => 'AuthController@login']);
        Route::post('logout', [ 'as' => 'logout', 'uses' => 'AuthController@logout']);
        Route::post('refresh', [ 'as' => 'refresh', 'uses' => 'AuthController@refresh']);
        Route::get('me', [ 'as' => 'me', 'uses' => 'AuthController@me']);
    });
});
