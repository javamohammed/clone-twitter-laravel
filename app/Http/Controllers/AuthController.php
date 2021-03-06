<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

class AuthController extends Controller
{
    public function getVerifyEmail()
    {
        return view('auth.verify-email');
    }

    public function verificationNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    public function postVerifyEmail(Request $request)
    {
        if (! hash_equals((string) $request->route('id'),
                      (string) $request->user()->getKey())) {
        abort(403);
        }

        if (! hash_equals((string) $request->route('hash'),
                        sha1($request->user()->getEmailForVerification()))) {
            abort(403);
        }

        $request->user()->markEmailAsVerified();

        event(new Verified($request->user()));

        return redirect('/home');
    }

    public function loadedUsers($str){
        $users = User::where('email', $str)->orWhere('email', 'like', '%' . trim($str). '%')
                        ->orWhere('name', 'like', '%' . trim($str). '%')
                        ->get();
        $json = [];
        if($str != "" ){
            foreach($users as $user)
            {
                $json[$user->id] = $user->name.'['.$user->email.']';
            }
        }
        
        return response()->json($json);
    }

}
