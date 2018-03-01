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
            <a href="/cpanel/tshirt">MindKraft T-Shirt Registration</a><br><br>
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
                  <td><a href="/cpanel/showinfo/event/<?php echo $record->id ?>/users">Show Registered Users</a></td>
                <?php else: ?>
                  <td>No Users Have Registered</td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>

      <?php
        if ($access_level == 3) {
          $prefix = env('DB_TABLE_PREFIX', '');
          $user = DB::select('select * from '.$prefix.'cpanel_mapping where username=\''.session('cpaneluser').'\'');
          $user = $user[0];
          function getEventName($id, $type)
          {
            $prefix = env('DB_TABLE_PREFIX', '');
            $event = DB::select('select * from '.$prefix.$type.'s_list where id=\''.$id.'\'');
            return $event[0]->name;
          }

          function getDepartmentName($id, $type)
          {
            $prefix = env('DB_TABLE_PREFIX', '');
            $event = DB::select('select * from '.$prefix.$type.'s_list where id=\''.$id.'\'');
            if (isset($event[0]->department)) {
              if (isset(Controller::dept_list[$event[0]->department])) {
                return Controller::dept_list[$event[0]->department];
              }
              else {
                return Controller::dept_list_workshop[$event[0]->department];
              }
            }
            return 'NIL';
          }

          function getInfo($id, $prefix)
          {
            $query = 'select * from '.$prefix.'enduser where id=?';
            return DB::select($query, [$id])[0];
          }

          // NOTE: Due to older ID type in events, it is necessary to check type
          if (count(explode('-', $user->events)) == 2) {
            $event = explode('-', $user->events)[1];
            $type = explode('-', $user->events)[0];
          }
          else {
            $event = $user->events;
            $type = 'event';
          }

          // Get users list
          $query = 'select * from '.$prefix.'event_registration where id=?';
          $list = DB::select($query, [$type.'-'.$event]);

          ?>

          <?php
          if (count($list) == 1):
            $list = $list[0];
          ?>

            <div class="box">
              <p><b>Event Name</b> - <?php echo getEventName($event, $type) ?> </p>
              <br>
              <p><b>Department</b> - <?php echo getDepartmentName($event, $type) ?></p>
              <br>
              <p><b>Registered Users</b> - <?php echo count(explode(':', $list->registered_users)); ?></p>
              <br><br>
            </div>

            <table class="table card" style="margin: 0px auto">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Mobile</th>
                  <th>E-Mail</th>
                  <th>College</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach (explode(':', $list->registered_users) as $record):
                  $record = getInfo($record, $prefix);
                ?>
                  <tr>
                    <td><?php echo $record->name; ?></td>
                    <td><?php echo $record->mobile; ?></td>
                    <td><?php echo $record->email; ?></td>
                    <td><?php echo $record->college; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>


          <?php else: ?>

            <div class="box">
              <p> <b>Event Name</b> - <?php echo getEventName($event, $type) ?> </p>
              <br>
              <p>No Users Have Registered!</p>
            </div>

          <?php endif; ?>

      <?php
        }
      ?>


      <!-- ACC 9 -->
      <?php
        if ($access_level == 9):
          $list = DB::select('select * from mindkraft18_tshirt_registration order by name');

      ?>

      <div class="box">
        <p><b>MindKraft T-Shirt Registration</b></p>
        <br>
        <p><b>Total Registrations</b> - <?php echo count($list) ?></p><br>
        <p><b>Statistics</b></p>
        <p><b>Male (<?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\'')); ?>)</b></p>
        <p>Small - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'s%\'')); ?></p>
        <p>Medium - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'m%\'')); ?></p>
        <p>Large - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'l%\'')); ?></p>
        <p>XL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'xl%\'')); ?></p>
        <p>XXL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'xxl%\'')); ?></p>
        <p>XXXL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'xxxl%\'')); ?></p>
        <br><br>
        <p><b>Female (<?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\'')); ?>)</b></p>
        <p>Small - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'s%\'')); ?></p>
        <p>Medium - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'m%\'')); ?></p>
        <p>Large - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'l%\'')); ?></p>
        <p>XL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'xl%\'')); ?></p>
        <p>XXL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'xxl%\'')); ?></p>
        <p>XXXL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'xxxl%\'')); ?></p>
        <br><br>
      </div>

      <table class="table card" style="margin: 0px auto">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Registration Number</th>
            <th>Gender</th>
            <th>Size</th>
            <th></th>
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
              <td><a href="/cpanel/showinfo/tshirt/<?php echo $record->register_number ?>">Update Info</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php endif; ?>

    </div>
  </body>
</html>
