<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect, Request;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }

  $request = new Request();

  $prefix = env('DB_TABLE_PREFIX', '');
  $user = DB::select('select * from '.$prefix.'enduser where mobile=\''.Request::input('mobile').'\'');

  if (count($user) == 0) {
    echo "User Not Found!";
    return;
  }

  $user = $user[0];

  $events_list = DB::select('select * from '.$prefix.'events_list');
  $workshops_list = DB::select('select * from '.$prefix.'workshops_list');

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
            <a class="navbar-item is-tab is-active">User Info</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level == 10): ?>
        <div class="box">
          <br><br>
          <p><b>Name</b> - <?php echo $user->name ?></p>
          <p><b>College</b> - <?php echo $user->college ?></p>
          <p><b>Registration Number</b> - <?php echo $user->register_number ?></p><br>
          <p><b>Events Registered</b></p>
          <?php
            foreach ($events_list as $event) {
              $users = DB::select('select * from mindkraft18_event_registration where id=\'event-'.$event->id.'\'');
              if (count($users) == 1) {
                $users = $users[0]->registered_users;
              }
              else {
                continue;
              }
              if (in_array($user->id, explode(':', $users))) {
                echo $event->name . '<br>';
              }
            }
          ?>
          <br>
          <p><b>Workshops Registered</b></p>
          <?php
            foreach ($workshops_list as $workshop) {
              $users = DB::select('select * from mindkraft18_event_registration where id=\'workshop-'.$workshop->id.'\'');
              if (count($users) == 1) {
                $users = $users[0]->registered_users;
              }
              else {
                continue;
              }
              if (in_array($user->id, explode(':', $users))) {
                echo $workshop->name . '<br>';
              }
            }
          ?><br>

          <button type="button" id="button" class="button is-link" name="button">Approve Registration</button>
          <br><br>
          <p id="ajax-output"></p>
          <br>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
        $('#button').click(function () {
          $.ajax({
            type: 'POST',
            url: '/cpanel/user/<?php echo $user->id ?>/approve',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
              $('#ajax-output').html(data);
            }
          });
        });
        </script>

        <div class="box">
          <b>Payment</b>
          <?php if (checkUserStatus($user->id)): ?>
            <b>Workshops</b><br>
            <?php
              foreach ($workshops_list as $workshop) {
                $users = DB::select('select * from mindkraft18_event_registration where id=\'workshop-'.$workshop->id.'\'');
                if (count($users) == 1) {
                  $users = $users[0]->registered_users;
                }
                else {
                  continue;
                }
                if (in_array($user->id, explode(':', $users))) {
                  if (checkPaymentStatus($workshop->id, $user->id)) {
                    echo $workshop->name . ' - ' . '<b>Paid</b>' . '<br>';
                  }
                  else {
                    echo $workshop->name . ' - Tick to pay <input type="checkbox" class="input workshop" name="'. $workshop->id .'">'.'<br>';
                    echo '<b>Fees</b><br>' . $workshop->fee.'<br>';
                  }
                }
              }
            ?><br>
            <input type="number" name="amt" value="">
            <button type="button" id="pay" class="button is-link">Pay Now</button>

            <script type="text/javascript">
            $('#pay').click(function () {

              formData = new FormData();

              document.querySelectorAll('input.workshop').forEach(function (currentValue, currentIndex, listObj) {
                console.log(currentValue);
              });

              $.ajax({
                type: 'POST',
                url: '/cpanel/user/<?php echo $user->id ?>/pay',
                data:
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                  $('#ajax-output').html(data);
                }
              });
            });
            </script>

          <?php endif; ?>

        </div>

        <?php else: ?>
        <div class="box">
          <b>401 - Unauthorized Access!</b>
        </div>
      <?php endif; ?>

    </div>
  </body>
</html>
