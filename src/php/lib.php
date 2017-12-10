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


  // PDO error
  function PDOerror($errorMessage)
  {
    return "An SQL error occured! <br><br>Error message : $errorMessage";
  }

?>
