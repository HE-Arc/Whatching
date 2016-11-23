<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function suggestion(){
      return $this->belongsToMany(Suggestion::class);
    }
}
