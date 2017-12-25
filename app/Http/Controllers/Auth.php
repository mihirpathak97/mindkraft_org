<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Auth extends Controller
{
  public function login(Request $request)
  {

    $prefix = env('DB_VIEW_PREFIX', '');

    // $query = "SELECT * FROM $prefix"."enduser WHERE mobile= ? AND password=PASSWORD( ? )";

    // $user = DB::select($query, [$request->input('mobile'), $request->input('password')]);
    $match = ['cpanel_username' => $request->input('mobile'), 'user_password' => $request->input('password')];
    // $user = DB::table('mindkraft18_cpanel_users')->select('cpanel_username')->where($match);

    $user = DB::table('mindkraft18_cpanel_users')->select();

    return "ge";

  }
}
