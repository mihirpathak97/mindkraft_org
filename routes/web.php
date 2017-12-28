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
Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return redirect('/');
});

// Displaying Events/Workshops/Games
Route::get('/events', function () {
    return view('events');
});

Route::get('/events/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('events')->with($data);
});

Route::get('/workshops', function () {
    return view('workshops');
});

Route::get('/games', function () {
    return view('games');
});


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


// Misc. Routes
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/faq', function () {
    return view('faq');
});


// Auth Routes
Route::get('/login', function () {
    return view('login');
});

Route::post('userlogin', 'Auth@login');

Route::get('/register', function () {
    return view('register');
});

Route::post('userregister', 'Auth@register');


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


// Test route. Do all testing in this view
Route::get('/test', function () {
    return view('test');
});
