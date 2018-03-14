<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');

  function yesNo($value){
    return $value == true ? 'Yes' : 'No';
  }

  function inCollegeList($college)
  {
    foreach (Controller::colleges_list as $key => $value) {
      if ($college == $value) {
        return true;
      }
    }
    return false;
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Console</title>
    <link rel="stylesheet" href="{{ URL::asset('css/cms.css') }}">
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
            <a class="navbar-item is-tab is-active">Users List</a>
          </div>
        </div>
      </nav>

      <div class="box">
        <p><b>Total External Registrations</b> - <?php echo count(DB::select('select * from mindkraft18_enduser where not college=\'Karunya Institute of Technology and Sciences, Coimbatore\'')); ?></p>
        <br><br>
        <?php
          foreach (Controller::colleges_list as $college):
            $query = 'SELECT * from '.$prefix.'enduser WHERE college=?';
            $list = DB::select($query, [$college]);
            if (count($list) > 0):
        ?>
          <a href="/admin/users/<?php echo $college ?>"><?php echo $college; ?></a><br><br>
        <?php endif; ?>

        <?php endforeach; ?>
      </div>

      <div class="box">
        <p><b>Other College Students - </b></p>
      </div>

      <table class="table card">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>E-Mail</th>
            <th>College</th>
            <th>Verified</th>
            <th>Login Attempts</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = 'SELECT * from '.$prefix.'enduser order by name';
          $list = DB::select($query);
          ?>
          <?php foreach ($list as $record): ?>
            <?php if (!inCollegeList($record->college)): ?>
              <tr>
                <td><?php echo $record->id; ?></td>
                <td><?php echo $record->name; ?></td>
                <td><?php echo $record->mobile; ?></td>
                <td><?php echo $record->email; ?></td>
                <td><?php echo $record->college; ?></td>
                <td><?php echo yesNo($record->is_verified); ?></td>
                <td><?php echo $record->visit_count; ?></td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </body>
</html>
