<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; //Pour pouvoir utiliser les méthodes de Auth

use Illuminate\Foundation\Inspiring;

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
      $user = User::find($id);
      if($user == null) $user = Auth::user();
      $alreadySubscribed = DB::table('subscriptions')->where('follower_id', Auth::user()->id)->where('followed_id', $id)->first();
      $canSub = ($alreadySubscribed == null ? true : false);
      $quote = Inspiring::quote();
      return view('users.profile', compact('user', 'quote', 'id', 'canSub'));
    }

    public function suggestions(){
      $user = Auth::user();
      $pendingSuggestions = Suggestion::with('source', 'film', 'user')
      ->where('suggestions.user_id', Auth::id())
      ->where('suggestions.state_id', 1)->select('*')->get();

      $acceptedSuggestions = Suggestion::with('source', 'film', 'user')
      ->where('suggestions.user_id', Auth::id())
      ->where('suggestions.state_id', 2)->select('*')->get();

      return view('users.suggestions', compact('user', 'pendingSuggestions', 'acceptedSuggestions'));
    }

    /**
    * The very very important feed for a user
    *
    */
    public function feed(){
      $user = Auth::user();
      $feed = [];

      // Get suggestion given by followed people
      $suggestBy = Suggestion::with('source', 'film', 'user')
      ->join('subscriptions', 'source_id', '=', 'followed_id')
      ->where('followed_id', Auth::id())->select('*', 'suggestions.created_at as date')->get();
      foreach($suggestBy as $suggest){
        array_push($feed, [$suggest['date'],0,$suggest]);
      }

      // Get notes given by followed people
      $notesBy = Note::with('user', 'film')
      ->join('subscriptions', 'notes.user_id', '=', 'followed_id')
      ->where('follower_id', '=', Auth::id())->select('*', 'notes.created_at as date')->get();
      foreach($notesBy as $note){
        array_push($feed, [$note['date'],1,$note]);
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


    public function usersList(){
      $users = User::all();
      return view('users.list', compact('users'));
    }

    /**
    * Search for users
    *
    */
    public function search($query){
      //return view('users.search', compact('query'));
      $users = User::where('name', 'like', $query.'%')->get();
      $autocompletableList = array();
      foreach($users as $usr){
        array_push($autocompletableList, ["id" => $usr->id, "label" => "@".$usr->name]);
      }
      return $autocompletableList;
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
        $reponse = Response::json(['message' => 'Successfully subscribed', 'action' => 'sub']);
      }else{
        DB::table('subscriptions')->where('follower_id', $request->follower_id)->where('followed_id', $request->followed_id)->delete();
        $reponse =  Response::json(['message' => 'Successfully unsubscribed', 'action' => 'unsub']);
      }
      if(!isset($request->nojs)){
        return $reponse;
      }else{
        if(!isset($request->userlist)){
          return redirect()->route('userProfile', ['id' => $request->followed_id]);
        }else{
          return redirect()->route('usersList');
        }

      }


    }



}
