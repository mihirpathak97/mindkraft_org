<?php
	namespace App\Http\Controllers;
	use URL, DB;

	if (session()->has('userid') && Controller::checkUserId(session('userid'))) {
		$username = session('username');
	}
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MindKraft | Z Coders</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
  </head>

	<style media="screen">
		.full-height {
				height: 40vh;
		}

		.position-ref {
				position: relative;
		}

		.content {
			text-align: center;
      width: 80%;
      display: block;
      margin: auto;
		}

    h1{
      color: hsl(171, 100%, 41%) !important;
    }

		.website, .app, .social {
			color: hsl(0, 0%, 96%) !important;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 18px;
      text-align: center;
			padding: 10px;
		}

    .social a{
      display: inline;
      font-size: 26px;
      text-decoration: none;
      padding: 20px;
    }

    .fa-bitbucket{
      color: #003366;
    }

    .fa-github{
      color: grey;
    }
	</style>

  <body>

    <!-- Actual body -->

    <!-- <div id="particle-canvas"></div> -->

    <div id="base-hero" class="select-disable">

      <!-- "NAV" -->
      <div id="navbar" class="navbar-collapse collapse enable-select">
        <ul class="nav-ul">
					<li><a href="/home"><span>Home</span></a></li>
          <?php if (isset($username)) { ?>
            <li><a href="/user"><span><?php echo $username; ?></span></a></li>
            <li><a href="/logout"><span>Logout</span></a></li>
          <?php }else{ ?>
            <li><a href="/login"><span>Login</span></a></li>
            <li><a href="/register"><span>Register</span></a></li>
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
				<div class="modal animated fadeIn">
					<div class="modal-background"></div>
					<div class="modal-content">
						<ol>
							<li class="navbar-li"><a href="/home">Home</a></li>
							<li class="navbar-li"><a href="/events">Events</a></li>
							<li class="navbar-li"><a href="/workshops">Workshops</a></li>
							<li class="navbar-li"><a href="/gmaes">Games</a></li>
							<li class="navbar-li"><a href="/lectures">Lectures</a></li>
							<li class="navbar-li"><a href="/exhibitions">Exhibitions</a></li>
							<li class="navbar-li"><a href="/sponsors">Our Sponsors</a></li>
							<li class="navbar-li"><a href="/contact">Contact</a></li>
							<?php if (isset($username)): ?>
								<li class="navbar-li"><a href="/user"><?php echo $username; ?></a></li>
								<li class="navbar-li"><a href="/logout">Logout</a></li>
							<?php else: ?>
								<li class="navbar-li"><a href="/login">Login</a></li>
								<li class="navbar-li"><a href="/register">Register</a></li>
							<?php endif; ?>
						</ol>
					</div>
					<button class="modal-close is-large" aria-label="close"></button>
				</div>
			</nav>
      <br><br>
      <h2 class="hero-head">Z Coders</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="website">
						<h1>Website Team</h1>
            <p>Mihir Pathak</p>
            <p>Dalbut Pelfrey</p>
					</div>
          <div class="app">
            <h1>App Team</h1>
            <p>Vetha Gnanam</p>
            <p>Mihir Pathak</p>
          </div>
          <!-- <div class="social">
            <h1>Contact</h1>
            <a href="https://bitbucket.org/z_coders" target="_blank"><i class="fa fa-bitbucket" aria-hidden="true"></i></a>
            <a href="https://github.com/z-coders" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
          </div> -->
				</div>
			</div>

    </div>

  </body>
  <script src="{{ URL::asset('js/lodash.core.js') }}"></script>
  <script src="{{ URL::asset('js/greensock/TweenMax.min.js') }}"></script>
  <script src="{{ URL::asset('js/app.js') }}" charset="utf-8"></script>
</html>
