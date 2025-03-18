<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function store(Request $request)
    {
        Log::info("Hello");
        Log::info($request);
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|',
            'password' => 'required|string|min:8',
        ]);
        Log::info("Hello");

        $user = User::create([
            'name' => $request["username"],
            'email' => $request["email"],
            'password' => Hash::make($request["password"]),
        ]);
        Log::info($user);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        Log::info("Hello 1");
        Log::info($request->all());
        $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);
        Log::info("Hello 2");

        Log::info($request["email"]);
        $user = User::where('email', $request["email"])->first();
        Log::info($user);
        if($user && Hash::check($request["password"], $user->password)){
            return response()->json("OK", 200);
        }else{
            return response()->json("Unauthorized", 401);
        }
    }
}
