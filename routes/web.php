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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');

Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('category.edit');

Route::put('/categories/{id}', 'CategoryController@update')->name('category.update');

Route::get('/coachs', 'CoachController@index')->name('coachs');

Route::get('/licences', 'LicenceController@index')->name('licences');

Route::get('/licences/category/{categoryId}', 'LicenceController@findByCategory')->name('licencesByCategory');

Route::get('/players/{id}', 'PlayerController@show')->name('player');

Route::get('/entrainements', 'EntrainementController@index')->name('entrainements');

Route::get('/entrainements/{id}', 'EntrainementController@show')->name('entrainement');

Route::get('/entrainements/coach/{coachId}', 'EntrainementController@findByCoach')->name('entrainementsByCoach');

Route::get('/entrainements/category/{categoryId}', 'EntrainementController@findByCategory')->name('entrainementsByCategory');

Route::get('/convocations', 'ConvocationController@index')->name('convocations');

Route::get('/convocations/{id}', 'ConvocationController@show')->name('convocation');

Route::get('/convocations/coach/{coachId}', 'ConvocationController@findByCoach')->name('convocationsByCoach');

Route::get('/convocations/category/{categoryId}', 'ConvocationController@findByCategory')->name('convocationsByCategory');

Route::get('/operations', 'OperationController@index')->name('operations');

Route::get('/operations/{id}', 'OperationController@show')->name('operation');

Route::get('/invitations', 'InvitationController@index')->name('invitations');

Route::get('/invitations/category/{categoryId}', 'InvitationController@findByCategory')->name('invitationsByCategory');

Route::get('/invitations/{id}', 'InvitationController@show')->name('invitation');

Route::get('/inscriptions', 'InscriptionController@index')->name('inscriptions');

Route::get('/inscriptions/category/{categoryId}', 'InscriptionController@findByCategory')->name('inscriptionsByCategory');

Route::get('/inscriptions/{id}', 'InscriptionController@show')->name('inscription');

Auth::routes();

