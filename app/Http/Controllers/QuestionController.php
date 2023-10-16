<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function showGlobalQuestions()
{
    $questions = Question::all(); // Retrieve all questions from the database
    return view('questions.global_questions', compact('questions'));
}



public function editQuestion($question_id)
{
    $question = Question::find($question_id);
    // Additional logic for editing the question
    $subjects = Subject::all();
    return view('questions.edit_question', compact('question', 'subjects'));
}

public function updateQuestion(Request $request, $q_id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'subject_id' => 'required|exists:subjects,s_id',
        // Add other validation rules for other columns here
    ]);

    // Get the question by ID
    $question = Question::find($q_id);

    // Update the question data with the validated data
    $question->title = $validatedData['title'];
    $question->description = $validatedData['description'];
    $question->s_id = $validatedData['subject_id'];
    // Add other updates for other columns here

     // Initialize image field as an empty array if it is null
     $question->image = $question->image ? json_decode($question->image, true) : [];

    // Handle new images
    if ($request->hasFile('new_images')) {
        $newImages = [];
        foreach ($request->file('new_images') as $newImage) {
            $imageName = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move(public_path('images'), $imageName);
            $newImages[] = 'images/' . $imageName;
        }
        $currentImages = $question->image;
        $allImages = array_merge($currentImages, $newImages);
        $question->image = json_encode($allImages);
    }

     // Handle deleted images
     if ($request->has('deleted_images')) {
        $deletedImages = json_decode($request->input('deleted_images'), true);
        if (!empty($deletedImages)) {
            if($request->hasFile('new_images')){
                $currentImages = $allImages;
            } else {
                $currentImages = $question->image;
            }
            $updatedImages = array_diff($currentImages, $deletedImages);
            $question->image = !empty($updatedImages) ? json_encode($updatedImages) : null;

             // Delete the image files from the server
             foreach ($deletedImages as $deletedImage) {
                if (file_exists(public_path($deletedImage))) {
                    unlink(public_path($deletedImage));
                }
            }
        }
    }

    // Save the updated question
    $question->save();

    // Redirect to the question view page or any other page as needed
    return redirect()->route('my_profile', ['q_id' => $q_id])->with('success', 'Question updated successfully!');
}

public function showSearchQuestions()
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('message', 'Please log in to access this feature.');
    }

    return view('questions.searchQuestions');
}

public function searchQuestions(Request $request)
{
    $search = $request->input('search');

    if (!empty($search)) {
        $questions = Question::where('title', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%')
                            ->get();
    } else {
        $questions = []; // No search term provided, so no results
    }

    return view('questions.searchQuestions', ['questions' => $questions]);
}



}
