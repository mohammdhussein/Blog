<?php

use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    Mail::to('mohammd.hussein04@gmail.com')->send(new JobPosted());
    return 'Mail sent';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');




