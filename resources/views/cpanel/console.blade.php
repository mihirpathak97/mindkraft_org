<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }

  $access_level = CpanelController::getAccessLevel(session('cpaneluser'));
?>

<!DOCTYPE html>
<html>
  <head>

    @include('admin.includes.meta')

    <title>Admin Console</title>

    @include('admin.includes.stylesheets')
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
             <li class="is-active">
               <a href="/cpanl/console" id='active'>Admin Console</a>
             </li>
           </ul>
         </nav></div>
       </div>

   </section>

    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab is-active">Dashboard</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level <= 1): ?>
        <div class="box">
          <article>
            <a href="/cpanel/events">Events List</a><br><br>
            <a href="/cpanel/games">Games List</a><br><br>
            <a href="/cpanel/workshops">Workshops List</a><br><br>
            <a href="/cpanel/users">Users List By College</a><br><br>
            <a href="/cpanel/kits">KITS Users List</a><br><br>
          </article>
        </div>
      <?php endif; ?>

      <?php if ($access_level == 2): ?>
        <p>Forbidden</p>
      <?php endif; ?>

    </div>
  </body>
</html>
