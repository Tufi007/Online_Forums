<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AskController extends Controller
{
    public function showForm()
    {
        $subjects = Subject::all();
        return view('questions.ask_form', compact('subjects'));
    }

    public function submitQuestion(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'subject_id' => 'required',
        ]);

        // Get the currently logged in user's ID
        $userId = Auth::id();

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $images[] = 'images/' . $imageName;
            }
        }

        $question = new Question();
        $question->user_id = $userId;
        $question->title = $request->input('title');
        $question->description = $request->input('description');
        if (!empty($images)) {
            $question->image = json_encode($images);
        } else {
            $question->image = null;
        }
        $question->date_time = now();
        $question->s_id = $request->input('subject_id');
        if ($question->save()) {
            // Question saved successfully
            return redirect()->route('ask_form')->with('success', 'Question submitted successfully!');
        } else {
            // Error in saving the question
            $errorMessage = 'Failed to submit the question. Please try again.';
            Session::flash('error', $errorMessage);
            return redirect()->route('ask_form')->with('error', $errorMessage);
        }
    }
}
