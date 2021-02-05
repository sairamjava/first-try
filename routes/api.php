<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

 Route::post('/register','ApiAuthController@register');
 Route::post('/login','ApiAuthController@login');
 Route::get('/getProfile','ApiAuthController@getProfile')->middleware('auth:api');
 Route::post('/userUpdate','ApiAuthController@update')->middleware('auth:api');
Route::get('/userDelete','ApiAuthController@delete')->middleware('auth:api');


