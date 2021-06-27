<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required|email',
                'name'     => 'required|min:3',
                'password' => 'required|min:6',
            ]
        );

        $user = User::create(
            [
                'email'    => $request->email,
                'name'     => $request->name,
                'password' => $request->password,
            ]
        );

        return response()->json($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ]
        );


//        if (!Auth::attempt($credentials)) {
//            return response()->json(
//                [
//                    'errors' => 'Invalid credentials',
//                ],
//                422
//            );
//        }

//        :D

        $user = User::where('email', $request->email)->first();

        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json(
            [
                'access_token' => $authToken,
            ]
        );
    }
}
