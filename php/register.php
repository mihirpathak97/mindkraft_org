<?php
    require 'sqlconf.php';
    session_start();
    $con = mysqli_connect($host, $username, $password, $db);
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $college = $_POST['college'];
    $password = $_POST['password'];
    $userid = generateUniqueUserId();
    $query = "insert into user_table values ('" . $name . "', '" . $mobile . "', '" . $email . "', '" . $college . "', '" . $password . "', '" . $userid . "')";
    $result = mysqli_query($con, $query);
    if ($result) {
      $query = "select * from user_table where mobile='" . $mobile . "' and password='" . $password . "'";
      $result = mysqli_query($con, $query);
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $_SESSION['userid'] = $record['userid'];
      $_SESSION['sql-success'] = '1';
      header("location:../index.php");
    }
    else {
      $_SESSION['sql-err'] = '1';
      header("location:../register.php");
    }

    function generateUniqueUserId($length = 15) {
      global $con;
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      $query = "select * from user_table where userid='" . $randomString . "'";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) > 0) {
        generateUniqueUserId();
      }
      else {
        return $randomString;
      }
    }

?>
