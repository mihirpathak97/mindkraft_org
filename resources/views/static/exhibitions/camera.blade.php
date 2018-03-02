@extends('layouts.nondbcontent')

@section('title', 'Camera Exhibition')

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
        <b>Organized By - Department of Media and Communication</b><br><br>
        The exhibition will showcase the evolution of photography cameras at different stages.
        Visitors won’t be allowed to touch the equipment.
        There will be technicians available to explain the working of cameras.
        The exhibition will be the first of its kind in Karunya Institute of Technology and Sciences.
      </p>
      <h3 style="color: hsl(348, 100%, 61%)">Rules</h3>
      <li>Crowding should be avoided</li>
      <li>Visitors should strictly follow the instructions given by the volunteers</li>

      <h3 style="color: hsl(348, 100%, 61%)">Venue</h3>
      <p>Will be updated soon!</p>

    </div>
  </div>
</div>
@endsection
