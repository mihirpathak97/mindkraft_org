@extends('layouts.nondbcontent')

@section('title', 'Sponsors')

<style media="screen">
  .title-heading{
    color: hsl(171, 100%, 41%) !important;
    margin-bottom: 3rem !important;
  }
  .sponsor{
  }
  .tmb{
    width: 200px;
    height: 120px;
  }
  .cola{
    width: 200px;
    height: 200px;
    padding: 20px;
  }
  .syndicate{
    width: 300px;
    height: 150px;
    padding: 20px;
  }
  .itc{
    width: 180px;
    height: 180px;
    padding: 20px;
  }
  .accenture{
    width: 280px;
    height: 180px;
    padding: 20px;
  }
  .hindu{
    width: 280px;
    height: 180px;
    padding: 20px;
  }
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="title">
      <h2 class="title-heading">MindKraft 2017 Sponsors</h2>
      <img src="{{ URL::asset('images/sponsors/old/tmb.png') }}" class="sponsor tmb" alt="TMB">
      <img src="{{ URL::asset('images/sponsors/old/cola.png') }}" class="sponsor cola" alt="Coco-Cola">
      <img src="{{ URL::asset('images/sponsors/old/syndicate.png') }}" class="sponsor syndicate" alt="Syndicate Bank">
      <img src="{{ URL::asset('images/sponsors/old/itc.png') }}" class="sponsor itc" alt="ITC">
      <br>
      <img src="{{ URL::asset('images/sponsors/old/accenture.png') }}" class="sponsor accenture" alt="Accenture">
      <img src="{{ URL::asset('images/sponsors/old/hindu.jpg') }}" class="sponsor hindu" alt="The Hindu">
    </div>
  </div>
</div>
@endsection
