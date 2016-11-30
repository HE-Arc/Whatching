<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{

    public function state(){
      return $this->hasOne(State::class);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function film(){
      return $this->belongsTo(Film::class);
    }

    public function source(){
      return $this->belongsTo(User::class, 'source_id');
    }

    protected $fillable = ['user_id', 'film_id', 'state_id', 'source_id'];
}
