<?php

namespace App\Http\Controllers;

use App\Models\HostedGame;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class HostingController
{
    public function store(Request $request){
        $user = '';
        $token = $request->bearerToken();
        if($token){
            $user = PersonalAccessToken::findToken($token)?->tokenable;
        }
        $request->validate([
            'gameName' => 'required'
        ]);
        $gameName = $request["gameName"];
        $game = new HostedGame([
            "name" => $gameName,
            "password" => Hash::make($request->get('password')),
            "host_id" => $user->id
        ]);
        Log::info("Storing hosted game with gameName : $gameName and user = $user");
        $game->save();
        $savedGame = HostedGame::where("host_id", "=", $user->id)->firstOrFail();
        Log::info("Saved Game : $savedGame");
        return response()->json([
            "gameName" => $gameName,
            "gameId" => $savedGame->id
        ]);
    }
}
