<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Controller
|--------------------------------------------------------------------------
|
| Author - Mihir Pathak
| Copyright (c) 2017 Z Coders All Rights Reserved
|
| All calls except in auth group must contain a valid 64-digit alphanumeric
| `api_token` (generated when a user registers). `api_token` is unique
| and unchanging.
|
| Invalid `api_token` or improper API calls will return false
|
*/

class APIController extends Controller
{

  /*
  |--------------------------------------------------------------------------
  | Authentication Functions
  |--------------------------------------------------------------------------
  */

  public function userAuthLogin(Request $request)
  {
    /**
     * Accepts a mobile number and password
     * Returns api_token
     */

    return "true";
  }

  public function userAuthRegister(Request $request)
  {
    /**
     * Accetps user registration data
     * Returns "login successful" (until OTP framework is enabled)
     * When OTP framework is enabled, will return a proper message
     */

    return "true";
  }

  public function userAuthRegisterKarunya(Request $request)
  {
    /**
     * Accepts user registration data along with Karunya
     * registration number
     *
     * Return - Same as userAuthRegister
     */

    return "true";
  }

  public function userAuthAuthenticate(Request $request)
  {
    /**
     * Accepts mobile number, password and OTP
     * Returns api_token
     */

    return "true";
  }


  /*
  |--------------------------------------------------------------------------
  | Get Functions
  |--------------------------------------------------------------------------
  |
  | All calls require `api_token`
  | All responses must be in strict JSON format
  |
  */

  public function getEventsList(Request $request)
  {
    /**
     * Returns events list (departments)
     */

    return "true";
  }

  public function getEventsListDepartment(Request $request)
  {
    /**
     * Returns department wise events list
     */

    return "true";
  }

  public function getGamesList(Request $request)
  {
    /**
     * Returns games list
     */

    return "true";
  }

  public function getWorkshopsList(Request $request)
  {
    /**
     * Returns workshops list
     */

    return "true";
  }

}
