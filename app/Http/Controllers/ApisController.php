<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;


class ApisController extends Controller
{

    public function users(){
        return UserResource::collection(User::paginate(5)); 
    }

    public function user(User $user)
    {
        return new UserResource($user);
    }

    public function getSelfInfos(Request $request)
    {

        return response()->json(auth()->user());
    }
    
    public function test()
    {        
        return "test";
    }
}
