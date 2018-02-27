<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }
?>

<!DOCTYPE html>
<html>
  <head>

    @include('admin.includes.meta')

    <title>Admin Console</title>

    @include('admin.includes.stylesheets')
  </head>
  <body>

    <section class="hero is-primary">

     <div class="hero-body" style="background:#383838">
       <div class="container">
         <div class="columns is-vcentered">
           <div class="column">
             <p class="title">
               -$ DevConsole
             </p>
           </div>
         </div>
       </div>
     </div>

     <div class="hero-foot">
       <div class="container">
         <nav class="tabs is-boxed">
           <ul>
             <li class="is-active">
               <a href="/admin/console">Admin Console</a>
             </li>
             <li>
               <a href="/admin/cms/console">CMS Console</a>
             </li>
             <li>
               <a href="/admin/mailer" id='active'>Mailer</a>
             </li>
           </ul>
         </nav></div>
       </div>

   </section>

    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab is-active">Dashboard</a>
          </div>
        </div>
      </nav>

      <div class="box">
        <article>
          <form class="" action="/admin/mailer/send" method="post">
            {{ csrf_field() }}
            <p class="ip-group">
              <label class="label">Mailing List</label>
              <div class="control">
                <div class="select">
                  <select class="select" name="list">
                    <option value="coreteam" selected>Core Team</option>
                    <option value="ctas">Core Team + Dr. Jegathesan</option>
                  </select>
                </div>
              </div>
            </p>
            <p class="ip-group">
              <label class="label">E-mail Subject</label>
              <input type="text" name="subject" class="input" value="" required>
            </p>
            <p class="ip-group">
              <label class="label">From Address</label>
              <input type="text" name="from" class="input" value="" required>
            </p>
            <p class="ip-group">
              <label class="label">E-mail Body</label>
              <textarea name="body" class="textarea" value="" required></textarea>
            </p>
            <input type="submit" name="" class="button is-link" value="Submit">
          </form>
        </article>
      </div>
    </div>
  </body>
</html>
