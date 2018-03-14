<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }
  $prefix = env('DB_TABLE_PREFIX', '');
  $query = 'select * from '.$prefix.'event_registration where id=?';
  $list = DB::select($query, [$type.'-'.$id]);
  $list = $list[0];

  $name = DB::select('select name from '.$prefix.$type.'s_list where id=\''.$id.'\'')[0]->name;

  function getInfo($id, $prefix)
  {
    $query = 'select * from '.$prefix.'enduser where id=?';
    if (count(DB::select($query, [$id])) == 1) {
      return DB::select($query, [$id])[0];
    }
    return false;
  }



    // Color Coding
    function checkUserStatus($id)
    {
      if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
        return true;
      }
      return false;
    }

    function paymentStatus($id, $workshop)
    {
      $payed_for = DB::select('select * from mindkraft18_payment_info where id=\''.$id.'\'')[0]->payed_for;
      if (in_array($workshop, explode(':', $payed_for))) {
        return true;
      }
      return false;
    }

    function getColor($id, $type, $workshop)
    {
      if (!checkUserStatus($id)) {
        return '#ff3860';
      }
      if ($type == 'workshop' && !paymentStatus($id, $workshop)) {
        return '#ffdd57';
      }

      return '';
    }

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
            <a class="navbar-item is-tab" href="/admin/<?php echo $type ?>s"><?php echo ucfirst($type) ?>s List</a>
            <a class="navbar-item is-tab is-active"><?php echo $name ?></a>
          </div>
        </div>
      </nav>


      <table class="table card">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Mobile</th>
            <th>E-Mail</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach (explode(':', $list->registered_users) as $record):
            $record = getInfo($record, $prefix);
            if (!$record) {
              continue;
            }
          ?>
            <tr bgcolor="<?php echo getColor($record->id, $type, $id) ?>">
              <td><?php echo $record->id; ?></td>
              <td><?php echo $record->name; ?></td>
              <td><?php echo $record->mobile; ?></td>
              <td><?php echo $record->email; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>


    </div>
  </body>
</html>
