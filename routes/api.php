<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CorsMiddleware;

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::post("/register", [UserController::class, 'store']);
});

Route::get('/', function () {
    return response()->json([
        "message" => "Good",
        "data" => "Big data"
    ], 200);
});

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->get("/authenticate", [LoginController::class, "authenticate"]);
