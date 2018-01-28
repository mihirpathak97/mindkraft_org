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
      <h2 class="hero-head">Z Coders</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="website">
						<h1>Website Team</h1>
            <p>Mihir Pathak - 3rd CSE</p>
					</div>
          <div class="app">
            <h1>App Team</h1>
            <p>Vetha Gnanam - 2nd EMT</p>
            <p>Mihir Pathak - 3rd CSE</p>
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
  @include('includes.jsmin')
</html>
