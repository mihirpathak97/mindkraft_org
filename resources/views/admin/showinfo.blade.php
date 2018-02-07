<?php
  namespace App\Http\Controllers;
  use DB, URL;
  if (!session()->has('adminuser')) {
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
    <div id="app">

      <nav class="navbar has-shadow">
        <div class="container">
          <div class="navbar-brand">
            <a class="navbar-item is-tab is-active"><?php echo $event->name ?> (<?php echo $type ?>)</a>
          </div>
        </div>
      </nav>

      <div class="box">
        <article>
          <form class="" action="/cms/modifyevent" method="post">
            {{ csrf_field() }}
            <p class="ip-group">
              <label class="label">Name</label>
              <input type="text" name="name" class="input" required>
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
              <textarea name="contact" class="textarea" required></textarea>
            </p>
            <p class="ip-group">
              <label class="label">Fee (type 0 if free)</label>
              <input type="text" name="fee" class="input" required>
            </p>
            <?php if ($type != 'workshop'): ?>
              <p class="ip-group">
                <label class="label">Prize (type 0 if none)</label>
                <textarea name="prize" class="textarea" required></textarea>
              </p>
              <p class="ip-group">
                <label class="label">Rules</label>
                <textarea name="rules" class="textarea" required></textarea>
              </p>
            <?php endif; ?>
            <p class="ip-group">
              <label class="label">Description</label>
              <textarea name="about" class="textarea" required></textarea>
            </p>
            <p class="ip-group">
              <label class="label">Available Seats</label>
              <input type="text" name="seats" class="input" value="" required>
            </p>
            <input type="submit" name="" class="button is-link" value="Update">
          </form>
        </article>
      </div>

    </div>
  </body>
  <script type="text/javascript">
    document.getElementsByName('name')[0].value = "<?php echo $event->name ?>";
    document.getElementsByName('type')[0].value = "<?php echo $event->type ?>";
    document.getElementsByName('department')[0].value = "<?php echo $event->department ?>";
    document.getElementsByName('contact')[0].value = "<?php echo $event->contact ?>";
    document.getElementsByName('fee')[0].value = "<?php echo $event->fee ?>";
    document.getElementsByName('prize')[0].value = "<?php echo $event->prize ?>";
    document.getElementsByName('rules')[0].value = "<?php echo $event->rules ?>";
    document.getElementsByName('about')[0].value = "<?php echo $event->about ?>";
    document.getElementsByName('seats')[0].value = "<?php echo $event->seats ?>";
  </script>
</html>
