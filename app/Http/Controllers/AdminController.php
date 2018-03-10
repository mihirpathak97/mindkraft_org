<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SimpleMailer;

class AdminController extends Controller
{
  // login logic
  public function login(Request $request)
  {
    $prefix = env('DB_TABLE_PREFIX', '');

    $username = $request->input('username');
    $password = $request->input('password');

    $query = 'SELECT * FROM '.$prefix.'cpanel_users WHERE username=? AND password=PASSWORD(?)';

    $user = DB::select($query, [$username, $password]);

    if (count($user) == 1 && $user[0]->access_level == 0) {
      session([
        'adminuser' => $user[0]->username,
      ]);
      return redirect('/admin/console');
    }
    else {
      return redirect('admin');
    }
  }

  public function MailSender(Request $request)
  {
    $data = ['subject' => $request->input('subject'), 'body' => $request->input('body'), 'from' => $request->input('from')];
    $emails = ['mihirr@karunya.edu.in'];
    Mail::to($emails)->send(new SimpleMailer($data));
    return "E-mail was sent successfully";
  }


  public function approveUser(Request $request)
  {
    return "working";
  }


}
