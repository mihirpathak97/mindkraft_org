<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRegistration extends Controller
{
    public function register(Request $request)
    {

      $table_prefix = env('DB_TABLE_PREFIX', '');
      $view_prefix = env('DB_VIEW_PREFIX', '');

      $path = explode('/', $request->path());
      $type = $path[count($path) - 3];
      $userid = $path[count($path) - 2];
      $eventid = $path[count($path) - 1];
      $list_id = $type . '-' . $eventid;

      $list = DB::select('select * from '.$view_prefix.'event_registration where id=\''.$list_id.'\'');

      if (count($list) == 0) {
        // Create record and insert
        DB::beginTransaction();
        try {
          DB::insert('insert into '.$table_prefix.'event_registration (id, registered_users) values(\''.$list_id.'\', \''.$userid.'\')');
          DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return "There was an error when regitering user!";
        }

      }

      else {
        // Check if user already registered
        $list = $list[0];
        $registered_users = explode(':', $list->registered_users);
        if (in_array($userid, $registered_users)) {
          return "You have already registered!";
        }
        else {
          $registered_users = implode(':', $registered_users);
          $registered_users .= ':'.$userid;
          DB::beginTransaction();
          try {
            DB::insert('update '.$table_prefix.'event_registration set registered_users=\''.$registered_users.'\'');
            DB::commit();
          } catch (\Exception $e) {
              DB::rollback();
              return "There was an error when regitering user!";
          }
        }
      }

      return "You have successfully registered for this event!";

    }
}
