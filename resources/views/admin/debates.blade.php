<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
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
            <a class="navbar-item is-tab is-active">Debates</a>
          </div>
        </div>
      </nav>

      <table class="table card">
        <thead>
          <tr>
            <th>Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>Agro War</td>
            <?php
              $q = 'select * from '.$prefix.'event_registration where id=?';
              $data = DB::select($q, ['debate-agro_war']);
              if (count($data) > 0):
            ?>
              <td><a href="/admin/showinfo/debate/agro_war/users">Show Registered Users</a></td>
            <?php else: ?>
              <td>No Users Have Registered</td>
            <?php endif; ?>
          </tr>

          <tr>
            <td>Mock Parliament</td>
            <?php
              $q = 'select * from '.$prefix.'event_registration where id=?';
              $data = DB::select($q, ['debate-mock_parliament']);
              if (count($data) > 0):
            ?>
              <td><a href="/admin/showinfo/debate/mock_parliament/users">Show Registered Users</a></td>
            <?php else: ?>
              <td>No Users Have Registered</td>
            <?php endif; ?>
          </tr>

        </tbody>
      </table>


    </div>
  </body>
</html>
