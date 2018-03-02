@extends('layouts.nondbcontent')

@section('title', 'Agro War')

<style media="screen">
    .content {
      text-align: center;
      width: 80%;
      display: block;
      margin: auto;
    }

    h1{
      color: hsl(171, 100%, 41%) !important;
      font-size: 24px !important;
    }

    .body{
      color: hsl(0, 0%, 96%) !important;
      font-family: 'Raleway', sans-serif;
      font-weight: 100;
      font-size: 18px;
      text-align: left;
      margin-bottom: 3rem;
      padding: 10px;
    }
    .theme{
      font-size: 18px !important;
      color: hsl(171, 100%, 41%) !important;
      text-align: center;
    }
    .quote{
      text-align: right;
      font-weight: bold;
      margin-top: 70px;
      color: hsl(348, 100%, 61%);
      font-family: 'Roboto', sans-serif;
    }
    .by, .otherby{
      text-align: right;
      padding: 0;
    }
    .otherby{
      line-height: 0.1rem;
      margin-top: -10px;
    }

    .button{
      display: block;
      margin: auto;
      margin-top: 2rem;
    }

  </style>
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="body">
      <p>
        <b>TOPIC - ORGANIC FARMING VS MODERN AGRICULTURE</b><br><br>
        <b>Debate</b> - It is group event. This event to explore speaking to groups will help the participants to organize thoughts and express ideas on agriculture.
        The participants can come to with their own views on the trending issues. Best ten speakers will be selected for final round.<br>
        <b>Turncoat</b> - It is a form of debate where the speaker literally debates against oneself.
        The speaker starts by taking a stance on the topic and switches sides after a specific duration of time.
        (On the spot topics will be given)
      </p>
      <h3 style="color: hsl(348, 100%, 61%)">Requirements/Rules</h3>
      <li>College Identity Card</li>
      <li>
        Participants should speak to the topic of the content they speak.
        Should not exceed the given time duration.
        Speaker should not speak against any specific institutions, organization or any personality by name.
      </li>
      <li>
        It is a debate to express your views on agriculture and gain knowledge on modern and organic farming.
        The judges are selected from the faculty members
      </li>
      <li>The three best speakers will be rewarded at the final round of debate who explored their opinions on the current trends and technologies on agriculture.</li>
      <?php if (session()->has('userid')): ?>
        <a class="button is-link is-centered" style="display:block;margin:auto;margin-top:4rem;height:50px;width:200px;font-size:20px;" href="/register/debate/{{ session('userid') }}/agro_war">Register Here!</a>

      <?php else: ?>
        <p style="text-align:center; color:hsl(348, 100%, 61%); margin-top:3rem">You must login to register!</p>
      <?php endif; ?>

    </div>
  </div>
</div>
@endsection
