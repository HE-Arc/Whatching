<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public function collections(){
      return $this->belongsToMany(Collection::class);
    }

    public function notes(){
      return $this->belongsToMany(Note::class);
    }

    public function suggestions(){
      return $this->belongsToMany(Suggestion::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'collections');
    }

}
