<?php
  $event = $_GET['event_id'];
  $user = $_GET['user_id'];
  if (strlen($user) != 16) {
    echo "Please log in to register!";
    return;
  }
  if (strlen($user) == 16 && strlen($event) == 16) {
    require '../php/sqlconf.php';
    $con = mysqli_connect($host, $username, $password, $db);
    if (check_exists_event($event)) {
      $query = "select registered_users from ".$table_prefix."enduser_registration where event_id='".$event."'";
      $record = mysqli_fetch_array(mysqli_query($con, $query), MYSQL_ASSOC);
      if (!user_registered($user, $record)) {
        $con->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
        $query = "update ".$table_prefix."enduser_registration set registered_users='".$record['registered_users'].$user.":'";
        $result = mysqli_query($con, $query);
        if ($result) {
          echo "Succesfully registered for event!";
        }
        else {
          echo "There was an error registering for the event!";
        }
        $con->commit();
        $con->close();
      }
      else {
        echo "You have already registed for this event...";
      }
    }
    else {
      $con->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
      $query = "insert into ".$table_prefix."enduser_registration values ('".$event."','".$user.":')";
      $result = $result = mysqli_query($con, $query);
      if ($result) {
        echo "Succesfully registered for event!";
      }
      else {
        echo "There was an error registering for the event!";
      }
      $con->commit();
      $con->close();
    }
  }

  function check_exists_event($event_id)
  {
    require '../php/sqlconf.php';
    $con = mysqli_connect($host, $username, $password, $db);
    $query = "select * from ".$table_prefix."enduser_registration where event_id='".$event_id."'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
      return true;
    }
    else {
      return false;
    }
  }

  function user_registered($user_id, $record)
  {
    $records = explode(":", $record['registered_users']);
    if (in_array($user_id, $records)) {
      return true;
    }
    else {
      return false;
    }
  }
?>
