<?php
    require 'sqlconf.php';
    session_start();
    $con = mysqli_connect($host, $username, $password, $db);
    $query = "select * from ".$view_prefix."enduser_table where mobile='" . $_POST['uname'] . "' and password=password('" . $_POST['password'] . "')";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $_SESSION['userid'] = $record['userid'];
      $_SESSION['username'] = $record['name'];
      echo "Successfully logged in!";
    }
    else {
      $query = "select * from ".$view_prefix."enduser_table where mobile='" . $_POST['uname'] . "'";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) == 1) {
        echo "Your password is incorrect!";
      }
      else {
        echo "The user account could not be found. <br>Are you sure you signed up?";
      }
      // $_SESSION['sql-err'] = '1';
      // header("location:../login.php");
    }
?>
