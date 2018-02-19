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
					<div class="main-cordinators">
						<div class="item">
							<figure>
								<img src="{{ URL::asset('images/profile/mihir.jpg') }}">
								<div class="contact">
									<a href="https://twitter.com/mihirpathak97" class="tw"></a>
									<a href="" class="in"></a>
									<a href="" class="gp"></a>
									<a href="mailto:me@mihirpathak.xyz" class="ma"></a>
								</div>
							</figure>
							<h1>Mihir Pathak<br>3rd CSE</h1>
						</div>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
