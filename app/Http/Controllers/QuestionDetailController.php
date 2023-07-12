<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Answer;

use Illuminate\Http\Request;

class QuestionDetailController extends Controller
{
    public function showQuestion($questionId)
{
    $question = Question::findOrFail($questionId);
    $answers = $question->answers;

    return view('question_detail', compact('question', 'answers'));
}

}
