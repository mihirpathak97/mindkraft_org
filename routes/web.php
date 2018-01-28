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


// Base Routes
Route::view('/', 'home');

Route::view('/home', '/');

// Displaying Events/Workshops/Games
Route::view('/events', 'events');

Route::get('/events/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('events')->with($data);
});

Route::view('/games', 'games');

Route::view('/workshops', 'workshops');

Route::view('/logout', 'logout');

Route::view('/user', 'user');


// Event Request Routes
Route::get('/events/{dept}/{name}/{id}', function ($dept, $name, $id) {
    $data = array('dept' => $dept, 'name' => $name, 'id' => $id);
    return view('req.event')->with($data);
});

Route::get('/workshops/{name}/{id}', function ($name, $id) {
    $data = array('name' => $name, 'id' => $id);
    return view('req.workshop')->with($data);
});

Route::get('/games/{name}/{id}', function ($name, $id) {
    $data = array('name' => $name, 'id' => $id);
    return view('req.game')->with($data);
});

// Event Registration Route
Route::view('/register/{type}/{userid}/{eventid}', 'req.registerevent');


// Misc. Routes (Static Pages)
Route::view('/lectures', 'static.lectures');

Route::view('/exhibitions', 'static.exhibitions');

Route::view('/sponsors', 'static.sponsors');

Route::view('/team', 'static.team');

Route::view('/schedule', 'static.schedule');

Route::redirect('/when', '/schedule');

Route::view('/accomodation', 'static.accomodation');

Route::view('/z', 'static.z');

Route::view('/app', 'static.app');


// Auth Routes
Route::view('/login', 'login');

Route::post('userlogin', 'Auth@login');

Route::view('/register', 'register');

Route::post('userregister', 'Auth@register');

Route::get('verify/{userid}/{token}/{api_token}', 'Auth@userVerify');


// CMS Routes
Route::prefix('cms')->group(function () {

  Route::view('/', 'cms.main');
  Route::view('console', 'cms.console');
  Route::view('game', 'cms.game');
  Route::view('workshop', 'cms.workshop');

  // Auth Route
  Route::post('authenticate', 'CmsController@login');

  // Adder Routes
  Route::post('addevent', 'CmsController@addevent');
  Route::post('addgame', 'CmsController@addgame');
  Route::post('addworkshop', 'CmsController@addworkshop');

});


// Admin Routes
Route::prefix('admin')->group(function () {

  Route::view('/', 'admin.main');
  Route::view('console', 'admin.console');

  Route::view('events', 'admin.events');
  Route::view('games', 'admin.games');
  Route::view('workshops', 'admin.workshops');
  Route::view('users', 'admin.users');

  // Auth Route
  Route::post('authenticate', 'AdminController@login');
});


// Test route. Do all testing in this view
Route::view('/test', 'test');
