<?php
	session_start();
  $path = public_path();
  require $path . '/php/pdo.php';
  require_once $path . '/php/sqlconf.php';
  require_once $path . '/php/lib.php';

  if ($pdo == null) {
    echo "<h2>PDO object could not be created!</h2>";
    return;
  }

	if (isset($_SESSION['username'])) {
      $name = $_SESSION['username'];
	}
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MindKraft 2018</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/radial-menu.css') }}">
  </head>

  <style media="screen">
    <?php
      foreach (dept_list as $key => $dept_name) {
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
      margin-left: -25px;
      height: 200px;
      width: 200px;
      border-radius: 15px;
    }
    .col-sm-3{
      margin-top: 30px;
    }
    .col-sm-3 a:hover{
      text-decoration: none;
    }
    .dept-head{
      margin-top: 15%;
      padding: 5px;
    }
  </style>

  <body>

    <!-- Actual body -->

    <!-- <div id="particle-canvas"></div> -->

    <div id="base-hero" class="select-disable">

      <!-- "NAV" -->
      <div id="navbar" class="navbar-collapse collapse enable-select">
        <ul class="nav-ul">
          <?php if (isset($name)) { ?>
            <li><a href="user"><span><?php echo $name; ?></span></a></li>
            <li><a href="logout"><span>Logout</span></a></li>
          <?php }else{ ?>
            <li><a href="login"><span>Login</span></a></li>
            <li><a href="register"><span>Register</span></a></li>
          <?php } ?>
        </ul>
      </div>

      <!-- <nav>
        <svg id="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 38">
          <path data-v-14b53e32="" data-name="Line 1" d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z" class="line line-1"></path>
          <path data-v-14b53e32="" data-name="Line 2" d="M6.91,15L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z" class="line line-2"></path>
          <path data-v-14b53e32="" data-name="Line 3" d="M12.91,15L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z" class="line line-3"></path>
          <path data-v-14b53e32="" data-name="Line 4" d="M18.91,15l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z" class="line line-4"></path>
          <path data-v-14b53e32="" data-name="Line 5" d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z" class="line line-5"></path>
        </svg>
      </nav> -->
      <br><br>
      <?php
        if (isset($dept)){
          $stmt = $pdo->query("SELECT * FROM $view_prefix" . "events_list WHERE event_department='" . $dept. "'");
      ?>
        <div class="games">
          <h2 class="hero-head"><?php echo dept_list[$dept]; ?></h2>
          <br><br>
          <div class="">
            <?php foreach($stmt as $record) { ?>
              <div class="col-sm-3">
                <div class="card game-card event">
                  <h4><?php echo $record['event_name']; ?></h4>
                  <br><br>
                  <p><a href="/eventreq/<?php echo $record['event_id']?>">Know More</a></p>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php }else { ?>
        <h2 class="hero-head">Events</h2>
        <br><br>
        <div class="games">
          <?php foreach (dept_list as $key => $dept) { ?>
            <div class="col-sm-3">
              <a href="events/<?php echo $key ?>">
                <div class="card game-card <?php echo $key ?> game-card-dept">
                </div>
              </a>
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
  <script src="{{ URL::asset('js/particles.js') }}" charset="utf-8"></script>
</html>