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
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

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


// Route for editing questions, answers and comments
Route::middleware('auth')->group(function () {
    Route::get('/edit_question/{question_id}', [QuestionController::class, 'editQuestion'])->name('edit_question');
    Route::post('/update_question/{q_id}', [QuestionController::class, 'updateQuestion'])->name('update_question');

    Route::get('/edit_answer/{answer_id}', [AnswerController::class, 'editAnswer'])->name('edit_answer');
    Route::post('/update_answer/{answer_id}', [AnswerController::class, 'updateAnswer'])->name('update_answer');

    Route::post('/update_comment/{comment_id}', [CommentController::class, 'updateComment'])->name('update_comment');
});

// Routes to update profile data, user data and change the password
// web.php
Route::middleware('auth')->group(function () {

    // Route to update user data and profile data
    Route::post('/update_user_data', [AuthController::class, 'updateUserData'])->name('update_user_data');
    Route::post('/update_profile_data', [ProfileController::class, 'updateProfile'])->name('update_profile_data');

    // Route to create profile
    Route::post('/create_profile', [ProfileController::class, 'createProfile'])->name('create_profile');

    //Route to change the password
    Route::post('/change_password', [AuthController::class, 'changePassword'])->name('change_password');
    // routes/web.php
    Route::post('/delete_account', [AuthController::class, 'deleteAccount'])->name('delete_account');


});


Route::get('/search-users-page', [ProfileController::class, 'showSearchUsers'])->name('showSearchUsers');

Route::post('/search-users', [ProfileController::class, 'searchUsers'])->name('searchUsers');

Route::get('/view-profile/{id}', [ProfileController::class, 'viewProfile'])->name('viewProfile');

Route::get('/showSearch-questions', [QuestionController::class, 'showSearchQuestions'])->name('showSearch.questions');

Route::get('/search-questions', [QuestionController::class, 'searchQuestions'])->name('questions.search');

Route::middleware('auth')->group(function () {
    Route::post('/admin/make-admin/{user_id}', [AdminController::class, 'makeAdmin'])->name('admin.make.admin');
});




