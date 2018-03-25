<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (session()->has('adminuser') && Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin/console')->send();
  }
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MindKraft Admin</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>

  <style media="screen">
    body
    {
      background-color: #fdbd00;
      color: #ffffff;
    }

    .container .jumbotron{
      background-color: black;
      opacity: 0.8;
      filter: alpha(opacity=50);
    }

    #login
    {
      background-color:#fdbd00;
      color: #343025;
      border: 0px;
    }
  </style>
  <body>
    <div class="container">
        <div class="jumbotron">
          <div class="container">
            <h1 class="display-3">Admin - Login</h1>
            <br>
            <?php if (session('error')): ?>
              <h4 style="color:red">{{ session('error') }}</h3>
            <?php endif; ?>
            <form class="form-inline" action="/admin/authenticate" id="login-form" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <label for="email" id="user">Username :</label>
                <input type="text" class="form-control" id="email" name="username" placeholder="Your ID here." required>
                </div>
                <p></p>
                <div class="form-group">
                <label for="password" id="pass">Password :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Your password here." required>
              </div>
            </form>
            <hr class="m-y-md">
            <input type="submit" form="login-form" name="" value="Login" class="btn btn-primary btn-lg">
        </div>
      </div>
      </div>
  </body>
</html>
