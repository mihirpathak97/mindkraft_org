<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $list = DB::select('select * from '.$prefix.$table_name.' order by name');

  $alias = array(
    'events_list' => 'Events List',
    'games_list' => 'Games List',
    'workshops_list' => 'Workshops List'
  );

  $type = array(
    'events_list' => 'event',
    'games_list' => 'game',
    'workshops_list' => 'workshop'
  );

  function getByDepartment($dept, $prefix, $table_name)
  {
    return count(DB::select('select * from '.$prefix.$table_name.' where department=\''.$dept.'\''));
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
               <a href="/cpanel/console" id='active'>Admin Console</a>
             </li>
           </ul>
         </nav></div>
       </div>

   </section>
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab" href="/cpanel/console">Dashboard</a>
            <a class="navbar-item is-tab is-active">T-Shirt Registration</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level == 1): ?>

        <div class="box">
          <p><b>MindKraft T-Shirt Registration</b></p>
          <br>
          <p><b>Total Registrations</b> - <?php echo count($list) ?></p>
          <br><br>
        </div>

        <table class="table card" style="margin: 0px auto">
          <thead>
            <tr>
              <th>Full Name</th>
              <th>Registration Number</th>
              <th>Gender</th>
              <th>Size</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($list as $record):
            ?>
              <tr>
                <td><?php echo $record->name; ?></td>
                <td><?php echo strtoupper($record->register_number); ?></td>
                <td><?php echo $record->gender; ?></td>
                <td><?php echo strtoupper($record->size); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <?php else: ?>
        <div class="box">
          <b>401 - Unauthorized Access!</b>
        </div>
      <?php endif; ?>

    </div>
  </body>
</html>
