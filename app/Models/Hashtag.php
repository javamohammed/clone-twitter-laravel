<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    public  function tweet()
    {
        return $this->belongsTo('App\Models\Tweet', 'tweet_id');
    }
    public static function tendance()
    {

        return  \DB::table('hashtags')
        ->select('hashtag', \DB::raw('count(*) as cnt'))
        ->groupBy('hashtag')
        ->orderBy('cnt', 'DESC')
        ->limit(3)
        ->get();
    }


}
