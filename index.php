<?php
	session_start();
	if (isset($_SESSION['sql-success'])) {
		$success = true;
		unset($_SESSION['sql-success']);
	}
	if (isset($_SESSION['userid'])) {
		require 'php/sqlconf.php';
		$con = mysqli_connect($host, $username, $password, $db);
    $query = "select * from ".$view_prefix."enduser_table where userid='" . $_SESSION['userid'] . "'";
    $result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) == 1) {
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $name = $record['name'];
    }
	}
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MindKraft 2018</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/icomoon.css">
		<link rel="stylesheet" href="css/simple-line-icons.css">
		<link rel="stylesheet" href="css/owl.carousel.min.css">
		<link rel="stylesheet" href="css/owl.theme.default.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/modernizr-2.6.2.min.js"></script>
	</head>
	<style media="screen">
		.col-md-3{
			padding-bottom: 75px;
		}
		.bottom-grid{
			margin: auto;
			margin-bottom: -85px;
		}
		.col-md-3 a:hover{
			text-decoration: none;
		}
	</style>
	<body>
	<header role="banner" id="header">
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
	</header>

	<!-- Modal -->
	<div class="modal fade" id="info-modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Information</h4>
				</div>
				<div class="modal-body">
					<p>
						Successfully logged in / registered...
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div id="slider" data-section="home">
		<div class="owl-carousel owl-carousel-main owl-carousel-fullwidth">
		    <div class="item">
		    	<div class="container" style="position: relative;">
		    		<div class="row animate-box" data-animate-effect="fadeIn">
							<div class="col-md-4 col-md-push-1 col-sm-4 col-sm-push-1 mobile-image">
								<div class="mobile"><img src="images/kit-logo.png" alt="Karunya Institute of Technology"></div>
							</div>
					    <div class="">
			    			<div class="owl-text-wrap">
						    	<div class="owl-text">
						    		<h1 class="lead">Proudly Presents</h1>
										<h2 class="sub-lead"></h2>
						    	</div>
						    </div>
					    </div>
		    		</div>
		    	</div>
		    </div>

				<div class="item">
		    	<div class="container" style="position: relative;">
		    		<div class="row animate-box" data-animate-effect="fadeIn">
					    <div class="">
			    			<div class="owl-text-wrap">
						    	<div class="owl-text">
						    		<h1 class="lead">MindKraft 2018</h1>
										<h2 class="sub-lead"></h2>
						    	</div>
						    </div>
					    </div>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>

	<div id="services" data-section="services">
		<div class="container">
			<div class="row row-bottom-padded-sm animate-box">
				<div class="col-md-12 section-heading text-center">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h3></h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">

				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/about.php">
						<div class="icon colored-1"><span><i class="icon-user"></i></span></div>
						<h3>About</h3>
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/sponsors.php">
						<div class="icon colored-4"><span><i class="icon-ticket"></i></span></div>
						<h3>Our Sponsors</h3>
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/gallery.php">
						<div class="icon colored-3"><span><i class="icon-image"></i></span></div>
						<h3>Gallery</h3>
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/events.php">
						<div class="icon colored-2"><span><i class="icon-trophy"></i></span></div>
						<h3>Events</h3>
						</a>
					</div>
				</div>

				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/workshops.php">
						<div class="icon colored-6"><span><i class="icon-wrench"></i></span></div>
						<h3>Workshops</h3>
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/games.php">
						<div class="icon colored-1"><span><i class="icon-gamepad"></i></span></div>
						<h3>Games</h3>
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/team.php">
						<div class="icon colored-7"><span><i class="icon-users"></i></span></div>
						<h3>Team</h3>
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box animate-box">
						<a href="pages/contact.php">
						<div class="icon colored-8"><span><i class="icon-phone"></i></span></div>
						<h3>Contact Us</h3>
						</a>
					</div>
				</div>

				<div class="col-md-3 bottom-grid">
					<div class="box animate-box">
						<a href="pages/faq.php">
						<div class="icon colored-2"><span><i class="icon-question"></i></span></div>
						<h3>FAQ</h3>
						</a>
					</div>
				</div>

				<div class="col-md-3 bottom-grid">
					<div class="box animate-box">
						<a href="pages/faq.php">
						<div class="icon colored-7"><span><i class="icon-home"></i></span></div>
						<h3>Accomodation</h3>
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>


	<div class="cta" style="background-image:url(images/feedback.jpg)">
		<div class="overlay"></div>
		<div class="container">
			<div class="col-md-8 col-md-offset-2 text-center">
				<h3>
					We would love to hear your feedback and suggestions. Leave us a comment and
					we will try our best to set things up for you.
				</h3>
				<p><a href="pages/feedback.php" class="btn btn-primary btn-outline btn-lg">Feedback</a></p>
			</div>
		</div>
	</div>

	<footer id="footer" role="contentinfo">
		<div class="container">
			<div class="row row-bottom-padded-sm">
				<div class="col-md-12">
					<p class="copyright text-center">&copy; 2017 <a href="http://karunya.edu">Karunya Institute of Technology</a>. All Rights Reserved.</p>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-md-12 text-center">
					<ul class="social social-circle">
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-facebook"></i></a></li>
					</ul>
				</div>
			</div> -->
		</div>
	</footer>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>

	<?php if (isset($success) && $success): ?>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#info-modal').modal('toggle');
			})
		</script>
	<?php endif; ?>

	</body>
</html>
