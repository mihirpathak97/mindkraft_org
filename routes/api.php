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

// Legacy API Routes (Used by website)
Route::get('/geteventinfo/{id}/{param}', 'EventInfoController@getEventInfo');
Route::get('/getgameinfo/{id}/{param}', 'EventInfoController@getGameInfo');
Route::get('/getworkshopinfo/{id}/{param}', 'EventInfoController@getWorkshopInfo');
Route::get('/prepareuserregister/{type}/{userid}/{eventid}', 'EventInfoController@prepareUserRegister');
Route::get('/getchatmessages', 'Controller@getChatMessages');

// Event Registration Route
Route::get('/register/{type}/{userid}/{eventid}', 'EventRegistration@register');


/*
|--------------------------------------------------------------------------
| Mobile App API Routes
|--------------------------------------------------------------------------
|
| All API calls except Auth needs to have an `api_token`
|
*/

// Auth Routes
Route::prefix('auth')->group(function () {

  Route::get('/login/{mobile}/{password}', 'APIController@userAuthLogin');
  Route::get('/register/{name}/{mobile}/{email}/{college}/{password}', 'APIController@userAuthRegister');
  Route::get('/register/{name}/{mobile}/{email}/{college}/{register_no}/{password}', 'APIController@userAuthRegisterKarunya');
  Route::get('/get/api_token/{userid}', 'APIController@getAPIToken');

});
// Get Data
Route::get('{api_token}/get/events', 'APIController@getEventsList');
Route::get('{api_token}/get/events/{dept}', 'APIController@getEventsListDepartment');
Route::get('{api_token}/get/games', 'APIController@getGamesList');
Route::get('{api_token}/get/workshops', 'APIController@getWorkshopsList');
