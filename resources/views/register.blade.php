<?php
  // if (Request::segment(1) == 'login') {
  //   callLogin();
  // }
  // elseif (Request::segment(1) == 'register') {
  //   callRegister();
  // }
?>

<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MindKraft | Register</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/radial-menu.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/component.css') }}">
    <script src="{{ URL::asset('js/modernizr.custom.js') }}"></script>
  </head>

  <style media="screen">
    .container{
      margin-top: 10%;
    }
  </style>

  <body>

    <!-- Actual body -->

    <!-- <div id="particle-canvas"></div> -->

    <div id="base-hero" class="select-disable">

      <!-- "NAV" -->
      <div id="navbar" class="navbar-collapse collapse enable-select">
        <ul class="nav-ul">
          <?php if (isset($name)) { ?>
            <li><a href="user"><span><?php echo $name; ?></span></a></li>
            <li><a href="logout"><span>Logout</span></a></li>
          <?php }else{ ?>
            <li><a href="login"><span>Login</span></a></li>
            <li><a href="register"><span>Register</span></a></li>
          <?php } ?>
        </ul>
      </div>

      <nav>
        <svg id="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 38">
          <path data-v-14b53e32="" data-name="Line 1" d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z" class="line line-1"></path>
          <path data-v-14b53e32="" data-name="Line 2" d="M6.91,15L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z" class="line line-2"></path>
          <path data-v-14b53e32="" data-name="Line 3" d="M12.91,15L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z" class="line line-3"></path>
          <path data-v-14b53e32="" data-name="Line 4" d="M18.91,15l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z" class="line line-4"></path>
          <path data-v-14b53e32="" data-name="Line 5" d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z" class="line line-5"></path>
        </svg>
      </nav>
      <br><br><br>

      <h2 class="hero-head">Register</h2>

        <div class="">
    			<section>
    				<form id="theForm" class="simform" autocomplete="off">
    					<div class="simform-inner">
    						<ol class="questions">
    							<li>
    								<span><label for="q1">Let's start with your name</label></span>
    								<input id="q1" name="q1" type="text"/>
    							</li>
    							<li>
    								<span><label for="q2">How do we contact you? (primary phone number)</label></span>
    								<input id="q2" name="q2" type="text"/>
    							</li>
    							<li>
    								<span><label for="q3">What is your primary email?</label></span>
    								<input id="q3" name="q3" type="text"/>
    							</li>
    							<li>
    								<span><label for="q4">Where you do you go to college?</label></span>
    								<input id="q4" name="q4" type="text"/>
    							</li>
    							<li>
    								<span><label for="q5">Pick a password</label></span>
    								<input id="q5" name="q5" type="password"/>
    							</li>
    							<li>
    								<span><label for="q6">Retype your password just once more</label></span>
    								<input id="q6" name="q6" type="password"/>
    							</li>
    						</ol><!-- /questions -->
    						<button class="submit" type="submit">Send answers</button>
    						<div class="controls">
    							<button class="next"></button>
    							<div class="progress"></div>
    							<span class="number">
    								<span class="number-current"></span>
    								<span class="number-total"></span>
    							</span>
    							<span class="error-message"></span>
    						</div><!-- / controls -->
    					</div><!-- /simform-inner -->
    					<span class="final-message"></span>
    				</form><!-- /simform -->
    			</section>
    		</div><!-- /container -->
    </div>

  </body>
  <script src="{{ URL::asset('js/lodash.core.js') }}"></script>
  <script src="{{ URL::asset('js/greensock/TweenMax.min.js') }}"></script>
  <script src="{{ URL::asset('js/app.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/particles.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/classie.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/stepsForm.js') }}" charset="utf-8"></script>

  <script>
    var theForm = document.getElementById( 'theForm' );

    new stepsForm( theForm, {
      onSubmit : function( form ) {
        // hide form
        classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );
        var messageEl = theForm.querySelector( '.final-message' );
        messageEl.innerHTML = 'Hold on... <br>Crunching that ol\' database, just for you :) ';
        classie.addClass( messageEl, 'show' );
        formData = new FormData(form);
        formData.append('action', 'register');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            messageEl.innerHTML = xhttp.responseText;
          }
        };
        xhttp.open("POST", "{{ URL::asset('php/authenticate.php') }}", true);
        xhttp.send(formData);
      }
    } );
  </script>

</html>
