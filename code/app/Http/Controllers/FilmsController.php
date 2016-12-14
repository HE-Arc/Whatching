<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Response;
use App\Film;
use App\Suggestion;
use App\User;
use App\Collection;

class FilmsController extends Controller
{

  /**
  * A simple film info page with user reviews
  *
  */
  public function film($id){

    // TODO: Some users just to test, need to be correctly filtered !!
    $user = Auth::user();
    $film = Film::find($id);
    $isWatched = $user->films()->where('film_id', $id)->exists();
    $personalNote = $user->notes()->where('film_id', $id)->first();
    $followeds = $user->followedUsers;
    $suggestableUsers = [];
    foreach($followeds as $u){
        if(!$u->films()->where('film_id', $id)->exists()){
            array_push($suggestableUsers, $u);
        }
    }
    return view('films.film', compact('film', 'user', 'isWatched', 'personalNote', 'suggestableUsers'));
  }


  /**
  * Search a movie
  *
  */
  public function search($query){
    $films = Film::select('id', 'name as label')->where('name', 'like', $query.'%')->get();
    return $films;
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
    Suggestion::create([
      "user_id" => $targetID,
      "film_id" => $request->film_id,
      "state_id" => $request->state_id,
      "source_id" => $request->source_id
    ]);
  }

  return Response::json(['message' => 'Successfully added suggestion(s)', 'action' => 'addSugg']);
}

public function addNote(Request $request){
    $user = Auth::user();
    $user->notes()->create($request->only('film_id', 'stars', 'comment'));

    return redirect()->route('moviePage', ['id' => $request->film_id]);
}

public function modifyNote(Request $request){
    $user = Auth::user();
    $note = $user->notes()->where('film_id', $request->film_id)->first();
    $note->stars = $request->stars;
    $note->comment = $request->comment;

    $note->save();
    return redirect()->route('moviePage', ['id' => $request->film_id]);
}

public function watched(Request $request){
    $id = $request->film_id;
    $actUser = Auth::user();
    $existent = $actUser->films()->where('film_id', $id)->exists();
    $film = Film::find($id);
    if(!$existent){
        $actUser->films()->attach($film);
    } else {
        $actUser->films()->detach($film);
    }

}


}
