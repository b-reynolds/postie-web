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

Route::get('/', 'Files\CreateController@get');
Route::post('/', 'Files\CreateController@post');

Route::get('/{id}', 'Files\FileController@get');
Route::get('/raw/{id}', 'Files\RawController@get');
Route::get('/download/{id}', 'Files\DownloadController@get');
