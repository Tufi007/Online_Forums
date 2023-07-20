<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Answer;

class CommentController extends Controller
{
    public function submitComment(Request $request)
    {
        $validatedData = $request->validate([
            'answer_id' => 'required|exists:answers,a_id',
            'question_id' => 'required|exists:questions,q_id',
            'comment_text' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->comment_text = $validatedData['comment_text'];
        $comment->user_id = Auth::id();
        $comment->q_id = $validatedData['question_id'];
        $comment->a_id = $validatedData['answer_id'];
        $comment->save();

        return redirect()->back()->with('success', 'Comment submitted successfully');
    }

    public function getComments($answerId)
    {
        $comments = Comment::where('a_id', $answerId)->get();

        return view('comments', compact('comments'));
    }

}
