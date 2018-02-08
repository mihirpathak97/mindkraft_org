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

    <title>MindKraft | Terms &amp; Conditions</title>

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
    li{
      padding: 10px 0;
    }
	</style>

  <body>

    <!-- Actual body -->

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

			@include('includes.mobilenav')

      <br><br>
      <h2 class="hero-head">Terms and Condtitions</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="body">
						<p>
              <li>The institute and the organizing committe holds the rights of admission.</li>
              <li>
                If any damage to the college properties is reported, the cost of the damage will be collected from the
                responsibe students.
              </li>
              <li>
                Smoking is strictly prohibited inside the campus premises. Possession and consumption of alcohol and narcotics and other illegal activities in any form is strictly prohibited.
                Any violation of the mentioned rules will be reported to your college and the case will be severely dealt with.
              </li>
              <li>The organizing committe is not responsibe for any loss/theft of property.</li>
              <li>The organizing committe will not take responsibility for any form of damage to any person or personal property during the course of MindKraft '18.</li>
              <li>In case of any discrepancy, the decision of the organizing committe is final.</li>
            </p>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
