<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notes(){
      return $this->hasMany(Note::class);
    }

    public function preferences(){
      return $this->hasMany(Preference::class);
    }

    public function collections(){
      return $this->hasMany(Collection::class);
    }

    public function suggestions(){
      return $this->hasMany(Suggestion::class);
    }

    public function pendingSuggestions(){
      return $this->hasMany(Suggestion::class)->where('state_id', '=', 1);
    }

    public function acceptedSuggestions(){
      return $this->hasMany(Suggestion::class)->where('state_id', '=', 2);
    }

    public function followedUsers(){
      return $this->belongsToMany(User::Class, 'subscriptions', 'follower_id', 'followed_id');
    }

    public function followingUsers(){
      return $this->belongsToMany(User::class, 'subscriptions', 'follower_id', 'follower_id');
    }

    public function films(){
      return $this->belongsToMany(Film::class, 'collections');
    }
}
