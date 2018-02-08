<?php
  if (!session()->has('adminuser')) {
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
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
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
