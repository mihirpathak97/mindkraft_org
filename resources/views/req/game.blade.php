<?php

  if (session()->has('username')) {
    $username = session('username');
  }

  $prefix = env('DB_VIEW_PREFIX', '');

  $event = DB::select('select * from '.$prefix.'games_list where id=\''.$id.'\'');

  $event = $event[0];

?>

<html lang="{{ app()->getLocale() }}">

  <head>
    @include('includes.meta')

    <title>MindKraft | Games</title>

    @include('includes.stylesheets')
  </head>

  <body>
    <div id="base-hero" class="select-disable">

      @include('includes.nav')

      @include('includes.mobilenav')

      <br><br><br>

      <h2 class="hero-head">{{ $event->name }}</h2>

      <div class="item-info">
        <ul>
          <li class="info-list game-list-item">Info</li>
          <li class="info-list game-list-item">Rules</li>
          <li class="info-list game-list-item">Contact</li>
          <li class="info-list game-list-item">Fee</li>
          <li class="info-list game-list-item">Prize</li>
          <li class="info-list register-game">Register</li>
        </ul>
        <div class="info-box">
          <div class="info-stuff">
            <h2 class="heading">Info</h2><br>
            <p class="body"><?php echo $event->about; ?></p>
          </div>
        </div>
      </div>

    </div>

    @include('includes.radialmenu')

  </body>

  @include('includes.jsmin')

  <script type="text/javascript">
    var userid = '<?php if(session()->has('userid')){ echo session('userid'); }else { echo 'nil'; } ?>';
    var eventid = window.location.href.split('/')[window.location.href.split('/').length -1];
    $('.register-game').click(function () {
      $.ajax({
        type: 'GET',
        url: '/api/prepareuserregister/game/'+userid+'/'+eventid,
        success: function (data) {
          $('.info-stuff').children('.heading').text('Register');
          $('.info-stuff').children('.body').html(data);
        }
      });
    })
  </script>

</html>
