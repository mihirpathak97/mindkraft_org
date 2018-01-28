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

    <title>MindKraft | App</title>

    @include('includes.stylesheets')
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

		.body{
			color: hsl(0, 0%, 96%) !important;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 18px;
			text-align: center;
      margin-bottom: 3rem;
			padding: 10px;
		}
	</style>

  <body>

    <!-- Actual body -->

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

			@include('includes.mobilenav')

      <br><br>
      <h2 class="hero-head">MindKraft Mobile App</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="body">
						<p>Our team is working tirelessy to get the mobile application out into your hands!</p>
            <p>This page will be updated when it is ready.</p>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
