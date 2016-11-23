<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function user(){
      return $this->belongsTo(User::class);
    }

    public function film(){
      return $this->hasOne(Film::class);
    }
}
