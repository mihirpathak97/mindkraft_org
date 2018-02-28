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

  public function updateTshirtInfo(Request $request)
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


    try {
      $result = DB::table('tshirt_registration')
                          ->where('register_number', $reg_no)
                          ->update([
                            'name' => $name,
                            'gender' => $gender,
                            'ugpg' => $ugpg,
                            'school' => $map[$school],
                            'size' => $size,
                           ]);
    } catch (\Illuminate\Database\QueryException $e) {
        echo "Error updating!<br>Please try again later<br><br>";
        echo "<b>Error Message</b> <br>" . $e->getMessage();
        return;
      }

    return "Successfully updated!";
  }

}
