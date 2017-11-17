<?php
	session_start();
  require '../php/sqlconf.php';
	if (isset($_SESSION['userid'])) {
		$con = mysqli_connect($host, $username, $password, $db);
    $query = "select * from ".$view_prefix."enduser_table where userid='" . $_SESSION['userid'] . "'";
    $result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) == 1) {
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $name = $record['name'];
    }
	}
	$dept_list = array(
											'ae' => 'Aerospace Engineering',
											'bt' => 'Bio Technology',
											'bi' => 'Bio Informatics',
											'ce' => 'Civil Engineering',
											'cse' => 'Computer Science',
											'ece' => 'Electronics and Communication',
											'eee' => 'Electrical and Eclectronics',
											'eie' => 'Electronics and Instrumentation',
											'fp' => 'Foop Processing',
											'me' => 'Mechanical Engineering',
											'emt' => 'Media Technology',
											'nano' => 'Nano Technology',
											'snh' => 'Science and Humanities'
										);
  $event_type = array(
                       'tech' => 'Technical',
                       'nontech' => 'Non Technical'
                     );
  $event_category = array(
                       'event' => 'Event',
                       'workshop' => 'Workshop',
                       'game' => 'Games'
                     );
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MindKraft 2018 | Events</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../images/favicon.ico">
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="../css/animate.css">
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/events.css">
	</head>
	<body>
	<div id="header">
			<div class="container">
				<!-- <div class="row"> -->
			    <nav class="navbar navbar-default">
		        <div class="navbar-header">
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
		  </div>
	</div>

  <br>

  <div id="slider" data-section="home">
		<div class="row animate-box" data-animate-effect="fadeIn">
			<?php
				if (isset($_GET['q'])){
					$con = mysqli_connect($host, $username, $password, $db);
					$query = "select * from ".$view_prefix."all_events where event_id='".$_GET['q']."'";
					$result = mysqli_query($con, $query);
			?>
        <?php while ($record = mysqli_fetch_array($result, MYSQL_ASSOC)) { ?>
          <div class="games">
            <h2><?php echo $record['event_name']; ?></h2>
            <br><br>
            <div class="event-info">
              <p>Event Name : <?php echo $record['event_name']; ?></p>
              <p>Event Cetegory : <?php echo $event_category[$record['category']]; ?></p>
              <?php if ($record['category'] == 'event'): ?>
                <p>Event Type : <?php echo $event_type[$record['event_type']]; ?></p>
              <?php endif; ?>
              <p>Department : <?php echo $dept_list[$record['department']]; ?></p>
              <p>Event Co-ordinator : <?php echo $record['event_incharge']; ?></p>
              <p>Co-ordinator Contact : <?php echo $record['incharge_contact']; ?></p>
              <p>Event Fee : <?php echo $record['event_fee']; ?></p>
              <?php if ($record['category'] != 'workshop'): ?>
                <p>Prize : <?php echo $record['event_prize']; ?></p>
              <?php endif; ?>
              <p>Description : <?php echo $record['description']; ?></p>
              <input type="button" class="register-button" value="Register">
            </div>
          </div>
        <?php } ?>
      <?php }else{ header("location:events.php"); }?>
		</div>
	</div>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.waypoints.min.js"></script>

</body>
</html>
