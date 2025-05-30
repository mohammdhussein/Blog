<?php

use App\Http\Controllers\v1\ApplicantController;
use App\Http\Controllers\v1\ApplicationController;
use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\JobController;
use App\Http\Controllers\v1\RegisteredUserController;
use App\Http\Controllers\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => '/v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('jobs', JobController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('applicants', ApplicantController::class);
    Route::apiResource('applications', ApplicationController::class);

});

// auth route
Route::post('/login', [AuthController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'destroy']);
