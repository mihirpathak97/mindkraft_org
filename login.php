<?php
	session_start();
	if (isset($_SESSION['username'])) {
			$name = $_SESSION['username'];
	}
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MindKraft 2018 | Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="src/css/animate.css">
		<link rel="stylesheet" href="src/css/icomoon.css">
		<link rel="stylesheet" href="src/css/simple-line-icons.css">
		<link rel="stylesheet" href="src/css/owl.carousel.min.css">
		<link rel="stylesheet" href="src/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="src/css/bootstrap.css">
		<link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/login.css">
		<script src="src/js/modernizr-2.6.2.min.js"></script>
	</head>
	<style media="screen">
	</style>
	<body>
	<div role="banner" id="header">
			<div class="container">
				<!-- <div class="row"> -->
			    <nav class="navbar navbar-default">
		        <div class="navbar-header">
		        	<!-- Mobile Toggle Menu Button -->
					<a href="#" class="js-nav-toggle nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
		          	<a class="navbar-brand" href="index.php">MindKraft</a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-right">
								<?php if (isset($name)) { ?>
									<li><a href="#"><span><?php echo $name; ?></span></a></li>
									<li><a href="logout.php"><span>Logout</span></a></li>
								<?php }else{ ?>
			            <li><a href="login.php"><span>Login</span></a></li>
			            <li><a href="register.php"><span>Register</span></a></li>
								<?php } ?>
		          </ul>
		        </div>
			    </nav>
			  <!-- </div> -->
		  </div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="info-modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Information</h4>
				</div>
				<div class="modal-body">
					<p id="info-body"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

  <br>

  <div id="slider" data-section="home">
		<div>
		    <div class="item">
		    	<div class="container" style="position: relative;">
		    		<div class="row animate-box" data-animate-effect="fadeIn">
					    <div class="col-md-7 col-sm-7">
								<?php if(isset($_SESSION['userid'])){ ?>
									<div class="login">
	                  <h3>Already Logged In!</h3>
	                  <br><br>
	                  <h5>A user is alrady logged, close the browser or click <a href="logout.php">here</a> to logout</h5>
							    </div>

								<?php }else { ?>
									<div class="login">
	                  <h3>Login</h3>
	                  <br><br>
	                  <form class="" id="login_form">
	                    <input type="text" name="uname" value="" placeholder="Mobile Number" required>
	                    <input type="password" name="password" value="" placeholder="Password" required>
	                    <p><br> <input type="button" class="btn btn-primary btn-lg" value="Login" onclick="submitLoginForm()"></p>
	                  </form>
							    </div>
								<?php } ?>
					    </div>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
  <script src="src/js/jquery.min.js"></script>
  <script src="src/js/jquery.easing.1.3.js"></script>
  <script src="src/js/bootstrap.min.js"></script>
  <script src="src/js/jquery.waypoints.min.js"></script>
  <script src="src/js/owl.carousel.min.js"></script>
  <script src="src/js/main.js"></script>
	<script src="src/js/libjs.js" charset="utf-8"></script>

</body>
</html>
