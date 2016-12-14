<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    public function collections(){
      return $this->belongsToMany(Collection::class);
    }

    public function notes(){
      return $this->hasMany(Note::class)->orderBy('created_at', 'desc');
    }

    public function suggestions(){
      return $this->belongsToMany(Suggestion::class);
    }
    public function users(){
        return $this->belongsToMany(User::class, 'collections');
    }

}
