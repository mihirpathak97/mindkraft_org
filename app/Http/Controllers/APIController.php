<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

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


  protected function checkAPIToken($api_token)
  {
    /**
     *  checkAPIToken - returns true if given `api_token` is valid
     */

    $prefix = env('DB_VIEW_PREFIX', '');

    $query = 'SELECT * FROM '.$prefix.'enduser WHERE api_token=?';

    $user = DB::select($query, [$api_token]);

    if (count($user) == 1) {
      return true;
    }
    else {
      return false;
    }

  }


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

       $user = $user[0];

       // Check if user is verified
       if ($user->is_verified == 0) {
         $data = ['id' => $user->id, 'api_token' => $user->api_token];
         Mail::to($user->email)->send(new VerificationEmail($data));
         return '{ "auth_type": "login", "success": false, "verify": true }';
       }

       // increment visit_count by 1
       DB::update('UPDATE '.$prefix.'enduser SET visit_count = visit_count + 1 where id=\''.$user->id.'\'');
       $json_result = '{ "auth_type": "login", "success": true, "userid": "'.$user->id.'", "api_token": "'.$user->api_token.'" }';
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
     $name = urldecode($path[count($path) - 5]);
     $mobile = $path[count($path) - 4];
     $email = $path[count($path) - 3];
     $college = urldecode($path[count($path) - 2]);
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

     $prefix = env('DB_TABLE_PREFIX', '');

     $path = explode('/', $request->path());
     $id = Controller::generateRandomString();
     $name = urldecode($path[count($path) - 6]);
     $mobile = $path[count($path) - 5];
     $email = $path[count($path) - 4];
     $college = urldecode($path[count($path) - 3]);
     $reg_no = $path[count($path) - 2];
     $password = $path[count($path) - 1];
     $api_token = Controller::generateRandomString(64);

     $query = 'INSERT INTO '.$prefix.'enduser (id, name, mobile, email, college, register_number, password, api_token) VALUES ( ?, ?, ?, ?, ?, ?, PASSWORD( ? ), ?)';

     tryinsert:
       try {
         $result = DB::insert($query, [$id, $name, $mobile, $email, $college, $reg_no, $password, $api_token]);
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
     }
  }


  public function getAPIToken(Request $request)
  {
    $prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());
    $id = $path[count($path) - 1];

    $user = DB::select('SELECT * FROM '.$prefix.'enduser WHERE id=\''.$id.'\'');
    if (count($user) == 1) {
      $user = $user[0];
      return '{ "api_token": "'.$user->api_token.'" }';
    }
    else {
      return '{ "message": "Invalid userid" }';
    }

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


  }

  public function getEventsListDepartment(Request $request)
  {
    /**
     * Returns department wise events list
     */

    $prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());
    $api_token = $path[count($path) - 4];
    $dept = $path[count($path) - 1];

    if (!APIController::checkAPIToken($api_token)) {
      return '{ "event_type": "events", "department": "'.$dept.'", "invalid_token": true }';
    }

    $query = 'SELECT * FROM '.$prefix.'events_list WHERE department= ? ';
    $events_list = DB::select($query, [$dept]);

    $json_result = '{ "event_type": "events", "department": "'.Controller::dept_list[$dept].'", "events": [';

    for ($i=0; $i < count($events_list); $i++) {
      if ($i == count($events_list) - 1) {
        $json_result .= '{ "event_name": "'.$events_list[$i]->name.'", "event_id": "'.$events_list[$i]->id.'" }';
      }
      else {
        $json_result .= '{ "event_name": "'.$events_list[$i]->name.'", "event_id": "'.$events_list[$i]->id.'" }, ';
      }
    }

    $json_result .= '] }';

    return $json_result;

  }

  public function getGamesList(Request $request)
  {
    /**
     * Returns games list
     */

     $prefix = env('DB_VIEW_PREFIX', '');

     $path = explode('/', $request->path());
     $api_token = $path[count($path) - 3];

     if (!APIController::checkAPIToken($api_token)) {
       return '{ "event_type": "games", "invalid_token": true }';
     }

     $query = 'SELECT * FROM '.$prefix.'games_list';
     $games_list = DB::select($query);

     $json_result = '{ "event_type": "workshops", "games": [';

     for ($i=0; $i < count($games_list); $i++) {
       if ($i == count($games_list) - 1) {
         $json_result .= '{ "game_name": "'.$games_list[$i]->name.'", "game_id": "'.$games_list[$i]->id.'" }';
       }
       else {
         $json_result .= '{ "game_name": "'.$games_list[$i]->name.'", "game_id": "'.$games_list[$i]->id.'" }, ';
       }
     }

     $json_result .= '] }';

     return $json_result;

  }

  public function getWorkshopsList(Request $request)
  {
    /**
     * Returns workshops list
     */

     $prefix = env('DB_VIEW_PREFIX', '');

     $path = explode('/', $request->path());
     $api_token = $path[count($path) - 3];

     if (!APIController::checkAPIToken($api_token)) {
       return '{ "event_type": "workshops", "invalid_token": true }';
     }

     $query = 'SELECT * FROM '.$prefix.'workshops_list';
     $workshops_list = DB::select($query);

     $json_result = '{ "event_type": "workshops", "workshops": [';

     for ($i=0; $i < count($workshops_list); $i++) {
       if ($i == count($workshops_list) - 1) {
         $json_result .= '{ "workshop_name": "'.$workshops_list[$i]->name.'", "workshop_id": "'.$workshops_list[$i]->id.'" }';
       }
       else {
         $json_result .= '{ "workshop_name": "'.$workshops_list[$i]->name.'", "workshop_id": "'.$workshops_list[$i]->id.'" }, ';
       }
     }

     $json_result .= '] }';

     return $json_result;

  }

  /*
  |--------------------------------------------------------------------------
  | Get Specific Functions
  |--------------------------------------------------------------------------
  |
  | All calls require `api_token`
  | Returns an event's details in JSON
  |
  */

  public function getEventInfo(Request $request)
  {
    /**
     * Accepts `event_id`
     * and returns event info in JSON
     */

     $prefix = env('DB_TABLE_PREFIX', '');

     $path = explode('/', $request->path());
     $api_token = $path[count($path) - 4];
     $id = $path[count($path) - 1];

     if (!APIController::checkAPIToken($api_token)) {
       return '{ "invalid_token": true }';
     }

     $query = 'SELECT * FROM '.$prefix.'events_list WHERE id= ? ';
     $event = DB::select($query, [$id]);

     if (count($event) != 1) {
       return '{ "invalid_id": true }';
     }

     $event = $event[0];

     $json_result = '{ "id": "'.$event->id.'", '.
       '"name": "'.$event->name.'", '.
       '"department": "'.Controller::dept_list[$event->department].'", '.
       '"type": "'.Controller::event_type[$event->type].'", '.
       '"contact": '.json_encode($event->contact).', '.
       '"fee": "'.$event->fee.'", '.
       '"prize": "'.$event->prize.'", '.
       '"rules": '.json_encode($event->rules).', '.
       '"about": '.json_encode($event->about).', '.
       '"seats": "'.$event->seats.'", ';

       if ($event->open) {
         $json_result .= '"is_open": true ';
       }
       else {
         $json_result .= '"is_open": false ';
       }

     $json_result .= ' }';

     return $json_result;

  }


  public function getGameInfo(Request $request)
  {
    /**
     * Accepts `game_id`
     * and returns game info in JSON
     */

     $prefix = env('DB_TABLE_PREFIX', '');

     $path = explode('/', $request->path());
     $api_token = $path[count($path) - 4];
     $id = $path[count($path) - 1];

     if (!APIController::checkAPIToken($api_token)) {
       return '{ "invalid_token": true }';
     }

     $query = 'SELECT * FROM '.$prefix.'games_list WHERE id= ? ';
     $game = DB::select($query, [$id]);

     if (count($game) != 1) {
       return '{ "invalid_id": true }';
     }

     $game = $game[0];

     $json_result = '{ "id": "'.$game->id.'", '.
       '"name": "'.$game->name.'", '.
       '"contact": "'.$game->contact.'", '.
       '"fee": "'.$game->fee.'", '.
       '"prize": "'.$game->prize.'", '.
       '"rules": "'.$game->rules.'", '.
       '"about": "'.$game->about.'", '.
       '"seats": "'.$game->seats.'", ';

       if ($game->open) {
         $json_result .= '"is_open": true ';
       }
       else {
         $json_result .= '"is_open": false ';
       }

     $json_result .= ' }';

     return $json_result;

  }

  public function getWorkshopInfo(Request $request)
  {
    /**
     * Accepts `workshop_id`
     * and returns workshop info in JSON
     */

     $prefix = env('DB_TABLE_PREFIX', '');

     $path = explode('/', $request->path());
     $api_token = $path[count($path) - 4];
     $id = $path[count($path) - 1];

     if (!APIController::checkAPIToken($api_token)) {
       return '{ "invalid_token": true }';
     }

     $query = 'SELECT * FROM '.$prefix.'workshops_list WHERE id= ? ';
     $workshop = DB::select($query, [$id]);

     if (count($workshop) != 1) {
       return '{ "invalid_id": true }';
     }

     $workshop = $workshop[0];

     $json_result = '{ "id": "'.$workshop->id.'", '.
       '"name": "'.$workshop->name.'", '.
       '"department": "'.$workshop->department.'", '.
       '"contact": '.json_encode($workshop->contact).', '.
       '"fee": "'.$workshop->fee.'", '.
       '"about": '.json_encode($workshop->about).', '.
       '"seats": "'.$workshop->seats.'", ';

       if ($workshop->open) {
         $json_result .= '"is_open": true ';
       }
       else {
         $json_result .= '"is_open": false ';
       }

     $json_result .= ' }';

     return $json_result;

  }


  /*
  |--------------------------------------------------------------------------
  | Register to Event
  |--------------------------------------------------------------------------
  |
  | This call is used to register a userid to the specified event
  | requires `api_token`
  | Returns the result in JSON
  |
  */

  public function registerToItem(Request $request)
  {

    $table_prefix = env('DB_TABLE_PREFIX', '');
    $view_prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());
    $api_token = $path[count($path) - 5];
    $userid = $path[count($path) - 3];
    $type = $path[count($path) - 2];
    $eventid = $path[count($path) - 1];
    $list_id = $type . '-' . $eventid;

    if (!APIController::checkAPIToken($api_token)) {
      return '{ "invalid_token": true }';
    }

    $list = DB::select('select * from '.$view_prefix.'event_registration where id=\''.$list_id.'\'');

    if (count($list) == 0) {
      // Create record and insert
      DB::beginTransaction();
      try {
        DB::insert('insert into '.$table_prefix.'event_registration (id, registered_users) values(\''.$list_id.'\', \''.$userid.'\')');
        DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
          return '{ "success": false, "message": "Error registering user! Please try again" }';
      }

    }

    else {
      // Check if user already registered
      $list = $list[0];
      $registered_users = explode(':', $list->registered_users);
      if (in_array($userid, $registered_users)) {
        return '{ "success": false, "message": "You have already registered for this event!" }';
      }
      else {
        $registered_users = implode(':', $registered_users);
        $registered_users .= ':'.$userid;
        DB::beginTransaction();
        try {
          DB::insert('update '.$table_prefix.'event_registration set registered_users=\''.$registered_users.'\' where id=\''.$list->id.'\'');
          DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return '{ "success": false, "message": "Error registering user! Please try again" }';
        }
      }
    }

    return '{ "success": true, "message": "You have successfully registered for this event!" }';

  }


  /*
  |--------------------------------------------------------------------------
  | Search for Item
  |--------------------------------------------------------------------------
  |
  | This call is used to search and event/game/workshop
  | requires `api_token`
  | Returns the result in JSON
  |
  */

  public function searchForItem(Request $request)
  {

    $prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());
    $api_token = $path[count($path) - 3];
    $search_string = $path[count($path) - 1];

    if (!APIController::checkAPIToken($api_token)) {
      return '{ "invalid_token": true }';
    }

    // Get events list that match the search string
    $query = 'SELECT name, id FROM '.$prefix.'events_list WHERE name LIKE \'%'.$search_string.'%\'';
    $events_list = DB::select($query);

    $json_result = '{ "events": [';

    for ($i=0; $i < count($events_list); $i++) {
      if ($i == count($events_list) - 1) {
        $json_result .= '{ "event_name": "'.$events_list[$i]->name.'", "event_id": "'.$events_list[$i]->id.'" }';
      }
      else {
        $json_result .= '{ "event_name": "'.$events_list[$i]->name.'", "event_id": "'.$events_list[$i]->id.'" }, ';
      }
    }

    $json_result .= '], ';

    // Get games list that match the search string
    $query = 'SELECT name, id FROM '.$prefix.'games_list WHERE name LIKE \'%'.$search_string.'%\'';
    $games_list = DB::select($query);

    $json_result .= '"games": [';

    for ($i=0; $i < count($games_list); $i++) {
      if ($i == count($games_list) - 1) {
        $json_result .= '{ "game_name": "'.$games_list[$i]->name.'", "game_id": "'.$games_list[$i]->id.'" }';
      }
      else {
        $json_result .= '{ "game_name": "'.$games_list[$i]->name.'", "game_id": "'.$games_list[$i]->id.'" }, ';
      }
    }

    $json_result .= '], ';

    // Get workshops list that match the search string
    $query = 'SELECT name, id FROM '.$prefix.'workshops_list WHERE name LIKE \'%'.$search_string.'%\'';
    $workshops_list = DB::select($query);

    $json_result .= '"workshops": [';

    for ($i=0; $i < count($workshops_list); $i++) {
      if ($i == count($workshops_list) - 1) {
        $json_result .= '{ "workshop_name": "'.$workshops_list[$i]->name.'", "workshop_id": "'.$workshops_list[$i]->id.'" }';
      }
      else {
        $json_result .= '{ "workshop_name": "'.$workshops_list[$i]->name.'", "workshop_id": "'.$workshops_list[$i]->id.'" }, ';
      }
    }

    $json_result .= '] }';

    echo "$json_result";


  }


  function getReceiptInfo(Request $request)
  {
    $path = explode('/', $request->path());
    $id = $path[count($path) - 1];

    if ($id == 'main') {
      return 'MindKraft Registration';
    }

    return DB::select('select * from mindkraft18_workshops_list where id=\''.$id.'\'')[0]->name;

  }


}
