<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');
  $query = 'SELECT * from '.$prefix.'enduser WHERE college=? order by name';
  $list = DB::select($query, [$college]);

  // get users from each year
  function getByYear($year, $prefix, $college)
  {
    if ($year == 1) {
      $condition = 'UR_17%';
    }
    if ($year == 2) {
      $condition = 'UR16%';
    }
    if ($year == 3) {
      $condition = 'UR15%';
    }
    if ($year == 4) {
      $condition = 'UR14%';
    }

    $query = 'SELECT * from '.$prefix.'enduser WHERE college=? and register_number like \''.$condition.'\'';
    return count(DB::select($query, [$college]));

  }

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
            <a class="navbar-item is-tab is-active">KITS Users List</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level == 1): ?>
        <div class="box">
          <h1><b>Statistics</b></h1>
          <br><br>
          <p>Total Users - <b><?php echo count($list) ?></b></p>
          <br>
          <h2><b>Years Wise Statistics</b></h2>
          <br>
          <p>1st Years - <b><?php echo getByYear(1, $prefix, $college); ?></b></p>
          <p>2nd Years - <b><?php echo getByYear(2, $prefix, $college); ?></b></p>
          <p>3rd Years - <b><?php echo getByYear(3, $prefix, $college); ?></b></p>
          <p>4th Years - <b><?php echo getByYear(4, $prefix, $college); ?></b></p>
          <br><br>
        </div>

        <table class="table card">
          <thead>
            <tr>
              <th>Registration Number</th>
              <th>Full Name</th>
              <th>Mobile</th>
              <th>E-Mail</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $record): ?>
              <tr>
                <td><?php echo $record->register_number; ?></td>
                <td><?php echo $record->name; ?></td>
                <td><?php echo $record->mobile; ?></td>
                <td><?php echo $record->email; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      <?php else: ?>

        <div class="box">
          <p><b>401 - Unauthorized Access</b></p>
        </div>

      <?php endif; ?>


    </div>
  </body>
</html>
