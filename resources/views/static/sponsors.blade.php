@extends('layouts.nondbcontent')

@section('title', 'Sponsors')

<style media="screen">
  .tmb{
    width: 200px;
    height: 120px;
    padding: 0 10px;
  }
  .paytm{
    width: 300px;
    height: 200px;
    padding: 20px;
    margin-top: -30px;
  }
  .syndicate{
    width: 300px;
    height: 150px;
    padding: 20px;
  }
  .niehoff{
    width: 200px;
    height: 150px;
    padding: 20px;
  }
  .nvidia{
    width: 200px;
    height: 200px;
    padding: 20px;
  }
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="title">
      <img src="{{ URL::asset('images/sponsors/paytm.png') }}" class="sponsor paytm" alt="PayTM">
      <img src="{{ URL::asset('images/sponsors/tmb.png') }}" class="sponsor tmb" alt="TMB">
      <img src="{{ URL::asset('images/sponsors/syndicate.png') }}" class="sponsor syndicate" alt="Syndicate Bank"><br>
      <img src="{{ URL::asset('images/sponsors/niehoff.gif') }}" class="sponsor niehoff" alt="Niehoff Gruppe">
      <img src="{{ URL::asset('images/sponsors/nvidia.jpg') }}" class="sponsor nvidia" alt="Nvidia">
    </div>
  </div>
</div>
@endsection
