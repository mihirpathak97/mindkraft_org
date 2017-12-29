<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Departments list
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

    // Event Types
    const event_type = array(
      'tech' => 'Technical',
      'nontech' => 'Non Technical'
    );

    // Event Categories
    const event_category = array(
      'event' => 'Event',
      'workshop' => 'Workshop',
      'game' => 'Games'
    );

    // Generates a 16-digit alpha-numeric
    public function generateRandomString($length = 16) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      return $randomString;
    }

    // Mini slugify function
    public static function slugify($string, $delimiter = '-')
    {
      $string = preg_replace('#[^\pL\d]+#u', '-', $string);
      // Trim trailing -
      $string = trim($string, '-');
      $clean = preg_replace('~[^-\w]+~', '', $string);
      $clean = strtolower($clean);
      $clean = preg_replace('#[\/_|+ -]+#', $delimiter, $clean);
      $clean = trim($clean, $delimiter);
      return $clean;
    }

    public function nl_replace($string)
    {
      return str_replace(array("\r", "\n", "\r\n", "\n\r"), '<br>', $string);
    }

}
