<?php
	namespace App\Http\Controllers;
	use URL, DB;

	if (session()->has('userid') && Controller::checkUserId(session('userid'))) {
		$username = session('username');
	}

	$pdo = DB::connection()->getPdo();

	$view_prefix = env('DB_VIEW_PREFIX', '');

?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MindKraft 2018</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/radial-menu.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
  </head>

  <style media="screen">
    <?php
      foreach (Controller::dept_list as $key => $dept_name) {
        echo
        ".".$key."{
          background-image: url(/images/dept/$key.jpg);
          background-size: cover;
          background-repeat: no-repeat;
          }
        ";
      }
    ?>
    .game-card-dept{
      height: 200px;
      width: 200px;
      border-radius: 8px;
			display: block;
			margin: auto;
    }
  </style>

  <body>

    <!-- Actual body -->

    <!-- <div id="particle-canvas"></div> -->

    <div id="base-hero" class="select-disable">

      <!-- "NAV" -->
      <div id="navbar" class="navbar-collapse collapse enable-select">
        <ul class="nav-ul">
          <?php if (isset($username)) { ?>
            <li><a href="/user"><span><?php echo $username; ?></span></a></li>
            <li><a href="/logout"><span>Logout</span></a></li>
          <?php }else{ ?>
            <li><a href="/login"><span>Login</span></a></li>
            <li><a href="/register"><span>Register</span></a></li>
          <?php } ?>
        </ul>
      </div>

			<nav>
				<svg id="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 38">
					<path data-v-14b53e32="" data-name="Line 1" d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z" class="line line-1"></path>
					<path data-v-14b53e32="" data-name="Line 2" d="M6.91,15L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z" class="line line-2"></path>
					<path data-v-14b53e32="" data-name="Line 3" d="M12.91,15L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z" class="line line-3"></path>
					<path data-v-14b53e32="" data-name="Line 4" d="M18.91,15l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z" class="line line-4"></path>
					<path data-v-14b53e32="" data-name="Line 5" d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z" class="line line-5"></path>
				</svg>
				<div class="modal animated fadeIn">
					<div class="modal-background"></div>
					<div class="modal-content">
						<ol></ol>
					</div>
					<button class="modal-close is-large" aria-label="close"></button>
				</div>
			</nav>
      <br><br>
      <?php
        if (isset($dept)){
          $stmt = $pdo->query("SELECT * FROM $view_prefix" . "events_list WHERE department='" . $dept. "'");
					$result = $stmt->fetchAll();
      ?>
        <div class="games">
          <h2 class="hero-head"><?php echo Controller::dept_list[$dept]; ?></h2>
          <br><br>
					<?php for ($i=0; $i < $stmt->rowCount(); $i+=4) { ?>
						<div class="columns">
							<?php foreach(array_slice($result, $i, 4) as $record) { ?>
								<div class="column is-one-quarter">
									<div class="game-card">
										<h3 class="dept-head"><?php echo $record['name']; ?></h3>
										<p class="know-more"><a href="/events/<?php echo $record['department'].'/'.Controller::slugify($record['name'], '_').'/'.$record['id']?>">Know More</a></p>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
        </div>
      <?php }else { ?>
				<div class="games">
					<h2 class="hero-head">Events</h2>
	        <br><br>
					<?php for ($i=0; $i < count(Controller::dept_list); $i+=4) { ?>
						<div class="columns">
							<?php foreach (array_slice(Controller::dept_list, $i, 4) as $key => $value) { ?>
								<div class="column is-one-quarter">
									<a href="/events/<?php echo $key ?>">
										<div class="card game-card <?php echo $key ?> game-card-dept">
										</div>
									</a>
								</div>
							<?php } ?>
						</div>
							<?php } ?>
				</div>
				<?php } ?>
    </div>

    <div id="radial-menu" class="cm-container">
      <ul class="cm-items"></ul>
      <div class="cm-selected-container">
        <div class="cm-selected-label">
          <span><!-- Init here --></span>
        </div>
        <a class="cm-button cm-button-prev" type="button" title="Previous">&lt;</a>
        <a class="cm-button cm-button-next" type="button" title="Next">&gt;</a>
      </div>
    </div>

  </body>
  <script src="{{ URL::asset('js/lodash.core.js') }}"></script>
  <script src="{{ URL::asset('js/greensock/TweenMax.min.js') }}"></script>
  <script src="{{ URL::asset('js/app.js') }}" charset="utf-8"></script>
</html>
