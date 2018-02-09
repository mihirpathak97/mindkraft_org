<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CpanelController extends Controller
{
  // login logic
  public function login(Request $request)
  {
    $prefix = env('DB_TABLE_PREFIX', '');

    $username = $request->input('username');
    $password = $request->input('password');

    $query = 'SELECT * FROM '.$prefix.'cpanel_users WHERE username=? AND password=PASSWORD(?)';

    $user = DB::select($query, [$username, $password]);

    if (count($user) == 1) {
      session([
        'cpaneluser' => $user[0]->username,
      ]);
      return redirect('/cpanel/console');
    }
    else {
      return redirect('cpanel');
    }
  }

  public static function getAccessLevel($user)
  {
    $prefix = env('DB_TABLE_PREFIX', '');
    $query = 'SELECT * FROM '.$prefix.'cpanel_users WHERE username=?';
    $user = DB::select($query, [$user]);
    if (count($user) == 1) {
      return $user[0]->access_level;
    }
    else {
      return -1;
    }
  }
}
