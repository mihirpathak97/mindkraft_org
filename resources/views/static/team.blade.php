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
			width: 100%;
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
						<h1>Orgainzing Secretary</h1>
						<p>Dr. V. Jegathesan (Department of Electrical Sciences)</p>
					</div>
					<div class="students">
						<h1>Student Co-Ordinators</h1>

						<div class="main-cordinators">
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/renious.jpg') }}">
				        </figure>
				        <h1>Renious Charles<br>2nd MTECH FP</h1>
				      </div>
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/rizal.jpg') }}">
				        </figure>
				        <h1>Rizal Joseph<br>3rd ME</h1>
				      </div>
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/mobin.jpg') }}">
				        </figure>
				        <h1>Mobin Sam<br>3rd ME</h1>
				      </div>
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/vignesh.jpg') }}">
				        </figure>
				        <h1>Vignesh L<br>3rd EEE</h1>
				      </div>
				    </div>

						<div class="promotion">
							<h2><i class="fa fa-newspaper"></i>Promotion, Media & Debates</h2>
							<div class="promotion-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/vignesh.jpg') }}">
					        </figure>
					        <h1>Vignesh L<br>3rd EEE</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/akash.jpg') }}">
					        </figure>
					        <h1>Akash<br>2nd EE</h1>
					      </div>
							</div>
						</div>

						<div class="exhibition">
							<h2>Exhibitions</h2>
							<div class="exhibition-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/mobin.jpg') }}">
					        </figure>
					        <h1>Mobin<br>3rd ME</h1>
					      </div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/effrim.png') }}">
									</figure>
									<h1>Effrim Rifon<br>3rd CE</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/stephen.jpg') }}">
									</figure>
									<h1>Stephenraj<br>3rd BT</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/selva.jpg') }}">
									</figure>
									<h1>Selvakumar<br>3rd BT</h1>
								</div>
							</div>
						</div>

						<div class="workshop">
							<h2>Workshop</h2>
							<div class="workshop-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/renious.jpg') }}">
					        </figure>
					        <h1>Renious<br>2nd MTECH FP<br>9787744647</h1>
					      </div>
							</div>
						</div>

						<div class="tech">
							<h2>Technical Events</h2>
							<div class="tech-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/gideon.jpg') }}">
					        </figure>
					        <h1>Gideon<br>3rd BM<br>7708206236</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/rizal.jpg') }}">
					        </figure>
					        <h1>Rizal<br>3rd ME<br>8438153106</h1>
					      </div>
							</div>
						</div>

						<div class="sponsors">
							<h2>Sponsorship & Tech Talks</h2>
							<div class="sponsors-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/nobody.jpg') }}">
									</figure>
									<h1>Justin Varghese<br>4th ME</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/nobody.jpg') }}">
									</figure>
									<h1>Jerin John<br>4th ME</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/naveen.jpg') }}">
									</figure>
									<h1>Naveen Jacob<br>3rd ME</h1>
								</div>
							</div>
						</div>

						<div class="food">
							<h2>Food Stalls</h2>
							<div class="food-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/mobin.jpg') }}">
					        </figure>
					        <h1>Mobin<br>3rd ME</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/gautham.jpg') }}">
					        </figure>
					        <h1>Gautham<br>3rd ME</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/vignesh.jpg') }}">
					        </figure>
					        <h1>Vignesh L<br>3rd EEE</h1>
					      </div>
							</div>
						</div>

						<div class="decoration">
							<h2>Decorations</h2>
							<div class="decoration-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/subin.jpg') }}">
					        </figure>
					        <h1>Subin Sajan<br>3rd ME</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/kv.jpg') }}">
					        </figure>
					        <h1>Nivathitha<br>3rd CSE</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/rony.png') }}">
					        </figure>
					        <h1>Rony Raj<br>3rd CE</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/ancy.jpg') }}">
					        </figure>
					        <h1>Ancy<br>3rd AE</h1>
					      </div>
							</div>
						</div>

						<div class="souvenir">
							<h2>Souvenir</h2>
							<div class="souvenir-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/gideon.jpg') }}">
									</figure>
									<h1>Gideon<br>3rd BM</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/alekhya.jpg') }}">
									</figure>
									<h1>Alekhya<br>2nd FP</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/wesley.jpg') }}">
									</figure>
									<h1>John Wesley<br>2nd EEE</h1>
								</div>
							</div>
						</div>

						<div class="design">
							<h2>Design</h2>
							<div class="design-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/anosh.jpg') }}">
									</figure>
									<h1>Anosh Xavier<br>3rd CSE</h1>
								</div>
							</div>
						</div>


						<div class="games">
							<h2>Games</h2>
							<div class="games-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/effrim.png') }}">
									</figure>
									<h1>Effrim Rifon<br>3rd CE</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/allan.jpg') }}">
									</figure>
									<h1>Allan Thomas Cabral<br>3rd ME</h1>
								</div>
							</div>
						</div>

						<div class="cultural">
							<h2>Cultural Team</h2>
							<div class="cultural-inner">
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/gautham.jpg') }}">
									</figure>
									<h1>Gautham Chandra<br>3rd ME</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/navya.jpg') }}">
									</figure>
									<h1>Navya Darla<br>3rd EC</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
</html>
