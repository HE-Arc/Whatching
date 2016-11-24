<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function follower(){
      return $this->belongsTo(User::class, 'follower_id');
    }

    public function followed(){
      return $this->belongsTo(User::class, 'followed_id');
    }
}
