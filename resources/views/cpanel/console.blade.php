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

      <?php if ($access_level == 1): ?>
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

      <?php
      if($access_level == 2):
        $prefix = env('DB_TABLE_PREFIX', '');
        $list = DB::select('select * from '.$prefix.'events_list order by name');
      ?>

        <div class="box">
          <h1><b>Statistics</b></h1>
          <br><br>
          <p>Total Events - <b><?php echo count($list) ?></b></p>
        </div>

        <table class="table card">
          <thead>
            <tr>
              <th>Name</th>
              <th>Department</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $record): ?>
              <tr>
                <td><?php echo $record->name ?></td>
                <td><?php echo Controller::dept_list[$record->department] ?></td>
                <?php
                  $q = 'select * from '.$prefix.'event_registration where id=?';
                  $data = DB::select($q, ['event-'.$record->id]);
                  if (count($data) > 0):
                ?>
                  <td><a href="/cpanel/showinfo/event/<?php echo $record->id ?>">Show Registered Users</a></td>
                <?php else: ?>
                  <td>No Users Have Registered</td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

      <?php if($access_level == 3): ?>

        <div class="box">
          <h1 class="center"><b>401 - Access Forbidden</b></h1>
        </div>
      <?php endif; ?>

    </div>
  </body>
</html>
