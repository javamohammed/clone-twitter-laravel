<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function hashtags()
    {
        return $this->hasMany('App\Models\Hashtag');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }


    public function  getRetweetUserId()
    {
        $tab = explode('|', $this->tweet_owner);
            return $tab[0];
    }

    public function  getRetweetUserName()
    {
        $tab = explode('|', $this->tweet_owner);
            return $tab[1];
       
    }

    public function createdAt(){
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }


    public static function  getRetweetUserNameStatic($tweet_owner)
    {
        $tab = explode('|', $tweet_owner);
            return $tab[1];
       
    }
    public static function createdAtStatic($created_at){
        return \Carbon\Carbon::parse($created_at)->diffForHumans();
    }
}
