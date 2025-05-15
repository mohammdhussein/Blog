<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    Mail::to('mohammd.hussein04@gmail.com')->send(new JobPosted());
    return 'Mail sent';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');




