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
      $name = $request->input('name');
      $type = $request->input('type');
      $dept = $request->input('department');
      $contact = $request->input('contact');
      $fee = $request->input('fee');
      $prize = $request->input('prize');
      $about = $request->input('about');

      $query = 'INSERT INTO '.$prefix.'events_list (id, name, type, department, contact, fee, prize, about) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $type, $dept, $contact, $fee, $prize, $about]);
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
      $name = $request->input('name');
      $contact = $request->input('contact');
      $fee = $request->input('fee');
      $prize = $request->input('prize');
      $about = $request->input('about');

      $query = 'INSERT INTO '.$prefix.'games_list (id, name, contact, fee, prize, about) VALUES (?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $contact, $fee, $prize, $about]);
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
      $name = $request->input('name');
      $dept = $request->input('department');
      $contact = $request->input('contact');
      $fee = $request->input('fee');
      $about = $request->input('about');

      $query = 'INSERT INTO '.$prefix.'workshops_list (id, name, department, contact, fee, about) VALUES (?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $dept, $contact, $fee, $about]);
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
