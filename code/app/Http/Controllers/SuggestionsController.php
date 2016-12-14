<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Suggestion;
use App\Http\Requests;

class SuggestionsController extends Controller
{
  public function acceptSuggestion($id){
    $suggestion = Suggestion::find($id);
    if($suggestion == null || $suggestion->user_id != Auth::id()) return redirect()->back();
    $suggestion->state_id = 2;
    $suggestion->save();
    return redirect()->back();
  }

  public function refuseSuggestion($id){
    $suggestion = Suggestion::find($id);
    if($suggestion == null || $suggestion->user_id != Auth::id()) return redirect()->back();
    $suggestion->state_id = 3;
    $suggestion->save();
    return redirect()->back();
  }
}
