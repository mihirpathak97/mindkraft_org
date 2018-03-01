<?php
  namespace App\Http\Controllers;
  use URL, DB;

  if (session()->has('userid') && Controller::checkUserId(session('userid'))) {
    $username = session('username');
  }
?>

<html lang="{{ app()->getLocale() }}">
  <head>
    @include('includes.meta')

    <title>MindKraft | Register</title>

    @include('includes.stylesheets')
  </head>

  <style media="screen">
    .container{
      margin-top: 10%;
    }
  </style>

  <body>

    <!-- Actual body -->

    <div id="base-hero">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">MindKraft 2018 T-Shirt Registration</h2>

      <h2 class="hero-head">Registration are closed!</h2>

    </div>

  </body>
  @include('includes.jsmin')


</html>
