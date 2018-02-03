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
		@include('includes.meta')

    <title>MindKraft 2018</title>

    @include('includes.stylesheets')
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.css">
		<script src="{{ URL::asset('js/countdown.js') }}" charset="utf-8"></script>
  </head>

	<style media="screen">
		body{
			width: 100vw;
			height: 100vh;
		}
	</style>

  <body>

    @include('includes.preloader')

    <!-- Actual body -->

    <div id="particle-canvas"></div>

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

			@include('includes.mobilenav')

			<div id="fullpage">

				<div class="section">
					<img src="{{ URL::asset('images/kit-new.png') }}" class="head-logo" alt="">
					<h2 class="hero-presents">Presents</h2>
					<div class="mk-div">
						<img src="{{ URL::asset('images/mk-cropped.png') }}" class="mk-logo" alt="">
						<h2 class="mk-2018">MindKraft 2018</h2>
						<h2 class="hero-scroll">Scroll Down!</h2>
					</div>
				</div>

				<div class="section">
					<h2 class="hero-theme">Zenith of Intelligence</h2>
					<h3 class="tag">The Engineers' Contrivance</h3>
		      <h2 class="hero-date">15 March - 17 March</h2>
					<div class="countdown">
						<div class="days">
							<h2></h2>
							<h1 class="time-class">DAYS</h1>
						</div>
						<div class="hours">
							<h2></h2>
							<h1 class="time-class">HOURS</h1>
						</div>
						<div class="minutes">
							<h2></h2>
							<h1 class="time-class">MINS</h1>
						</div>
						<div class="seconds">
							<h2></h2>
							<h1 class="time-class">SECS</h1>
						</div>
					</div>
				</div>

			</div>


			<!-- <img src="{{ URL::asset('images/mk-cropped.png') }}" class="mk-logo" alt=""> -->

			<!-- Chat Box -->
			<div class="message-box-holder">

			</div>

			<!-- Footer -->
			<div class="footer-bottom">
				<a href=""><li class="social-icon"><i class="fa fa-facebook-f" aria-hidden="true"></i></li></a>
				<a href=""><li class="social-icon"><i class="fa fa-instagram" aria-hidden="true"></i></li></a>
				<a href=""><li class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></li></a>
				<a href=""><li class="social-icon"><i class="fa fa-youtube-play" aria-hidden="true"></i></li></a>
				<p>|</p>
				<p>Written with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="/z">Z Coders</a></p>
				<p>|</p>
				<a href="/team">Core Team</a>
			</div>

    </div>

    @include('includes.radialmenu')

		<!-- <footer class="footer">
			<div class="core">

			</div>
			<div class="z-coders">

			</div>
		</footer> -->

  </body>
  @include('includes.js')
	<script src="{{ URL::asset('js/countdown.js') }}" charset="utf-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.5/jquery.fullpage.js" charset="utf-8"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#fullpage').fullpage();
	});
	</script>
</html>
