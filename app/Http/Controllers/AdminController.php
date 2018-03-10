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
    $prefix = env('DB_VIEW_PREFIX', '');

    $path = explode('/', $request->path());
    $id = $path[count($path) - 2];

    $user = DB::select('select * from '.$prefix.'enduser where id=\''.$id.'\'')[0];

    $events_list = DB::select('select * from '.$prefix.'events_list');
    $workshops_list = DB::select('select * from '.$prefix.'workshops_list');

    $msg = 'Hi,%0AThank you for registering at MindKraft 2018.%0A%0A';

    $msg .= 'Your Name: '.$user->name.'%0A';
    $msg .= 'Your Registered Mobile Number: '.$user->mobile.'%0A%0A';
    $msg .= 'Registered Events - %0A';

    // Populate Events
    foreach ($events_list as $event) {
      $users = DB::select('select * from mindkraft18_event_registration where id=\'event-'.$event->id.'\'');
      if (count($users) == 1) {
        $users = $users[0]->registered_users;
      }
      else {
        continue;
      }
      if (in_array($id, explode(':', $users))) {
        $msg .= $event->name . '%0A';
      }
    }

    $msg .= '%0A';

    // Populate Workshops
    foreach ($workshops_list as $workshop) {
      $users = DB::select('select * from mindkraft18_event_registration where id=\'workshop-'.$workshop->id.'\'');
      if (count($users) == 1) {
        $users = $users[0]->registered_users;
      }
      else {
        continue;
      }
      if (in_array($id, explode(':', $users))) {
        $msg .= $workshop->name . '%0A';
      }
    }

    $msg .= '%0A%0A';

    $msg .= 'With Regards,%0AMindKraft Organizing Committee';

    $request = "";
    $param['method'] = "sendMessage";
    $param['send_to'] = $user->mobile;
    $param['msg'] = $msg;
    $param['userid'] = "2000162130";
    $param['password'] = "SkyLAwn";
    $param['v'] = "1.1";
    $param['msg_type'] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
    $param['auth_scheme'] = "PLAIN";
    //Have to URL encode the values
    foreach($param as $key => $val) {
    $request .= $key . "=" . $val;
    //we have to urlencode the values
    $request .= "&";
    //append the ampersand (&) sign after each parameter/value pair
    }
    $request = substr($request, 0, strlen($request)-1);
    //remove final (&) sign from the request
    $url = "http://enterprise.smsgupshup.com/GatewayAPI/rest?" . $request;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);
    echo $request . '<br>' . $curl_scraped_page;
  }


}
