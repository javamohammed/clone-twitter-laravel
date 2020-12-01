<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Tweet;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tweet_id)
    {
        //
        $tweet = Tweet::where('id', '=',$tweet_id)->first();
        $comments = Comment::where('tweet_id', '=', $tweet_id)->orderBy('created_at','desc')->get();
        return view('comments', compact('comments', 'tweet'));
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
    public function store(Request $request, $tweet_id, $redirect_to)
    {
        $userId = \Auth::id();
        $data = $request->all();
        if($data['comment_text'] == '' || $tweet_id == ''){
            return redirect()->route('home');
        }
        $comment = new Comment();
        $comment->comment_text = $data['comment_text'];
        $comment->user_id = $userId;
        $comment->tweet_id = $tweet_id;
        $comment->save();
        if($redirect_to == 'cmt'){
            return redirect()->route('show_comments',['tweet_id' => $tweet_id]); 
        }
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
