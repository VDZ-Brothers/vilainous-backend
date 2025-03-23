<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController
{
    public function authenticate(Request $request)
    {
        return response()->json([
            'message' => "Valid Token",
            'user' => Auth::user()
        ], 200);
    }
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where('email', $request["email"])->first();

        if ($user && Hash::check($request["password"], $user->password)) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json($token, 200);
        }
        return response()->json("Unauthorized", 401);
    }

    public function logout(Request $request)
    {
        if(!$request->user()){
            return response()->json([
                'message' => "No User found",
            ], 404);
        }
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Déconnexion réussie'
        ], 200);
    }
}
