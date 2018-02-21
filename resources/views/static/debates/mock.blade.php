@extends('layouts.nondbcontent')

@section('title', 'Mock Indian Parliament')

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
      <h1 style="text-align:center">Parliamentary Procedures - A Studends Intentive</h1>
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
      <h3 style="color: hsl(348, 100%, 61%)">Requirements</h3>
      <li>College Identity Card</li>
      <li>Code of Conduct Certificate from your college/university</li>
      <br>
      <h3 style="color: hsl(348, 100%, 61%)">The Task</h3>
      <h4 style="color: #f5f8fa">Session 1</h4>
      <li>Consideration and Passing of the BILL.</li>
      <li>First the participants will be addressed by the speaker.</li>
      <li>Leader of the house and the leader of opposition will be selected by the event coordinator.</li>
      <li>The students will be informed about the procedures to be followed.</li>
      <li>Debate will be initiated by the speaker.</li>
      <br>
      <h4 style="color: #f5f8fa">Session 2</h4>
      <li>Debate and Voting of the bill in detail.</li>
      <li>Participants debate on the bill in detail with its technical terms in the bill.</li>
      <li>Voting of the bill and the guest will be passing the bill.</li>
      <br>
      <h3 style="color: hsl(348, 100%, 61%)">Rules</h3>
      <li>Only students are allowed.</li>
      <li>Open to students of all educational background.</li>
      <li>Right spirit of participation is expected from the participants.</li>
      <li>Aggressive behavior will not be tolerated and will be disqualified from the debate.</li>

      <?php if (session()->has('userid')): ?>
        <a class="button is-link is-centered" style="display:block;margin:auto;margin-top:4rem;height:50px;width:200px;font-size:20px;" href="/register/debate/{{ session('userid') }}/mock_parliament">Register Here!</a>

      <?php else: ?>
        <p style="text-align:center; color:hsl(348, 100%, 61%); margin-top:3rem">You must login to register!</p>
      <?php endif; ?>

    </div>
  </div>
</div>
@endsection
