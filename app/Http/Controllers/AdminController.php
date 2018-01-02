<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  // login logic
  public function login(Request $request)
  {
    $prefix = env('DB_TABLE_PREFIX', '');

    $username = $request->input('username');
    $password = $request->input('password');

    $query = 'SELECT * FROM '.$prefix.'admin_user WHERE username=? AND password=PASSWORD(?)';

    $user = DB::select($query, [$username, $password]);

    if (count($user) == 1) {
      session([
        'cmsuser' => $user[0]->username,
      ]);
      return redirect('/admin/console');
    }
    else {
      return redirect('admin');
    }
  }
}
