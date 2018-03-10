<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');
  $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];

  $events_list = DB::select('select * from '.$prefix.'events_list');
  $workshops_list = DB::select('select * from '.$prefix.'workshops_list');

?>

<!DOCTYPE html>
<html>
  <head>
    @include('admin.includes.meta')
    <title>Admin Console</title>
    @include('admin.includes.stylesheets')
  </head>
  <style media="screen">
    .card{
      margin: auto;
      margin-top: 2rem;
    }
  </style>
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
               <a href="/admin/console" id='active'>Admin Console</a>
             </li>
             <li>
               <a href="/admin/cms/console">CMS Console</a>
             </li>
             <li>
               <a href="/admin/mailer">Mailer</a>
             </li>
           </ul>
         </nav></div>
       </div>

   </section>
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab" href="/admin/console">Dashboard</a>
            <a class="navbar-item is-tab is-active">Users Info</a>
          </div>
        </div>
      </nav>

      <div class="box">
        <br><br>
        <p><b>Name</b> - <?php echo $user->name ?></p>
        <p><b>College</b> - <?php echo $user->college ?></p>
        <p><b>Registration Number</b> - <?php echo $user->register_number ?></p><br>
        <p><b>Events Registered</b></p>
        <?php
          foreach ($events_list as $event) {
            $users = DB::select('select * from mindkraft18_event_registration where id=\'event-'.$event->id.'\'');
            if (count($users) == 1) {
              $users = $users[0]->registered_users;
            }
            else {
              continue;
            }
            if (in_array($id, explode(':', $users))) {
              echo $event->name . '<br>';
            }
          }
        ?>
        <br>
        <p><b>Workshops Registered</b></p>
        <?php
          foreach ($workshops_list as $workshop) {
            $users = DB::select('select * from mindkraft18_event_registration where id=\'workshop-'.$workshop->id.'\'');
            if (count($users) == 1) {
              $users = $users[0]->registered_users;
            }
            else {
              continue;
            }
            if (in_array($id, explode(':', $users))) {
              echo $workshop->name . '<br>';
            }
          }
        ?><br>

        <button type="button" id="button" class="button is-link" name="button">Approve Registration</button>

        <br>

        <p id="ajax-output"></p>

        <br>

      </div>

    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  <script type="text/javascript">
  $('#button').click(function () {

    $.ajax({
      type: 'POST',
      url: '/admin/user/<?php echo $user->id ?>/approve',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: formData,
      success: function (data) {
        $('#ajax-output').html(data);
      }
    });

    return false;
  });
  </script>

</html>
