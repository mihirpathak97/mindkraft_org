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

    function generatereceipt($user, $for)
    {
      $last = DB::select('select * from mindkraft18_receipt_details');
      $last = $last[count($last) - 1];
      $receipt = $last->number + 1;

      $final = '';

      $i = 0;

      foreach ($for as $item => $fee) {
        $final .= $item . '-' . $fee;
        if (! ++$i === count($for)) {
          $final .= ':';
        }
      }

      DB::insert('insert into mindkraft18_receipt_details values (\''.$receipt.'\', \''.$user->id.'\', \''.$final.'\'');

      $reply = '{ "success": true, "receipt": "'.$receipt.'", for: '.json_encode($for).', "user": "'.$user->id.'" }';

      return $reply;

    }

    $prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());
    $id = $path[count($path) - 2];

    $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];

    // Add user to approved list and payment list
    try {
      DB::statement('insert into mindkraft18_approved_enduser values(\''.$user->id.'\')');
      DB::statement('insert into mindkraft18_payment_info values(\''.$user->id.'\', \'main\')');
    } catch (\Exception $e) {
      return '{ "success": false, "reason": "SQL Error!" }';
    }

    // // Populate and send Message
    //
    // $events_list = DB::select('select * from '.$prefix.'events_list');
    // $workshops_list = DB::select('select * from '.$prefix.'workshops_list');
    //
    // $msg = 'Hi,%0AThank you for registering at MindKraft 2018.%0A%0A';
    //
    // $msg .= 'Your Name: '.$user->name.'%0A%0A';
    // $msg .= 'Registered Events - %0A';
    //
    // // Populate Events
    // foreach ($events_list as $event) {
    //   $users = DB::select('select * from mindkraft18_event_registration where id=\'event-'.$event->id.'\'');
    //   if (count($users) == 1) {
    //     $users = $users[0]->registered_users;
    //   }
    //   else {
    //     continue;
    //   }
    //   if (in_array($id, explode(':', $users))) {
    //     $msg .= $event->name . '%0A';
    //   }
    // }
    //
    // $msg .= '%0ARegistered Workshops - %0A';
    //
    // // Populate Workshops
    // foreach ($workshops_list as $workshop) {
    //   $users = DB::select('select * from mindkraft18_event_registration where id=\'workshop-'.$workshop->id.'\'');
    //   if (count($users) == 1) {
    //     $users = $users[0]->registered_users;
    //   }
    //   else {
    //     continue;
    //   }
    //   if (in_array($id, explode(':', $users))) {
    //     $msg .= $workshop->name . '%0A';
    //   }
    // }
    //
    // $msg .= '%0AWith Regards,%0AMindKraft Organizing Committee';
    //
    // $msg = urlencode($msg);
    // $msg = str_replace('%25', '%', $msg);
    //
    // $request = "";
    // $param['method'] = "sendMessage";
    // $param['send_to'] = $user->mobile;
    // $param['msg'] = $msg;
    // $param['userid'] = "2000162130";
    // $param['password'] = "SkyLAwn";
    // $param['v'] = "1.1";
    // $param['msg_type'] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
    // $param['auth_scheme'] = "PLAIN";
    // //Have to URL encode the values
    // foreach($param as $key => $val) {
    // $request .= $key . "=" . $val;
    // //we have to urlencode the values
    // $request .= "&";
    // //append the ampersand (&) sign after each parameter/value pair
    // }
    // $request = substr($request, 0, strlen($request)-1);
    // //remove final (&) sign from the request
    // $url = "http://enterprise.smsgupshup.com/GatewayAPI/rest?" . $request;
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $curl_scraped_page = curl_exec($ch);
    // curl_close($ch);

    $for = ['main': '300'];
    $workshop_array = explode(':', $request->input('workshops');

    function isInternal($user)
    {
      if ($user->college == 'Karunya Institute of Technology and Sciences, Coimbatore') {
        return true;
      }
      return false;
    }

    foreach ($workshop_array as $workshop) {
      if (strlen($workshop) == 16) {
        if (isInternal($user)) {
          $fee = DB::select('select * from mindkraft18_workshop_details')[0]->fee_internal;
        }
        else {
          $fee = DB::select('select * from mindkraft18_workshop_details')[0]->fee_external;
        }
        array_push($for, 'workshop-'.$workshop, $fee);
      }
    }

    return generatereceipt($user, $for);

  }


  public function makePayment(Request $request)
  {
    var_dump($request->input('workshops'));
  }


}
