<?php
  session_start();
  require 'pdo.php';
  require_once 'sqlconf.php';
  require_once 'lib.php';

  echo $_POST['q1'];

  if (isset($_POST['action'])) {
    if ($_POST['action'] == 'login') {
      loginUser();
    }
    else if ($_POST['action'] == 'register') {
      registerUser();
    }
    else {
      echo "Error: Unknown action. Supported actions and 'login' and 'register'";
    }
  }
  else {
    echo "Uh oh... <br><br>Are you sure you are supposed to be in this page?";
  }

  // Login logic

  function loginUser($mobile = null, $password = null)
  {
    if (isset($_POST['enduser_mobile']) && isset($_POST['enduser_password'])) {
      $mobile = $_POST['enduser_mobile'];
      $password = $_POST['enduser_password'];
    }
    global $pdo, $view_prefix;
    $query = "SELECT * FROM $view_prefix" . "enduser_table WHERE enduser_mobile= ? AND enduser_password=PASSWORD( ? )";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$mobile, $password]);

    if ($stmt->rowCount() == 1) {
      $record = $stmt->fetch(PDO::FETCH_ASSOC);
      $_SESSION['userid'] = $record['userid'];
      $_SESSION['username'] = $record['enduser_name'];
      echo "Successfully logged in!";
    }
    else {
      $query = "SELECT * FROM $view_prefix" . "enduser_table WHERE enduser_mobile= ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_POST['enduser_mobile']]);
      if ($stmt->rowCount() == 1) {
        echo "Your password is incorrect!";
      }
      else {
        echo "The user account could not be found. <br>Are you sure you signed up?";
      }
    }
  }

  // User registration Logic
  function registerUser()
  {
    global $pdo, $table_prefix;

    if ($pdo == null) {
      return;
    }

    $userid = generateRandomString();
    $mobile = $_POST['enduser_mobile'];
    $name = $_POST['enduser_name'];
    $email = $_POST['enduser_email'];
    $college = $_POST['enduser_college_name'];
    $password = $_POST['enduser_password'];

    $query = "INSERT INTO $table_prefix" . "enduser_table VALUES ( ?, ?, ?, ?, ?, PASSWORD( ? ))";

    tryinsert:
      try {
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([$userid, $mobile, $name, $email, $college, $password]);
      } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
          // Duplicate key error
          if ($e->errorInfo[1] == 1062) {
            if (strpos($e->getMessage(), 'userid') != false) {
              $userid = generateRandomString();
              goto tryinsert;
            }
            else {
              echo "User account with the given credentials already exists!
              <br><br>
              Try logging in...";
            }
          }
        }
        else {
          echo PDOerror("There was an error registering the user!<br>" . $e->getMessage());
        }
      }
    if ($result) {
      echo "User registration was successfull!<br><br>You can now login...";
      // loginUser($mobile, $password);
    }
  }
?>
