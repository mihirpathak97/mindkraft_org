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

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/events/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('events')->with($data);
});

Route::get('/eventreq/{eventid}', function ($eventid) {
    $data = array('eventid' => $eventid);
    return view('eventreq')->with($data);
});

Route::get('/workshops', function () {
    return view('workshops');
});

Route::get('/games', function () {
    return view('games');
});

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


// Test route. Do all testing in this view
Route::get('/test', function () {
    return view('test');
});
