<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $list = DB::select('select * from '.$prefix.'enduser order by name');

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
            <a class="navbar-item is-tab is-active">Users List</a>
          </div>
        </div>
      </nav>

      <table class="table card">
        <thead>
          <tr>
            <th>Name</th>
            <th>ID</th>
            <th>Number</th>
            <th>College</th>
            <th></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($list as $record): ?>
            <tr>
              <td><?php echo $record->name ?></td>
              <td><?php echo $record->id ?></td>
              <td><?php echo $record->mobile ?></td>
              <td><?php echo $record->college ?></td>
              <td><a href="/admin/user/<?php echo $record->id ?>">Show Info</a></td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>


    </div>
  </body>
</html>
