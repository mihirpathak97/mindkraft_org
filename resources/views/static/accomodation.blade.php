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

    <title>MindKraft | Accomodation</title>

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
			text-align: left;
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
      <h2 class="hero-head">Accomodation</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="body">
						<p>
							We are pleased to inform that your accommodation will be arranged at Karunya Institute of Technology and Sciences during the course of
							MindKraft 2018 at a very nominal fare of <b>₹ 250 per night without food</b> and <b>₹ 400 with 3 meals a day</b>.
							The provided accommodation will be within the Campus and hence will spare you travelling worries.
							The pleasant climate in the Karunya campus will make you feel at home and at ease with the surroundings.
							As your host we’re excited to have you and wish you a wonderful stay and an enjoyable, rejuvenating experience in Karunya.
						</p>
						<p><b>Note</b> - Rooms are subject to demand and will be allotted on first come first serve basis.</p>
						<br>
						<p><b>Contact</b></p>
						<p>Vignesh - 9491082989</p>
					</div>
				</div>
			</div>

    </div>

		@include('includes.radialmenu')

  </body>
  @include('includes.jsmin')
</html>
