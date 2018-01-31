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

      <h2 class="hero-head">Register</h2>

      <?php if (session()->has('username')): ?>

          <h2>A user is already logged in!</h2>

      <?php else: ?>

        <form class="" id="internalRegisterForm">
          <div class="field card">
            <label class="label">Full Name</label>
            <div class="control">
              <input class="input" type="text" name="name" placeholder="Your Name" required>
            </div>
            <p class="help"></p>
            <label class="label">Mobile Number</label>
            <div class="control">
              <input class="input" type="text" name="mobile" placeholder="Mobile number" required>
            </div>
            <p class="help"></p>
            <label class="label">University E-Mail ID</label>
            <div class="control">
              <input class="input" type="text" name="email" placeholder="E-Mail ID" required>
            </div>
            <p class="help"></p>
            <label class="label">Registration Numnber</label>
            <div class="control">
              <input class="input" type="text" name="reg_no" placeholder="XXYYDDNNNN" required>
            </div>
            <label class="label">Password</label>
            <div class="control">
              <input class="input" type="password" name="password" placeholder="Password" required>
            </div>
            <p class="help"></p>
            <label class="label">Retype Password</label>
            <div class="control">
              <input class="input" type="password" name="retype" placeholder="Retype password" required>
            </div>
            <p class="help"></p>
            <div class="control">
              <br><br>
              <button class="button is-link">Register</button>
            </div>
            <p id="ajax-output"></p>
            <br><br>
          </div>
        </form>

      <?php endif; ?>

    </div>

  </body>
  @include('includes.jsmin')

</html>
