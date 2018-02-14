<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    // login logic
    public function login(Request $request)
    {
      $prefix = env('DB_VIEW_PREFIX', '');

      $username = $request->input('username');
      $password = $request->input('password');

      $query = 'SELECT * FROM '.$prefix.'cpanel_users WHERE username=? AND password=PASSWORD(?)';

      $user = DB::select($query, [$username, $password]);

      if (count($user) == 1) {
        session([
          'cmsuser' => $user[0]->username,
        ]);
        return redirect('/cms/console');
      }
      else {
        return redirect('cms');
      }
    }

    public function addevent(Request $request)
    {

      $prefix = env('DB_TABLE_PREFIX', '');

      $id = Controller::generateRandomString();
      $name = Controller::nl_replace($request->input('name'));
      $type = Controller::nl_replace($request->input('type'));
      $dept = Controller::nl_replace($request->input('department'));
      $contact = Controller::nl_replace($request->input('contact'));
      $fee = Controller::nl_replace($request->input('fee'));
      $prize = Controller::nl_replace($request->input('prize'));
      $rules = Controller::nl_replace($request->input('rules'));
      $about = Controller::nl_replace($request->input('about'));
      $seats = Controller::nl_replace($request->input('seats'));

      $query = 'INSERT INTO '.$prefix.'events_list (id, name, type, department, contact, fee, prize, rules, about, seats) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $type, $dept, $contact, $fee, $prize, $rules, $about, $seats]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
              // Checks if generated user id is already taken
              if (stripos($e->getMessage(), 'for key \'events_list_id_unique\'') != false) {
                $id = Controller::generateRandomString();
                goto tryinsert;
              }
              else {
                return $e->getMessage();
              }
            }
            // If it's not a duplicate entry but something is still wrong
            else {
              echo "Error adding event!<br>Please try again later<br><br>";
              echo "<b>Error Message</b> <br>" . $e->getMessage();
            }
          }

      if (isset($result) && $result) {
        return "Successfully added event!";
      }

    }

    public function addgame(Request $request)
    {

      $prefix = env('DB_TABLE_PREFIX', '');

      $id = Controller::generateRandomString();
      $name = Controller::nl_replace($request->input('name'));
      $contact = Controller::nl_replace($request->input('contact'));
      $fee = Controller::nl_replace($request->input('fee'));
      $prize = Controller::nl_replace($request->input('prize'));
      $rules = Controller::nl_replace($request->input('rules'));
      $about = Controller::nl_replace($request->input('about'));
      $seats = Controller::nl_replace($request->input('seats'));

      $query = 'INSERT INTO '.$prefix.'games_list (id, name, contact, fee, prize, rules, about, seats) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $contact, $fee, $prize, $rules, $about, $seats]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
              // Checks if generated user id is already taken
              if (stripos($e->getMessage(), 'for key \'games_list_id_unique\'') != false) {
                $id = Controller::generateRandomString();
                goto tryinsert;
              }
              else {
                return $e->getMessage();
              }
            }
            // If it's not a duplicate entry but something is still wrong
            else {
              echo "Error adding event!<br>Please try again later<br><br>";
              echo "<b>Error Message</b> <br>" . $e->getMessage();
            }
          }

      if (isset($result) && $result) {
        return "Successfully added event!";
      }

    }

    public function addworkshop(Request $request)
    {

      $prefix = env('DB_TABLE_PREFIX', '');

      $id = Controller::generateRandomString();
      $name = Controller::nl_replace($request->input('name'));
      $dept = Controller::nl_replace($request->input('department'));
      $contact = Controller::nl_replace($request->input('contact'));
      $fee = Controller::nl_replace($request->input('fee'));
      $about = Controller::nl_replace($request->input('about'));
      $seats = Controller::nl_replace($request->input('seats'));

      $query = 'INSERT INTO '.$prefix.'workshops_list (id, name, department, contact, fee, about, seats) VALUES (?, ?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $dept, $contact, $fee, $about, $seats]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
              // Checks if generated user id is already taken
              if (stripos($e->getMessage(), 'for key \'events_list_id_unique\'') != false) {
                $id = Controller::generateRandomString();
                goto tryinsert;
              }
              else {
                return $e->getMessage();
              }
            }
            // If it's not a duplicate entry but something is still wrong
            else {
              echo "Error adding event!<br>Please try again later<br><br>";
              echo "<b>Error Message</b> <br>" . $e->getMessage();
            }
          }

      if (isset($result) && $result) {
        return "Successfully added event!";
      }

    }

    // Modifer Functoins


    public function modifyevent(Request $request)
    {

      $prefix = env('DB_TABLE_PREFIX', '');

      $id = $request->input('id');
      $name = $request->input('name');
      $type = $request->input('type');
      $dept = $request->input('department');
      $contact = $request->input('contact');
      $fee = $request->input('fee');
      $prize = $request->input('prize');
      $rules = $request->input('rules');
      $about = $request->input('about');
      $seats = $request->input('seats');

        try {
          $result = DB::table('events_list')
                              ->where('id', $id)
                              ->update([
                                'name' => $name,
                                'type' => $type,
                                'department' => $dept,
                                'contact' => $contact,
                                'fee' => $fee,
                                'prize' => $prize,
                                'rules' => $rules,
                                'about' => $about,
                                'seats' => $seats
                               ]);
        } catch (\Illuminate\Database\QueryException $e) {
            echo "Error updating event!<br>Please try again later<br><br>";
            echo "<b>Error Message</b> <br>" . $e->getMessage();
            return;
          }

      return "Successfully updated event!";

    }


    public function addcpaneluser(Request $request)
    {

      $prefix = env('DB_TABLE_PREFIX', '');

      $name = $request->input('name');
      $password = $request->input('password');
      $id = $request->input('id');

      $access_level = 3;

      $query = 'INSERT INTO '.$prefix.'cpanel_users (username, password, access_level) VALUES (?, PASSWORD(?), ?)';
      $query2 = 'INSERT INTO '.$prefix.'cpanel_mapping (username, events) VALUES (?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$name, $password, $access_level]);
          $result2 = DB::insert($query2, [$name, $id]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
              // Checks if generated user id is already taken
              if (stripos($e->getMessage(), 'for key \'events_list_id_unique\'') != false) {
                $id = Controller::generateRandomString();
                goto tryinsert;
              }
              else {
                return $e->getMessage();
              }
            }
            // If it's not a duplicate entry but something is still wrong
            else {
              echo "Error adding event!<br>Please try again later<br><br>";
              echo "<b>Error Message</b> <br>" . $e->getMessage();
            }
          }

      if (isset($result) && $result) {
        return "Successfully added event!";
      }

    }

}
