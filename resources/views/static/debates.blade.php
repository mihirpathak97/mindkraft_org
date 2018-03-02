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
    .game-card .dept-head{
      font-size: 20px !important;
    }
    .game-card .know-more{
      font-size: 16px;
      font-weight: bold;
    }
  </style>
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="body">
      <div class="columns">
        <div class="column is-one-quarter">
          <div class="game-card">
            <h3 class="dept-head">Mock Indian Parliament</h3>
            <p class="know-more"><a href="/debates/mock_parliament">Know More</a></p>
          </div>
        </div>
        <div class="column is-one-quarter">
          <div class="game-card">
            <h3 class="dept-head">Agro War</h3>
            <p class="know-more"><a href="/debates/agro_war">Know More</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
