<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');
  $list = DB::select('SELECT * from '.$prefix.'enduser');


  // Counts internal participants
  function countInternal($list)
  {
    $count = 0;
    foreach ($list as $item) {
      if ($item->college == 'Karunya Institute of Technology and Sciences, Coimbatore' && Controller::checkUserStatus($item->id)) {
        $count++;
      }
    }
    return $count;
  }

  // Gets "Payed For"
  function getPayedFor($user)
  {
    $user = DB::select('select * from mindkraft18_payment_info where id=\''.$user.'\'')[0];
    $acc = '';

    foreach (explode(':', $user->payed_for) as $payed_for) {
      if ($payed_for == 'main') {
        $acc .= 'MindKraft Registration<br>';
      }
      else {
        if (count(DB::select('select * from mindkraft18_workshops_list where id=\''.$payed_for.'\'')) == 1) {
          $acc .= DB::select('select * from mindkraft18_workshops_list where id=\''.$payed_for.'\'')[0]->name . '<br>';
        }
        else {
          $acc .= $payed_for . '<br>';
        }
      }
    }
    return $acc;
  }

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
            <a class="navbar-item is-tab is-active">Approve Users</a>
          </div>
        </div>
      </nav>

      <div class="box">
        <h1><b>Statistics</b></h1>
        <br><br>
        <p>Total Users - <b><?php echo count(DB::select('select * from mindkraft18_approved_enduser')) ?></b></p>
        <p>Internal -  <?php echo countInternal($list) ?></p>
        <br>
      </div>

      <table class="table card">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>Payed For</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list as $record): ?>
            <tr>
              <td><?php echo $record->id; ?></td>
              <td><?php echo $record->name; ?></td>
              <td><?php echo $record->mobile; ?></td>
              <td><?php echo getPayedFor($record->id) ?></td>
              <td><a href="/cpanel/user/<?php $record->id ?>/receipts">Show Receipts</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </body>
</html>
