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
            <a class="navbar-item is-tab is-active"><?php echo $alias[$table_name]; ?></a>
          </div>
        </div>
      </nav>

      <?php if ($access_level == 1): ?>
        <div class="box">
          <h1><b>Statistics</b></h1>
          <br><br>
          <p>Total Events - <b><?php echo count($list) ?></b></p>
          <br>
          <h2><b>Department Wise Statistics</b></h2>
          <br>
          <?php if ($table_name != 'games_list'): ?>
            <?php
              foreach (Controller::dept_list as $key => $value):
              $count = getByDepartment($key, $prefix, $table_name);
            ?>
            <?php if ($count != 0): ?>
              <p><?php echo $value ?> - <b><?php echo $count ?></b></p>
            <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <br><br>
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

            <?php if ($table_name == 'events_list'): ?>
              <?php foreach ($list as $record): ?>
                <tr>
                  <td><?php echo $record->name ?></td>
                  <td><?php echo Controller::dept_list[$record->department] ?></td>
                  <?php
                    $q = 'select * from '.$prefix.'event_registration where id=?';
                    $data = DB::select($q, [$type[$table_name].'-'.$record->id]);
                    if (count($data) > 0):
                  ?>
                    <td><a href="/cpanel/showinfo/event/<?php echo $record->id ?>">Show Registered Users</a></td>
                  <?php else: ?>
                    <td>No Users Have Registered</td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($table_name == 'games_list'): ?>
                <?php foreach ($list as $record): ?>
                  <tr>
                    <td><?php echo $record->name ?></td>
                    <?php
                      $q = 'select * from '.$prefix.'event_registration where id=?';
                      $data = DB::select($q, [$type[$table_name].'-'.$record->id]);
                      if (count($data) > 0):
                    ?>
                      <td><a href="/cpanel/showinfo/game/<?php echo $record->id ?>">Show Registered Users</a></td>
                    <?php else: ?>
                      <td>No Users Have Registered</td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($table_name == 'workshops_list'): ?>
              <?php foreach ($list as $record): ?>
                <tr>
                  <td><?php echo $record->name ?></td>
                  <td><?php echo Controller::dept_list[$record->department] ?></td>
                  <?php
                    $q = 'select * from '.$prefix.'event_registration where id=?';
                    $data = DB::select($q, [$type[$table_name].'-'.$record->id]);
                    if (count($data) > 0):
                  ?>
                    <td><a href="/cpanel/showinfo/workshop/<?php echo $record->id ?>">Show Registered Users</a></td>
                  <?php else: ?>
                    <td>No Users Have Registered</td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>

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
