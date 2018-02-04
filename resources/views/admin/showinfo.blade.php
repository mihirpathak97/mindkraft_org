<?php
  namespace App\Http\Controllers;
  use DB, URL;
  if (!session()->has('adminuser')) {
    Redirect::to('admin')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $query = 'SELECT * from '.$prefix.$type.'_list WHERE id=?';
  $event = DB::select($query, [$id]);
  $event = $event[0];
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
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab is-active"><?php $event->name; ?></a>
          </div>
        </div>
      </nav>

      <div class="box">
        <?php var_dump($event); ?>
      </div>

    </div>
  </body>
</html>
