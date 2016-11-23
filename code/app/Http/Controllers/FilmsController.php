<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FilmsController extends Controller
{

  /**
  * A simple film info page with user reviews
  *
  */
  public function film($id){
    return view('films.film', compact('id'));
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

}
