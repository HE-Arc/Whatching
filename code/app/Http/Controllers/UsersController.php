<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{

    /**
    * Show overview infos of a user's profile
    *
    */
    public function profile($id){
      return view('users.profile', compact('id'));
    }

    /**
    * The very very important feed for a user
    *
    */
    public function feed(){
      return view('users.feed');
    }

    /**
    * Detailed logs and stats of a user
    *
    */
    public function statistics($id){
      return view('users.statistics', compact('id'));
    }

    /**
    * A list of viewed films and reviews for user
    *
    */
    public function watchedFilms($id){
      return view('users.watchedFilms', compact('id'));
    }

}
