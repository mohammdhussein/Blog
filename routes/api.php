<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => '/v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('jobs', JobController::class);
    Route::apiResource('users', UserController::class);

});

// auth route
Route::post('/login', [AuthController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy']);
