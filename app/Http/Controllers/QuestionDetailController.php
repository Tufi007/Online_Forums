<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Vote;

use Illuminate\Http\Request;

class QuestionDetailController extends Controller
{
    public function showQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $answers = $question->answers;

        $questionVotes = Vote::where('votable_type', Question::class)
            ->where('votable_id', $questionId)
            ->get();
        $answerVotes = Vote::where('votable_type', Answer::class)
            ->whereIn('votable_id', $answers->pluck('a_id'))
            ->get();

        return view('questions.question_detail', compact('question', 'answers', 'questionVotes', 'answerVotes'));
    }
}
