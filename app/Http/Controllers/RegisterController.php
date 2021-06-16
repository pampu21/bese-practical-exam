<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRegistration;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Registration;

class RegisterController extends Controller
{
    public function register(RequestRegistration $request)
    {
        $data = User::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        // Mail::to($data->email)->queue(new Registration($data));

        return response()->json(['msg' => 'User successfully registered' , 'data' => $data],201);
    }

}
