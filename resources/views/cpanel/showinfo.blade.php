<?php

namespace App\Http\Controllers;
use URL, DB, Redirect;

if (!session()->has('cpaneluser') || !Controller::checkAdmin(session('cpaneluser'))) {
  Redirect::to('cpanel')->send();
}

$access_level = CpanelController::getAccessLevel(session('cpaneluser'));

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
               <a href="/cpanl/console" id='active'>Admin Console</a>
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


      <?php
      if ($access_level == 9):
        $user = DB::select('select * from tshirt_registration where register_number=\''.$id.'\'');
        $user = $user[0];

        $rev_map = array(
          'School of Engineering and Technology' => 'eng',
          'School of Arts, Science and Media' => 'arts',
          'School of Agriculture and Biosciences' => 'agri',
          'School of Management and Law' => 'mba'
        );

      ?>
      <div class="box">
        <article>
          <form class="" action="/cpanel/update/tshirt/<?php echo $id ?>" method="post">
            {{ csrf_field() }}
            <p class="ip-group">
              <label class="label">Name</label>
              <input type="text" name="name" class="input" value="<?php echo $user->name ?>" required>
            </p>
            <input type="text" name="reg_no" value="<?php echo $id ?>" hidden>
            <p class="ip-group">
              <label class="label">Registration Number</label>
              <input type="text" value="<?php echo $user->register_number ?>" class="input" disabled>
            </p>
            <p class="ip-group">
              <label class="label">Gender</label>
              <div class="control">
                <div class="select">
                  <select class="select" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </p>
            <p class="ip-group">
              <label class="label">UG/PG</label>
              <div class="control">
                <div class="select">
                  <select class="select" name="ugpg">
                    <option value="UG">UG</option>
                    <option value="PG">PG</option>
                  </select>
                </div>
              </div>
            </p>
            <p class="ip-group">
              <label class="label">School</label>
              <div class="control">
                <div class="select">
                  <select class="select" name="school">
                    <option value="eng">School of Engineering and Technology</option>
                    <option value="arts">School of Arts, Science and Media</option>
                    <option value="agri">School of Agriculture and Biosciences</option>
                    <option value="mba">School of Management and Law</option>
                  </select>
                </div>
              </div>
            </p>
            <p class="ip-group">
              <label class="label">Size</label>
              <div class="control">
                <div class="select">
                  <select class="select" name="size">
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="XXXL">XXXL</option>
                  </select>
                </div>
              </div>
            </p>
            <br>
            <input type="submit" name="" class="button is-link" value="Update">
          </form>
        </article>
      </div>

      <script type="text/javascript">
        document.getElementsByName('gender')[0].value = "<?php echo $user->gender ?>";
        document.getElementsByName('ugpg')[0].value = "<?php echo $user->ugpg ?>";
        document.getElementsByName('school')[0].value = "<?php echo $rev_map[$user->school] ?>";
        document.getElementsByName('size')[0].value = "<?php echo $user->size ?>";
      </script>

      <?php endif; ?>



    </div>
  </body>
</html>
