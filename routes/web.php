<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/


// NOTE: Please make sure that you use API requests to perform all tasks
// if you can.


// 127.0.0.1
Route::view('/', 'index');
Route::redirect('/home', '/');


/*
|--------------------------------------------------------------------------
| Content Display Routes
|--------------------------------------------------------------------------
|
| There are currently the following supported types -
| - Technical Events [Department Wise]
| - Workshops [Department Wise]
| - Debates
| - Exhibitions
| - Games
|
| More content types can be added, just remember to add it to this comment too :)
|
*/

// Displaying Events
Route::view('/events', 'errors.404');
Route::view('/events/{dept}', 'errors.404');

// Displaying Workshops
Route::view('/workshops', 'errors.404');
Route::view('/workshops/{dept}', 'errors.404');

Route::view('/games', 'errors.404');
Route::view('/debates', 'errors.404');
Route::view('/exhibitions', 'errors.404');


/*
|--------------------------------------------------------------------------
| Content Request Routes
|--------------------------------------------------------------------------
|
| These routes are used to request content for each {item} of {type}
| from the database.
|
| There are currently the following supported types -
| - Technical Events [Department Wise]
| - Workshops [Department Wise]
|
| More content types can be added, just remember to add it to this comment too :)
|
*/

Route::view('/events/{dept}/{name}/{id}', 'errors.404');
Route::view('/workshops/{dept}/{name}/{id}', 'errors.404');


/*
|--------------------------------------------------------------------------
| Events/Workshop Registration Routes
|--------------------------------------------------------------------------
|
| You can create a registration for almost anything by passing {type},
| {userid} and {eventid}
|
*/

Route::view('/register/{type}/{userid}/{eventid}', 'errors.404');
// Event Terms and Conditions
Route::view('/register/terms', 'errors.404');


/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
|
| All static pages should be under the folder "static"
|
*/

Route::view('/accomodation', 'errors.404');
Route::view('/app', 'errors.404');
Route::view('/schedule', 'errors.404');
Route::view('/sponsors', 'errors.404');
Route::view('/team', 'errors.404');
Route::view('/terms', 'errors.404');
Route::view('/z', 'errors.404');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| All user authentication routes like login and register are under this
| banner.
|
*/

Route::view('/login', 'errors.404');
Route::view('/register', 'errors.404');
Route::view('/logout', 'errors.404');
Route::view('/user', 'errors.404');
Route::view('/register/internal', 'errors.404');
Route::view('/register/external', 'errors.404');
Route::post('userlogin', 'Auth@login');
Route::post('userregister', 'Auth@register');
Route::get('verify/{userid}/{token}/{api_token}', 'Auth@userVerify');


/*
|--------------------------------------------------------------------------
| Helper Routes
|--------------------------------------------------------------------------
|
| Use cool shorthand route names here to redirect to complex routes.
|
*/
Route::redirect('/when', '/schedule');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| For the use of Level 0 user.
| {prefix} = 'admin'
|
*/

Route::prefix('admin')->group(function () {
  Route::view('/', 'errors.404');
});



/*
|--------------------------------------------------------------------------
| Cpanel Routes
|--------------------------------------------------------------------------
|
| For the use of other admin users.
| {prefix} = 'cpanel'
|
*/

Route::prefix('cpanel')->group(function () {
  Route::view('/', 'errors.404');
});


/*
|--------------------------------------------------------------------------
| Resource Routes
|--------------------------------------------------------------------------
|
| For all kinds of file downloads
| {prefix} = 'resources'
|
*/

Route::prefix('resources')->group(function () {
  // Add resource routes here
});


// Test route. Do all testing in this view
Route::view('/test', 'test');
