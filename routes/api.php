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

Route::get('/clubs/default', 'ClubController@default')->name('api.club.default');

Route::get('/entrainements/coach/{coachId}', 'EntrainementController@api_findByCoach')->name('api.entrainementsByCoach');

Route::get('/entrainements/category/{categoryId}', 'EntrainementController@api_findByCategory')->name('api.entrainementsByCategory');

Route::get('/entrainements', 'EntrainementController@api_index')->name('api.entrainements');

Route::get('/inscriptions/category/{categoryId}', 'InscriptionController@api_findByCategory')->name('api.inscriptionsByCategory');

Route::get('/inscriptions', 'InscriptionController@api_index')->name('api.inscriptions');

Route::get('/convocations/coach/{coachId}', 'ConvocationController@api_findByCoach')->name('api.convocationsByCoach');

Route::get('/convocations/category/{categoryId}', 'ConvocationController@api_findByCategory')->name('api.convocationsByCategory');

Route::get('/convocations', 'ConvocationController@api_index')->name('api.convocations');

Route::get('/categories', 'CategoryController@api_index')->name('api.categories');

Route::get('/coachs', 'CoachController@api_index')->name('api.coachs');