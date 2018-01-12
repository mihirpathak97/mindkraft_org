<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Controller
|--------------------------------------------------------------------------
|
| Author - Mihir Pathak
| Copyright (c) 2018 Z Coders All Rights Reserved
|
| All calls except in auth group must contain a valid 64-digit alphanumeric
| `api_token` (generated when a user registers). `api_token` is unique
| and unchanging.
|
| Invalid `api_token` or improper API calls will return false.
|
| [IMPORTANT] : `api_token` is not stored in the client-side in anyway. Use
| `auth/get/api_token/{userid}` to retrieve it from the server.
|
*/

class APIController extends Controller
{

  /*
  |--------------------------------------------------------------------------
  | Authentication Functions
  |--------------------------------------------------------------------------
  */

  public function userAuthLogin(Request $request)
  {
    /**
     * Accepts a mobile number and password
     * Returns `api_token` and `userid`
     * [NOTE] : `userid` can be stored on the client-side
     */

     $prefix = env('DB_VIEW_PREFIX', '');

     $path = explode('/', $request->path());
     $mobile = $path[count($path) - 2];
     $password = $path[count($path) - 1];

     $query = 'SELECT * FROM '.$prefix.'enduser WHERE mobile=? AND password=PASSWORD(?)';

     $user = DB::select($query, [$mobile, $password]);

     if (count($user) == 1) {

       // increment visit_count by 1
       DB::update('UPDATE '.$prefix.'enduser SET visit_count = visit_count + 1 where id=\''.$user[0]->id.'\'');

       $json_result = '{ "auth_type": "login", "success": true, "userid": "'.$user[0]->id.'", "api_token": "'.$user[0]->api_token.'" }';

       return $json_result;

     }
     else {
       return '{ "auth_type": "login", "success": false }';
     }
  }

  public function userAuthRegister(Request $request)
  {
    /**
     * Accetps user registration data
     * Returns a boolean (until OTP framework is enabled)
     * When OTP framework is enabled, will return a proper message
     */

     $prefix = env('DB_TABLE_PREFIX', '');

     $path = explode('/', $request->path());
     $id = Controller::generateRandomString();
     $name = $path[count($path) - 5];
     $mobile = $path[count($path) - 4];
     $email = $path[count($path) - 3];
     $college = $path[count($path) - 2];
     $password = $path[count($path) - 1];
     $api_token = Controller::generateRandomString(64);

     $query = 'INSERT INTO '.$prefix.'enduser (id, name, mobile, email, college, password, api_token) VALUES ( ?, ?, ?, ?, ?, PASSWORD( ? ), ?)';

     tryinsert:
       try {
         $result = DB::insert($query, [$id, $name, $mobile, $email, $college, $password, $api_token]);
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
               return '{ "auth_type": "register", "success": false, "duplicate": true }';
             }
           }
           // If it's not a duplicate entry but something is still wrong
           else {
             return '{ "auth_type": "register", "success": false, "error_message": "'.$e->getMessage().'" }';
           }
         }

     if (isset($result) && $result) {
       return '{ "auth_type": "register", "success": true }';
       // loginUser($mobile, $password);
     }
  }

  public function userAuthRegisterKarunya(Request $request)
  {
    /**
     * Accepts user registration data along with Karunya
     * registration number
     *
     * Return - Same as userAuthRegister
     */

    return "true";
  }

  public function userAuthAuthenticate(Request $request)
  {
    /**
     * Accepts mobile number, password and OTP
     * Returns "You can now login"
     */

    return "true";
  }


  /*
  |--------------------------------------------------------------------------
  | Get Functions
  |--------------------------------------------------------------------------
  |
  | All calls require `api_token`
  | All responses must be in strict JSON format
  |
  */

  public function getEventsList(Request $request)
  {
    /**
     * Returns events list (departments)
     */

    return "true";
  }

  public function getEventsListDepartment(Request $request)
  {
    /**
     * Returns department wise events list
     */

    return "true";
  }

  public function getGamesList(Request $request)
  {
    /**
     * Returns games list
     */

    return "true";
  }

  public function getWorkshopsList(Request $request)
  {
    /**
     * Returns workshops list
     */

    return "true";
  }

}
