<?php
  if (session()->has('username')) {
    session()->forget('username');
  }
  if (session()->has('userid')) {
    session()->forget('userid');
  }

  Redirect::to('home')->send();

?>
