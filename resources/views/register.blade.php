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
    .full-height {
        height: 40vh;
    }

    .content {
      text-align: center;
    }

    .title {
      color: hsl(0, 0%, 96%);
      font-family: 'Raleway', sans-serif;
      font-weight: 100;
      width: 80%;
      display: block;
      margin: auto;
      font-size: 24px;
      padding: 20px;
    }

    .big{
      display: block;
      margin: auto;
      height: 5rem;
      margin-bottom: 3rem;
    }

    .big .font{
      margin-top: 20px;
      margin-bottom: 20px;
      font-size: 20px;
    }
  </style>

  <body>

    <!-- Actual body -->

    <div id="base-hero">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">Register</h2>

      <?php if (session()->has('username')): ?>

        <h2>A user is already logged in!</h2>

      <?php else: ?>

        <div class="full-height">
  				<div class="content">
  					<div class="title">
              <button type="button" class="button is-link big" onclick="JavaScript:window.location.assign('/register/internal')" name="button"><span class="font">Internal Students</span></button>
              <button type="button" class="button is-link big" onclick="JavaScript:window.location.assign('/register/external')" name="button"><span class="font">External Students</span></button>
  					</div>
  				</div>
  			</div>

      <?php endif; ?>

    </div>

  </body>
  @include('includes.jsmin')

</html>
