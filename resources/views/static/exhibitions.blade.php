@extends('layouts.nondbcontent')

@section('title', 'Exhibitions')

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
  </style>
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="body">
      <h3><a style="color: hsl(171, 100%, 41%)" href="/exhibition/camera_exhibition">Camera Exhibition</a></h1>
    </div>
  </div>
</div>
@endsection
