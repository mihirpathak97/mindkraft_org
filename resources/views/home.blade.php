<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MindKraft 2018</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
  </head>

  <body>
    <div class="e-loadholder">
      <div class="m-loader">
		    <span class="e-text">Loading</span>
	    </div>
    </div>
    <div id="particleCanvas-Blue"></div>
    <div id="particleCanvas-White"></div>
  </body>
</html>
