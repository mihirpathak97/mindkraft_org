<?php
    require 'sqlconf.php';
    session_start();
    $con = mysqli_connect($host, $username, $password, $db);
    $userid = generateUniqueUserId();
    $mobile = $_POST['mobile'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $college = $_POST['college'];
    $password = $_POST['password'];
    $query = "insert into ".$table_prefix."enduser_table values ('" . $userid . "', '" . $mobile . "', '" . $name . "', '" . $email . "', '" . $college . "', password('" . $password . "'))";
    $result = mysqli_query($con, $query);
    if ($result) {
      $query = "select * from ".$view_prefix."enduser_table where mobile='" . $mobile . "' and password=password('" . $password . "')";
      $result = mysqli_query($con, $query);
      $record = mysqli_fetch_array($result, MYSQL_ASSOC);
      $_SESSION['userid'] = $record['userid'];
      $_SESSION['username'] = $record['name'];
      echo "User registration successfull!";
    }
    else {
      $query = "select * from ".$view_prefix."enduser_table where mobile='" . $mobile . "'";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) == 1) {
        echo "User account with the given mobile number already exists!";
      }
      else {
        echo "There was an error registering the user! <br><br>Please check your credentials and try again";
      }
    }

    function generateUniqueUserId($length = 16) {
      global $con;
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      $query = "select * from user_table where userid='" . $randomString . "'";
      $result = mysqli_query($con, $query);
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          generateUniqueUserId();
        }
      }
      else {
        return $randomString;
      }
    }

?>
