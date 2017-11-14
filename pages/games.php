<?php
	session_start();
  require '../php/sqlconf.php';
	if (isset($_SESSION['userid'])) {
		$con = mysqli_connect($host, $username, $password, $db);
    $query = "select * from user_table where userid='" . $_SESSION['userid'] . "'";
    $result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) == 1) {
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $name = $record['name'];
    }
	}
  $con = mysqli_connect($host, $username, $password, $db);
  $query = "select * from mindkraft18_games";
  $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MindKraft 2018 | Games</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../images/favicon.ico">
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="../css/animate.css">
		<link rel="stylesheet" href="../css/icomoon.css">
		<link rel="stylesheet" href="../css/simple-line-icons.css">
		<link rel="stylesheet" href="../css/owl.carousel.min.css">
		<link rel="stylesheet" href="../css/owl.theme.default.min.css">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/events.css">
		<script src="../js/modernizr-2.6.2.min.js"></script>
	</head>
	<style media="screen">
    /*.col-md-4{
      margin-left: -100px;
    }*/
	</style>
	<body>
	<div role="banner" id="header">
			<div class="container">
				<!-- <div class="row"> -->
			    <nav class="navbar navbar-default">
		        <div class="navbar-header">
		        	<!-- Mobile Toggle Menu Button -->
					<a href="#" class="js-nav-toggle nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
		          	<a class="navbar-brand" href="../index.php">MindKraft</a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-right">
								<?php if (isset($name)) { ?>
									<li><a href="#"><span><?php echo $name; ?></span></a></li>
									<li><a href="../logout.php"><span>Logout</span></a></li>
								<?php }else{ ?>
			            <li><a href="../login.php"><span>Login</span></a></li>
			            <li><a href="../register.php"><span>Register</span></a></li>
								<?php } ?>
		          </ul>
		        </div>
			    </nav>
			  <!-- </div> -->
		  </div>
	</div>

  <br>

  <div id="slider" data-section="home">
		    <div class="item">
		    	<div class="container" style="position: relative;">
		    		<div class="row animate-box" data-animate-effect="fadeIn">
					    <div class="col-md-7 col-sm-7">
								<div class="games">
                  <h2>Games</h2>
                  <br><br>
                  <?php while ($record = mysqli_fetch_array($result, MYSQL_ASSOC)) { ?>
                    <div class="col-md-4">
                      <div class="box animate-box">
                        <h4><?php echo $record['name']; ?></h4>
                        <p><?php echo $record['co-ordinator']; ?></p>
                        <p><?php echo $record['contact']; ?></p>
												<p style="display:none"><?php echo $record['description'] ?></p>
                      </div>
                    </div>
                  <?php } ?>
                </div>
							</div>
					  </div>
		    	</div>
		    </div>
		</div>
	</div>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>
  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/main.js"></script>

</body>
</html>
