<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{

  /*
  |--------------------------------------------------------------------------
  | Authentication Functions
  |--------------------------------------------------------------------------
  */

  public function userAuthLogin(Request $request)
  {
    return "true";
  }

  public function userAuthRegister(Request $request)
  {
    return "true";
  }

  public function userAuthRegisterKarunya(Request $request)
  {
    return "true";
  }

  public function userAuthAuthenticate(Request $request)
  {
    return "true";
  }
}
