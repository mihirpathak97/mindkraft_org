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

    @include('admin.includes.meta')

    <title>Admin Console</title>

    @include('admin.includes.stylesheets')
  </head>
  <body>
    <div id="app">

      @include('admin.includes.topnav')

      <div class="box">
        <article>
          <a href="/admin/events">Events List</a><br><br>
          <a href="/admin/games">Games List</a><br><br>
          <a href="/admin/workshops">Workshops List</a><br><br>
          <a href="/admin/users">Users List By College</a><br><br>
          <a href="/admin/kits">KITS Users List</a><br><br>
        </article>
      </div>
    </div>
  </body>
</html>
