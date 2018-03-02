@extends('layouts.nondbcontent')

@section('title', 'Debates')

<style media="screen">
    .content {
      text-align: center;
      width: 80%;
      display: block;
      margin: auto;
    }

    h1{
      color: hsl(171, 100%, 41%) !important;
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
    .parliament{
      width: 350px;
      height: 140px;
    }
  </style>
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="body">
      <img class="parliament" src="{{ URL::asset('images/debates/parliament.jpg') }}" alt="">
      <h3><a style="color: hsl(171, 100%, 41%)" href="/debates/mock_parliament">Mock Indian Parliament</a></h1>
      <br>
      <h3><a style="color: hsl(171, 100%, 41%)" href="/debates/agro_war">Agro War</a></h1>
    </div>
  </div>
</div>
@endsection
