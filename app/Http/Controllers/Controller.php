<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

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
      // 'nano' => 'Nano Technology',
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

    // Checks if provided userid is an authentic user
    public static function checkUserId($uid)
    {
      $prefix = env('DB_VIEW_PREFIX', '');
      $user = DB::select('select * from '.$prefix.'enduser where id=\''.$uid.'\'');

      if (count($user) > 0) {
        return true;
      }

      return false;

    }

    public function getChatMessages()
    {

      $prefix = env('DB_VIEW_PREFIX', '');
      $messages = DB::select('select * from '.$prefix.'news_feed');

      $acc = '{ "messages":[';

      for ($i=0; $i < count($messages); $i++) {
        if ($i == count($messages) - 1) {
          $acc .= '"'.$messages[$i]->message.'"';
        }
        else {
          $acc .= '"'.$messages[$i]->message.'",';
        }
      }

      $acc .= ']}';

      return $acc;

    }

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
