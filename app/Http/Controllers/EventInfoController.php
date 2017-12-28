<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventInfoController extends Controller
{
    public function getEventInfo(Request $request)
    {

      $prefix = env('DB_VIEW_PREFIX', '');

      $path = explode('/', $request->path());
      $id = $path[count($path) - 2];
      $param = $path[count($path) - 1];

      $event = DB::select('select * from '.$prefix.'events_list where id=\''.$id.'\'');
      $event = $event[0];

      if ($event->fee == 0) {
        $event->fee = 'Free!';
      }

      if ($event->prize == 0) {
        $event->prize = 'No prizes for this event';
      }

      if ($param == 'about') {
        $acc = '{ "heading": "Info",';
        $acc .= '"body": "'.$event->about.'"}';
        return $acc;
      }
      if ($param == 'contact') {
        $acc = '{ "heading": "Contact",';
        $acc .= '"body": "'.$event->contact.'"}';
        return $acc;
      }
      if ($param == 'fee') {
        $acc = '{ "heading": "Fee",';
        $acc .= '"body": "'.$event->fee.'"}';
        return $acc;
      }
      if ($param == 'prize') {
        $acc = '{ "heading": "Prize",';
        $acc .= '"body": "'.$event->prize.'"}';
        return $acc;
      }

      $acc = '{ "heading": "'.$param.'",';
      $acc .= '"body": "Not Available"}';
      return $acc;

    }

    public function getGameInfo(Request $request)
    {

      $prefix = env('DB_VIEW_PREFIX', '');

      $path = explode('/', $request->path());
      $id = $path[count($path) - 2];
      $param = $path[count($path) - 1];

      $event = DB::select('select * from '.$prefix.'games_list where id=\''.$id.'\'');
      $event = $event[0];

      if ($event->fee == 0) {
        $event->fee = 'Free!';
      }

      if ($event->prize == 0) {
        $event->prize = 'No prizes for this event';
      }

      if ($param == 'about') {
        $acc = '{ "heading": "Info",';
        $acc .= '"body": "'.$event->about.'"}';
        return $acc;
      }
      if ($param == 'contact') {
        $acc = '{ "heading": "Contact",';
        $acc .= '"body": "'.$event->contact.'"}';
        return $acc;
      }
      if ($param == 'fee') {
        $acc = '{ "heading": "Fee",';
        $acc .= '"body": "'.$event->fee.'"}';
        return $acc;
      }
      if ($param == 'prize') {
        $acc = '{ "heading": "Prize",';
        $acc .= '"body": "'.$event->prize.'"}';
        return $acc;
      }

      $acc = '{ "heading": "'.$param.'",';
      $acc .= '"body": "Not Available"}';
      return $acc;

    }

    public function getWorkshopInfo(Request $request)
    {

      $prefix = env('DB_VIEW_PREFIX', '');

      $path = explode('/', $request->path());
      $id = $path[count($path) - 2];
      $param = $path[count($path) - 1];

      $event = DB::select('select * from '.$prefix.'workshops_list where id=\''.$id.'\'');
      $event = $event[0];

      if ($event->fee == 0) {
        $event->fee = 'Free!';
      }

      if ($param == 'about') {
        $acc = '{ "heading": "Info",';
        $acc .= '"body": "'.$event->about.'"}';
        return $acc;
      }
      if ($param == 'contact') {
        $acc = '{ "heading": "Contact",';
        $acc .= '"body": "'.$event->contact.'"}';
        return $acc;
      }
      if ($param == 'fee') {
        $acc = '{ "heading": "Fee",';
        $acc .= '"body": "'.$event->fee.'"}';
        return $acc;
      }

      $acc = '{ "heading": "'.$param.'",';
      $acc .= '"body": "Not Available"}';
      return $acc;

    }

    public function prepareUserRegister(Request $request)
    {

      $prefix = env('DB_VIEW_PREFIX', '');

      $path = explode('/', $request->path());
      $table = $prefix . $path[count($path) - 3] . "s_list";
      $userid = $path[count($path) - 2];
      $eventid = $path[count($path) - 1];

      if ($userid == 'nil') {
        return "You must login first!";
      }

      else {

        $user = DB::select('select * from '.$prefix.'enduser where id=\''.$userid.'\'');
        $user = $user[0];

        $event = DB::select('select * from '.$table.' where id=\''.$eventid.'\'');
        $event = $event[0];
        if (!$event->open) {
          return "<p>Registrations for this event is closed!</p>";
        }
        // else {
        //   // Check seats available
        // }
        $acc = '<a href="/register/'.$type.'/'.$userid.'/'.$eventid.'">Register Now!</a>';
        return $acc;
      }

    }
}
