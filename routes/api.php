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

Route::get('/entrainements', 'EntrainementController@api_index')->name('api.entrainements');

Route::get('/inscriptions', 'InscriptionController@api_index')->name('api.inscriptions');

Route::get('/convocations', 'ConvocationController@api_index')->name('api.convocations');