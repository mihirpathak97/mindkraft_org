<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    // login logic
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

    public function addevent(Request $request)
    {

      $prefix = env('DB_VIEW_PREFIX', '');

      $id = Controller::generateRandomString();
      $name = $request->input('ev_name');
      $type = $request->input('ev_type');
      $dept = $request->input('ev_department');
      $contact = $request->input('ev_contact');
      $fee = $request->input('ev_fee');
      $prize = $request->input('ev_prize');
      $about = $request->input('ev_about');
      $faq = $request->input('ev_faq');

      $query = 'INSERT INTO'.$prefix.'events_list (id, name, type, department, contact, fee, prize, about, faq) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

      tryinsert:
        try {
          $result = DB::insert($query, [$id, $name, $type, $dept, $contact, $fee, $prize, $about, $faq]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
              // Checks if generated user id is already taken
              if (stripos($e->getMessage(), 'for key \'events_list_id_unique\'') != false) {
                $id = Controller::generateRandomString();
                goto tryinsert;
              }
              else {
                return $e->getMessage();
              }
            }
            // If it's not a duplicate entry but something is still wrong
            else {
              return "Error adding event!<br>Please try again later";
            }
          }

      if (isset($result) && $result) {
        return "Successfully added event!";
      }

    }
}
