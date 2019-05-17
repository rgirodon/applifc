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

Route::get('/categories', 'CategoryController@index')->name('categories')->middleware('auth');

Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('category.edit')->middleware('auth');

Route::get('/categories/edit', 'CategoryController@editAll')->name('category.editAll')->middleware('auth');

Route::get('/categories/create', 'CategoryController@create')->name('category.create')->middleware('auth');

Route::post('/categories', 'CategoryController@store')->name('category.store')->middleware('auth');

Route::put('/categories/{id}', 'CategoryController@update')->name('category.update')->middleware('auth');

Route::put('/categories', 'CategoryController@updateAll')->name('category.updateAll')->middleware('auth');

Route::delete('/categories/{id}', 'CategoryController@destroy')->name('category.delete')->middleware('auth');

Route::get('/coachs/{id}/edit', 'CoachController@edit')->name('coach.edit')->middleware('auth');

Route::get('/coachs/create', 'CoachController@create')->name('coach.create')->middleware('auth');

Route::post('/coachs', 'CoachController@store')->name('coach.store')->middleware('auth');

Route::put('/coachs/{id}', 'CoachController@update')->name('coach.update')->middleware('auth');

Route::delete('/coachs/{id}', 'CoachController@destroy')->name('coach.delete')->middleware('auth');

Route::get('/coachs', 'CoachController@index')->name('coachs')->middleware('auth');

Route::get('/coach/{id}', 'CoachController@show')->name('coach')->middleware('auth');

Route::get('/licences', 'LicenceController@index')->name('licences')->middleware('auth');

Route::get('/licences/{playerId}/create', 'LicenceController@create')->name('licence.create')->middleware('auth');

Route::post('/licences', 'LicenceController@store')->name('licence.store')->middleware('auth');

Route::get('/licences/{id}/edit', 'LicenceController@edit')->name('licence.edit')->middleware('auth');

Route::put('/licences/{id}', 'LicenceController@update')->name('licence.update')->middleware('auth');

Route::delete('/licences/{id}', 'LicenceController@destroy')->name('licence.delete')->middleware('auth');

Route::post('/licences/renew', 'LicenceController@renew')->name('licences.renew')->middleware('auth');

Route::get('/licences/renew', 'LicenceController@renewDisplay')->name('licences.renewDisplay')->middleware('auth');

Route::post('/licences/storeAll', 'LicenceController@storeAll')->name('licences.storeAll')->middleware('auth');

Route::get('/licences/category/{categoryId}', 'LicenceController@findByCategory')->name('licencesByCategory')->middleware('auth');

Route::get('/players/{id}', 'PlayerController@show')->name('player')->middleware('auth');

Route::get('/entrainements', 'EntrainementController@index')->name('entrainements');

Route::get('/entrainements/{id}', 'EntrainementController@show')->name('entrainement')->middleware('auth');

Route::get('/entrainements/coach/{coachId}', 'EntrainementController@findByCoach')->name('entrainementsByCoach');

Route::get('/entrainements/category/{categoryId}', 'EntrainementController@findByCategory')->name('entrainementsByCategory');

Route::get('/convocations', 'ConvocationController@index')->name('convocations');

Route::get('/convocations/create', 'ConvocationController@create')->name('convocation.create')->middleware('auth');

Route::post('/convocations', 'ConvocationController@store')->name('convocation.store')->middleware('auth');

Route::get('/convocations/{id}/edit', 'ConvocationController@edit')->name('convocation.edit')->middleware('auth');

Route::put('/convocations/{id}', 'ConvocationController@update')->name('convocation.update')->middleware('auth');

Route::get('/convocations/{id}', 'ConvocationController@show')->name('convocation');

Route::delete('/convocations/{id}', 'ConvocationController@destroy')->name('convocation.delete')->middleware('auth');

Route::get('/convocations/coach/{coachId}', 'ConvocationController@findByCoach')->name('convocationsByCoach');

Route::get('/convocations/category/{categoryId}', 'ConvocationController@findByCategory')->name('convocationsByCategory');

Route::post('/convocations/{id}/addPlayer', 'ConvocationController@addPlayer')->name('convocation.addPlayer')->middleware('auth');

Route::delete('/convocations/{id}/deletePlayer/{playerId}', 'ConvocationController@deletePlayer')->name('convocation.deletePlayer')->middleware('auth');

Route::get('/operations', 'OperationController@index')->name('operations')->middleware('auth');

Route::get('/operations/{id}/edit', 'OperationController@edit')->name('operation.edit')->middleware('auth');

Route::get('/operations/create', 'OperationController@create')->name('operation.create')->middleware('auth');

Route::get('/operations/{id}', 'OperationController@show')->name('operation')->middleware('auth');

Route::delete('/operations/{id}', 'OperationController@destroy')->name('operation.delete')->middleware('auth');

Route::post('/operations', 'OperationController@store')->name('operation.store')->middleware('auth');

Route::put('/operations/{id}', 'OperationController@update')->name('operation.update')->middleware('auth');

Route::delete('/actions/{id}', 'OperationController@destroyAction')->name('action.delete')->middleware('auth');

Route::get('/actions/{id}/edit', 'OperationController@editAction')->name('action.edit')->middleware('auth');

Route::put('/actions/{id}', 'OperationController@updateAction')->name('action.update')->middleware('auth');

Route::post('/operations/{id}/addAction', 'OperationController@addAction')->name('operation.addAction')->middleware('auth');

Route::get('/invitations', 'InvitationController@index')->name('invitations')->middleware('auth');

Route::get('/invitations/category/{categoryId}', 'InvitationController@findByCategory')->name('invitationsByCategory')->middleware('auth');

Route::get('/invitations/{id}/edit', 'InvitationController@edit')->name('invitation.edit')->middleware('auth');

Route::get('/invitations/{id}/refuse', 'InvitationController@refuse')->name('invitation.refuse')->middleware('auth');

Route::get('/invitations/{id}/accept', 'InvitationController@accept')->name('invitation.accept')->middleware('auth');

Route::put('/invitations/{id}', 'InvitationController@update')->name('invitation.update')->middleware('auth');

Route::get('/invitations/create', 'InvitationController@create')->name('invitation.create')->middleware('auth');

Route::post('/invitations', 'InvitationController@store')->name('invitation.store')->middleware('auth');

Route::get('/invitations/{id}', 'InvitationController@show')->name('invitation')->middleware('auth');

Route::delete('/invitations/{id}', 'InvitationController@destroy')->name('invitation.delete')->middleware('auth');

Route::get('/inscriptions', 'InscriptionController@index')->name('inscriptions');

Route::get('/inscriptions/category/{categoryId}', 'InscriptionController@findByCategory')->name('inscriptionsByCategory');

Route::get('/inscriptions/{id}', 'InscriptionController@show')->name('inscription');

Route::get('/notes/{id}/edit', 'NoteController@edit')->name('note.edit')->middleware('auth');

Route::put('/notes/{id}', 'NoteController@update')->name('note.update')->middleware('auth');

Route::get('/notes/{playerId}/create', 'NoteController@create')->name('note.create')->middleware('auth');

Route::post('/notes', 'NoteController@store')->name('note.store')->middleware('auth');

Route::delete('/notes/{id}', 'NoteController@destroy')->name('note.delete')->middleware('auth');

Auth::routes();

Route::get('/unauthorized', function() {
    return view('unauthorized');
});
