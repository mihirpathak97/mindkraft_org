<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $list = DB::select('select * from '.$prefix.$table_name);

  $alias = array(
    'events_list' => 'Events List',
    'games_list' => 'Games List',
    'workshops_list' => 'Workshops List'
  );

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
           </ul>
         </nav></div>
       </div>

   </section>
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab" href="/admin/console">Dashboard</a>
            <a class="navbar-item is-tab is-active"><?php echo $alias[$table_name]; ?></a>
          </div>
        </div>
      </nav>

      <?php if ($table_name == 'games_list'): ?>
        <div class="box">
          <?php foreach ($list as $record): ?>
            <a href="/admin/showinfo/game/<?php echo $record->id ?>"><?php echo $record->name ?></a><br><br>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($table_name == 'events_list'): ?>
        <div class="box">
          <?php foreach ($list as $record): ?>
            <a href="/admin/showinfo/event/<?php echo $record->id ?>"><?php echo $record->name ?></a><br><br>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($table_name == 'workshops_list'): ?>
        <div class="box">
          <?php foreach ($list as $record): ?>
            <a href="/admin/showinfo/workshop/<?php echo $record->id ?>"><?php echo $record->name ?></a><br><br>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </div>
  </body>
</html>
