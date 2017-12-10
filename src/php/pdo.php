<?php
  // pdo.php - Initializes a basic PDO object
  // Copyright (C) - Z-Coders

  require 'sqlconf.php';

  $dsn = "mysql:host=$hostname;dbname=$database;charset=utf8mb4";

  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
  ];

  try {
    $pdo = new PDO($dsn, $username, $password, $options);
  } catch (PDOException $e) {
    if ($e->getCode() == 2002) {
      echo "<b>Error!</b> <br><br>Server actively refused the SQL connection.";
    }
    $pdo = null;
  }
?>
