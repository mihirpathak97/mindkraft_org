<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $atv = DB::select('select * from '.$prefix.'games_registration where id like \'%atv\'');

  function getPaintballCount()
  {
    $count = 0;
    $paintball = DB::select('select * from '.$prefix.'games_registration where id like \'%paintball\'');
    foreach ($paintball as $item) {
      $count += $item->times;
    }
    return $count;
  }

  function getLaserCount()
  {
    $count = 0;
    $laser = DB::select('select * from '.$prefix.'games_registration where id like \'%laser\'');
    foreach ($laser as $item) {
      $count += $item->times;
    }
    return $count;
  }

  function getAtvCount()
  {
    $count = 0;
    $atv = DB::select('select * from '.$prefix.'games_registration where id like \'%atv\'');
    foreach ($atv as $item) {
      $count += $item->times;
    }
    return $count;
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
            <a class="navbar-item is-tab" href="/cpanel/games">Games List</a>
          </div>
        </div>
      </nav>

      <?php if ($access_level <= 2): ?>

        <div class="box">
          <b>Paintball</b> - <?php echo getPaintballCount() ?><br>
          <b>Laser Tag</b> - <?php echo getLaserCount() ?><br>
          <b>ATV</b> - <?php echo getAtvCount() ?>
        </div>

        <table class="table card">
          <thead>
            <tr>
              <th>Full Name</th>
              <th>Mobile</th>
              <th>E-Mail</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach (explode(':', $list->registered_users) as $record):
              $record = getInfo($record, $prefix);
            ?>
              <tr bgcolor="<?php echo getColor($record->id, $type, $id) ?>">
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
