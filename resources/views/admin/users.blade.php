<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }
  
  $prefix = env('DB_TABLE_PREFIX', '');

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

      <div class="box">
        <?php
          foreach (Controller::colleges_list as $college):
            $query = 'SELECT * from '.$prefix.'enduser WHERE college=?';
            $list = DB::select($query, [$college]);
            if (count($list) > 0):
        ?>
          <a href="/admin/users/<?php echo $college ?>"><?php echo $college; ?></a><br><br>
        <?php endif; ?>

        <?php endforeach; ?>
      </div>


    </div>
  </body>
</html>
