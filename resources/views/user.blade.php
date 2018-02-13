<?php
  namespace App\Http\Controllers;
  use URL, DB;

  if (session()->has('userid') && Controller::checkUserId(session('userid'))) {
    $username = session('username');

    $prefix = env('DB_VIEW_PREFIX', '');

    $user = DB::select('select * from '.$prefix.'enduser where id=\''.session('userid').'\'')[0];

  }

  function verificatonStatus($value){
    return $value == true ? 'Verified' : 'Not Verified!';
  }

?>

<html lang="{{ app()->getLocale() }}">
  <head>
    @include('includes.meta')

    <title>MindKraft | User</title>

    @include('includes.stylesheets')
  </head>

  <style media="screen">
    .container{
      margin-top: 10%;
      width: 75%;
      display: block;
      margin: auto;
    }
    #base-hero .field{
      padding-bottom: 3%;
    }
    .container p{
      color: white !important;
      font-family: 'Raleway', sans-serif;
      text-align: left;
      font-size: 24px;
      padding: 10px;
    }
  </style>

  <body>

    <!-- Actual body -->

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">User Details</h2>

      <?php if (session()->has('username')): ?>

        <div class="container">
          <p> <b>Name</b> - <?php echo $user->name; ?> </p>
          <p> <b>Mobile Number</b> - <?php echo $user->mobile; ?> </p>
          <p> <b>E-mail ID</b> - <?php echo $user->email; ?> </p>
          <p> <b>College Name</b> - <?php echo $user->college; ?> </p>
          <p> <b>Account Verification Status</b> - <?php echo verificatonStatus($user->is_verified); ?> </p>
        </div>

      <?php else: ?>

        <h2>You Must Login First</h2>

        <?php endif; ?>

    </div>

  </body>
  @include('includes.jsmin')
</html>
