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

//Route::get('book', 'BookController@index');
//
//Route::get('book/{id}/', 'BookController@show');

/** route設定 **/
Route::resource('book', 'BookController');

Route::resource('capture', 'CaptureController');

Route::post('api/v1/upload-single', 'Api\SingleImageController@uploadSingle');