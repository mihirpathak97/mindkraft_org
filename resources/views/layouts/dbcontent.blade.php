<?php
	namespace App\Http\Controllers;
	use URL, DB;
	if (session()->has('userid') && Controller::checkUserId(session('userid'))) {
		$username = session('username');
	}

	$table_list = DB::select("select * from $table_name");

?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    @include('includes.meta')

    <title>MindKraft | @yield('title')</title>

    @include('includes.stylesheets')
  </head>

  <body>

    <!-- Actual body -->

    <div id="base-hero" class="select-disable">

      @include('includes.nav')

			@include('includes.mobilenav')

			<br><br>

			<div class="games">
        <h2 class="hero-head">@yield('title')</h2>
        <br><br>
				<?php if (count($table_list) == 0): ?>
					<div class="not-avail-content">
						<div class="title">
							<p>This page will be up real soon! Stay tuned</p>
						</div>
					</div>
				<?php else: ?>
	        <?php for ($i=0; $i < count($table_list); $i+=4) { ?>
						<div class="columns">
							<?php	foreach(array_slice($table_list, $i, 4) as $record) { ?>
								<div class="column is-one-quarter">
									<div class="game-card">
										<h3 class="dept-head"><?php echo $record->name; ?></h3>
										<br><br>
										<p class="know-more"><a href="<?php echo '/'.$link.'/'.Controller::slugify($record->name, '_').'/'.$record->id ?>">Know More</a></p>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				<?php endif; ?>
      </div>

		</div>

    @include('includes.radialmenu')

  </body>
  @include('includes.jsmin')
</html>
