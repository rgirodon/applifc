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

Route::get('/coachs', 'CoachController@index');

Route::get('/licences', 'LicenceController@index')->name('licences');

Route::get('/licencesByCategory/{categoryId}', 'LicenceController@findByCategory')->name('licencesByCategory');

Route::get('/player/{id}', 'PlayerController@show')->name('player');

Route::get('/entrainements', 'EntrainementController@index')->name('entrainements');

Route::get('/entrainement/{id}', 'EntrainementController@show')->name('entrainement');

Route::get('/entrainementsByCoach/{coachId}', 'EntrainementController@findByCoach')->name('entrainementsByCoach');

Route::get('/convocations', 'ConvocationController@index')->name('convocations');

Route::get('/convocation/{id}', 'ConvocationController@show')->name('convocation');

Route::get('/convocationsByCoach/{coachId}', 'ConvocationController@findByCoach')->name('convocationsByCoach');
