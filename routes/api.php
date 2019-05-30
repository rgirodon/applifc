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

Route::get('/players/search', 'PlayerController@search')->name('player.autocomplete.search');

Route::get('/clubs/default', 'ClubController@default')->name('api.club.default')->middleware('client');

Route::get('/entrainements/coach/{coachId}', 'EntrainementController@api_findByCoach')->name('api.entrainementsByCoach')->middleware('client');

Route::get('/entrainements/category/{categoryId}', 'EntrainementController@api_findByCategory')->name('api.entrainementsByCategory')->middleware('client');

Route::get('/entrainements', 'EntrainementController@api_index')->name('api.entrainements')->middleware('client');

Route::get('/inscriptions/category/{categoryId}', 'InscriptionController@api_findByCategory')->name('api.inscriptionsByCategory')->middleware('client');

Route::get('/inscriptions', 'InscriptionController@api_index')->name('api.inscriptions')->middleware('client');

Route::get('/convocations/coach/{coachId}', 'ConvocationController@api_findByCoach')->name('api.convocationsByCoach')->middleware('client');

Route::get('/convocations/category/{categoryId}', 'ConvocationController@api_findByCategory')->name('api.convocationsByCategory')->middleware('client');

Route::get('/convocations', 'ConvocationController@api_index')->name('api.convocations')->middleware('client');

Route::get('/categories', 'CategoryController@api_index')->name('api.categories')->middleware('client');

Route::get('/coachs', 'CoachController@api_index')->name('api.coachs')->middleware('client');