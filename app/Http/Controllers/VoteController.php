<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Notification;

class VoteController extends Controller
{
    public function upvoteQuestion(Request $request, $questionId)
    {
        // Validate the request data
        // Check if the provided question ID exists in the database
        $question = Question::where('id', $questionId)->first();
        if (!$question) {
            throw new \InvalidArgumentException('Invalid question ID.');
        }

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Check if the user has already upvoted the question
        if (Vote::where('user_id', $userId)
            ->where('votable_id', $questionId)
            ->where('votable_type', Question::class)
            ->where('vote', 1)
            ->exists()
        ) {
            throw ValidationException::withMessages([
                'question_id' => 'You have already upvoted this question.',
            ]);
        }

        // Check if the user has already downvoted the question
        $downvote = Vote::where('user_id', $userId)
            ->where('votable_id', $questionId)
            ->where('votable_type', Question::class)
            ->where('vote', 0)
            ->first();

        if ($downvote) {
            // Remove the existing downvote entry
            $downvote->delete();
        }

        // Create a new upvote entry in the Votes table
        $vote = new Vote();
        $vote->user_id = $userId;
        $vote->votable_id = $questionId;
        $vote->votable_type = Question::class;
        $vote->vote = 1; // 1 for upvote, 0 for downvote
        $vote->save();


        // Create a notification for the question owner
        $notification = new Notification();
        $notification->user_id = $question->user_id; // Question owner's user ID
        $notification->sender_id = $userId;
        $notification->notifiable_id = $questionId;
        $notification->notifiable_type = Question::class;
        $notification->data = Auth::user()->name . ' upvoted your question: "' . $question->title . '"';
        $notification->save();


        return response()->json([
            'message' => 'Question upvoted successfully',
        ]);
    }


    public function downvoteQuestion(Request $request, $questionId)
    {
        // Validate the request data
        $question = Question::where('id', $questionId)->first();
        if (!$question) {
            throw new \InvalidArgumentException('Invalid question ID.');
        }

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Check if the user has already downvoted the question
        if (Vote::where('user_id', $userId)
            ->where('votable_id', $questionId)
            ->where('votable_type', Question::class)
            ->where('vote', 0)
            ->exists()
        ) {
            throw ValidationException::withMessages([
                'question_id' => 'You have already downvoted this question.',
            ]);
        }

        // Check if the user has already upvoted the question
        $upvote = Vote::where('user_id', $userId)
            ->where('votable_id', $questionId)
            ->where('votable_type', Question::class)
            ->where('vote', 1)
            ->first();

        if ($upvote) {
            // Remove the existing upvote entry
            $upvote->delete();
        }

        // Create a new downvote entry in the Votes table
        $vote = new Vote();
        $vote->user_id = $userId;
        $vote->votable_id = $questionId;
        $vote->votable_type = Question::class;
        $vote->vote = 0; // 0 for downvote
        $vote->save();

        // Create a notification for the question owner
        $notification = new Notification();
        $notification->user_id = $question->user_id; // Question owner's user ID
        $notification->sender_id = $userId;
        $notification->notifiable_id = $questionId;
        $notification->notifiable_type = Question::class;
        $notification->data = Auth::user()->name . ' downvoted your question: "' . $question->title . '"';
        $notification->save();

        return response()->json([
            'message' => 'Question downvoted successfully',
        ]);
    }

    public function upvoteAnswer(Request $request, $answerId)
    {
        // Validate the request data if needed
        $answer = Answer::where('id', $answerId)->first();
        $question = Question::where('id', $answer->q_id)->first();
        if (!$answer) {
            throw new \InvalidArgumentException('Invalid Answer ID.');
        }

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Check if the user has already upvoted the answer
        if (Vote::where('user_id', $userId)
            ->where('votable_type', Answer::class)
            ->where('votable_id', $answerId)
            ->where('vote', 1)
            ->exists()
        ) {
            throw ValidationException::withMessages([
                'answer_id' => 'You have already upvoted this answer.',
            ]);
        }

        // Check if the user has already downvoted the answer
        $downvote = Vote::where('user_id', $userId)
            ->where('votable_type', Answer::class)
            ->where('votable_id', $answerId)
            ->where('vote', 0)
            ->first();

        if ($downvote) {
            // Remove the existing downvote entry
            $downvote->delete();
        }

        // Create a new upvote entry in the Votes table
        $vote = new Vote();
        $vote->user_id = $userId;
        $vote->votable_id = $answerId;
        $vote->votable_type = Answer::class;
        $vote->vote = 1; // 1 for upvote, 0 for downvote
        $vote->save();

        // Create a notification for the answer owner
        $notification = new Notification();
        $notification->user_id = $answer->user_id; // Answer owner's user ID
        $notification->sender_id = $userId;
        $notification->notifiable_id = $question->id;
        $notification->notifiable_type = Answer::class;
        $notification->data = Auth::user()->name . ' upvoted your answer.';
        $notification->save();

        // Return the success response if needed
        return response()->json([
            'message' => 'Answer upvoted successfully',
        ]);
    }

    public function downvoteAnswer(Request $request, $answerId)
    {
        // Validate the request data if needed
        $answer = Answer::where('id', $answerId)->first();
        $question = Question::where('id', $answer->q_id)->first();
        if (!$answer) {
            throw new \InvalidArgumentException('Invalid Answer ID.');
        }

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Check if the user has already downvoted the answer
        if (Vote::where('user_id', $userId)
            ->where('votable_type', Answer::class)
            ->where('votable_id', $answerId)
            ->where('vote', 0)
            ->exists()
        ) {
            throw ValidationException::withMessages([
                'answer_id' => 'You have already downvoted this answer.',
            ]);
        }

        // Check if the user has already upvoted the answer
        $upvote = Vote::where('user_id', $userId)
            ->where('votable_type', Answer::class)
            ->where('votable_id', $answerId)
            ->where('vote', 1)
            ->first();

        if ($upvote) {
            // Remove the existing upvote entry
            $upvote->delete();
        }

        // Create a new downvote entry in the Votes table
        $vote = new Vote();
        $vote->user_id = $userId;
        $vote->votable_id = $answerId;
        $vote->votable_type = Answer::class;
        $vote->vote = 0; // 1 for upvote, 0 for downvote
        $vote->save();


        // Create a notification for the answer owner
        $notification = new Notification();
        $notification->user_id = $answer->user_id; // Answer owner's user ID
        $notification->sender_id = $userId;
        $notification->notifiable_id = $question->id;
        $notification->notifiable_type = Answer::class;
        $notification->data = Auth::user()->name . ' downvoted your answer.';
        $notification->save();

        // Return the success response if needed
        return response()->json([
            'message' => 'Answer downvoted successfully',
        ]);
    }
}
