<?php
    require 'sqlconf.php';
    session_start();
    $con = mysqli_connect($host, $username, $password, $db);
    $query = "select * from user_table where mobile='" . $_POST['uname'] . "' and password='" . $_POST['password'] . "'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $_SESSION['userid'] = $record['userid'];
      $_SESSION['sql-success'] = '1';
      header("location:../index.php");
    }
    else {
      $_SESSION['sql-err'] = '1';
      header("location:../login.php");
    }
?>
