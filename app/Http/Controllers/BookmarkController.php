<?php

namespace App\Http\Controllers;
use App\Models\Tweet;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = Bookmark::Where('owner_id',\Auth::id())->orderBy('created_at', 'desc')->take(10)->get();
        // dd($bookmarks);
         return view('bookmarks', compact('bookmarks'));
    }

    public function store($tweet_id)
    {
        $tweet = Tweet::find($tweet_id);
        if($tweet == null){
            return redirect()->route('home');  
        }
        $userId = \Auth::id();
        $bookmark = new Bookmark();
        $bookmark->tweet_text = $tweet->tweet_text;
        $bookmark->user_id = $tweet->user->id;
        $bookmark->owner_id = $userId;
        $bookmark->save();
        return redirect()->route('bookmark.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $data = $request->all();
        $bookmark = Bookmark::find($data['id']);
        $bookmark->delete();
        return $data['id'];
    }
}
