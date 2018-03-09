<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');

  $access_level = CpanelController::getAccessLevel(session('cpaneluser'));

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Console</title>
    <link rel="stylesheet" href="{{ URL::asset('css/cms.css') }}">
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
            <a class="navbar-item is-tab is-active">Users List</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level == 1): ?>
        <div class="box">
          <p><b>Total External Registrations</b> <?php echo count(DB::select('select * from mindkraft18_enduser where not college=\'Karunya Institute of Technology and Sciences, Coimbatore\'')); ?></p>
          <br><br>
          <?php
            foreach (Controller::colleges_list as $college):
              $query = 'SELECT * from '.$prefix.'enduser WHERE college=?';
              $list = DB::select($query, [$college]);
              if (count($list) > 0):
          ?>
            <a href="/cpanel/users/<?php echo $college ?>"><?php echo $college; ?></a><br><br>
          <?php endif; ?>

          <?php endforeach; ?>
        </div>

      <?php else: ?>

        <div class="box">
          <p><b>401 - Unauthorized Access</b></p>
        </div>

      <?php endif; ?>


    </div>
  </body>
</html>
