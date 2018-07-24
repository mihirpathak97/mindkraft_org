<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the application. These
| routes are loaded by the Laravel backend
|
| NOTE: Please define your apps routes in 'resources/assets/js/React.jsx'
| It is not advised to have any other routes here as they can interfere
| with the React Router.
|
*/

// Test Route
// Uncomment this line if you want to test any code snippet
// Route::view('/test', 'test'); 

// 127.0.0.1
Route::view('/{path?}', 'index')
      ->where('path', '.*');
