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

    <title>MindKraft | Terms and Conditions</title>

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
      <h2 class="hero-head">Event Terms and Conditions</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="body">
						<p>
              The following terms and conditions apply to participants who apply for any events, games or workshops
              conducted during this festival.
              <li>The organizing committee has the authority to not allow a particatular participant to participate in the said event without the need to produce a valid reason.</li>
              <li>Students are strictly advised to follow the rules and regulations of the particatular eventt without fail.</li>
              <li>Event venue/details is subject to change with or without notice and the committee or the institute is not reponsible in any way.</li>
              <li>Event fee (if any) is non-refundable.</li>
            </p>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
