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

    function checkUserStatus($id)
    {
      if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
        return true;
      }
      return false;
    }

    function generatereceipt($user, $for)
    {
      $last = DB::select('select * from mindkraft18_receipt_details');
      $last = $last[count($last) - 1];
      $receipt = str_pad($last->number + 1, 6, "0", STR_PAD_LEFT);

      if (!checkUserStatus($user->id)) {
        $final = 'main:';
      }
      else {
        $final = '';
      }

      $i = 0;

      foreach ($for as $item => $fee) {
        $final .= $item . '-' . $fee . ':';
      }

      $query = 'insert into mindkraft18_receipt_details values (?, ?, ?)';

      $result = DB::insert($query, [$receipt, $user->id, $final]);

      $uid = DB::select('select * from mindkraft18_enduser_id where id=\''.$user->id.'\'')[0]->mk_id;

      if ($result) {
        $reply = '{ "success": true, "receipt": "'.$receipt.'", "for": '.json_encode($for).', "user": "'.$uid.'" }';
      }
      else {
        $reply = '{ "success": false }';
      }

      return $reply;

    }

    $prefix = env('DB_VIEW_PREFIX', '');
    $path = explode('/', $request->path());
    $id = $path[count($path) - 2];

    $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];

    if (!checkUserStatus($user->id)) {
      $for = ['main' => '300'];
    }
    else {
      $for = [];
    }
    $workshop_array = explode(':', $request->input('workshops'));

    function isInternal($user)
    {
      if ($user->college == 'Karunya Institute of Technology and Sciences, Coimbatore') {
        return true;
      }
      return false;
    }

    foreach ($workshop_array as $workshop) {
      if (strlen($workshop) > 1) {
        if (isInternal($user)) {
          $fee = DB::select('select * from mindkraft18_workshop_details where id=\''.$workshop.'\'')[0]->fee_internal;
        }
        else {
          $fee = DB::select('select * from mindkraft18_workshop_details where id=\''.$workshop.'\'')[0]->fee_external;
        }
        $for[$workshop] = $fee;
      }
    }

    // Add user to approved list and payment list
    try {
      if (!checkUserStatus($user->id)) {

        DB::statement('insert into mindkraft18_approved_enduser values(\''.$user->id.'\')');
        DB::statement('insert into mindkraft18_payment_info values(\''.$user->id.'\', \''.'main:'.implode(':', $workshop_array).'\')');

        // Generate new MK ID
        $last = DB::select('select * from mindkraft18_enduser_id');
        $last = $last[count($last) - 1];
        $uid = str_pad($last->mk_id + 1, 4, "0", STR_PAD_LEFT);
        DB::statement('insert into mindkraft18_enduser_id values (\''.$user->id.'\', \''.$uid.'\')');
      }
      else {
        // Check and add
        $payed_for = DB::select('select * from mindkraft18_payment_info where id=\''.$user->id.'\'')[0]->payed_for;
        foreach (explode(':', $payed_for) as $item) {
          if (in_array($item, $workshop_array)) {
            unset($workshop_array[array_search($item, $workshop_array)]);
          }
        }
        // Then append remaining items to payed_for
        $new = DB::select('select * from mindkraft18_payment_info where id=\''.$user->id.'\'')[0]->payed_for . implode(':', $workshop_array);
        DB::statement('update mindkraft18_payment_info set payed_for=\''.$new.'\' where id=\''.$user->id.'\'');
      }
    } catch (\Exception $e) {
      return '{ "success": false, "reason": "SQL Error!", "message": '.json_encode($e->getMessage()).' }';
    }

    return generatereceipt($user, $for);
  }

  public function registerGame(Request $request)
  {
    $last = DB::select('select * from mindkraft18_receipt_details');
    $last = $last[count($last) - 1];
    $receipt = str_pad($last->number + 1, 6, "0", STR_PAD_LEFT);

    function checkUserStatus($id)
    {
      if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
        return true;
      }
      return false;
    }

    function generatereceipt($user, $for)
    {
      $last = DB::select('select * from mindkraft18_receipt_details');
      $last = $last[count($last) - 1];
      $receipt = str_pad($last->number + 1, 6, "0", STR_PAD_LEFT);

      $final = '';

      foreach ($for as $item => $fee) {
        $final .= $item . '-' . $fee . ':';
      }

      $query = 'insert into mindkraft18_receipt_details values (?, ?, ?)';

      $result = DB::insert($query, [$receipt, $user->id, $final]);

      $uid = DB::select('select * from mindkraft18_enduser_id where id=\''.$user->id.'\'')[0]->mk_id;

      if ($result) {
        $reply = '{ "success": true, "receipt": "'.$receipt.'", "for": '.json_encode($for).', "user": "'.$uid.'" }';
      }
      else {
        $reply = '{ "success": false }';
      }

      return $reply;

    }


    $prefix = env('DB_VIEW_PREFIX', '');
    $path = explode('/', $request->path());
    $id = $path[count($path) - 3];

    $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];

    if ($request->has('paintball')) {
      $game = 'paintball';
    }
    elseif ($request->has('laser')) {
      $game = 'laser';
    }
    elseif ($request->has('atv')) {
      $game = 'atv';
    }
    else {
      return '{ "success": false, "reason": "Invalid game!" }';
    }

    $for = [$game => $request->input($game)];

    // Add user to approved list and payment list
    try {
      if (checkUserStatus($user->id)) {
        if (count(DB::select('select * from mindkraft18_games_registration where id=\''.$user->id.'-'.$game.'\'')) == 1) {
          // Increase times
          DB::statement('update mindkraft18_games_registration set times= times + 1 where id=\''.$user->id.'-'.$game.'\'');
        }
        else {
          // Else insert new
          DB::statement('insert into mindkraft18_games_registration values (\''.$user->id.'-'.$game.'\', \'1\')');
        }
      }
    } catch (\Exception $e) {
      return '{ "success": false, "reason": "SQL Error!", "message": '.json_encode($e->getMessage()).' }';
    }

    return generatereceipt($user, $for);

  }


  // Register Accomodation
  public function registerAccomodation(Request $request)
  {
    $last = DB::select('select * from mindkraft18_receipt_details');
    $last = $last[count($last) - 1];
    $receipt = str_pad($last->number + 1, 6, "0", STR_PAD_LEFT);

    function checkUserStatus($id)
    {
      if (count(DB::select('select * from mindkraft18_approved_enduser where id=\''.$id.'\'')) > 0 ) {
        return true;
      }
      return false;
    }

    function generatereceipt($user, $for)
    {
      $last = DB::select('select * from mindkraft18_receipt_details');
      $last = $last[count($last) - 1];
      $receipt = str_pad($last->number + 1, 6, "0", STR_PAD_LEFT);

      $final = '';

      foreach ($for as $item => $fee) {
        $final .= $item . '-' . $fee . ':';
      }

      $query = 'insert into mindkraft18_receipt_details values (?, ?, ?)';

      $result = DB::insert($query, [$receipt, $user->id, $final]);

      $uid = DB::select('select * from mindkraft18_enduser_id where id=\''.$user->id.'\'')[0]->mk_id;

      if ($result) {
        $reply = '{ "success": true, "receipt": "'.$receipt.'", "for": '.json_encode($for).', "user": "'.$uid.'" }';
      }
      else {
        $reply = '{ "success": false }';
      }

      return $reply;

    }


    $prefix = env('DB_VIEW_PREFIX', '');
    $path = explode('/', $request->path());
    $id = $path[count($path) - 2];

    $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];

    $for = ['accomodation' => $request->input('total')];

    // Add user to approved list and payment list
    try {
      if (checkUserStatus($user->id)) {
        DB::statement('insert into mindkraft18_acc_registration values (\''.$user->id.'\', \''.$request->input('from').'\', \''.$request->input('to').'\', \''.$request->input('food').'\')');
      }
    } catch (\Exception $e) {
      return '{ "success": false, "reason": "SQL Error!", "message": '.json_encode($e->getMessage()).' }';
    }

    return generatereceipt($user, $for);

  }


}
