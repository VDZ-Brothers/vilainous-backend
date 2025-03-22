<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request["username"],
            'email' => $request["email"],
            'password' => Hash::make($request["password"]),
        ]);

        return response()->json($user, 201);
    }
}
