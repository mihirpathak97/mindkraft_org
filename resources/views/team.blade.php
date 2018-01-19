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

    <title>MindKraft | Core Team</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/radial-menu.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
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

		.faculty, .students{
			color: hsl(0, 0%, 96%) !important;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 18px;
			text-align: center;
			padding: 10px;
		}

		.students{
			margin-top: 3rem;
			margin-bottom: 3rem;
		}

		.gold{
			color: #FFEB3B;
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
      <h2 class="hero-head">MindKraft Core Team</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="faculty">
						<h1>Facluties</h1>
						<p><b>Orgainzing Secretary - </b>Dr. V. Jagatheesan (Department of Electrical Sciences)</p>
					</div>
					<div class="students">
						<h1>Student Co-Ordinators</h1>
						<p class="gold">Renious Charles - MTECH IT</p>
						<p class="gold">Mobin Sam Baby - 3rd ME</p>
						<p class="gold">Rizal Joseph - 3rd ME</p>
						<p class="gold">Vignesh L - 3rd ECE</p>
						<p>Jestin Varghese - 4th ME</p>
						<p>Amit K Reji - 4th CSE</p>
						<p>Adarsh S Monippally - 4th EMT</p>
						<p>Amy Paul - 5th VC</p>
						<p>Jerin V John - 4th ME</p>
						<p>Koshy Sam - 4th ME</p>
						<p>Mohit George - 4th ME</p>
						<p>Praharsha Siddela - 4th ME</p>
						<p>Allan Thomash Cabral - 3rd ME</p>
						<p>Ancy Johnson - 3rd AE</p>
						<p>Anosh Xavier - 3rd CSE</p>
						<p>Dalbut Pelfrey - 3rd EMT</p>
						<p>Effrim Riffon - 3rd ME</p>
						<p>Gautham Chandra - 3rd ME</p>
						<p class="gold">Mihir Pathak - 3rd CSE</p>
						<p>Naveen Philip - 3rd ME</p>
						<p>Navya Darla - 3rd ECE</p>
						<p>K V Nivethitha - 3rd CSE</p>
						<p>Rony Y Raj - 3rd CE</p>
						<p>Selva - 3rd</p>
						<p>Stephan Raj - 3rd BT</p>
						<p>Subin P Sajan - 3rd ME</p>
						<p>Vijay Gideon Manekshaw - 3rd ECE</p>
						<p>Farzana Jabar A - 2nd FP</p>
						<p>Akilhia - 2nd FP</p>
						<p>Vetha Gnanam - 2nd EMT</p>
					</div>
				</div>
			</div>

    </div>

  </body>
  <script src="{{ URL::asset('js/lodash.core.js') }}"></script>
  <script src="{{ URL::asset('js/greensock/TweenMax.min.js') }}"></script>
  <script src="{{ URL::asset('js/app.js') }}" charset="utf-8"></script>
</html>
