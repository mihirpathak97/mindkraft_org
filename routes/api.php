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

Route::get('/geteventinfo/{id}/{param}', 'EventInfoController@getEventInfo');
Route::get('/getgameinfo/{id}/{param}', 'EventInfoController@getGameInfo');
Route::get('/getworkshopinfo/{id}/{param}', 'EventInfoController@getWorkshopInfo');
Route::get('/prepareuserregister/{type}/{userid}/{eventid}', 'EventInfoController@prepareUserRegister');

// Event Registration Route
Route::get('/register/{type}/{userid}/{eventid}', 'EventRegistration@register');
