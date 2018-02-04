<?php
  namespace App\Http\Controllers;
  use DB, URL;
  if (!session()->has('adminuser')) {
    Redirect::to('admin')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $query = 'SELECT * from '.$prefix.'enduser WHERE college=?';
  $list = DB::select($query, [$college]);
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
            <a class="navbar-item is-tab is-active">Users List</a>
          </div>
        </div>
      </nav>

      <table class="table card">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>E-Mail</th>
            <th>College</th>
            <th>Verified</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($list as $record): ?>
            <tr>
              <td><?php echo $record->id; ?></td>
              <td><?php echo $record->name; ?></td>
              <td><?php echo $record->mobile; ?></td>
              <td><?php echo $record->email; ?></td>
              <td><?php echo $record->college; ?></td>
              <td><?php echo $record->is_verified; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </body>
</html>
