<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = \Auth::id();
        $lists = Group::Where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        //$user = User::find(2);
        //$countMembers = $user->groups->count();
        //dd($countMembers);
        return view('lists', compact('lists'));
    }

    public function listsOn()
    {
        $userId = \Auth::id();
        $user = User::find($userId);
        $lists = $user->groups()->get();
        /*
        foreach($lists as $list) {
            dd($list);
        }
        dd("");*/
        return view('lists', compact('lists'));
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
            'name_group' => ['required', 'string']
        ]);
        $group = new Group;
        $group->name_group = $data['name_group'];
        $group->user_id = $userId;
        $group->save();

        return redirect()->route('lists.index'); 

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
