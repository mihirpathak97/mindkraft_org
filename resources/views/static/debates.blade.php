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
  </style>
</style>

@section('body')
<div class="full-height">
  <div class="content">
    <div class="body">
      <h1 style="text-align:center">Mock Indian Parliament</h1>
      <h2 class="theme">Parliamentary Procedures - A Studends Intentive</h2>
      <p>
        India is the world’s largest democracy and soon will be youngest nation. By 2020, it is expected that 59% of population in India will be in age group of 18-40 years.
        A young democracy, with an even younger demographics, will test India’s democratic values and its parliamentary structure.
        Indian youth today are very dynamic, opinionated, much more equipped with resources and knowledge than any point in histroy.
        Unfortunately, the youth lack interest and insights on policies & how they are made.
        With a view to set ‘policy’ as an agenda for youth, Mock Indian Parliament, a 3 day event, will be organized by <b style="color:hsl(204, 86%, 53%)">Karunya Institute of Technology and Sciences</b> to acquaint Indian youth
        about functioning of our representative institutions and give them a firsthand experience of the policy making process.
      </p>
      <p class="quote">“One of the very important characteristics of a student is to question. Let the students ask questions.”</p>
      <p class="by">Dr. A P J Abdul Kalam</p>
      <p class="otherby">Former President of India</p>
    </div>
  </div>
</div>
@endsection
