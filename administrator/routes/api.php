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

Route::post('v1/upload-single', 'Api\SingleImageController@uploadSingle');
Route::delete('v1/upload-single', 'Api\SingleImageController@deleteSingle');

Route::post('v1/upload-multi', 'Api\MultiImageController@uploadMulti');
Route::delete('v1/upload-multi', 'Api\MultiImageController@deleteMulti');

Route::post('v1/upload-media', 'Api\MediaImageController@uploadMedia');
Route::delete('v1/upload-media', 'Api\MediaImageController@deleteMedia');