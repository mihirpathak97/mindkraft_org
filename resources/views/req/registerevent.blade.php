<?php

  if (session()->has('username')) {
    $username = session('username');
  }

  $path = explode('/', Request::path());
  $type = $path[count($path) -3];
  $userid = $path[count($path) -2];
  $eventid = $path[count($path) -1];

?>

<html lang="{{ app()->getLocale() }}">

  <head>
    @include('includes.meta')

    <title>MindKraft | Register</title>

    @include('includes.stylesheets')
  </head>

  <body>
    <div id="base-hero" class="select-disable">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">Register for {{ $type }}</h2>

        <div class="box">
          <label class="checkbox">
            <input type="checkbox">
            I agree to the <a href="/register/terms" target="_blank">terms and conditions</a>
          </label>
          <br><br>
          <label class="checkbox">
            <input type="checkbox">
            I am willing to pay the required registration fee <br>(if applicable)</a>
          </label>
          <br><br>
          <button class="button is-link" id="event-register">Submit</button>
          <h2 id="register-reply"></h2>
        </div>

    </div>

  </body>

  @include('includes.jsmin')

  <script type="text/javascript">

  </script>

</html>
