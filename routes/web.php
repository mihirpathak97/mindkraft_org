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

Route::redirect('/home', '/');

// Displaying Events/Workshops/Games
Route::view('/events', 'events');

Route::get('/events/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('events')->with($data);
});

Route::view('/workshops', 'workshops');

Route::get('/workshops/{dept}', function ($dept) {
    $data = array('dept' => $dept);
    return view('workshops')->with($data);
});

Route::view('/games', 'games');

Route::view('/logout', 'logout');

Route::view('/user', 'user');


// Event Request Routes
Route::get('/events/{dept}/{name}/{id}', function ($dept, $name, $id) {
    $data = array('dept' => $dept, 'name' => $name, 'id' => $id);
    return view('req.event')->with($data);
});

Route::get('/workshops/{dept}/{name}/{id}', function ($dept, $name, $id) {
    $data = array('dept' => $dept, 'name' => $name, 'id' => $id);
    return view('req.workshop')->with($data);
});

Route::get('/games/{name}/{id}', function ($name, $id) {
    $data = array('name' => $name, 'id' => $id);
    return view('req.game')->with($data);
});

// Event Registration Route
Route::view('/register/{type}/{userid}/{eventid}', 'req.registerevent');

// Event Terms and Conditions
Route::view('/register/terms', 'req.terms');


// Misc. Routes (Static Pages)
Route::view('/accomodation', 'static.accomodation');
Route::view('/app', 'static.app');
Route::view('/schedule', 'static.schedule');
Route::view('/sponsors', 'static.sponsors');
Route::view('/team', 'static.team');
Route::view('/terms', 'static.terms');
Route::view('/z', 'static.z');


// Debate Routes
Route::view('/debates', 'static.debates');
Route::view('/debates/mock_parliament', 'static.debates.mock');
Route::view('/debates/agro_war', 'static.debates.agrowar');


// Exhibition Routes
Route::view('/exhibitions', 'static.exhibitions');
Route::view('/exhibitions/camera_exhibition', 'static.exhibitions.camera');


// Helper Routes
Route::redirect('/when', '/schedule');

// T-Shir Registration
// Route::view('register/tshirt', 'tshirt-register');
// Route::post('register/tshirt/register', 'Auth@tshirtRegister');

// Auth Routes
Route::view('/login', 'login');
Route::post('userlogin', 'Auth@login');
Route::view('/register', 'register');
// Disable Registration
// Route::view('/register', 'tempdisable');
Route::view('/register/internal', 'internal');
Route::view('/register/external', 'external');
Route::post('userregister', 'Auth@register');
Route::get('verify/{userid}/{token}/{api_token}', 'Auth@userVerify');


// Admin Routes
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


// CPanel Routes
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

  // Auth Route
  Route::post('authenticate', 'CpanelController@login');
  Route::get('logout', 'CpanelController@logout');

});


// Resource Routes
Route::prefix('resources')->group(function () {

  // IEEE Paper Presentation Format
  Route::redirect('ieee', '/resources/ieee-format.doc');

});


// Test route. Do all testing in this view
Route::view('/test', 'test');
