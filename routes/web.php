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

Route::get('/categories/edit', 'CategoryController@editAll')->name('category.editAll');

Route::get('/categories/create', 'CategoryController@create')->name('category.create');

Route::post('/categories', 'CategoryController@store')->name('category.store');

Route::put('/categories/{id}', 'CategoryController@update')->name('category.update');

Route::put('/categories', 'CategoryController@updateAll')->name('category.updateAll');

Route::delete('/categories/{id}', 'CategoryController@destroy')->name('category.delete');

Route::get('/coachs', 'CoachController@index')->name('coachs');

Route::get('/licences', 'LicenceController@index')->name('licences');

Route::get('/licences/{playerId}/create', 'LicenceController@create')->name('licence.create');

Route::post('/licences', 'LicenceController@store')->name('licence.store');

Route::get('/licences/{id}/edit', 'LicenceController@edit')->name('licence.edit');

Route::put('/licences/{id}', 'LicenceController@update')->name('licence.update');

Route::delete('/licences/{id}', 'LicenceController@destroy')->name('licence.delete');

Route::post('/licences/renew', 'LicenceController@renew')->name('licences.renew');

Route::get('/licences/renew', 'LicenceController@renewDisplay')->name('licences.renewDisplay');

Route::post('/licences/storeAll', 'LicenceController@storeAll')->name('licences.storeAll');

Route::get('/licences/category/{categoryId}', 'LicenceController@findByCategory')->name('licencesByCategory');

Route::get('/players/{id}', 'PlayerController@show')->name('player');

Route::get('/coachs/{id}', 'CoachController@show')->name('coach');

Route::get('/entrainements', 'EntrainementController@index')->name('entrainements');

Route::get('/entrainements/{id}', 'EntrainementController@show')->name('entrainement');

Route::get('/entrainements/coach/{coachId}', 'EntrainementController@findByCoach')->name('entrainementsByCoach');

Route::get('/entrainements/category/{categoryId}', 'EntrainementController@findByCategory')->name('entrainementsByCategory');

Route::get('/convocations', 'ConvocationController@index')->name('convocations');

Route::get('/convocations/create', 'ConvocationController@create')->name('convocation.create');

Route::post('/convocations', 'ConvocationController@store')->name('convocation.store');

Route::get('/convocations/{id}/edit', 'ConvocationController@edit')->name('convocation.edit');

Route::put('/convocations/{id}', 'ConvocationController@update')->name('convocation.update');

Route::get('/convocations/{id}', 'ConvocationController@show')->name('convocation');

Route::delete('/convocations/{id}', 'ConvocationController@destroy')->name('convocation.delete');

Route::get('/convocations/coach/{coachId}', 'ConvocationController@findByCoach')->name('convocationsByCoach');

Route::get('/convocations/category/{categoryId}', 'ConvocationController@findByCategory')->name('convocationsByCategory');

Route::post('/convocations/{id}/addPlayer', 'ConvocationController@addPlayer')->name('convocation.addPlayer');

Route::delete('/convocations/{id}/deletePlayer/{playerId}', 'ConvocationController@deletePlayer')->name('convocation.deletePlayer');

Route::get('/operations', 'OperationController@index')->name('operations');

Route::get('/operations/{id}', 'OperationController@show')->name('operation');

Route::get('/invitations', 'InvitationController@index')->name('invitations');

Route::get('/invitations/category/{categoryId}', 'InvitationController@findByCategory')->name('invitationsByCategory');

Route::get('/invitations/{id}', 'InvitationController@show')->name('invitation');

Route::get('/inscriptions', 'InscriptionController@index')->name('inscriptions');

Route::get('/inscriptions/category/{categoryId}', 'InscriptionController@findByCategory')->name('inscriptionsByCategory');

Route::get('/inscriptions/{id}', 'InscriptionController@show')->name('inscription');

Auth::routes();

