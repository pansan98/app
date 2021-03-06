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

//Route::get('book', 'BookController@index');
//
//Route::get('book/{id}/', 'BookController@show');

/** route設定 **/
Route::resource('book', 'BookController');

Route::resource('capture', 'CaptureController');

Route::resource('client-storage', 'StorageController');

Route::resource('media', 'MediaController');