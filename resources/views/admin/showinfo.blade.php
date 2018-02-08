<?php
  namespace App\Http\Controllers;
  use URL, DB, Redirect;

  if (!session()->has('adminuser') || !Controller::checkAdmin(session('adminuser'))) {
    Redirect::to('admin')->send();
  }

  $prefix = env('DB_TABLE_PREFIX', '');
  $query = 'SELECT * from '.$prefix.$type.'s_list WHERE id=?';
  $event = DB::select($query, [$id]);
  $event = $event[0];

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
            <a class="navbar-item is-tab is-active"><?php echo $event->name ?></a>
          </div>
        </div>
      </nav>

      <div class="box">
        <article>
          <form class="" action="/admin/cms/modify<?php echo $type?>" method="post">
            {{ csrf_field() }}
            <p class="ip-group">
              <label class="label">Name</label>
              <input type="text" name="name" class="input" value="<?php echo $event->name ?>" required>
            </p>
            <input type="text" name="id" value="<?php echo $event->id ?>" hidden>
            <p class="ip-group">
              <label class="label">ID</label>
              <input type="text" value="<?php echo $event->id ?>" class="input" disabled>
            </p>
            <?php if ($type == 'event'): ?>
              <p class="ip-group">
                <label class="label">Type</label>
                <div class="control">
                  <div class="select">
                    <select class="select" name="type">
                      <option value="tech">Technical</option>
                      <option value="nontech">Non Technical</option>
                    </select>
                  </div>
                </div>
              </p>
            <?php endif; ?>
            <?php if ($type != 'game'): ?>
              <p class="ip-group">
                <label class="label">Department</label>
                <div class="control">
                  <div class="select">
                    <select class="select" name="department">
                      <option value="ae">Aerospace</option>
                      <option value="bt">Bio Technology</option>
                      <option value="bi">Bio Informatics</option>
                      <option value="ce">Civil</option>
                      <option value="cse">Computer Science</option>
                      <option value="ece">ECE</option>
                      <option value="eee">EEE</option>
                      <option value="eie">EIE</option>
                      <option value="eng">Department of English</option>
                      <option value="fp">Food Processing</option>
                      <option value="me">Mechanical</option>
                      <option value="emt">EMT</option>
                      <option value="nano">Nano Technology</option>
                    </select>
                  </div>
                </div>
              </p>
            <?php endif; ?>
            <p class="ip-group">
              <label class="label">Contact</label>
              <textarea name="contact" class="textarea" required><?php echo $event->contact ?></textarea>
            </p>
            <p class="ip-group">
              <label class="label">Fee (type 0 if free)</label>
              <input type="text" name="fee" class="input" value="<?php echo $event->fee ?>" required>
            </p>
            <?php if ($type != 'workshop'): ?>
              <p class="ip-group">
                <label class="label">Prize (type 0 if none)</label>
                <textarea name="prize" class="textarea" required><?php echo $event->prize ?></textarea>
              </p>
              <p class="ip-group">
                <label class="label">Rules</label>
                <textarea name="rules" class="textarea" required><?php echo $event->rules ?></textarea>
              </p>
            <?php endif; ?>
            <p class="ip-group">
              <label class="label">Description</label>
              <textarea name="about" class="textarea" required><?php echo $event->about ?></textarea>
            </p>
            <p class="ip-group">
              <label class="label">Available Seats</label>
              <input type="text" name="seats" class="input" value="<?php echo $event->seats ?>" required>
            </p>
            <input type="submit" name="" class="button is-link" value="Update">
          </form>
        </article>
      </div>

    </div>
  </body>
  <script type="text/javascript">
    <?php if ($type == 'event'): ?>
      document.getElementsByName('type')[0].value = "<?php echo $event->type ?>";
    <?php endif; ?>
    <?php if ($type != 'games'): ?>
      document.getElementsByName('department')[0].value = "<?php echo $event->department ?>";
    <?php endif; ?>
  </script>
</html>
