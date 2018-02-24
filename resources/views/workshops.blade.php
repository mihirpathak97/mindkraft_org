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
    @include('includes.meta')

    <title>MindKraft 2018 | Events</title>

    @include('includes.stylesheets')
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

      @include('includes.nav')

			@include('includes.mobilenav')

      <br><br>
      <?php
        if (isset($dept)){
          if ($dept == 'snh') {
            $stmt = $pdo->query("SELECT * FROM $view_prefix" . "workshops_list WHERE department in ('chem', 'phy', 'math', 'nano')");
  					$result = $stmt->fetchAll();
          }
          else {
            $stmt = $pdo->query("SELECT * FROM $view_prefix" . "workshops_list WHERE department='" . $dept. "'");
  					$result = $stmt->fetchAll();
          }
      ?>
        <div class="games">
          <h2 class="hero-head"><?php echo Controller::dept_list[$dept]; ?></h2>
          <br><br>
					<?php if ($stmt->rowCount() == 0): ?>
						<div class="not-avail-content">
							<div class="title">
								<p>More workshops will be added soon! Stay tuned</p>
							</div>
						</div>
					<?php else: ?>
						<?php for ($i=0; $i < $stmt->rowCount(); $i+=4) { ?>
							<div class="columns">
								<?php foreach(array_slice($result, $i, 4) as $record) { ?>
									<div class="column is-one-quarter">
										<div class="game-card">
											<h3 class="dept-head"><?php echo $record['name']; ?></h3>
											<p class="know-more"><a href="/workshops/<?php echo $record['department'].'/'.Controller::slugify($record['name'], '_').'/'.$record['id']?>">Know More</a></p>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					<?php endif; ?>
        </div>
      <?php }else { ?>
				<div class="games">
					<h2 class="hero-head">Workshops</h2>
	        <br><br>
					<?php for ($i=0; $i < count(Controller::dept_list); $i+=4) { ?>
						<div class="columns">
							<?php foreach (array_slice(Controller::dept_list, $i, 4) as $key => $value) { ?>
								<div class="column is-one-quarter">
									<a href="/workshops/<?php echo $key ?>">
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

    @include('includes.radialmenu')

  </body>
  @include('includes.jsmin')
</html>
