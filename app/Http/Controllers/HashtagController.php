<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hashtag;

class HashtagController extends Controller
{
    //
    public function index($hashtag){
            $tweets = \DB::table('tweets')
                    ->join('users', 'users.id', '=', 'tweets.user_id')
                    ->join('hashtags', function ($join) use (&$hashtag) {
                        $join->on('tweets.id', '=', 'hashtags.tweet_id')
                            ->where('hashtags.hashtag', '=', '#'.$hashtag);
                    })
                ->get();
               // dd($tweets);
            return view('hashtags', compact('tweets'));
    }
}
