<?php

use App\Http\Controllers\HostingController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CorsMiddleware;

Route::middleware([CorsMiddleware::class])->group(function () {
    Route::post("/register", [UserController::class, 'store']);
});
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/createHostGame', [HostingController::class, 'store']);

Route::post('/joinHostGame', [HostingController::class, 'join']);

Route::middleware('auth:sanctum')->get("/authenticate", [LoginController::class, "authenticate"]);

