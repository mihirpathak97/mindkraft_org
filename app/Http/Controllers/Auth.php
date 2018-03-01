<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

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

      $user = $user[0];

      // Check if user is verified
      if ($user->is_verified == 0) {
        $data = ['id' => $user->id, 'api_token' => $user->api_token];
        Mail::to($user->email)->send(new VerificationEmail($data));
        return "A verification link was sent to your email account, please use that link to verify your account";
      }

      // increment visit_count by 1
      DB::update('UPDATE '.$prefix.'enduser SET visit_count = visit_count + 1 where id=\''.$user->id.'\'');

      session([
        'username' => $user->name,
        'userid' => $user->id
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
    if ($request->has('college')) {
      $college = Controller::colleges_list[$request->input('college')];
    }
    else {
      $college = $request->input('college_other');
    }
    if ($request->has('reg_no')) {
      $reg_no = $request->input('reg_no');
    }
    if ($request->has('state')) {
      $state = Controller::states_list[$request->input('state')];
    }
    $password = $request->input('password');
    $api_token = Controller::generateRandomString(64);

    // Internal
    if (isset($reg_no)) {
      $query = 'INSERT INTO '.$prefix.'enduser (id, name, mobile, email, college, register_number, password, api_token) VALUES ( ?, ?, ?, ?, ?, ?, PASSWORD( ? ), ?)';
    }
    // External
    else {
      $query = 'INSERT INTO '.$prefix.'enduser (id, name, mobile, email, college, state, password, api_token) VALUES ( ?, ?, ?, ?, ?, ?, PASSWORD( ? ), ?)';
    }

    tryinsert:
      try {
        if (isset($reg_no)) {
          $result = DB::insert($query, [$id, $name, $mobile, $email, $college, $reg_no, $password, $api_token]);
        }
        else {
          $result = DB::insert($query, [$id, $name, $mobile, $email, $college, $state, $password, $api_token]);
        }
      } catch (\Illuminate\Database\QueryException $e) {
          if ($e->errorInfo[1] == 1062) {
            // Checks if generated user id is already taken
            if (stripos($e->getMessage(), 'for key \'enduser_id_unique\'') != false) {
              $id = Controller::generateRandomString();
              goto tryinsert;
            }
            // Checks if generated api_token is already taken
            elseif (stripos($e->getMessage(), 'for key \'enduser_api_token_unique\'') != false) {
              $id = Controller::generateRandomString(64);
              goto tryinsert;
            }
            else {
              // Houston we have a duplicate entry!
              return "A user account with the given credentials already exists!";
            }
          }
          // If it's not a duplicate entry but something is still wrong
          else {
            return "Error creating user account!<br>Please check your input and try again later";
          }
        }

    if (isset($result) && $result) {
      return "User registration was successfull!<br><br>Click here to <a href=\"/login\">login</a>";
      // loginUser($mobile, $password);
    }

  }


  public function userVerify(Request $request)
  {

    $prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());

    $id = $path[count($path) - 3];
    $hash = $path[count($path) - 2];
    $api_token = $path[count($path) - 1];

    if ($hash == hash('sha256', $id)) {

      // check if already done
      $user = DB::select('SELECT * FROM '.$prefix.'enduser WHERE id=\''.$id.'\'');

      if (count($user) != 1) {
        return view('verify.failed');
      }

      $user = $user[0];

      if ($user->is_verified == 1) {
        return view('verify.done');
      }

      // set is_verified to 1
      DB::update('UPDATE '.$prefix.'enduser SET is_verified = 1 where id=\''.$id.'\'');
      return view('verify.success');

    }

    else {
      return view('verify.failed');
    }

  }

  // Tshir registration
  public function tshirtRegister(Request $request)
  {

    $name = $request->input('name');
    $reg_no = $request->input('reg_no');
    $gender = $request->input('gender');
    $ugpg = $request->input('ugpg');
    $school = $request->input('school');
    $size = $request->input('size');

    $map = array(
      'eng' => 'School of Engineering and Technology',
      'arts' => 'School of Arts, Science and Media',
      'agri' => 'School of Agriculture and Biosciences',
      'mba' => 'School of Management and Law'
    );

    $query = 'INSERT INTO mindkraft18_tshirt_registration VALUES (?, ?, ?, ?, ?, ?)';
    tryinsert:
      try {
        $result = DB::insert($query, [$name, $reg_no, $gender, $ugpg, $map[$school], $size]);
      } catch (\Illuminate\Database\QueryException $e) {
          if ($e->errorInfo[1] == 1062) {
            return "You have already registered!";
          }
          // If it's not a duplicate entry but something is still wrong
          else {
            return "Error creating user account!<br>Please check your input and try again later";
          }
        }

    if (isset($result) && $result) {
      return "Successfully registered!";
    }
  }


}
