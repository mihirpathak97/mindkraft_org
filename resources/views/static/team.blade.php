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
						<p>Dr. V. Jagathesan (Department of Electrical Sciences)</p>
					</div>
					<div class="students">
						<h1>Student Co-Ordinators</h1>

						<div class="main-cordinators">
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/renious.jpg') }}">
				          <div class="contact">
				            <a href="https://twitter.com/ReniousCharles" class="tw"></a>
				            <a href="https://www.facebook.com/renious.manleo" class="fb"></a>
				            <a href="" class="gp"></a>
				            <a href="" class="ma"></a>
				          </div>
				        </figure>
				        <h1>Renious Charles<br>2nd MTECH FP</h1>
				      </div>
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/rizal.jpg') }}">
				          <div class="contact">
				            <a href="" class="tw"></a>
				            <a href="" class="fb"></a>
				            <a href="" class="gp"></a>
				            <a href="" class="ma"></a>
				          </div>
				        </figure>
				        <h1>Rizal Joseph<br>3rd ME</h1>
				      </div>
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/mobin.jpg') }}">
				          <div class="contact">
				            <a href="" class="tw"></a>
				            <a href="" class="fb"></a>
				            <a href="" class="gp"></a>
				            <a href="" class="ma"></a>
				          </div>
				        </figure>
				        <h1>Mobin Sam<br>3rd ME</h1>
				      </div>
				      <div class="item">
				        <figure>
				          <img src="{{ URL::asset('images/profile/vignesh.jpg') }}">
				          <div class="contact">
				            <a href="" class="tw"></a>
				            <a href="" class="fb"></a>
				            <a href="" class="gp"></a>
				            <a href="mailto:vigneshl@karunya.edu.in" class="ma"></a>
				          </div>
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
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Vignesh L<br>3rd EEE</h1>
					      </div>
							</div>
						</div>

						<div class="exhibition">
							<h2>Exhibitions</h2>
							<div class="exhibition-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/mobin.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Mobin<br>3rd ME</h1>
					      </div>
							</div>
						</div>

						<div class="workshop">
							<h2>Workshop</h2>
							<div class="workshop-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/renious.jpg') }}">
					          <div class="contact">
					            <a href="https://twitter.com/ReniousCharles" class="tw"></a>
					            <a href="https://www.facebook.com/renious.manleo" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Renious<br>2nd MTECH FP<br>9787744647</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/akash.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Akash<br>2nd EEE<br>9500175255</h1>
					      </div>
							</div>
						</div>

						<div class="tech">
							<h2>Technical Events</h2>
							<div class="tech-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/gideon.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Gideon<br>3rd BM<br>7708206236</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/rizal.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
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
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
									</figure>
									<h1>Justin Varghese<br>4th ME</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/nobody.jpg') }}">
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
									</figure>
									<h1>Jerin John<br>4th ME</h1>
								</div>
							</div>
						</div>

						<div class="food">
							<h2>Food Stalls</h2>
							<div class="food-inner">
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/mobin.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Mobin<br>3rd ME</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/gautham.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Gautham<br>3rd ME</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/vignesh.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
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
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Subin Sajan<br>3rd ME</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/kv.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
					        </figure>
					        <h1>Nivathitha<br>3rd CSE</h1>
					      </div>
								<div class="item">
					        <figure>
					          <img src="{{ URL::asset('images/profile/nobody.jpg') }}">
					          <div class="contact">
					            <a href="" class="tw"></a>
					            <a href="" class="fb"></a>
					            <a href="" class="gp"></a>
					            <a href="" class="ma"></a>
					          </div>
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
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
									</figure>
									<h1>Gideon<br>3rd BM</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/alekhya.jpg') }}">
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
									</figure>
									<h1>Alekhya<br>2nd FP</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/wesley.jpg') }}">
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
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
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
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
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
									</figure>
									<h1>Effrim Riffon<br>3rd CE</h1>
								</div>
								<div class="item">
									<figure>
										<img src="{{ URL::asset('images/profile/allan.jpg') }}">
										<div class="contact">
											<a href="" class="tw"></a>
											<a href="" class="fb"></a>
											<a href="" class="gp"></a>
											<a href="" class="ma"></a>
										</div>
									</figure>
									<h1>Allan Thomas Cabral<br>3rd ME</h1>
								</div>
							</div>
						</div>


						<!-- <p class="gold">Renious Charles - MTECH IT</p>
						<p class="gold">Mobin Sam Baby - 3rd ME</p>
						<p class="gold">Rizal Joseph - 3rd ME</p>
						<p class="gold">Vignesh L - 3rd EEE</p>
						<p class="gold">Mihir Pathak - 3rd CSE</p>
						<p>Jestin Varghese - 4th ME</p>
						<p>Amy Paul - 5th VC</p>
						<p>Jerin V John - 4th ME</p>
						<p>Allan Thomash Cabral - 3rd ME</p>
						<p>Ancy Johnson - 3rd AE</p>
						<p>Anosh Xavier - 3rd CSE</p>
						<p>Effrim Riffon - 3rd CE</p>
						<p>Gautham Chandra - 3rd ME</p>
						<p>Gideon - 3rd BM</p>
						<p>Naveen Philip - 3rd ME</p>
						<p>Navya Darla - 3rd ECE</p>
						<p>K V Nivathitha - 3rd CSE</p>
						<p>Rony Y Raj - 3rd CE</p>
						<p>Selva - 3rd</p>
						<p>Stephan Raj - 3rd BT</p>
						<p>Subin P Sajan - 3rd ME</p>
						<p>Alekhya Alex - 2nd FP</p>
						<p>Vetha Gnanam - 2nd EMT</p> -->
					</div>
				</div>
			</div>

    </div>

  </body>
  @include('includes.jsmin')
	<script type="text/javascript">
		// $('.promotion').click(function () {
		// 	$('.promotion-inner').toggle();
		// });
		// $('.exhibition').click(function () {
		// 	$('.exhibition-inner').toggle();
		// });
		// $('.workshop').click(function () {
		// 	$('.workshop-inner').toggle();
		// });
		// $('.tech').click(function () {
		// 	$('.tech-inner').toggle();
		// });
		// $('.food').click(function () {
		// 	$('.food-inner').toggle();
		// });
		// $('.decoration').click(function () {
		// 	$('.decoration-inner').toggle();
		// });
		// $('.souvenir').click(function () {
		// 	$('.souvenir-inner').toggle();
		// });
		// $('.design').click(function () {
		// 	$('.design-inner').toggle();
		// });
		// $('.sponsors').click(function () {
		// 	$('.sponsors-inner').toggle();
		// });
	</script>
</html>
