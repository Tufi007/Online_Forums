<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\log;

class AnswerController extends Controller
{
    public function showAnsForm($questionId)
    {
        $question = Question::find($questionId);
        return view('answer_form', compact('question'));
    }

    public function submitAnswer(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'answer_text' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'reference_links' => 'nullable|url',
            'q_id' => 'required|exists:questions,q_id',
        ]);

        // Get the currently logged in user's ID
        $userId = Auth::id();

        // Handle the image uploads, if provided
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $images[] = 'images/' . $imageName;
            }
        }


        // Create a new answer instance and fill the data
        $answer = new Answer();
        $answer->user_id = $userId;
        $answer->answer_text = $request->input('answer_text');
        if (!empty($images)) {
            $answer->image = json_encode($images);
        } else {
            $answer->image = NULL;
        }
        $answer->date_time = now();
        $answer->reference_links = $request->input('reference_links');
        $answer->q_id = $request->input('q_id');

        // Save the answer
        if ($answer->save()) {
            Session::flash('success', 'Answer submitted successfully!');
        } else {
            Session::flash('error', 'Failed to submit the answer. Please try again.');
        }
        return redirect()->back();
    }
}
