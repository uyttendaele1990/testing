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

Route::post('/store', 'blogController@store');

Route::get('/about', 'blogController@about');

Route::get('/posts', 'blogController@posts');

Route::get('/post/{id}', 'blogController@show');

Route::put('/post/update/{id}', 'blogController@update');

Route::delete('/removePost/{id}', 'blogController@delete');