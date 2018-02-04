<?php
  if (!session()->has('adminuser')) {
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
    <title>Admin Console</title>
    <link rel="stylesheet" href="{{ URL::asset('css/cms.css') }}">
  </head>
  <body>
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab is-active">Admin Console</a>
          </div>
        </div>
      </nav>

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
