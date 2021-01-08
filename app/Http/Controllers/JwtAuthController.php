<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
class JwtAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            /*
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);*/
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
}
