<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AskController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionDetailController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

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


//Routes for answering questions start
Route::middleware('auth')->group(function () {
    Route::get('/answer_form/{question_id}', [AnswerController::class, 'showAnsForm'])->name('answer_form');
    Route::post('/submit_answer', [AnswerController::class, 'submitAnswer'])->name('submit_answer');
});
//Routes for answering questions end

// Routes for questionDetail page start
Route::get('/question/{question_id}', [QuestionDetailController::class, 'showQuestion'])->name('question_detail');

// Routes for questionDetail page end


// Route for global questions page
Route::get('/global_questions', [QuestionController::class, 'showGlobalQuestions'])->name('global_questions');


// Upvote a question
Route::post('/upvote_question/{questionId}', [VoteController::class, 'upvoteQuestion'])
    ->name('upvote_question');

// Downvote a question
Route::post('/downvote_question/{questionId}', [VoteController::class, 'downvoteQuestion'])
    ->name('downvote_question');

// Route to upvote an answer
Route::post('/upvote_answer/{answerId}', [VoteController::class, 'upvoteAnswer']);


// Route to downupvote an answer
Route::post('/downvote_answer/{answerId}', [VoteController::class, 'downvoteAnswer']);


//Routes for comments

Route::post('/submit_comment', [CommentController::class, 'submitComment'])->name('submit_comment');
Route::get('/get_comments/{answerId}', [CommentController::class, 'getComments'])->name('get_comments');


// Route for my profile
Route::middleware('auth')->group(function () {
    Route::get('/my_profile', [ProfileController::class, 'showProfile'])->name('my_profile');
});





