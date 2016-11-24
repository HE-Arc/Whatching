<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Pour pouvoir utiliser les méthodes de Auth

use App\Http\Requests;
use App\User;
use App\Note;
use App\Film;
class UsersController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }
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
      $user = Auth::user();
      return view('users.feed', compact('user'));
    }

    /**
    * Detailed logs and stats of a user
    *
    */
    public function statistics($id){
      $user = User::find($id);
      if($user == null) $user = Auth::user();
      return view('users.statistics', compact('user'));
    }

    /**
    * A list of viewed films and reviews for user
    *
    */
    public function watchedFilms($id){
      $user = User::find($id);
      if($user == null) $user = Auth::user();
      $films = $user->films;
      $filmsNotes = array();
      foreach($films as $film){
        $n = Note::where('user_id', $user->id)->where('film_id', $film->id)->first();
        array_push($filmsNotes, [$film, $n]);
      }
      return view('users.watchedFilms', compact('user', 'filmsNotes'));
    }

    /**
    * Search for users
    *
    */
    public function search($query){
      return view('users.search', compact('query'));
    }

}
