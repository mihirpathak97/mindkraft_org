<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }

  $access_level = CpanelController::getAccessLevel(session('cpaneluser'));

  $list = DB::select('select * from mindkraft18_tshirt_registration order by name');

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
          <p><b>Total Registrations</b> - <?php echo count($list) ?></p><br>
          <p><b>Statistics</b></p>
          <p><b>Male (<?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\'')); ?>)</b></p>
          <p>Small - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'s%\'')); ?></p>
          <p>Medium - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'m%\'') + 1); ?></p>
          <p>Large - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'l%\'')); ?></p>
          <p>XL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'xl%\'')); ?></p>
          <p>XXL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'xxl%\'')); ?></p>
          <p>XXXL - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Male\' having size like \'xxxl%\'')); ?></p>
          <br><br>
          <p><b>Female (<?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\'')); ?>)</b></p>
          <p>Small - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'s%\'')); ?></p>
          <p>Medium - <?php echo count(DB::select('select * from mindkraft18_tshirt_registration where gender=\'Female\' having size like \'m%\'') + 1); ?></p>
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
