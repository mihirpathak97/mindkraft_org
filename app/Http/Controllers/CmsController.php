<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsAuth extends Controller
{
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
}
