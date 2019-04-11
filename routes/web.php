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

Route::get('/categories', 'CategoryController@index');

Route::get('/licences', 'LicenceController@index')->name('licences');

Route::get('/licencesByCategory/{categoryId}', 'LicenceController@findByCategory')->name('licencesByCategory');

Route::get('/player/{id}', 'PlayerController@show')->name('player');