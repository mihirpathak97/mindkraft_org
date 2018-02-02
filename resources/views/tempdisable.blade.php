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

    <title>MindKraft | Register</title>

    @include('includes.stylesheets')
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

    <div id="base-hero" class="select-disable">

      <br><br>
      <h2 class="hero-head">Register</h2>

			<div class="flex-center position-ref full-height">
				<div class="content">
					<div class="title">
						<p>Registrations are temporarily disabled! Please check back later</p>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
