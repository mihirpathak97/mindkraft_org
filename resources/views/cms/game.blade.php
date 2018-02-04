<?php
  if (!session()->has('cmsuser')) {
    Redirect::to('cms')->send();
  }
?>
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
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
          <textarea name="prize" class="textarea" value="" required></textarea>
        </p>
        <p class="ip-group">
          <label class="label">Rules</label>
          <textarea name="rules" class="textarea" required></textarea>
        </p>
        <p class="ip-group">
          <label class="label">Game Description</label>
          <textarea name="about" class="textarea" required></textarea>
        </p>
        <p class="ip-group">
          <label class="label">Available Seats</label>
          <input type="text" name="seats" class="input" value="" required>
        </p>
        <input type="submit" name="" class="button is-link" value="Submit">
      </form>
    </article>
  </div>
</div>

</body>
</html>
