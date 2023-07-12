<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Additional routes for authentication
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Routes for ask questions page start
Route::middleware('auth')->group(function () {
    Route::get('/ask_form', [AskController::class, 'showForm'])->name('ask_form');
    Route::post('/submit_question', [AskController::class, 'submitQuestion'])->name('submit_question');

});
// Routes for ask questions page end



