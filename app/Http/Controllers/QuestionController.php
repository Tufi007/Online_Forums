<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function showGlobalQuestions()
{
    $questions = Question::all(); // Retrieve all questions from the database
    return view('global_questions', compact('questions'));
}



}
