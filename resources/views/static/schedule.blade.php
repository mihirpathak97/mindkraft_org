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

    <title>MindKraft | Schedule</title>

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
      <h2 class="hero-head">MindKraft 2018 Schedule</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="body">
						<p>This year's MindKraft is being held from March 15 to March 17</p>
            <p>More details will be updated when available.</p>
						<br>
						<p>Click <a href="/resources/event-schedule">here</a> to download Technical Events Schedule and Prize details </p>
						<p>Click <a href="/resources/workshop-schedule">here</a> to download Workshops Schedule</p>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
