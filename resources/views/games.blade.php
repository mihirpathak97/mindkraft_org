@extends('layouts.nondbcontent')

@section('title', 'Games')

<style media="screen">

    #radial-menu{
      display: none !important;
    }

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
        <b align="center" style="margin: auto; display: block; font-size: 36px">Paintball</b><br><br>
        <img src="{{ URL::asset('/images/games/paintball.jpg') }}" style="display:block; margin:auto" alt="Paintball"><br>
        Paintball is a competitive team shooting sport in which players eliminate opponents from play by hitting them with spherical dye-filled gelatin capsules ("paintballs") that break upon impact.
        Paintballs are usually shot using a low-energy air weapon called a paintball marker that is powered by compressed air (nitrogen) or carbon dioxide.
      </p>
      <h3 style="color: hsl(348, 100%, 61%)">Fee</h3>
      <p>₹ 120 / Try</p>
      <br><br><br>
      <p>
        <b align="center" style="margin: auto; display: block; font-size: 36px">Lazer Tag</b><br><br>
        Laser tag is a tag game played with guns which fire infrared beams. Infrared-sensitive targets are commonly worn by each player and are sometimes integrated within the arena in which the game is played.
        Since its birth in 1979, with the release of the Star Trek Electronic Phasers toy manufactured by the South Bend Electronics brand of Milton Bradley, laser tag has evolved into both indoor and outdoor styles of play, and may include simulations of combat, role play-style games, or competitive sporting events including tactical configurations and precise game goals.
      </p>
      <h3 style="color: hsl(348, 100%, 61%)">Fee</h3>
      <p>₹ 120 / Try</p>
      <br><br><br>
      </p>
      <p>
        <b align="center" style="margin: auto; display: block; font-size: 36px">All Terrain Vehicle</b><br><br>
        <img src="{{ URL::asset('/images/games/quad.jpg') }}" style="display:block; margin:auto" alt="ATV"><br>
        An all-terrain vehicle (ATV), also known as a quad bike is a vehicle that travels on low-pressure tires, with a seat that is straddled by the operator, along with handlebars for steering control.
        As the name implies, it is designed to handle a wider variety of terrain than most other vehicles.
      </p>
      <h3 style="color: hsl(348, 100%, 61%)">Fee</h3>
      <p>₹ 200 / Try</p>
      <br><br><br>
      </p>
    </div>
  </div>
</div>
@endsection
