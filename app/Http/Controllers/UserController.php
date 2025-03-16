<?php

namespace App\Http\Controllers;

use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

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
            'password' => $request["password"],
        ]);
        Log::info($user);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        Log::info("Hello Login");
        Log::info($request->all());
    }
}
