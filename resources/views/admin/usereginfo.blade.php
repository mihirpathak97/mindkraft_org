<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');
  $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'');

  $events_list = DB::select('select * from '.$prefix.'events_list');
  $workshops_list = DB::select('select * from '.$prefix.'workshops_list');

?>

<!DOCTYPE html>
<html>
  <head>
    @include('admin.includes.meta')
    <title>Admin Console</title>
    @include('admin.includes.stylesheets')
  </head>
  <style media="screen">
    .card{
      margin: auto;
      margin-top: 2rem;
    }
  </style>
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
            <a class="navbar-item is-tab" href="/admin/console">Dashboard</a>
            <a class="navbar-item is-tab is-active">Users Info</a>
          </div>
        </div>
      </nav>

      <div class="box">
        <br><br>
        <p><b>Name</b></p>
        <p><b>College</b></p>
        <p><b>Registration Number</b></p>
        <p><b>Events Registered</b></p><br>
        <?php
          foreach ($events_list as $event) {
            $users = DB::select('select * from mindkraft18_event_registration where id=\'event-'.$event->id.'\'');
            if (count($users) == 0) {
              $users = $users[0]->registered_users
            }
            else {
              continue;
            }
            if (in_array($id, explode(':', $users))) {
              echo $event->name . '<br>';
            }
          }
        ?>
        <br>
        <p><b>Workshops Registered</b></p><br>
        <?php
          foreach ($workshops_list as $workshop) {
            $users = DB::select('select * from mindkraft18_event_registration where id=\'workshop-'.$workshop->id.'\'')[0]->registered_users;
            if (in_array($id, explode(':', $users))) {
              echo $workshop->name . '<br>';
            }
          }
        ?>
      </div>


    </div>
  </body>
</html>
