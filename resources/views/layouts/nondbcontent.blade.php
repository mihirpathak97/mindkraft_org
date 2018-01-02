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

    <title>MindKraft | @yield('title')</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/radial-menu.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
  </head>

	<style media="screen">
		.full-height {
				height: 40vh;
		}

		.flex-center {
				align-items: center;
				display: flex;
				justify-content: center;
		}

		.position-ref {
				position: relative;
		}

		.content {
			text-align: center;
		}

		.title {
			color: hsl(0, 0%, 96%);
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 36px;
			padding: 20px;
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
            <li><a href="/user"><span><?php echo $name; ?></span></a></li>
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
						<ol></ol>
					</div>
					<button class="modal-close is-large" aria-label="close"></button>
				</div>
			</nav>
      <br><br>
      <h2 class="hero-head">@yield('title')</h2>

			<div class="flex-center position-ref full-height">
				<div class="content">
					<div class="title">
						<p>This page will be up real soon! Stay tuned</p>
					</div>
				</div>
			</div>

    </div>

    <div id="radial-menu" class="cm-container">
      <ul class="cm-items"></ul>
      <div class="cm-selected-container">
        <div class="cm-selected-label">
          <span><!-- Init here --></span>
        </div>
        <a class="cm-button cm-button-prev" type="button" title="Previous">&lt;</a>
        <a class="cm-button cm-button-next" type="button" title="Next">&gt;</a>
      </div>
    </div>

  </body>
  <script src="{{ URL::asset('js/lodash.core.js') }}"></script>
  <script src="{{ URL::asset('js/greensock/TweenMax.min.js') }}"></script>
  <script src="{{ URL::asset('js/app.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/particles.js') }}" charset="utf-8"></script>
</html>
