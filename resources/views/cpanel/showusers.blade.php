<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
    Redirect::to('cpanel')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $query = 'select * from '.$prefix.'event_registration where id=?';
  $list = DB::select($query, [$type.'-'.$id]);
  $list = $list[0];

  $name = DB::select('select name from '.$prefix.$type.'s_list where id=\''.$id.'\'')[0]->name;

  function getInfo($id, $prefix)
  {
    $query = 'select * from '.$prefix.'enduser where id=?';
    return DB::select($query, [$id])[0];
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
            <a class="navbar-item is-tab" href="/cpanel/<?php echo $type ?>s"><?php echo ucfirst($type) ?>s List</a>
            <a class="navbar-item is-tab is-active"><?php echo $name ?></a>
          </div>
        </div>
      </nav>

      <?php if ($access_level <= 2): ?>
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
              <tr>
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
