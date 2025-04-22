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
        $user = $this->getUserByToken($request->bearerToken());
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
        $user->game_id = $savedGame->id;
        $user->save();
        Log::info("Saved Game : $savedGame");
        return response()->json([
            "gameName" => $gameName,
            "gameId" => $savedGame->id
        ]);
    }

    public function join(Request $request){
        $request->validate([
            'gameName' => 'required'
        ]);
        $user = $this->getUserByToken($request->bearerToken());
        $game = HostedGame::where("name", "=", $request->gameName);
        Log::info("Game : $game");

    }

    private function getUserByToken(string $token){
        if($token){
            return PersonalAccessToken::findToken($token)?->tokenable;
        }
    }
}
