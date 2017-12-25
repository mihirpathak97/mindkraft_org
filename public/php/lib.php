<?php
  /**
   *  lib.php - Contains some basic tuples and functions
   *  Copyright (c) 2017 Z-Coders
   */

  const dept_list = array(
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

  const event_type = array(
    'tech' => 'Technical',
    'nontech' => 'Non Technical'
  );

  const event_category = array(
    'event' => 'Event',
    'workshop' => 'Workshop',
    'game' => 'Games'
  );

  // Generates a 16-digit alpha-numeric
  function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
  }


  // PDO error
  function PDOerror($errorMessage)
  {
    return "<b>An SQL error occured!</b><br><br>Error message : $errorMessage";
  }


  function textAjaxReply($msg)
  {
    $acc = '{';
    $acc .= 'type: "text"';
    $acc .= 'message: "'. $msg .'"';
    $acc .= '}';
    return $acc;
  }

  function modalAjaxReply($msg)
  {
    $acc = '{';
    $acc .= 'type: "modal"';
    $acc .= 'message: "'. $msg .'"';
    $acc .= '}';
    return $acc;
  }

?>
