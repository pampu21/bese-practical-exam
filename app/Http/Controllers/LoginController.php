<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $creds = User::where('email',request('email'))->first();
        if(!empty($creds) && Hash::check(request('password'),$creds->password)){
            $token = $creds->createToken('AuthToken')->accessToken;
            return response()->json(['user' => $creds,'token' => $token],201);
        }

        return response()->json(['message' => 'Invalid credentials'],401);
    }
}
