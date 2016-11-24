<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Film;

use App\User;

class FilmsController extends Controller
{

  /**
  * A simple film info page with user reviews
  *
  */
  public function film($id){
    $film = Film::where('filmTMDB_id', $id)->first();
    return view('films.film', compact('id', 'film'));
  }


  /**
  * Search a movie
  *
  */
  public function search($query){
    return view('films.search', compact('query'));
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

}
