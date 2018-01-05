<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Auth extends Controller
{
  // Login function
  public function login(Request $request)
  {

    $prefix = env('DB_VIEW_PREFIX', '');

    $mobile = $request->input('mobile');
    $password = $request->input('password');

    $query = 'SELECT * FROM '.$prefix.'enduser WHERE mobile=? AND password=PASSWORD(?)';

    $user = DB::select($query, [$mobile, $password]);

    if (count($user) == 1) {

      // increment visit_count by 1
      DB::update('UPDATE '.$prefix.'enduser SET visit_count = visit_count + 1 where id=\''.$user[0]->id.'\'');

      session([
        'username' => $user[0]->name,
        'userid' => $user[0]->id
      ]);

      if ($request->input('referrer') == 'register') {
        $link = 'javascript:history.go(-2)';
      }
      else {
        $link = 'javascript:history.back()';
      }
      return "Login was successfull! Click <a href=\"$link\">here</a> to go back";
    }
    else {
      return "Please check your credentials and try again!";
    }

  }


  public function register(Request $request)
  {

    $prefix = env('DB_TABLE_PREFIX', '');

    $id = Controller::generateRandomString();
    $name = $request->input('name');
    $mobile = $request->input('mobile');
    $email = $request->input('email');
    $college = $request->input('college');
    $password = $request->input('password');

    $query = 'INSERT INTO '.$prefix.'enduser (id, name, mobile, email, college, password) VALUES ( ?, ?, ?, ?, ?, PASSWORD( ? ))';
    // $result = DB::insert($query, [$id, $name, $mobile, $email, $college, $password]);

    tryinsert:
      try {
        $result = DB::insert($query, [$id, $name, $mobile, $email, $college, $password]);
      } catch (\Illuminate\Database\QueryException $e) {
          if ($e->errorInfo[1] == 1062) {
            // Checks if generated user id is already taken
            if (stripos($e->getMessage(), 'for key \'enduser_id_unique\'') != false) {
              $id = Controller::generateRandomString();
              goto tryinsert;
            }
            else {
              // Houston we have a duplicate entry!
              return "A user account with the given credentials already exists!";
            }
          }
          // If it's not a duplicate entry but something is still wrong
          else {
            return "Error creating user account!<br>Please try again later";
          }
        }

    if (isset($result) && $result) {
      return "User registration was successfull!<br><br>Click here to <a href=\"/login\">login</a>";
      // loginUser($mobile, $password);
    }

  }


}
