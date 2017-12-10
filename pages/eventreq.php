<?php
	session_start();
	require '../src/php/pdo.php';
  require_once '../src/php/sqlconf.php';
	require_once '../src/php/lib.php';
	if (isset($_SESSION['username'])) {
			$name = $_SESSION['username'];
	}
?>
<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>MindKraft 2018 | Events</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../images/favicon.ico">
		<link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="../src/css/animate.css">
		<link rel="stylesheet" href="../src/css/bootstrap.css">
		<link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="../src/css/events.css">
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

	<!-- Modal -->
	<div class="modal fade" id="info-modal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Information</h4>
				</div>
				<div class="modal-body">
					<p id="info-body">

					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

  <div id="slider" data-section="home">
		<div class="row animate-box" data-animate-effect="fadeIn">
			<?php
				if (isset($_GET['q'])){
					$con = mysqli_connect($host, $username, $password, $db);
					$query = "select * from ".$view_prefix."all_events where event_id='".$_GET['q']."'";
					$result = mysqli_query($con, $query);
			?>
        <?php
					while ($record = mysqli_fetch_array($result, MYSQL_ASSOC)) {
						$event_id = $record['event_id'];
				?>
          <div class="games">
            <h2><?php echo $record['event_name']; ?></h2>
            <br><br>
            <div class="event-info">
							<table>
								<tr>
									<td><p>Event Name : </p></td>
									<td><p><?php echo $record['event_name']; ?></p></td>
								</tr>
								<tr>
									<td><p>Event Category</p></td>
									<td><p><?php echo $event_category[$record['category']]; ?></p></td>
								</tr>
								<?php if ($record['category'] == 'event'): ?>
									<tr>
										<td><p>Event Type : </p></td>
										<td><p><?php echo $event_type[$record['event_type']]; ?></p></td>
									</tr>
								<?php endif; ?>
								<tr>
									<td><p>Department : </p></td>
									<td><p><?php echo $dept_list[$record['department']]; ?></p></td>
								</tr>
								<tr>
									<td><p>Event Co-ordinator : </p></td>
									<td><p><?php echo $record['event_incharge']; ?></p></td>
								</tr>
								<tr>
									<td><p>Co-ordinator Contact : </p></td>
									<td><p><?php echo $record['incharge_contact']; ?></p></td>
								</tr>
								<tr>
									<td><p>Event Fee : </p></td>
									<td><p><?php echo $record['event_fee']; ?></p></td>
								</tr>
								<?php if ($record['category'] != 'workshop'): ?>
									<tr>
										<td><p>Prize : </p></td>
										<td><p><?php echo $record['event_prize']; ?></p></td>
									</tr>
								<?php endif; ?>
								<tr>
									<td><p>Description : </p></td>
									<td><p><?php echo $record['description']; ?></p></td>
								</tr>
							</table>
              <input type="button" id="register_event" class="register-button" value="Register">
            </div>
          </div>
        <?php } ?>
      <?php }else{ header("location:events.php"); }?>
		</div>
	</div>

  <script src="../src/js/jquery.min.js"></script>
  <script src="../src/js/jquery.easing.1.3.js"></script>
  <script src="../src/js/bootstrap.min.js"></script>
  <script src="../src/js/jquery.waypoints.min.js"></script>
	<script src="../src/js/libjs.js" charset="utf-8"></script>

	<script type="text/javascript">
		var event_id = "<?php echo $event_id; ?>";
		var user_id = "<?php if(isset($_SESSION['userid'])){ echo $_SESSION['userid']; } else{ echo ""; } ?>";

		$('#register_event').click(function () {
			register_event(event_id, user_id);
		});
	</script>

</body>
</html>
