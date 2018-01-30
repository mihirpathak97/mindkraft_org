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

    <title>MindKraft | Login</title>

    @include('includes.stylesheets')
  </head>

  <style media="screen">
    .container{
      margin-top: 10%;
    }
    #base-hero .field{
      padding-bottom: 3%;
    }
  </style>

  <body>

    <!-- Actual body -->

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">Login</h2>

      <?php if (session()->has('username')): ?>

        <h2>A user is already logged in!</h2>

      <?php else: ?>

        <form class="" id="loginForm">
          <div class="field card">
            <label class="label">Mobile Number</label>
            <div class="control">
              <input class="input" type="text" name="mobile" placeholder="Number here" required>
            </div>
            <p class="help"></p>
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="password" name="password" placeholder="Password here" required>
            </div>
            <p class="help"></p>
            <div class="control">
              <br><br>
              <button class="button is-link">Submit</button>
            </div>
            <p id="ajax-output"></p>
          </div>
        </form>

        <?php endif; ?>

    </div>

  </body>
  @include('includes.jsmin')
</html>
