<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by Laravel's RouteServiceProvider.
|
*/

// Auth Routes
Route::prefix('auth')->group(function () {
  Route::get('/login/{mobile}/{password}', 'APIController@userAuthLogin');
  Route::get('/register/{name}/{mobile}/{email}/{college}/{password}', 'APIController@userAuthRegister');
  Route::get('/register/{name}/{mobile}/{email}/{college}/{register_no}/{password}', 'APIController@userAuthRegisterKarunya');
  Route::get('/get/api_token/{userid}', 'APIController@getAPIToken');
});

Route::middleware('token.check')->group(function () {
  Route::prefix('{api_token}')->group(function () {
    // Get Data
    Route::get('/get/events', 'APIController@getEventsList');
    Route::get('/get/events/{dept}', 'APIController@getEventsListDepartment');
    Route::get('/get/games', 'APIController@getGamesList');
    Route::get('/get/workshops', 'APIController@getWorkshopsList');
    Route::get('/get/workshops/{dept}', 'APIController@getWorkshopsListDepartment');

    // Get Specific
    Route::get('/get/event/{id}', 'APIController@getEventInfo');
    Route::get('/get/game/{id}', 'APIController@getGameInfo');
    Route::get('/get/workshop/{id}', 'APIController@getWorkshopInfo');

    // Register for item
    Route::get('/register/{userid}/{type}/{id}', 'APIController@registerToItem');

    // Search item
    Route::get('/search/{search_string}', 'APIController@searchForItem');
  });
});
