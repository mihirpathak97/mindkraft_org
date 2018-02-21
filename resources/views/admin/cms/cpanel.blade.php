<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }
?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Dev Console</title>
   <link rel="stylesheet" href="{{ URL::asset('css/cms.css') }}">
 </head>

 <body>

   <section class="hero is-primary">

    <div class="hero-body" style="background:#383838">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column">
            <p class="title">
              -$ DevConsole
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="hero-foot">
      <div class="container">
        <nav class="tabs is-boxed">
          <ul>
            <li>
              <a href="/admin/console">Admin Console</a>
            </li>
            <li class="is-active">
              <a href="/admin/cms/console">CMS Console</a>
            </li>
          </ul>
        </nav></div>
      </div>

  </section>

<div id="app">

  <nav class="navbar has-shadow">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-item is-tab" href="/admin/cms/console">Add Event</a>
        <a class="navbar-item is-tab" href="/admin/cms/game">Add Game</a>
        <a class="navbar-item is-tab" href="/admin/cms/workshop">Add Workshop</a>
        <a class="navbar-item is-tab is-active" href="/admin/cms/cpanel">Cpanel Users</a>
      </div>
    </div>
  </nav>

  <div class="box">
    <article>
      <form class="" action="/admin/cms/addcpaneluser" method="post">
        {{ csrf_field() }}
        <p class="ip-group">
          <label class="label">Cpanel Username</label>
          <input type="text" name="name" class="input" value="" required>
        </p>
        <p class="ip-group">
          <label class="label">Cpanel Password</label>
          <input type="text" name="password" class="input" value="" required>
        </p>
        <p class="ip-group">
          <label class="label">Event ID</label>
          <input type="text" name="id" class="input" value="" required>
        </p>
        <input type="submit" name="" class="button is-link" value="Submit">
      </form>
    </article>
  </div>
</div>

</body>
</html>
