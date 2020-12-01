<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tweets = Tweet::orderBy('created_at', 'desc')->take(10)->get();
        /*
        dd($tweets);
        $tweet = Tweet::find(1);
        dd($tweet->likes->count());*/
        return view('home', compact('tweets'));
    }

    public function profile()
    {
        $tweets = Tweet::Where('user_id',\Auth::id())->orderBy('created_at', 'desc')->take(10)->get();
       // dd($tweets);
        return view('profile', compact('tweets'));
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

        $tweet = new Tweet();
        $tweet->tweet_text = $data['tweet_text'];
        $tweet->user_id = $userId;
        $tweet->save();
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
}
