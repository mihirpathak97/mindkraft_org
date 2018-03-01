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

        <form class="" id="tshirtRegisterForm">
          {{ csrf_field() }}
          <div class="field card">
            <label class="label">Full Name</label>
            <div class="control">
              <input class="input" type="text" name="name" placeholder="Your Name" required>
            </div>
            <label class="label">Registration Number</label>
            <div class="control">
              <input class="input" type="text" name="reg_no" placeholder="XXYYDDNNNN" required>
            </div>
            <label class="label">Gender</label>
            <div class="control">
              <select class="" name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <label class="label">UG/PG</label>
            <div class="control">
              <select class="" name="ugpg" required>
                <option value="UG">UG</option>
                <option value="PG">PG</option>
              </select>
            </div>
            <label class="label">School</label>
            <div class="control">
              <select class="" name="school" required>
                <option value="eng">School of Engineering and Technology</option>
                <option value="arts">School of Arts, Science and Media</option>
                <option value="agri">School of Agriculture and Biosciences</option>
                <option value="mba">School of Management and Law</option>
              </select>
            </div>
            <label class="label">Size</label>
            <div class="control">
              <select class="" name="size" required>
                <option value="s">S</option>
                <option value="m">M</option>
                <option value="l">L</option>
                <option value="xl">XL</option>
                <option value="xxl">XXL</option>
                <option value="xxxl">XXXL</option>
              </select>
            </div>
            <div class="control">
              <br><br>
              <button class="button is-link">Register</button>
            </div>
            <p id="ajax-output"></p>
            <br><br>
          </div>
        </form>

    </div>

  </body>
  @include('includes.jsmin')


  <script type="text/javascript">
  $('#tshirtRegisterForm').submit(function () {

    $('.button').removeClass('is-link');
    $('.button').addClass('button-onclick-animation');
    $('.button').removeClass('button');

    formData = $('#tshirtRegisterForm').serializeArray();
    $.ajax({
      type: 'POST',
      url: '/register/tshirt/register',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: formData,
      success: function (data) {
        // puts back old button classes
        $('.button-onclick-animation').hide();
        $('.button-onclick-animation').addClass('button is-link');
        $('.button-onclick-animation').removeClass('button-onclick-animation');

        $('#ajax-output').html(data);
      }
    });

    return false;
  });
  </script>

</html>
