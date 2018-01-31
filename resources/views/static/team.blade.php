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

    <title>MindKraft | Core Team</title>

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

		.faculty, .students{
			color: hsl(0, 0%, 96%) !important;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 18px;
			text-align: center;
			padding: 10px;
		}

		.students{
			margin-top: 3rem;
			margin-bottom: 3rem;
		}

		.gold{
			color: #FFEB3B;
		}
	</style>

  <body>

    <!-- Actual body -->

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

			@include('includes.mobilenav')

      <br><br>
      <h2 class="hero-head">MindKraft Core Team</h2>

			<div class="position-ref full-height">
				<div class="content">
					<div class="faculty">
						<h1>Facluties</h1>
						<p><b>Orgainzing Secretary - </b>Dr. V. Jagatheesan (Department of Electrical Sciences)</p>
					</div>
					<div class="students">
						<h1>Student Co-Ordinators</h1>
						<p class="gold">Renious Charles - MTECH IT</p>
						<p class="gold">Mobin Sam Baby - 3rd ME</p>
						<p class="gold">Rizal Joseph - 3rd ME</p>
						<p class="gold">Vignesh L - 3rd ECE</p>
						<p>Jestin Varghese - 4th ME</p>
						<p>Amit K Reji - 4th CSE</p>
						<p>Adarsh S Monippally - 4th EMT</p>
						<p>Amy Paul - 5th VC</p>
						<p>Jerin V John - 4th ME</p>
						<p>Koshy Sam - 4th ME</p>
						<p>Mohit George - 4th ME</p>
						<p>Praharsha Siddela - 4th ME</p>
						<p>Allan Thomash Cabral - 3rd ME</p>
						<p>Ancy Johnson - 3rd AE</p>
						<p>Anosh Xavier - 3rd CSE</p>
						<p>Effrim Riffon - 3rd ME</p>
						<p>Gautham Chandra - 3rd ME</p>
						<p class="gold">Mihir Pathak - 3rd CSE</p>
						<p>Naveen Philip - 3rd ME</p>
						<p>Navya Darla - 3rd ECE</p>
						<p>K V Nivethitha - 3rd CSE</p>
						<p>Rony Y Raj - 3rd CE</p>
						<p>Selva - 3rd</p>
						<p>Stephan Raj - 3rd BT</p>
						<p>Subin P Sajan - 3rd ME</p>
						<p>Vijay Gideon Manekshaw - 3rd ECE</p>
						<p>Farzana Jabar A - 2nd FP</p>
						<p>Akilhia - 2nd FP</p>
						<p>Vetha Gnanam - 2nd EMT</p>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>