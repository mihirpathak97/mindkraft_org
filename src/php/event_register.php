<?php
  $eventid = $_GET['event_id'];
  $userid = $_GET['user_id'];
  if (strlen($userid) != 16) {
    echo "Please log in to register!";
    return;
  }
  if (strlen($userid) == 16 && strlen($eventid) == 16) {
    require 'pdo.php';
    require_once 'sqlconf.php';
    require_once 'lib.php';

    global $pdo, $table_prefix;

    // Begins SQL transaction
    $pdo->beginTransaction();

    // Check if event already exists in table
    $query = "SELECT * FROM $table_prefix" . "event_registration WHERE event_id='$eventid'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() == 0){
      $query = "INSERT INTO $table_prefix" . "event_registration VALUES ('$eventid','$userid')";
    }
    else {
      // Get list of registered users
      $query = $query = "SELECT registered_users FROM $table_prefix" . "event_registration WHERE event_id='$eventid'";
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      $registered_users = explode(':', $stmt->fetchColumn());

      // Check if already registered
      if (in_array($userid, $registered_users)) {
        echo "You have already registered...";
      }
      else {
        $registered_users = implode(':', $registered_users);
        $query = "UPDATE $table_prefix" . "event_registration SET registered_users='$registered_users:$userid' WHERE event_id='$eventid'";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute();
        if ($result) {
          echo "You have been succesfully registered for this event!";
        }
      }
    }

    // Commit changes
    $pdo->commit();

  }
?>
