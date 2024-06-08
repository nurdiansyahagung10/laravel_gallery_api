<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function signin(Request $request){
        $login = $request->username;
        $password = $request->password;

        $field  = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';


        if(Auth::attempt([$field => $login, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('gallery-token')->plainTextToken;
            return response()->json(['token' => $token,'userid' => $user->userid, 'message' => 'berhasil'], 200);
        }

        return response()->json(['message' => 'username or password incorret'], 401);
    }
}
