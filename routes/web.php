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
//       if you can.


// 127.0.0.1
Route::view('/', 'home');
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
Route::view('/events', 'events');
Route::get('/events/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('events')->with($data);
});

// Displaying Workshops
Route::view('/workshops', 'workshops');
Route::get('/workshops/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('workshops')->with($data);
});

Route::view('/games', 'games');
Route::view('/debates', 'debates');
Route::view('/exhibitions', 'exhibitions');


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

Route::get('/events/{dept}/{name}/{id}', function ($dept, $name, $id) {
    $data = array('dept' => $dept, 'name' => $name, 'id' => $id);
    return view('req.event')->with($data);
});
Route::get('/workshops/{dept}/{name}/{id}', function ($dept, $name, $id) {
    $data = array('dept' => $dept, 'name' => $name, 'id' => $id);
    return view('req.workshop')->with($data);
});


/*
|--------------------------------------------------------------------------
| Events/Workshop Registration Routes
|--------------------------------------------------------------------------
|
| You can create a registration for almost anything by passing {type},
| {userid} and {eventid}
|
*/

Route::view('/register/{type}/{userid}/{eventid}', 'req.registerevent');
// Event Terms and Conditions
Route::view('/register/terms', 'req.terms');


/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
|
| All static pages should be under the folder "static"
|
*/

Route::view('/accomodation', 'static.accomodation');
Route::view('/app', 'static.app');
Route::view('/schedule', 'static.schedule');
Route::view('/sponsors', 'static.sponsors');
Route::view('/team', 'static.team');
Route::view('/terms', 'static.terms');
Route::view('/z', 'static.zcoders');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| All user authentication routes like login and register are under this
| banner.
|
*/

Route::view('/login', 'login');
Route::view('/register', 'register');
Route::view('/logout', 'logout');
Route::view('/user', 'user');
Route::view('/register/internal', 'internal');
Route::view('/register/external', 'external');
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

  Route::view('/', 'admin.main');
  Route::view('console', 'admin.console');

  Route::view('events', 'admin.events');
  Route::view('games', 'admin.games');
  Route::view('workshops', 'admin.workshops');

  Route::view('users', 'admin.users');
  Route::get('users/{college}', function ($college) {
    return view('admin.userlist', ['college' => $college]);
  });
  Route::view('kits', 'admin.kitsusers', ['college' => 'Karunya Institute of Technology and Sciences, Coimbatore']);

  Route::get('/showinfo/{type}/{id}', function ($type, $id) {
    return view('admin.showinfo', ['type' => $type, 'id' => $id]);
  });

  Route::get('/showinfo/{type}/{id}/users', function ($type, $id) {
    return view('admin.showusers', ['type' => $type, 'id' => $id]);
  });

  // Approved Users
  Route::view('/approved', 'admin.approved');

  Route::view('test', 'admin.test');

  // Web Mailer Route
  Route::view('mailer', 'admin.mailer');
  Route::post('mailer/send', 'AdminController@MailSender');

  // CMS Routes
  Route::prefix('cms')->group(function () {

    Route::view('console', 'admin.cms.console');
    Route::view('game', 'admin.cms.game');
    Route::view('workshop', 'admin.cms.workshop');
    Route::view('cpanel', 'admin.cms.cpanel');

    // Adder Routes
    Route::post('addevent', 'CmsController@addevent');
    Route::post('addgame', 'CmsController@addgame');
    Route::post('addworkshop', 'CmsController@addworkshop');
    Route::post('addcpaneluser', 'CmsController@addcpaneluser');

    // Modifier Routes
    Route::post('modifyevent', 'CmsController@modifyevent');
    Route::post('modifygame', 'CmsController@modifygame');
    Route::post('modifyworkshop', 'CmsController@modifyworkshop');

  });

  // Auth Route
  Route::post('authenticate', 'AdminController@login');
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

  Route::view('/', 'cpanel.main');
  Route::view('console', 'cpanel.console');

  Route::view('events', 'cpanel.events');
  Route::view('games', 'cpanel.games');
  Route::view('workshops', 'cpanel.workshops');

  Route::view('users', 'cpanel.users');
  Route::get('users/{college}', function ($college) {
    return view('cpanel.userlist', ['college' => $college]);
  });
  Route::view('kits', 'cpanel.kitsusers', ['college' => 'Karunya Institute of Technology and Sciences, Coimbatore']);

  Route::get('/showinfo/{type}/{id}', function ($type, $id) {
    return view('cpanel.showinfo', ['type' => $type, 'id' => $id]);
  });

  Route::get('/showinfo/{type}/{id}/users', function ($type, $id) {
    return view('cpanel.showusers', ['type' => $type, 'id' => $id]);
  });

  Route::view('/tshirt', 'cpanel.tshirt');

  // Update T-shirt Info
  Route::get('/showinfo/tshirt/{id}', function ($type, $id) {
    return view('cpanel.showinfo', ['id' => $id]);
  });
  Route::post('/update/tshirt/{id}', 'CpanelController@updateTshirtInfo');

  // User Approval
  Route::post('/user/info', function () {
    return view('cpanel.userinfo');
  });

  Route::post('/user/{id}/approve', 'AdminController@approveUser');
  Route::post('/user/{id}/pay', 'AdminController@makePayment');

  // Games Registraion
  Route::post('/register/paintball',  function () {
    return view('cpanel.games.paintball');
  });
  Route::post('/register/laser',  function () {
    return view('cpanel.games.laser');
  });
  Route::post('/register/atv',  function () {
    return view('cpanel.games.atv');
  });

  Route::post('/user/{id}/register/{game}', 'AdminController@registerGame');

  // Accomodation
  Route::post('/user/accomodation',  function () {
    return view('cpanel.accomodation');
  });

  Route::post('/user/{id}/accomodation', 'AdminController@registerAccomodation');

  // Auth Route
  Route::post('authenticate', 'CpanelController@login');
  Route::get('logout', 'CpanelController@logout');

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
