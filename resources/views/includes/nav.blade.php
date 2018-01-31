<div id="navbar" class="navbar-collapse collapse enable-select">
  <ul class="nav-ul">
    <?php if (isset($username)) { ?>
      <li><a href="/user"><span><?php echo $username; ?></span></a></li>
      <li><a href="/logout"><span>Logout</span></a></li>
    <?php }else{ ?>
      <li><a href="/login"><span>Login</span></a></li>
      <li><a href="/register"><span>Register</span></a></li>
    <?php } ?>
  </ul>
</div>
