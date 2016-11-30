<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Response;
use App\Film;
use App\Suggestion;
use App\User;

class FilmsController extends Controller
{

  /**
  * A simple film info page with user reviews
  *
  */
  public function film($id){

    // TODO: Some users just to test, need to be correctly filtered !!
    $user = Auth::user();

    $film = Film::where('filmTMDB_id', $id)->first();
    return view('films.film', compact('id', 'film', 'user'));
  }


  /**
  * Search a movie
  *
  */
  public function search($query){
    //return view('users.search', compact('query'));
    $films = Film::where('name', 'like', $query.'%')->get();
    $autocompletableList = array();
    foreach($films as $flm){
      array_push($autocompletableList, ["id" => $flm->id, "label" => $flm->name]);
    }
    return $autocompletableList;
  }

  /**
  * Page for film suggestion
  *
  */
  public function suggestFilm(){
    return view('films.suggestFilm');
  }

  public function addToDB(Request $req){
    if($req->isMethod('post')){
      $tmdbId = $req->input('tmdbId');
      $name = $req->input('name');
      $res = Film::where('filmTMDB_id', $tmdbId)->count();
      if($res == 0){
        Film::insert([
          "filmTMDB_id" => $tmdbId,
          "name" => $name
        ]);
      }
    }

  }


/**
* Suggest a movie to a (real) friend
*
*/
public function suggestToFriend(Request $request){

  // Insert all suggestions
  foreach($request->user_ids as $targetID){
    Suggestion::insert([
      "user_id" => $targetID,
      "film_id" => $request->film_id,
      "state_id" => $request->state_id,
      "source_id" => $request->source_id
    ]);
  }

  return Response::json(['message' => 'Successfully added suggestion(s)', 'action' => 'addSugg']);
}


}
