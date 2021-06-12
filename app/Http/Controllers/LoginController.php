<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('JacreatorLen')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['message' => 'UnAuthorized'], 401);
        }
    }

    public function detial(){
        return response()->json(['user'=>$token], 200);
    }
}
