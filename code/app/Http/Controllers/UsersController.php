<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Pour pouvoir utiliser les méthodes de Auth

use Response;

use App\Http\Requests;
use App\User;
use App\Note;
use App\Film;
use App\Suggestion;

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
      $alreadySubscribed = DB::table('subscriptions')->where('follower_id', Auth::user()->id)->where('followed_id', $id)->first();
      $canSub = ($alreadySubscribed == null ? true : false);
      return view('users.profile', compact('id', 'canSub'));
    }

    /**
    * The very very important feed for a user
    *
    */
    public function feed(){
      $user = Auth::user();
      $feed = array();
      // BIG POO ('cause we are polite') INCOMING

      // Get suggestion given by followed people
      $suggestBy = Suggestion::join('subscriptions', 'suggestions.source_id', '=', 'subscriptions.followed_id')
      ->join('users', 'suggestions.source_id', '=', 'users.id')
      ->join('films', 'suggestions.film_id', '=', 'films.id')
      ->join('users as user_to', 'suggestions.user_id', '=', 'user_to.id')
      ->where('subscriptions.follower_id', '=', Auth::id())
      ->select('suggestions.user_id as target_id', 'user_to.name as target_name', 'films.id as film_id', 'films.name as film_name', 'suggestions.source_id','users.name as source_name', 'suggestions.created_at')
      ->get();
      //dd($suggestBy[0]['source_id']);
      foreach($suggestBy as $suggest){
        array_push($feed, [$suggest['created_at']->format('d-m-Y H:i:s') ,0,$suggest]);
      }

      //Notes données par des gens qu'on follow
      $notesBy = Note::join('subscriptions', 'notes.user_id', '=', 'subscriptions.followed_id')
      ->join('users', 'notes.user_id', '=', 'users.id')
      ->join('films', 'notes.film_id', '=', 'films.id')
      ->where('subscriptions.follower_id', '=', Auth::id())
      ->select('users.id as user_id', 'users.name as user_name', 'notes.stars', 'notes.comment', 'films.id as film_id', 'films.name as films_name', 'notes.created_at as created_at')
      ->get();
      foreach($notesBy as $note){
        array_push($feed, [$note['created_at']->format('d-m-Y H:i:s'),0,$note]);
      }
      uasort($feed, array('App\Http\Controllers\UsersController', 'date_compare'));
      return view('users.feed', compact('user', 'feed'));
    }

    public function date_compare($a, $b)
    {
        if(strtotime($a[0]) == strtotime($b[0])){
          return 0;
        }
        return (strtotime($a[0]) < strtotime($b[0])) ? 1 : -1;
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
      // A mettre dans un model peut-être.
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


    /**
    * Subscription routine
    *
    */
    public function subscribeToggle(Request $request){
      // Add users entry to sbscriptions
      if(DB::table('subscriptions')->where('follower_id', Auth::user()->id)->where('followed_id', $request->followed_id)->first() == null){
        DB::table('subscriptions')->insert(
          ['follower_id' => $request->follower_id, 'followed_id' => $request->followed_id]
        );
        return Response::json(['message' => 'Successfully subscribed', 'action' => 'sub']);
      }else{
        DB::table('subscriptions')->where('follower_id', $request->follower_id)->where('followed_id', $request->followed_id)->delete();
        return Response::json(['message' => 'Successfully unsubscribed', 'action' => 'unsub']);
      }

    }



}
