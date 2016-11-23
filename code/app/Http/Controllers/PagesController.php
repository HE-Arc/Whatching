<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Pour pouvoir utiliser les méthodes de Auth
use App\Http\Requests;

class PagesController extends Controller
{

  /**
  * Show the homepage with sign in or redirect to user's feed
  *
  */
  public function home()
  {
    if(Auth::id() != null) return app('App\Http\Controllers\UsersController')->feed();
    return view('pages.home');
  }


  /**
  * Info about the concept and how to use page
  *
  */
  public function about()
  {
    return view('pages.about');
  }

}
