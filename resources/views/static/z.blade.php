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

    <title>MindKraft | Z Coders</title>

    @include('includes.stylesheets')
		<link rel="stylesheet" href="{{ URL::asset('css/team.css') }}">
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

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

			@include('includes.mobilenav')

      <br><br>
      <h2 class="hero-head">Website Team</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="tech">
						<h2>Website and REST API Designed By</h2>
							<div class="tech-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/mihir.jpg') }}">
									</figure>
									<h1>
										Mihir Pathak<br>3rd CSE<br>
										<b>PS</b>: I didn't come up with the name "Z Coders"  
									</h1>
								</div>
							</div>
					</div>

					<br>

					<div class="tech">
						<h2>Android App Designed By</h2>
							<div class="tech-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/vedha.jpg') }}">
									</figure>
									<h1>Vedha<br>2nd EMT</h1>
								</div>
							</div>
					</div>

					<div class="tech" style="margin-top:7rem; margin-bottom:7rem"	>
							<div class="tech-inner">
								<div class="item">
									<h1>All department images and other logos courtesy of Sri Ganesh (3rd EMT)</h1>
								</div>
							</div>
					</div>


				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
