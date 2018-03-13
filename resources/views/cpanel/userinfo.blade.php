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


  function checkUserStatus($id)
  {
    if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
      return true;
    }
    return false;
  }

  function checkPaymentStatus($workshop, $id)
  {

    $user = DB::select('select * from mindkraft18_payment_info where id=\''.$id.'\'');

    if (count($user) > 0) {
      if (in_array($workshop, explode(':', $user[0]->payed_for))) {
        return true;
      }
    }
    return false;

  }


  function getFee($workshop, $user)
  {
    if ($user->college == 'Karunya Institute of Technology and Sciences, Coimbatore') {
      return DB::select('select * from mindkraft18_workshop_details where id=\''.$workshop->id.'\'')[0]->fee_internal;
    }
    return DB::select('select * from mindkraft18_workshop_details where id=\''.$workshop->id.'\'')[0]->fee_external;
  }


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
                if (checkPaymentStatus($workshop->id, $user->id)) {
                  echo $workshop->name . ' - ' . '<b>Paid</b>' . '<br>';
                }
                else {
                  echo $workshop->name . ' - Tick to pay <input type="checkbox" class="checkbox workshop" fee="'.getFee($workshop, $user).'" name="'. $workshop->id .'">'.'<br>';
                  echo '<b>Fees</b> - ' . getFee($workshop, $user).'<br>';
                }
              }
            }
          ?><br>

          <?php if (!checkUserStatus($user->id)): ?>
            <b>Note </b> - Please collect extra registration fee of Rs. 300 along with the total amount
          <?php else: ?>
            <p>User is already approved no need to collect registration fee</p>
          <?php endif; ?>

          <b>Total Amount To Be Payed </b> - Rs. <span id="amt">0</span> + <?php if (!checkUserStatus($user->id)) {echo '300';} ?><br><br>
          <?php if (!checkUserStatus($user->id)): ?>
            <button type="button" id="button" class="button is-link" name="button">Approve Registration</button>
          <?php else: ?>
            <button type="button" id="button" class="button is-link" name="button">Make Payment</button>
          <?php endif; ?>
          <br><br>
          <p id="ajax-output"></p>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
        $('.checkbox').change(function () {
          if (this.checked) {
            $('#amt').text(parseInt($('#amt').text()) + parseInt(this.getAttribute("fee")));
          }
          else {
            $('#amt').text(parseInt($('#amt').text()) - parseInt(this.getAttribute("fee")));
          }
        });
        $('#button').click(function () {

          formData = new FormData();
          formData.set('workshops', '');

          document.querySelectorAll('input.checkbox.workshop').forEach(function (currentValue, currentIndex, listObj) {
            if (currentValue.checked) {
              formData.set('workshops', formData.get('workshops') + currentValue.getAttribute('name') + ':');
            }
          });

          $.ajax({
            type: 'POST',
            url: '/cpanel/user/<?php echo $user->id ?>/approve',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {'workshops': formData.get('workshops')},
            success: function (data) {

              console.log(data);
              data = JSON.parse(data);

              var payed = {};

              function getEventName(key) {
                var rsp = '';
                $.get({
                  async: false,
                  url: '/api/open/get/workshop/' + key,
                  success: function (data) {
                    console.log(data);
                    rsp = data;
                  }
                });

                return rsp;

              }

              Object.keys(data.for).forEach(function(key) {
                console.log(key + '-' + data.for[key]);
                payed[getEventName(key)] = data.for[key];
              });

              printWindow = window.open('', 'PRINT', 'height=400, width=600');
              printWindow.document.write('<html><head><br><br><title>MindKraft Registrtion Invoice</title><br><br>');
              printWindow.document.write('<h2 align="center">Karunya Institute of Technology and Sciences</h2><br>');
              printWindow.document.write('<b>Name: </b> - <?php echo $user->name ?><br>');
              printWindow.document.write('<b>User ID: </b> - <?php echo $user->id ?><br>');
              printWindow.document.write('<b>Receipt Number: </b> - ' + data.receipt + '<br>');
              printWindow.document.write('<br><b>Payment has been accepted for the following</b> - <br><br>');
              Object.keys(payed).forEach(function(key) {
                printWindow.document.write(key + '<span style="float:right">'+payed[key]+'</span>' + '<br>');
              });
              printWindow.document.close(); // necessary for IE >= 10
              printWindow.focus(); // necessary for IE >= 10*/
              printWindow.print();
              printWindow.close();
            }
          });
        });
        </script>

        <br><br>

        <?php else: ?>
        <div class="box">
          <b>401 - Unauthorized Access!</b>
        </div>
      <?php endif; ?>

    </div>
  </body>
</html>
