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
               <a href="/admin/console" id='active'>Admin Console</a>
             </li>
             <li>
               <a href="/admin/cms/console">CMS Console</a>
             </li>
             <li>
               <a href="/admin/mailer">Mailer</a>
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

      <div class="box">
        <article>
          <a href="/admin/events">Events List</a><br><br>
          <a href="/admin/games">Games List</a><br><br>
          <a href="/admin/workshops">Workshops List</a><br><br>
          <a href="/admin/debates">Debates List</a><br><br>
          <a href="/admin/users">Users List By College</a><br><br>
          <a href="/admin/kits">KITS Users List</a><br><br>
          <a href="/admin/approved">Approved Users List</a><br><br>
        </article>
      </div>
    </div>
  </body>
</html>
