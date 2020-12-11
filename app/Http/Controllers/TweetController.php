<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Subscribe;
use App\Models\Hashtag;
class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tweets = Tweet::orderBy('created_at', 'desc')->take(100)->get();
        /*
        dd($tweets);
        $tweet = Tweet::find(1);
        dd($tweet->likes->count());*/
        return view('home', compact('tweets'));
    }

    public function zz()
    {
        $string = "this has a #hashtag a #lflfl-ssy #badhash-tag and a #goodhash_tag";
        $hashtags= FALSE;  
        preg_match_all("/(#\w+)/u", $string, $matches);  
        if ($matches) {
            $hashtagsArray = array_count_values($matches[0]);
            $hashtags = array_keys($hashtagsArray);
        }
        dd($hashtags);
    }


    public function profile()
    {
        $userId = \Auth::id();
        $tweets = Tweet::Where('user_id',$userId)->orderBy('created_at', 'desc')->take(100)->get();
        $subscriptions = Subscribe::where('user_id', $userId)->count();
        $subscribers = Subscribe::where('id_follow', $userId)->count();
        $countTweets = Tweet::where('user_id', $userId)->count();
        return view('profile', compact('tweets', 'subscriptions', 'subscribers', 'countTweets'));
    }

    public function getUser($userId)
    {
        $tweets = Tweet::Where('user_id',$userId)->orderBy('created_at', 'desc')->take(100)->get();
        $subscriptions = Subscribe::where('user_id', $userId)->count();
        $subscribers = Subscribe::where('id_follow', $userId)->count();
        $countTweets = Tweet::where('user_id', $userId)->count();
       // dd($tweets);
       return view('profile', compact('tweets', 'subscriptions', 'subscribers', 'countTweets'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = \Auth::id();
        $data = $request->all();

        $request->validate([
            'tweet_text' => ['required', 'string']
        ]);
        $hashtags = $this->getHashtags($data['tweet_text']);
        $data['tweet_text'] = str_replace('#', '', $data['tweet_text']);
        $tweet = new Tweet();
        $tweet->tweet_text = $data['tweet_text'];
        $tweet->user_id = $userId;
        $tweet->save();
      
        
        if(count($hashtags) != 0){
            
          for ($i=0 ; $i <= count($hashtags) -1 ; $i++) { 
                $hashtag = new Hashtag;
                $hashtag->hashtag = $hashtags[$i];
                $hashtag->tweet_id = $tweet->id;
               // echo $hashtag.'<br>';
                $hashtag->save();
            }
            //dd("END");
        }
        return redirect()->route('home'); 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function retweet($id)
    {
        $tweet = Tweet::find($id);
        if($tweet == null){
            return redirect()->route('home');  
        }
        $userId = \Auth::id();
        $MyTweet = new Tweet();
        $MyTweet->tweet_text = $tweet->tweet_text;
        $MyTweet->user_id = $userId;
        $MyTweet->tweet_owner = $tweet->user->id.'|'.$tweet->user->name;
        //dd($MyTweet);
        $MyTweet->save();
        return redirect()->route('home'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function getHashtags($string) {  
        $hashtags= FALSE;  
        preg_match_all("/(#\w+)/u", $string, $matches);  
        if ($matches) {
            $hashtagsArray = array_count_values($matches[0]);
            $hashtags = array_keys($hashtagsArray);
        }
        return $hashtags;
    }
}
