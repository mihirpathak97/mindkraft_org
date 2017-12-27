<?php
  if (!session()->has('cmsuser')) {
    Redirect::to('cms')->send();
  }
?>
<!DOCTYPE html>
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Dev Console</title>
   <link rel="stylesheet" href="{{ URL::asset('css/cms.css') }}">
 </head>
 <body>

   <section class="hero is-primary">
  <div class="hero-body" style="background:#383838">
    <div class="container">
      <div class="columns is-vcentered">
        <div class="column">
          <p class="title">
            -$ DevConsole
          </p>
        </div>
      </div>
    </div>
  </div>


  <div class="hero-foot">
    <div class="container">
      <nav class="tabs is-boxed">
        <ul>
          <li>
            <a href="/cms/console">Event</a>
          </li>
          <li class="is-active">
            <a href="/cms/game">Games</a>
          </li>
          <li>
            <a href="/cms/workshop">Workshops</a>
          </li>
        </ul>
      </nav></div>
    </div>

</section>

<div id="app">

  <nav class="navbar has-shadow">
    <div class="container">
      <div class="navbar-brand">
        <a class="navbar-item is-tab is-active" href="#">Add A New Game</a>
        <a class="navbar-item is-tab" @click="clone"><i class="fa fa-plus" aria-hidden="true"></i></a>
      </div>
    </div>
  </nav>

  <div class="box">
    <article>
      <form class="" action="/cms/addgame" method="post">
        {{ csrf_field() }}
        <p class="ip-group">
          <label class="label">Game Name</label>
          <input type="text" name="name" class="input" value="" required>
        </p>
        <p class="ip-group">
          <label class="label">Contact</label>
          <textarea name="contact" class="textarea" value="" required></textarea>
        </p>
        <p class="ip-group">
          <label class="label">Fee (type 0 if free)</label>
          <input type="text" name="fee" class="input" value="" required>
        </p>
        <p class="ip-group">
          <label class="label">Prize (type 0 if none)</label>
          <input type="text" name="prize" class="input" value="" required>
        </p>
        <p class="ip-group">
          <label class="label">Game Description</label>
          <textarea name="about" class="textarea" required></textarea>
        </p>
        <input type="submit" name="" class="button is-link" value="Submit">
      </form>
    </article>
  </div>
</div>

</body>
</html>
