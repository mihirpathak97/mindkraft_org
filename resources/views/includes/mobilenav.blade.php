<nav>

  <svg id="wave" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 38">
    <path data-v-14b53e32="" data-name="Line 1" d="M0.91,15L0.78,15A1,1,0,0,0,0,16v6a1,1,0,1,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H0.91Z" class="line line-1"></path>
    <path data-v-14b53e32="" data-name="Line 2" d="M6.91,15L6.78,9A1,1,0,0,0,6,10V28a1,1,0,1,0,2,0s0,0,0,0V10A1,1,0,0,0,7,9H6.91Z" class="line line-2"></path>
    <path data-v-14b53e32="" data-name="Line 3" d="M12.91,15L12.78,0A1,1,0,0,0,12,1V37a1,1,0,1,0,2,0s0,0,0,0V1a1,1,0,0,0-1-1H12.91Z" class="line line-3"></path>
    <path data-v-14b53e32="" data-name="Line 4" d="M18.91,15l-0.12,0A1,1,0,0,0,18,11V27a1,1,0,1,0,2,0s0,0,0,0V11a1,1,0,0,0-1-1H18.91Z" class="line line-4"></path>
    <path data-v-14b53e32="" data-name="Line 5" d="M24.91,15l-0.12,0A1,1,0,0,0,24,16v6a1,1,0,0,0,2,0s0,0,0,0V16a1,1,0,0,0-1-1H24.91Z" class="line line-5"></path>
  </svg>

  <div class="modal animated fadeIn">
    <div class="modal-background"></div>
    <div class="modal-content">
      <ol>
        <li class="navbar-li"><a href="/home">Home</a></li>
        <li class="navbar-li"><a href="/events">Events</a></li>
        <li class="navbar-li"><a href="/workshops">Workshops</a></li>
        <li class="navbar-li"><a href="/gmaes">Games</a></li>
        <li class="navbar-li"><a href="/lectures">Lectures</a></li>
        <li class="navbar-li"><a href="/exhibitions">Exhibitions</a></li>
        <li class="navbar-li"><a href="/sponsors">Our Sponsors</a></li>
        <li class="navbar-li"><a href="/contact">Contact</a></li>
        <?php if (isset($username)): ?>
          <li class="navbar-li"><a href="/user"><?php echo $username; ?></a></li>
          <li class="navbar-li"><a href="/logout">Logout</a></li>
        <?php else: ?>
          <li class="navbar-li"><a href="/login">Login</a></li>
          <li class="navbar-li"><a href="/register">Register</a></li>
        <?php endif; ?>
      </ol>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
  </div>
</nav>
